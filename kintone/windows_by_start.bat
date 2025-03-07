@echo off
cd /d %~dp0\app

echo アプリケーションを開始しています...
npm run start:all
if %errorlevel% neq 0 (
   echo エラー: アプリケーションの開始に失敗しました。
   exit /b 1
)

echo アプリケーションが正常に開始されました。
pause