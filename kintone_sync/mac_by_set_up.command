#!/bin/bash
cd "$(dirname "$0")/app"

# Node.jsのインストール（macOS/Linux用）
echo "Installing Node.js..."
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.5/install.sh | bash
if [ $? -ne 0 ]; then
  echo "Error: Failed to install Node.js."
  exit 1
fi

# NVMを使ってNode.jsをインストール
export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"
nvm install 20
if [ $? -ne 0 ]; then
  echo "Error: Failed to install Node.js version 20."
  exit 1
fi

nvm use 20
if [ $? -ne 0 ]; then
  echo "Error: Failed to use Node.js version 20."
  exit 1
fi

# 必要なパッケージのインストール
echo "Installing necessary packages..."
npm install
if [ $? -ne 0 ]; then
  echo "Error: Failed to install npm packages."
  exit 1
fi

echo "Setup complete."

# ターミナルを閉じる
osascript -e 'tell application "Terminal" to close first window' & exit