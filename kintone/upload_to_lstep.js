require('dotenv').config();
const { Builder, By, Key, until } = require('selenium-webdriver');
const path = require('path');

const uploadToLStep = async () => {
    // Chrome のヘッドレス（GUIなし）モードで起動
    let driver = await new Builder()
        .forBrowser('chrome')
        .setChromeOptions({ args: ['--headless', '--no-sandbox', '--disable-dev-shm-usage'] }) // 本番環境用
        .build();

    try {
        console.log("🚀 Lステップにログイン中...");

        // Lステップのログインページを開く
        await driver.get('https://manager.linestep.net/account/login');

        // メールアドレスとパスワードを入力
        await driver.findElement(By.name('id')).sendKeys(process.env.LSTEP_ID);
        await driver.findElement(By.name('password')).sendKeys(process.env.LSTEP_PASSWORD, Key.RETURN);

        // ダッシュボードに遷移するまで待機
        await driver.wait(until.urlContains('/account'), 10000);
        console.log("✅ ログイン成功");

        // CSVアップロードページへ移動
        await driver.get(process.env.LSTEP_UPLOAD_URL); // Lステップの実際のアップロードページURLを設定

        // CSVファイルのアップロード
        let fileInput = await driver.findElement(By.name('csv')); // アップロードボタンの input 要素
        let filePath = path.resolve(__dirname, 'kintone_data.csv'); // CSVファイルのパス
        await fileInput.sendKeys(filePath);

        // アップロードボタンをクリック
        let uploadButton = await driver.findElement(By.xpath("//input[@type='submit' and @value='CSVアップロード']")); // `value="CSVアップロード"` のボタンを探す
        await uploadButton.click();

        console.log("✅ CSV アップロード成功！");

    } catch (error) {
        console.error("❌ アップロード中にエラー発生:", error);
    } finally {
        await driver.quit();
    }
};

// 実行
uploadToLStep();
