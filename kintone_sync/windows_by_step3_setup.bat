@echo off
chcp 65001 > nul
setlocal enabledelayedexpansion

echo pm2をグローバルにインストールしています...
npm install -g pm2
if %errorlevel% neq 0 (
    echo エラー: pm2のインストールに失敗しました。
    pause
    exit /b 1
)

rem 2秒間待機
timeout /t 2 /nobreak > nul

echo すべてのインストールが完了しました。

endlocal