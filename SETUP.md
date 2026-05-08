# Server Setup Guide

## Step-by-Step Installation

### 1. Install Node.js

**Download and install Node.js:**
- Visit: https://nodejs.org/
- Download the LTS (Long Term Support) version
- Run the installer and follow the instructions
- Make sure to check "Add to PATH" during installation

**Verify installation:**
Open Command Prompt or PowerShell and run:
```bash
node --version
npm --version
```

You should see version numbers (e.g., v18.17.0 and 9.6.7)

### 2. Install Project Dependencies

Open Command Prompt or PowerShell in the project folder and run:

```bash
npm install
```

This will install:
- Express (web server)
- SQLite3 (database)
- bcryptjs (password hashing)
- CORS (cross-origin support)

### 3. Start the Server

**Option A: Using npm (Recommended)**
```bash
npm start
```

**Option B: Using the batch file (Windows)**
- Double-click `start-server.bat`

**Option C: Direct command**
```bash
node server.js
```

### 4. Verify Server is Running

You should see output like:
```
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
```

### 5. Open in Browser

Open your web browser and go to:
```
http://localhost:3000
```

## Common Issues & Solutions

### Issue: "node is not recognized"
**Solution:** 
- Node.js is not installed or not in PATH
- Reinstall Node.js and make sure to check "Add to PATH"
- Restart your terminal/command prompt after installation

### Issue: "Port 3000 already in use"
**Solution:**
1. Find what's using port 3000:
   ```bash
   netstat -ano | findstr :3000
   ```
2. Kill that process or change PORT in `server.js` to a different number (e.g., 3001)

### Issue: "Cannot find module"
**Solution:**
- Run `npm install` again
- Delete `node_modules` folder and `package-lock.json`, then run `npm install`

### Issue: "Database errors"
**Solution:**
- Delete `donors.db` file and restart server
- This will create a fresh database (all data will be lost)

### Issue: "CORS errors in browser"
**Solution:**
- Make sure you're accessing via `http://localhost:3000` (not `file://`)
- The server must be running

## Testing the Server

### Test Health Endpoint
Open in browser: `http://localhost:3000/api/health`

Should return: `{"status":"OK","message":"Server is running"}`

### Test Registration
1. Go to `http://localhost:3000/register.html`
2. Fill in the form
3. Submit and check if you get a success message

### Test Search
1. First register at least one donor
2. Go to `http://localhost:3000/search.html`
3. Select a blood group and search
4. You should see the registered donor

## Default Admin Credentials

- **Username:** `admin`
- **Password:** `admin123`

**Important:** Change these credentials in production!

## Stopping the Server

Press `Ctrl + C` in the terminal where the server is running.

## Next Steps

1. ✅ Server is running
2. ✅ Test registration
3. ✅ Test search functionality
4. ✅ Test login and dashboard
5. ✅ Test admin panel

Your Blood Donor Matching System is now ready to use! 🎉

