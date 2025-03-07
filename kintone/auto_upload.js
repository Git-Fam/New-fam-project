require('dotenv').config();
const puppeteer = require('puppeteer');
const fs = require('fs');
const path = require('path');
const cron = require('node-cron');
const crypto = require('crypto'); // ハッシュ計算用に追加

// 設定
const LSTEP_LOGIN_URL = 'https://manager.linestep.net/account/login';
const LSTEP_UPLOAD_URL = 'https://manager.linestep.net/line/importer';
const COOKIE_FILE = path.join(__dirname, 'lstep_cookies.json');
const CSV_FILE_PATH = path.resolve(__dirname, 'kintoneData.csv');
const UPLOAD_SCHEDULE = '30 8 * * *'; // 毎日朝8時半に実行（cron形式）
// const UPLOAD_SCHEDULE = '*/30 1 * * * *'; // 1分半に実行（cron形式）テスト

// Lステップにログインしてクッキーを保存する関数
const loginToLStep = async (forceNewLogin = false) => {
  // クッキーが存在し、強制ログインでない場合
  if (!forceNewLogin && fs.existsSync(COOKIE_FILE)) {
    try {
      const cookies = JSON.parse(fs.readFileSync(COOKIE_FILE, 'utf8'));

      const browser = await puppeteer.launch({
        headless: true,
        args: [
          '--disable-features=SameSiteByDefaultCookies,CookiesWithoutSameSiteMustBeSecure',
          '--disable-blink-features=AutomationControlled',
        ],
      });

      const page = await browser.newPage();
      await page.setCookie(...cookies);

      // ログインページにアクセスしてセッションを確認
      await page.goto(LSTEP_UPLOAD_URL, { waitUntil: 'networkidle2' });

      // セッションが有効かチェック
      const currentUrl = await page.url();
      if (!currentUrl.includes('/account/login')) {
        console.log('✅ 既存のセッションを使用してログインしました');
        await browser.close();
        return true;
      }

      await browser.close();
    } catch (error) {
      console.warn('⚠️ 保存されたCookieの使用に失敗しました。新規ログインを試みます。');
    }
  }

  // 初回または強制ログイン時のみ手動操作
  const browser = await puppeteer.launch({
    headless: false, // 初回のみ非ヘッドレスモード
    args: [
      '--disable-features=SameSiteByDefaultCookies,CookiesWithoutSameSiteMustBeSecure',
      '--disable-blink-features=AutomationControlled',
    ],
  });
  
  const page = await browser.newPage();

  try {
    // ログインページにアクセス
    await page.goto(LSTEP_LOGIN_URL, {
      waitUntil: 'networkidle2',
      timeout: 60000,
    });

    // ログイン情報を入力
    await page.type('input[name="name"]', process.env.LSTEP_ID);
    await page.type('input[name="password"]', process.env.LSTEP_PASSWORD);
    await page.click('button[type="submit"]');

    console.log('⚠️ reCAPTCHAを手動で解決してください...');

    // ユーザーが手動でreCAPTCHAを解決し、ログインが完了するのを待つ
    await page.waitForNavigation({ 
      waitUntil: 'networkidle2', 
      timeout: 120000 
    }).catch(() => console.log('待機継続中...'));

    // 追加の待機時間
    await new Promise(resolve => setTimeout(resolve, 5000));

    // ログイン状態を確認
    const currentUrl = await page.url();
    if (currentUrl.includes('/account/login')) {
      console.error('❌ ログインに失敗しました。reCAPTCHAが解決されていない可能性があります。');
      await browser.close();
      return false;
    }

    // クッキーを保存
    const cookies = await page.cookies();
    if (!cookies || cookies.length === 0) {
      console.error('❌ クッキーを取得できませんでした。');
      await browser.close();
      return false;
    }

    fs.writeFileSync(COOKIE_FILE, JSON.stringify(cookies, null, 2));
    console.log('✅ セッションクッキーを保存しました！');

    await browser.close();
    return true;

  } catch (error) {
    console.error('❌ ログイン中にエラーが発生しました:', error.message);
    await browser.close();
    return false;
  }
};

