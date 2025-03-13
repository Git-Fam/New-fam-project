@echo off
chcp 65001 > nul
cd /d %~dp0\app

echo アプリケーションを開始しています...
npm run start:all
if %errorlevel% neq 0 (
   echo エラー: アプリケーションの開始に失敗しました。
   pause >nul
   exit /b 1
)

echo アプリケーションが正常に開始されました。
echo.
echo スクリプトが完了しました。続行するには何かキーを押してください...
pause
cmd /k
