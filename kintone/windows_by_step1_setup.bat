@echo off
chcp 65001 > nul
setlocal enabledelayedexpansion

rem Node.jsのバージョンを指定
set NODE_VERSION=node-v20.8.0-x64
rem Node.jsのダウンロードURL
set NODE_URL=https://nodejs.org/dist/v20.8.0/%NODE_VERSION%.msi

rem このバッチファイルがあるディレクトリを取得
set CURRENT_DIR=%~dp0
rem appフォルダへのパスを設定（同じ階層にある想定）
set APP_PATH=%CURRENT_DIR%app

rem appフォルダが存在するか確認
if not exist "%APP_PATH%" (
    echo エラー: appフォルダが見つかりません: "%APP_PATH%"
    echo このバッチファイルはkintoneフォルダ内に配置し、同じ階層にappフォルダが必要です。
    pause
    exit /b 1
)

rem 一時ディレクトリに移動
cd /d %TEMP%

rem コマンドを別々に実行して文字化けを防止
echo Node.jsをダウンロードしています...
curl -o nodejs.msi %NODE_URL%
if %errorlevel% neq 0 (
    echo エラー: Node.jsのダウンロードに失敗しました。
    pause
    exit /b 1
)

echo Node.jsをインストールしています...
msiexec /i nodejs.msi /quiet /norestart
if %errorlevel% neq 0 (
    echo エラー: Node.jsのインストールに失敗しました。
    pause
    exit /b 1
)

rem 2秒間待機
timeout /t 2 /nobreak > nul

rem インストーラーを削除
del nodejs.msi

rem 2秒間待機
timeout /t 2 /nobreak > nul

echo Node.jsのインストールが完了しました。

endlocal
pause