// CSVをアップロードする関数
const uploadCSVToLStep = async () => {
  console.log('📤 CSVアップロード処理を開始...');

  // クッキーの存在確認
  let cookies;
  if (!fs.existsSync(COOKIE_FILE)) {
    console.log('⚠️ クッキーファイルが見つかりません。ログインを実行します...');
    const loginSuccess = await loginToLStep();
    if (!loginSuccess) return false;
  }

  try {
    cookies = JSON.parse(fs.readFileSync(COOKIE_FILE, 'utf8'));
  } catch (error) {
    console.error('❌ クッキーファイルの読み込みに失敗しました:', error.message);
    const loginSuccess = await loginToLStep();
    if (!loginSuccess) return false;
    cookies = JSON.parse(fs.readFileSync(COOKIE_FILE, 'utf8'));
  }

  const browser = await puppeteer.launch({
    headless: true, // 通常の実行はヘッドレスで
    args: [
      '--disable-features=SameSiteByDefaultCookies,CookiesWithoutSameSiteMustBeSecure',
      '--disable-blink-features=AutomationControlled',
    ],
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
      console.log('⚠️ セッションが無効です。再ログインします...');
      await browser.close();
      const loginSuccess = await loginToLStep();
      if (!loginSuccess) return false;
      return await uploadCSVToLStep(); // 再帰的に再試行
    }

    // CSVファイルをアップロード
    const fileInput = await page.$('input[name="csv"]');
    if (!fileInput) {
      console.error('❌ ファイル選択要素が見つかりません。');
      await browser.close();
      return false;
    }

    await fileInput.uploadFile(CSV_FILE_PATH);
    console.log('✅ CSVファイルを選択しました');

    // アップロードボタンをクリック
    const uploadButton = await page.$('input[type="submit"][value="CSVアップロード"]');
    if (!uploadButton) {
      console.error('❌ アップロードボタンが見つかりません。');
      await browser.close();
      return false;
    }

    await uploadButton.click();
    console.log('✅ アップロードボタンをクリックしました');

    // ページ遷移を待機
    await page
      .waitForNavigation({ waitUntil: 'networkidle2', timeout: 30000 })
      .catch((e) => console.log('ナビゲーション待機中:', e.message));

    // 「このデータを反映する」ボタンを探して押す
    let confirmButton = await page.$('input.btn.btn-primary[value="このデータを反映する"]');
    if (!confirmButton) {
      // 他の可能性のあるセレクタも試す
      confirmButton = await page.$(
        '.btn.btn-primary[value="このデータを反映する"], input[type="submit"][value="このデータを反映する"]'
      );
    }

    if (!confirmButton) {
      console.error('❌ 「このデータを反映する」ボタンが見つかりません。');

      // デバッグ情報を収集
      const buttonsInfo = await page.$$eval(
        'button, input[type="submit"]',
        (buttons) =>
          buttons.map((b) => ({
            type: b.tagName,
            value: b.value || b.textContent,
            id: b.id,
            class: b.className,
          }))
      );

      console.log('ページ上のボタン:', JSON.stringify(buttonsInfo, null, 2));
      await page.screenshot({ path: 'error_confirmation.png', fullPage: true });
      await browser.close();
      return false;
    }

    await confirmButton.click();
    console.log('✅ 「このデータを反映する」ボタンをクリックしました');

    // 最終処理の完了を待機
    await page
      .waitForNavigation({ waitUntil: 'networkidle2', timeout: 30000 })
      .catch((e) => console.log('最終ナビゲーション待機中:', e.message));

    console.log('✅ CSVアップロードと反映が完了しました！');
    await browser.close();
    return true;
  } catch (error) {
    console.error('❌ CSV処理中にエラーが発生しました:', error.message);
    await page.screenshot({ path: 'error_screenshot.png', fullPage: true });
    await browser.close();
    return false;
  }
};

// ファイルの内容からハッシュを計算する関数
const getFileHash = (filePath) => {
  try {
    const fileContent = fs.readFileSync(filePath);
    return crypto.createHash('md5').update(fileContent).digest('hex');
  } catch (error) {
    console.error(`❌ ファイル ${filePath} のハッシュ計算エラー:`, error.message);
    return null;
  }
};

// 前回のハッシュ値を保存する変数
let lastFileHash = null;

// CSVファイルの変更を確認する関数（ハッシュベース）
const checkCSVChanges = () => {
  try {
    // ファイルが存在するか確認
    if (!fs.existsSync(CSV_FILE_PATH)) {
      console.log(`⚠️ ファイル ${CSV_FILE_PATH} が見つかりません`);
      return false;
    }

    // 現在のファイルのハッシュを計算
    const currentHash = getFileHash(CSV_FILE_PATH);
    
    // ハッシュの計算に失敗した場合
    if (currentHash === null) {
      return false;
    }

    // 初回または内容が変更された場合
    if (lastFileHash === null || currentHash !== lastFileHash) {
      console.log('📝 ファイル内容に変更を検出しました');
      
      // ハッシュが変わった場合はタイムスタンプだけでなく内容も変更されたと判断
      if (lastFileHash !== null) {
        console.log(`🔄 前回: ${lastFileHash} → 今回: ${currentHash}`);
      }
      
      lastFileHash = currentHash;
      return true;
    }
    
    console.log('📝 ファイル内容に変更はありません (ハッシュ: ' + currentHash.substring(0, 8) + '...)');
    return false;
  } catch (error) {
    console.error('❌ ファイル変更検出エラー:', error.message);
    return false;
  }
};

// メイン処理
(async () => {
  console.log('🚀 自動化サービスを起動しました');

  // 毎日朝8時にログインしてクッキーを更新
  cron.schedule(UPLOAD_SCHEDULE, async () => {
    console.log('\n⏰ 定期的なログインを実行します');
    await loginToLStep(true);
  });

  // 起動時に現在のファイルハッシュを計算
  if (fs.existsSync(CSV_FILE_PATH)) {
    lastFileHash = getFileHash(CSV_FILE_PATH);
    console.log(`📊 初期ファイルハッシュ: ${lastFileHash}`);
  }

  // ファイル監視と変更時のアップロード
  setInterval(async () => {
    if (checkCSVChanges()) {
      console.log('🔄 CSVファイルの内容変更を検出しました！アップロードを実行します');
      await uploadCSVToLStep();
    }
  }, 30000); // 30秒ごとにチェック

  // 起動時に1回ログイン
  await loginToLStep();
})();