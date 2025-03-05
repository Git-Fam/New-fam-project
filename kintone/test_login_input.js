require('dotenv').config();
const puppeteer = require('puppeteer');
const fs = require('fs');
const path = require('path');

const LSTEP_LOGIN_URL = 'https://manager.linestep.net/account/login';
const LSTEP_UPLOAD_URL = 'https://manager.linestep.net/line/importer';

const LOGIN_SESSION_FILE = 'session.json';

// **Lステップに自動ログインし、セッションを保存**
const loginToLStep = async () => {
    const browser = await puppeteer.launch({ headless: true });
    const page = await browser.newPage();

    try {
        console.log("🚀 Lステップに自動ログイン...");
        
        await page.goto(LSTEP_LOGIN_URL, { waitUntil: 'networkidle2' });

        // **ID & パスワード入力**
        await page.type('input[name="name"]', process.env.LSTEP_ID);
        await page.type('input[name="password"]', process.env.LSTEP_PASSWORD);
        await page.click('button[type="submit"]');

        // **ログイン完了待機**
        await page.waitForNavigation({ waitUntil: 'networkidle2' });

        // **Cookie を保存**
        const cookies = await page.cookies();
        fs.writeFileSync(LOGIN_SESSION_FILE, JSON.stringify(cookies));

        console.log("✅ セッションを保存しました！");

    } catch (error) {
        console.error("❌ ログインに失敗しました:", error.message);
    } finally {
        await browser.close();
    }
};

// **LステップにCSVをアップロード**
const uploadCSVToLStep = async () => {
    const browser = await puppeteer.launch({ headless: true });
    const page = await browser.newPage();

    try {
        console.log("🚀 LステップにCSVをアップロード...");

        // **保存されたセッション Cookie を読み込む**
        if (!fs.existsSync(LOGIN_SESSION_FILE)) {
            console.log("⚠️ セッションがないため、再ログインします...");
            await loginToLStep();
        }
        const cookies = JSON.parse(fs.readFileSync(LOGIN_SESSION_FILE, 'utf8'));
        await page.setCookie(...cookies);

        // **アップロードページへ移動**
        await page.goto(LSTEP_UPLOAD_URL, { waitUntil: 'networkidle2' });

        // **CSVファイルをアップロード**
        const filePath = path.resolve(__dirname, 'kintoneData.csv');
        const fileInput = await page.waitForSelector('input[name="csv"]');
        await fileInput.uploadFile(filePath);

        // **アップロードボタンをクリック**
        await page.click('input[type="submit"][value="CSVアップロード"]');
        console.log("✅ CSV アップロード成功！");

    } catch (error) {
        console.error("❌ アップロード中にエラー発生:", error.message);
    } finally {
        await browser.close();
    }
};

// **定期的にログインセッションを更新**
setInterval(async () => {
    console.log("🔄 セッション更新...");
    await loginToLStep();
}, 24 * 60 * 60 * 1000); // 24時間ごとに実行

// **定期的に CSV をアップロード**
setInterval(async () => {
    console.log("📤 CSVを自動アップロード...");
    await uploadCSVToLStep();
}, 60 * 60 * 1000); // 1時間ごとに実行

console.log("🚀 サーバー起動完了！");
