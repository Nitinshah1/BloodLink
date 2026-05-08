# 🚀 Quick Start Guide - Server Setup

## Problem: "Unable to connect to server"

यह error तब आता है जब server running नहीं है। Server start करने के लिए follow करें:

## Step 1: Node.js Install करें

1. **Download Node.js:**
   - Visit: https://nodejs.org/
   - Download **LTS version** (Long Term Support)
   - File name जैसे: `node-v20.x.x-x64.msi`

2. **Install करें:**
   - Downloaded file को double-click करें
   - "Next" click करते रहें
   - **Important:** "Add to PATH" option को check करें
   - Install complete होने तक wait करें

3. **Verify Installation:**
   - Command Prompt या PowerShell खोलें
   - Type करें: `node --version`
   - Version number दिखना चाहिए (जैसे: v20.10.0)

## Step 2: Dependencies Install करें

Project folder में Command Prompt खोलें और run करें:

```bash
npm install
```

यह command install करेगी:
- Express (web server)
- SQLite3 (database)
- bcryptjs (password security)
- CORS (browser access)

## Step 3: Server Start करें

### Method 1: Batch File (सबसे आसान)
- `start-server.bat` file को double-click करें

### Method 2: Command Line
```bash
npm start
```

या

```bash
node server.js
```

## Step 4: Browser में खोलें

Server start होने के बाद browser में जाएं:
```
http://localhost:3000
```

## ✅ Success Check

Server start होने पर terminal में दिखेगा:
```
==================================================
🩸 Blood Donor Matching System Server
==================================================
✅ Server is running on http://localhost:3000
📄 Home page: http://localhost:3000/index.html
📝 Registration: http://localhost:3000/register.html
...
```

## ❌ Common Problems

### Problem 1: "node is not recognized"
**Solution:** Node.js install नहीं है या PATH में नहीं है
- Node.js को reinstall करें
- "Add to PATH" option check करें
- Computer को restart करें

### Problem 2: "Port 3000 already in use"
**Solution:** Port 3000 पर कोई और program चल रहा है
- `server.js` file खोलें
- Line 8 पर `const PORT = 3000;` को `const PORT = 3001;` करें
- Browser में `http://localhost:3001` use करें

### Problem 3: "Cannot find module"
**Solution:** Dependencies install नहीं हुईं
```bash
npm install
```

### Problem 4: "npm is not recognized"
**Solution:** Node.js properly install नहीं हुआ
- Node.js को reinstall करें
- Computer restart करें

## 📞 Need Help?

1. Check करें कि Node.js install है: `node --version`
2. Check करें कि dependencies install हैं: `node_modules` folder exist करना चाहिए
3. Server running है या नहीं: Terminal में "Server is running" message दिखना चाहिए
4. Browser में `http://localhost:3000/api/health` खोलें - `{"status":"OK"}` दिखना चाहिए

## 🎯 Quick Checklist

- [ ] Node.js installed है
- [ ] `npm install` run किया
- [ ] Server start किया (`npm start`)
- [ ] Browser में `http://localhost:3000` खोला
- [ ] Registration form submit किया

---

**Note:** Server हमेशा running रहना चाहिए। Browser में page खोलने से पहले server start करें।

