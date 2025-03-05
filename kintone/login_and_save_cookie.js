// login_and_save_cookie.js の修正版
require("dotenv").config();
const puppeteer = require("puppeteer");
const fs = require("fs");
const path = require("path");

const LSTEP_LOGIN_URL = "https://manager.linestep.net/account/login";
const COOKIE_FILE = path.join(__dirname, "lstep_cookies.json");

const loginToLStep = async () => {
	const browser = await puppeteer.launch({
		headless: false, // GUIを開いて確認
		args: [
			"--disable-features=SameSiteByDefaultCookies,CookiesWithoutSameSiteMustBeSecure",
			"--disable-blink-features=AutomationControlled",
		],
	});
	const page = await browser.newPage();

	try {
		console.log("🚀 Lステップに手動ログインを開始...");
		await page.goto(LSTEP_LOGIN_URL, {
			waitUntil: "networkidle2",
			timeout: 60000,
		});

		// ID & パスワードを入力
		await page.type('input[name="name"]', process.env.LSTEP_ID);
		await page.type('input[name="password"]', process.env.LSTEP_PASSWORD);
		await page.click('button[type="submit"]');

		// 手動で reCAPTCHA を突破し、ログイン
		console.log("🛑 手動で reCAPTCHA を突破してログインしてください...");
		console.log("🛑 ログイン完了したら、任意のキーを押してください...");
		
		// ユーザーが手動でログインするのを待つ（120秒に延長）
		// この間にreCAPTCHAを突破してログインする
		await page.waitForNavigation({ 
			waitUntil: "networkidle2", 
			timeout: 120000 
		}).catch(e => console.log("ナビゲーション待機中: 手動でログインを続けてください"));
		
		// ユーザーがログインを完了するのを待つ
		// プロンプトでユーザー入力を待つなどの方法もあります
		// 簡易的な方法として、しばらく待機
		await new Promise(resolve => setTimeout(resolve, 5000));
		
		// ログイン後のページにいるか確認
		const currentUrl = await page.url();
		console.log(`現在のURL: ${currentUrl}`);
		
		if (currentUrl.includes('/account/login')) {
			console.log("❌ まだログインページにいます。ログインが完了していません。");
			return;
		}

		// ログイン後の Cookie を取得
		const cookies = await page.cookies();
		if (cookies && cookies.length > 0) {
			// Cookie を JSON 形式で保存
			fs.writeFileSync(COOKIE_FILE, JSON.stringify(cookies, null, 2));
			console.log(`✅ セッション Cookie を保存しました！ (${COOKIE_FILE})`);
		} else {
			console.log("❌ Cookie が取得できませんでした。");
		}
		
	} catch (error) {
		console.error("❌ エラーが発生しました:", error.message);
	} finally {
		// 最後にブラウザを閉じる前に少し待機
		await new Promise(resolve => setTimeout(resolve, 3000));
		await browser.close();
	}
};

// スクリプトを実行
loginToLStep();