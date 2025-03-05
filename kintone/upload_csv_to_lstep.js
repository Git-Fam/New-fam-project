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
        
        // 「このデータを反映する」ボタンを探す
        console.log("🔍 「このデータを反映する」ボタンを探しています...");
        await page.waitForSelector('input.btn.btn-primary[value="このデータを反映する"]', { timeout: 10000 })
            .catch(e => console.log("ボタン待機中:", e.message));
            
        const confirmButton = await page.$('input.btn.btn-primary[value="このデータを反映する"]');
        if (!confirmButton) {
            console.error("❌ 「このデータを反映する」ボタンが見つかりません！");
            // 他に可能性のあるセレクタを試す
            const possibleButtons = await page.$$('input.btn.btn-primary, input[type="submit"].btn-primary, button.btn.btn-primary');
            console.log(`可能性のあるボタンが ${possibleButtons.length} 個見つかりました`);
            
            if (possibleButtons.length > 0) {
                console.log("一致する可能性のあるボタンをクリックします...");
                await possibleButtons[0].click();
                console.log("✅ ボタンをクリックしました");
            } else {
                // ページ上の全てのボタンをリスト
                const allFinalButtons = await page.$$eval('button, input[type="submit"]', buttons => 
                    buttons.map(b => ({ 
                        type: b.tagName, 
                        value: b.value || b.textContent, 
                        id: b.id, 
                        class: b.className 
                    }))
                );
                console.log("ページ上のボタン:", JSON.stringify(allFinalButtons, null, 2));
                return;
            }
        } else {
            // 「このデータを反映する」ボタンをクリック
            await confirmButton.click();
            console.log("✅ 「このデータを反映する」ボタンをクリックしました");
        }
        
        // 最終処理の完了を待機
        await page.waitForNavigation({ waitUntil: 'networkidle2', timeout: 30000 })
            .catch(e => console.log("最終ナビゲーション待機中:", e.message));
            
        // 最終的なURLを確認
        const finalUrl = await page.url();
        console.log(`✅ 最終的なページURL: ${finalUrl}`);

        // 操作の様子を確認するために少し待機
        await new Promise(resolve => setTimeout(resolve, 5000));
        console.log("✅ 全ての処理が完了しました");

    } catch (error) {
        console.error("❌ 処理中にエラー発生:", error.message);
    } finally {
        // スクリーンショットを撮影
        await page.screenshot({ path: 'final_result.png', fullPage: true });
        console.log("📸 スクリーンショットを保存しました: final_result.png");
        
        await browser.close();
    }
};

// スクリプトを実行
uploadCSVToLStep();