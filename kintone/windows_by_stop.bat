@echo off
chcp 65001 > nul
cd /d %~dp0\app

echo アプリケーションを停止しています...
npm run stop:all
if %errorlevel% neq 0 (
  echo エラー: アプリケーションの停止に失敗しました。
  exit /b 1
)

echo PM2プロセスを削除しています...
pm2 delete fetchKintoneData
if %errorlevel% neq 0 (
  echo エラー: fetchKintoneDataプロセスの削除に失敗しました。
  exit /b 1
)

pm2 delete auto_upload
if %errorlevel% neq 0 (
  echo エラー: auto_uploadプロセスの削除に失敗しました。
  exit /b 1
)

pm2 save
if %errorlevel% neq 0 (
  echo エラー: PM2の状態保存に失敗しました。
  exit /b 1
)

echo アプリケーションが正常に停止されました。
pause