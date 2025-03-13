@echo off
chcp 65001 > nul

rem 管理者権限チェックと昇格
>nul 2>&1 "%SYSTEMROOT%\system32\cacls.exe" "%SYSTEMROOT%\system32\config\system"
if %errorlevel% neq 0 (
    echo 管理者権限で実行します...
    powershell -Command "Start-Process '%~dpnx0' -Verb RunAs"
    exit /b
)

setlocal enabledelayedexpansion

echo pm2をグローバルにインストールしています...
call npm install -g pm2
if %errorlevel% neq 0 (
    echo エラー: pm2のインストールに失敗しました。
    pause
    exit /b 1
)

rem 2秒間待機
timeout /t 2 /nobreak > nul

rem PM2のホームディレクトリを設定
set PM2_HOME=%USERPROFILE%\.pm2

rem PM2デーモンを停止（既に実行中の場合）
echo 既存のPM2プロセスをクリーンアップしています...
taskkill /F /IM "pm2*" /T > nul 2>&1

rem .pm2ディレクトリをクリーンアップ
if exist "%PM2_HOME%" (
    rd /s /q "%PM2_HOME%"
)
mkdir "%PM2_HOME%"

rem PM2デーモンを初期化
echo PM2デーモンを初期化しています...
call pm2 kill
timeout /t 2 /nobreak > nul

rem Windows用のスタートアップスクリプトを作成
echo PM2をWindowsスタートアップに登録しています...
call pm2 startup
if %errorlevel% neq 0 (
    echo エラー: PM2スタートアップの設定に失敗しました。
    pause
    exit /b 1
)

rem デーモンの状態を確認
echo PM2デーモンの状態を確認しています...
call pm2 list
if %errorlevel% neq 0 (
    echo エラー: PM2デーモンの起動確認に失敗しました。
    pause
    exit /b 1
)

echo すべてのインストールが完了しました。

endlocal