#!/bin/bash
cd "$(dirname "$0")/app"

# Start the application
npm run start:all
if [ $? -ne 0 ]; then
   echo "Error: Failed to start the application."
   exit 1
fi

# Close the terminal
osascript -e 'tell application "Terminal" to close first window' & exit