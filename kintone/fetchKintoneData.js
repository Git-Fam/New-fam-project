require('dotenv').config();
const fetch = require('node-fetch');
const fs = require('fs');
const { parse } = require('json2csv');
const cron = require('node-cron');
const appID = 17;

const fetchKintoneData = async () => {
    try {
        const urlBase = `https://fullcomunication.cybozu.com/k/v1/records.json?app=${appID}&totalCount=true`;
        const authToken = process.env.KINTONE_PASS;


        if (!authToken) {
            throw new Error("環境変数 KINTONE_PASS が設定されていません！.env を確認してください。");
        }

        console.log("🚀 Fetching data from Kintone...");

        let allRecords = [];
        let offset = 0;
        const limit = 100; // Kintone API の 1 回の取得上限
        let totalRecords = 0;

        // まず totalCount を取得（全件数を把握する）
        const initialResponse = await fetch(urlBase, {
            method: 'GET',
            headers: {
                'X-Cybozu-Authorization': authToken
            }
        });

        if (!initialResponse.ok) {
            const errorText = await initialResponse.text();
            console.error(`❌ Error! HTTP Status: ${initialResponse.status}`);
            console.error("Response Body:", errorText);
            throw new Error(`HTTP error! Status: ${initialResponse.status}`);
        }

        const initialData = await initialResponse.json();
        totalRecords = parseInt(initialData.totalCount, 10) || 0;

        console.log(`📊 Kintone に存在するレコード数: ${totalRecords} 件`);

        // もしデータが 1 件もない場合は終了
        if (totalRecords === 0) {
            console.log("✅ No records found. Exiting...");
            return;
        }

        while (offset < totalRecords) {
            const url = `https://fullcomunication.cybozu.com/k/v1/records.json?app=${appID}&limit=${limit}&offset=${offset}`;
            console.log(`🔄 Fetching records from offset ${offset}...`);

            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'X-Cybozu-Authorization': authToken
                }
            });

            if (!response.ok) {
                const errorText = await response.text();
                console.error(`❌ Error! HTTP Status: ${response.status}`);
                console.error("Response Body:", errorText);
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();

            if (!data.records || data.records.length === 0) {
                console.log("✅ No more records found. Stopping data fetch.");
                break;
            }

            allRecords = allRecords.concat(data.records);
            offset += limit;
        }

        console.log(`✅ Successfully fetched ${allRecords.length} records from Kintone!`);

        // CSVに変換して保存
        saveDataAsCSV(allRecords);

    } catch (error) {
        console.error("❌ Error fetching data:", error.message);
    }
};

// JSONデータをCSVに変換して保存
const saveDataAsCSV = (records) => {
    if (!records || records.length === 0) {
        console.error("❌ No records found.");
        return;
    }

    try {
        const formattedData = records.map(record => ({
            ID: record["文字列__1行__42"]?.value || "",
            表示名: record["文字列__1行__33"]?.value || "",
            TraiL_ID: record["文字列__1行__19"]?.value || "",
            申込日: record["文字列__1行__36"]?.value || "",
            申し込み完了日: record["文字列__1行__37"]?.value || "",
            ステータス: record["文字列__1行__30"]?.value || "",
            代理店ID: record["文字列__1行__21"]?.value || "",
            代理店顧客ID: record["文字列__1行__23"]?.value || "",
            端末配送希望日: record["文字列__1行__43"]?.value || "",
            所属会社: record["ドロップダウン_4"]?.value || "",
            出荷日: record["文字列__1行__44"]?.value || "",
            解約日: record["文字列__1行__38"]?.value || ""

        }));

        // JSON → CSV 変換
        const csv = parse(formattedData);

        // "登録ID"をCSVの先頭に追加
        const header = '"登録ID","","友だち情報_2104833","友だち情報_2102021","友だち情報_2102020","友だち情報_2104441","友だち情報_2104443","友だち情報_2104444","友だち情報_2104445","友だち情報_2104446","友だち情報_2104447","友だち情報_2104841"\n';
        const csvWithHeader = header + csv;

        // CSVファイルに書き込み Shift JISで
        const iconv = require('iconv-lite');
        fs.writeFileSync("kintoneData.csv", iconv.encode(csvWithHeader, 'Shift_JIS'));

        console.log(`✅ CSV file saved with ${records.length} records: kintoneData.csv (Shift-JIS encoded)`);
    } catch (error) {
        console.error("❌ Error converting data to CSV:", error.message);
    }
};

const minute = '* * * * *'; // 1分ごとに実行（テスト）
const day = '0 8 * * *'; // 毎日朝8時に実行 (本番)

// cronジョブの設定
cron.schedule(day, async () => {
    console.log('🕒 Starting scheduled Kintone data fetch at:', new Date().toLocaleString());
    await fetchKintoneData();
});

// 直接実行時の処理
if (require.main === module) {
    console.log('🚀 Running immediate fetch...');
    fetchKintoneData();
}

// モジュールとしてエクスポート
module.exports = { fetchKintoneData };