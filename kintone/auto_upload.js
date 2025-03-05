require('dotenv').config();
const puppeteer = require('puppeteer');
const fs = require('fs');
const path = require('path');
const cron = require('node-cron');

// 設定
const LSTEP_LOGIN_URL = 'https://manager.linestep.net/account/login';
const LSTEP_UPLOAD_URL = 'https://manager.linestep.net/line/importer';
const COOKIE_FILE = path.join(__dirname, 'lstep_cookies.json');
const CSV_FILE_PATH = path.resolve(__dirname, 'kintoneData.csv');
const COOKIE_REFRESH_HOURS = 23; // クッキーを更新する間隔（時間）
const UPLOAD_SCHEDULE = '0 8 * * *'; // 毎日朝8時に実行（cron形式）

// Lステップにログインしてクッキーを保存する関数
const loginToLStep = async () => {
  console.log("🔐 Lステップにログイン開始...");
  
  const browser = await puppeteer.launch({
    headless: false, // 手動reCAPTCHA対応のため
    args: [
      '--disable-features=SameSiteByDefaultCookies,CookiesWithoutSameSiteMustBeSecure',
      '--disable-blink-features=AutomationControlled'
    ]
  });
  
  const page = await browser.newPage();
  
  try {
    // ログインページにアクセス
    await page.goto(LSTEP_LOGIN_URL, { waitUntil: 'networkidle2', timeout: 60000 });
    
    // ログイン情報を入力
    await page.type('input[name="name"]', process.env.LSTEP_ID);
    await page.type('input[name="password"]', process.env.LSTEP_PASSWORD);
    await page.click('button[type="submit"]');
    
    console.log("⚠️ reCAPTCHAを手動で解決してください...");
    
    // ユーザーが手動でreCAPTCHAを解決し、ログインが完了するのを待つ
    await page.waitForNavigation({ waitUntil: 'networkidle2', timeout: 120000 })
      .catch(() => console.log("待機継続中..."));
    
    // 追加の待機時間
    await new Promise(resolve => setTimeout(resolve, 5000));
    
    // ログイン状態を確認
    const currentUrl = await page.url();
    if (currentUrl.includes('/account/login')) {
      console.error("❌ ログインに失敗しました。reCAPTCHAが解決されていない可能性があります。");
      await browser.close();
      return false;
    }
    
    // クッキーを保存
    const cookies = await page.cookies();
    if (!cookies || cookies.length === 0) {
      console.error("❌ クッキーを取得できませんでした。");
      await browser.close();
      return false;
    }
    
    fs.writeFileSync(COOKIE_FILE, JSON.stringify(cookies, null, 2));
    console.log("✅ セッションクッキーを保存しました！");
    
    await browser.close();
    return true;
    
  } catch (error) {
    console.error("❌ ログイン中にエラーが発生しました:", error.message);
    await browser.close();
    return false;
  }
};

// CSVをアップロードする関数
const uploadCSVToLStep = async () => {
  console.log("📤 CSVアップロード処理を開始...");
  
  // CSVファイルの存在確認
  if (!fs.existsSync(CSV_FILE_PATH)) {
    console.error(`❌ CSVファイルが見つかりません: ${CSV_FILE_PATH}`);
    return false;
  }
  
  // クッキーの存在確認
  let cookies;
  if (!fs.existsSync(COOKIE_FILE)) {
    console.log("⚠️ クッキーファイルが見つかりません。ログインを実行します...");
    const loginSuccess = await loginToLStep();
    if (!loginSuccess) return false;
  }
  
  try {
    cookies = JSON.parse(fs.readFileSync(COOKIE_FILE, 'utf8'));
  } catch (error) {
    console.error("❌ クッキーファイルの読み込みに失敗しました:", error.message);
    const loginSuccess = await loginToLStep();
    if (!loginSuccess) return false;
    cookies = JSON.parse(fs.readFileSync(COOKIE_FILE, 'utf8'));
  }
  
  const browser = await puppeteer.launch({
    headless: true, // 通常の実行はヘッドレスで
    args: [
      '--disable-features=SameSiteByDefaultCookies,CookiesWithoutSameSiteMustBeSecure',
      '--disable-blink-features=AutomationControlled'
    ]
  });
  
  const page = await browser.newPage();
  
  try {
    // クッキーを設定
    await page.setCookie(...cookies);
    
    // アップロードページにアクセス
    await page.goto(LSTEP_UPLOAD_URL, { waitUntil: 'networkidle2' });
    
    // セッションが有効かチェック（リダイレクトされた場合）
    const currentUrl = await page.url();
    if (currentUrl.includes('/account/login')) {
      console.log("⚠️ セッションが無効です。再ログインします...");
      await browser.close();
      const loginSuccess = await loginToLStep();
      if (!loginSuccess) return false;
      return await uploadCSVToLStep(); // 再帰的に再試行
    }
    
    // CSVファイルをアップロード
    const fileInput = await page.$('input[name="csv"]');
    if (!fileInput) {
      console.error("❌ ファイル選択要素が見つかりません。");
      await browser.close();
      return false;
    }
    
    await fileInput.uploadFile(CSV_FILE_PATH);
    console.log("✅ CSVファイルを選択しました");
    
    // アップロードボタンをクリック
    const uploadButton = await page.$('input[type="submit"][value="CSVアップロード"]');
    if (!uploadButton) {
      console.error("❌ アップロードボタンが見つかりません。");
      await browser.close();
      return false;
    }
    
    await uploadButton.click();
    console.log("✅ アップロードボタンをクリックしました");
    
    // ページ遷移を待機
    await page.waitForNavigation({ waitUntil: 'networkidle2', timeout: 30000 })
      .catch(e => console.log("ナビゲーション待機中:", e.message));
    
    // 「このデータを反映する」ボタンを探して押す
    let confirmButton = await page.$('input.btn.btn-primary[value="このデータを反映する"]');
    if (!confirmButton) {
      // 他の可能性のあるセレクタも試す
      confirmButton = await page.$('.btn.btn-primary[value="このデータを反映する"], input[type="submit"][value="このデータを反映する"]');
    }
    
    if (!confirmButton) {
      console.error("❌ 「このデータを反映する」ボタンが見つかりません。");
      
      // デバッグ情報を収集
      const buttonsInfo = await page.$$eval('button, input[type="submit"]', buttons => 
        buttons.map(b => ({ 
          type: b.tagName, 
          value: b.value || b.textContent, 
          id: b.id, 
          class: b.className 
        }))
      );
      
      console.log("ページ上のボタン:", JSON.stringify(buttonsInfo, null, 2));
      await page.screenshot({ path: 'error_confirmation.png', fullPage: true });
      await browser.close();
      return false;
    }
    
    await confirmButton.click();
    console.log("✅ 「このデータを反映する」ボタンをクリックしました");
    
    // 最終処理の完了を待機
    await page.waitForNavigation({ waitUntil: 'networkidle2', timeout: 30000 })
      .catch(e => console.log("最終ナビゲーション待機中:", e.message));
    
    console.log("✅ CSVアップロードと反映が完了しました！");
    await browser.close();
    return true;
    
  } catch (error) {
    console.error("❌ CSV処理中にエラーが発生しました:", error.message);
    await page.screenshot({ path: 'error_screenshot.png', fullPage: true });
    await browser.close();
    return false;
  }
};

