const puppeteer = require('puppeteer');
const fs = require('fs');

const LSTEP_DASHBOARD_URL = 'https://manager.linestep.net/account';
const COOKIE_FILE = 'lstep_cookies.json';

const accessLStepWithSession = async () => {
    const browser = await puppeteer.launch({ headless: true });
    const page = await browser.newPage();

    try {
        console.log("🚀 Lステップのダッシュボードにアクセス...");

        // **保存された Cookie を適用**
        if (!fs.existsSync(COOKIE_FILE)) {
            console.log("⚠️ セッション Cookie が存在しません！手動でログインしてください。");
            return;
        }
        const cookies = JSON.parse(fs.readFileSync(COOKIE_FILE, 'utf8'));
        await page.setCookie(...cookies);

        // **ダッシュボードにアクセス**
        await page.goto(LSTEP_DASHBOARD_URL, { waitUntil: 'networkidle2' });

        console.log("✅ ダッシュボードにアクセス成功！");
    } catch (error) {
        console.error("❌ ダッシュボードにアクセスできません:", error.message);
    } finally {
        await browser.close();
    }
};

// **スクリプトを実行**
accessLStepWithSession();
