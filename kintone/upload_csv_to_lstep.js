const puppeteer = require('puppeteer');
const fs = require('fs');
const path = require('path');

const LSTEP_UPLOAD_URL = 'https://manager.linestep.net/line/importer';
const COOKIE_FILE = path.join(__dirname, 'lstep_cookies.json');
const CSV_FILE_PATH = path.resolve(__dirname, 'kintoneData.csv');

const uploadCSVToLStep = async () => {
    // CSVファイルの存在確認
    if (!fs.existsSync(CSV_FILE_PATH)) {
        console.error(`❌ CSVファイルが見つかりません: ${CSV_FILE_PATH}`);
        return;
    } else {
        console.log(`✅ CSVファイルを確認: ${CSV_FILE_PATH}`);
        // ファイルサイズの確認
        const stats = fs.statSync(CSV_FILE_PATH);
        console.log(`ファイルサイズ: ${stats.size} バイト`);
    }

    const browser = await puppeteer.launch({
        headless: false, // GUIを開いて確認
        args: [
            '--disable-features=SameSiteByDefaultCookies,CookiesWithoutSameSiteMustBeSecure',
            '--disable-blink-features=AutomationControlled'
        ]
    });
    const page = await browser.newPage();

    try {
        console.log("🚀 Lステップの CSV アップロードページにアクセス...");

        // Cookieの存在確認
        if (!fs.existsSync(COOKIE_FILE)) {
            console.error("❌ Cookieファイルが見つかりません！");
            return;
        }
        
        let cookies = JSON.parse(fs.readFileSync(COOKIE_FILE, 'utf8'));
        await page.setCookie(...cookies);
        console.log("✅ Cookie を適用しました！");

        // アップロードページへ移動
        await page.goto(LSTEP_UPLOAD_URL, { waitUntil: 'networkidle2' });
        
        // 現在のURLを確認
        const currentUrl = await page.url();
        console.log(`✅ 現在のページURL: ${currentUrl}`);

        // ログインページにリダイレクトされた場合の処理
        if (currentUrl.includes('/account/login')) {
            console.error("❌ ログインが必要です！セッションが切れている可能性があります。");
            return;
        }

        // CSVファイル入力フィールドの待機と検出
        console.log("🔍 CSVファイル入力フィールドを探しています...");
        await page.waitForSelector('input[name="csv"]', { timeout: 10000 })
            .catch(e => console.error("❌ CSVファイル入力フィールドが見つかりません:", e.message));

        // ファイル選択ダイアログをデバッグ
        page.on('dialog', async dialog => {
            console.log('ダイアログが表示されました:', dialog.message());
            await dialog.accept();
        });

        // CSVファイルをアップロード
        console.log("📂 CSVファイルをアップロード...");
        const fileInput = await page.$('input[name="csv"]');
        if (!fileInput) {
            console.error("❌ ファイル入力要素が見つかりません！");
            return;
        }
        
        // ファイルアップロード
        await fileInput.uploadFile(CSV_FILE_PATH);
        console.log("✅ ファイルを選択しました");

        // アップロードボタンを探す
        console.log("🔍 アップロードボタンを探しています...");
        const uploadButton = await page.$('input[type="submit"][value="CSVアップロード"]');
        if (!uploadButton) {
            console.error("❌ アップロードボタンが見つかりません！");
            // ページ上の全てのボタンをリスト
            const allButtons = await page.$$eval('button, input[type="submit"]', buttons => 
                buttons.map(b => ({ 
                    type: b.tagName, 
                    value: b.value || b.textContent, 
                    id: b.id, 
                    class: b.className 
                }))
            );
            console.log("ページ上のボタン:", JSON.stringify(allButtons, null, 2));
            return;
        }

        // アップロードボタンをクリック
        await uploadButton.click();
        console.log("✅ アップロードボタンをクリックしました");
        
        // アップロード完了を待機（少し長めに）
        await page.waitForNavigation({ waitUntil: 'networkidle2', timeout: 30000 })
            .catch(e => console.log("ナビゲーション待機中:", e.message));
        
        // アップロード後のURLを確認
        const afterUploadUrl = await page.url();
        console.log(`✅ アップロード後のページURL: ${afterUploadUrl}`);
        
        // 成功メッセージを確認
        const pageText = await page.evaluate(() => document.body.innerText);
        if (pageText.includes('成功') || pageText.includes('完了') || pageText.includes('アップロード')) {
            console.log("✅ CSV アップロード成功の可能性があります！");
        } else {
            console.log("⚠️ 成功メッセージが確認できません。アップロード状況を確認してください。");
        }

        // 操作の様子を確認するために少し待機
        await new Promise(resolve => setTimeout(resolve, 5000));
        console.log("✅ CSV アップロード処理が完了しました");

    } catch (error) {
        console.error("❌ アップロード中にエラー発生:", error.message);
    } finally {
        // スクリーンショットを撮影
        await page.screenshot({ path: 'upload_result.png', fullPage: true });
        console.log("📸 スクリーンショットを保存しました: upload_result.png");
        
        await browser.close();
    }
};

// スクリプトを実行
uploadCSVToLStep();