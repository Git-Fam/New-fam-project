@echo off
chcp 65001 > nul
setlocal enabledelayedexpansion

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


rem appディレクトリに移動
cd /d "%APP_PATH%"
if %errorlevel% neq 0 (
    echo エラー: appディレクトリに移動できませんでした。
    pause
    exit /b 1
)

rem 2秒間待機
timeout /t 2 /nobreak > nul

echo npm installを実行しています...
npm install --verbose
if %errorlevel% neq 0 (
    echo エラー: npm installに失敗しました。
    pause
    exit /b 1
)

rem 2秒間待機
timeout /t 2 /nobreak > nul

echo npm installが完了しました。

endlocal