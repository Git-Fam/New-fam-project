#!/bin/bash
cd "$(dirname "$0")/app"

# Stop the application
npm run stop:all
if [ $? -ne 0 ]; then
  echo "Error: Failed to stop the application."
  exit 1
fi

# Delete PM2 processes
pm2 delete fetchKintoneData
if [ $? -ne 0 ]; then
  echo "Error: Failed to delete fetchKintoneData process."
  exit 1
fi

pm2 delete auto_upload
if [ $? -ne 0 ]; then
  echo "Error: Failed to delete auto_upload process."
  exit 1
fi

# Save PM2 state
pm2 save
if [ $? -ne 0 ]; then
  echo "Error: Failed to save PM2 state."
  exit 1
fi

# Close the terminal
osascript -e 'tell application "Terminal" to close first window' & exit