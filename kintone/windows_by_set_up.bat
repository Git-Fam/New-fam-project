@echo off
cd /d %~dp0\app

echo Node.jsをインストールしています...
curl -o nodejs.msi https://nodejs.org/dist/v18.17.1/node-v18.17.1-x64.msi
if %errorlevel% neq 0 (
  echo エラー: Node.jsのダウンロードに失敗しました。
  exit /b 1
)

msiexec /i nodejs.msi /quiet /norestart
if %errorlevel% neq 0 (
  echo エラー: Node.jsのインストールに失敗しました。
  exit /b 1
)

echo 必要なパッケージをインストールしています...
npm install
if %errorlevel% neq 0 (
  echo エラー: npmパッケージのインストールに失敗しました。
  exit /b 1
)

echo セットアップが完了しました。
del nodejs.msi
pause