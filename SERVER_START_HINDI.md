How to Start the Server – Easy Guide
⚡ Easiest Method (Recommended)
Step 1: Run the Batch File

Open the project folder
(C:\Users\lenovo\Desktop\bllood)

Double-click the start-server.bat file

A window will open – please wait

Server will start automatically!

This will automatically:

✅ Check if Node.js is installed

✅ Install dependencies (if required)

✅ Start the server

📝 Using Command Prompt (Manual Method)
Step 1: Open Command Prompt

Press the Windows key

Type cmd

Press Enter

Step 2: Go to the Project Folder
cd C:\Users\lenovo\Desktop\bllood

Step 3: Install Dependencies (First Time Only)
npm install

Step 4: Start the Server
npm start


or

node server.js

✅ How to Know the Server Has Started?

You will see something like this in the terminal/window:

==================================================
🩸 Blood Donor Matching System Server
==================================================
✅ Server is running on http://localhost:3000
📄 Home page: http://localhost:3000/index.html
📝 Registration: http://localhost:3000/register.html
🔍 Search: http://localhost:3000/search.html
👤 Login: http://localhost:3000/login.html
⚙️  Admin: http://localhost:3000/admin.html
💚 Health check: http://localhost:3000/api/health
==================================================

🌐 Open in Browser

After the server starts:

Open any browser (Chrome, Firefox, Edge)

Type this in the address bar:

http://localhost:3000


Press Enter

Home page will open!

❌ If You Get an Error
Error 1: "node is not recognized"

Meaning: Node.js is not installed

Solution:

Go to https://nodejs.org/

Download the LTS version

Install it

Important: Check “Add to PATH” during installation

Restart your computer

Try again

Error 2: "Port 3000 already in use"

Meaning: Another program is using port 3000

Solution:

Open server.js

Go to line 8:

const PORT = 3000;


Change it to:

const PORT = 3001;


Save the file

Open in browser:

http://localhost:3001

Error 3: "Cannot find module"

Meaning: Dependencies are not installed

Solution:

npm install

🎯 Quick Checklist

 Node.js installed? (node --version)

 Ran npm install (first time)?

 Server started? (npm start or start-server.bat)

 Opened http://localhost:3000 in browser?

 Registration form working?

💡 Important Tips

Keep the server running before opening pages

Do not close the server window – server will stop

To stop the server – press Ctrl + C in terminal

📞 Test the Server

After starting the server, test in browser:

1️⃣ Health Check
http://localhost:3000/api/health


Response:

{"status":"OK","message":"Server is running"}

2️⃣ Home Page
http://localhost:3000/index.html

3️⃣ Registration Page
http://localhost:3000/register.html

🎉 Success!

If everything works:

✅ Server is running

✅ Pages open in browser

✅ Registration form submits successfully

Now you can use the Blood Donor System! 🩸