// Kintoneからデータを取得してCSVを作成する関数
const fetchKintoneData = async () => {
  console.log("📊 Kintoneからデータを取得してCSVを作成します...");
  
  try {
    // 既存のfetchKintoneData.jsのロジックをここに実装
    // あるいは子プロセスとして実行
    const { exec } = require('child_process');
    
    return new Promise((resolve, reject) => {
      exec('node fetchKintoneData.js', (error, stdout, stderr) => {
        if (error) {
          console.error(`❌ Kintoneデータ取得エラー: ${error.message}`);
          reject(error);
          return;
        }
        if (stderr) {
          console.error(`⚠️ Kintoneデータ取得の警告: ${stderr}`);
        }
        console.log(stdout);
        resolve(true);
      });
    });
    
  } catch (error) {
    console.error("❌ Kintoneデータ取得処理でエラーが発生しました:", error.message);
    return false;
  }
};

// クッキーを定期的に更新する関数
const refreshCookie = async () => {
  console.log("🔄 セッションクッキーを更新します...");
  return await loginToLStep();
};

// クッキーの有効期限を確認する関数
const isCookieValid = () => {
  if (!fs.existsSync(COOKIE_FILE)) return false;
  
  try {
    const cookies = JSON.parse(fs.readFileSync(COOKIE_FILE, 'utf8'));
    const now = new Date();
    
    // 少なくとも1つのクッキーが有効かチェック
    for (const cookie of cookies) {
      if (cookie.expires) {
        const expiryDate = new Date(cookie.expires * 1000); // 秒からミリ秒に変換
        if (expiryDate > now) return true;
      }
    }
    
    return false;
  } catch (error) {
    console.error("❌ クッキーファイルの読み込みに失敗しました:", error.message);
    return false;
  }
};

// 完全な自動化プロセスを実行する関数
const runFullProcess = async () => {
  const timestamp = new Date().toISOString();
  console.log(`\n===== 処理開始: ${timestamp} =====`);
  
  try {
    // クッキーの有効性チェック
    if (!isCookieValid()) {
      console.log("⚠️ 有効なクッキーがありません。ログインを実行します...");
      const loginSuccess = await loginToLStep();
      if (!loginSuccess) {
        console.error("❌ ログインに失敗しました。処理を中止します。");
        return;
      }
    }
    
    // Kintoneからデータを取得してCSVを作成
    const fetchSuccess = await fetchKintoneData();
    if (!fetchSuccess) {
      console.error("❌ データ取得に失敗しました。CSVアップロードをスキップします。");
      return;
    }
    
    // CSVをアップロード
    const uploadSuccess = await uploadCSVToLStep();
    if (!uploadSuccess) {
      console.error("❌ CSVアップロードに失敗しました。");
      return;
    }
    
    console.log("🎉 すべての処理が正常に完了しました！");
    
  } catch (error) {
    console.error("❌ 処理中に予期しないエラーが発生しました:", error.message);
  }
};

// ===== メイン処理 =====

// node-cronのインストールが必要
// npm install node-cron

// 定期的にクッキーを更新する（有効期限が切れる前に）
cron.schedule(`0 */${COOKIE_REFRESH_HOURS} * * *`, async () => {
  console.log(`\n⏰ 定期的なクッキー更新を実行します (${COOKIE_REFRESH_HOURS}時間ごと)`);
  await refreshCookie();
});

// 毎日朝8時にCSVをアップロードする
cron.schedule(UPLOAD_SCHEDULE, async () => {
  console.log("\n⏰ 毎日朝8時のCSVアップロードを実行します");
  await runFullProcess();
});

// 起動時に1回実行
(async () => {
  console.log("🚀 自動化サービスを起動しました");
  console.log(`📋 アップロードスケジュール: 毎日朝8時 (${UPLOAD_SCHEDULE})`);
  console.log(`🔑 クッキー更新間隔: ${COOKIE_REFRESH_HOURS}時間ごと`);
  
  // 初回実行
  await runFullProcess();
})();