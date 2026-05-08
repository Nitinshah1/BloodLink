# 🩸 Blood Donor Matching System - Complete Guide

## 🚀 Quick Start (5 मिनट में)

### Step 1: Node.js Install करें
1. **Download:** https://nodejs.org/
2. **LTS version** download करें (जैसे: node-v20.x.x-x64.msi)
3. **Install करें:**
   - File को double-click करें
   - "Next" click करते रहें
   - **Important:** "Add to PATH" option को ✅ check करें
   - Install complete होने तक wait करें
4. **Computer restart करें**

### Step 2: Server Start करें
**सबसे आसान तरीका:**
- `AUTO_SETUP.bat` file को **double-click** करें
- यह automatically सब कुछ कर देगा!

**या manually:**
1. Command Prompt खोलें
2. इस folder में जाएं: `cd C:\Users\lenovo\Desktop\bllood`
3. Run करें: `npm install` (पहली बार)
4. Run करें: `npm start`

### Step 3: Browser में खोलें
```
http://localhost:3000
```

---

## 📋 Complete Features

### ✅ Home Page
- Clean और professional design
- Search Blood button
- Register as Donor button
- Quick links

### ✅ Donor Registration
- Professional form design
- Personal Information section
- Contact details
- Account security (optional)
- Donation history

### ✅ Donor Login & Dashboard
- Email/Mobile + Password login
- Availability toggle (ON/OFF)
- Edit profile
- View donation history

### ✅ Blood Search Page
- Search by blood group
- Filter by city
- View available donors
- One-click calling

### ✅ Admin Panel
- View all donors
- Statistics by blood group
- Delete donors
- Professional management interface

---

## 🛠️ System Requirements

- **Node.js** v14 या higher
- **npm** (Node.js के साथ आता है)
- **Modern Browser** (Chrome, Firefox, Edge)
- **Internet** (पहली बार dependencies install के लिए)

---

## 📁 Project Structure

```
bllood/
├── index.html          # Home page
├── register.html       # Registration page
├── login.html          # Login page
├── dashboard.html      # Donor dashboard
├── search.html         # Search page
├── admin.html          # Admin panel
├── server.js           # Backend server
├── package.json        # Dependencies
├── AUTO_SETUP.bat      # Auto setup script
└── donors.db           # Database (auto-created)
```

---

## 🔧 Troubleshooting

### Problem: "node is not recognized"
**Solution:**
- Node.js install नहीं है
- Node.js को reinstall करें
- "Add to PATH" check करें
- Computer restart करें

### Problem: "Port 3000 already in use"
**Solution:**
- `server.js` file खोलें
- Line 8: `const PORT = 3000;` को `const PORT = 3001;` करें
- Browser में `http://localhost:3001` use करें

### Problem: "Cannot find module"
**Solution:**
```bash
npm install
```

### Problem: "Unable to connect to server"
**Solution:**
- Server running है या नहीं check करें
- Terminal में "Server is running" message दिखना चाहिए
- Browser में `http://localhost:3000/api/health` test करें

---

## 🔐 Default Credentials

### Admin Login
- **Username:** `admin`
- **Password:** `admin123`

**⚠️ Important:** Production में इन्हें change करें!

---

## 📊 Database

- **Type:** SQLite
- **File:** `donors.db` (auto-created)
- **Tables:**
  - `donors` - Donor information
  - `admins` - Admin accounts

---

## 🌐 API Endpoints

### Donor APIs
- `POST /api/donors` - Register donor
- `GET /api/donors` - Search donors
- `POST /api/donors/login` - Login
- `PATCH /api/donors/:id` - Update profile
- `PATCH /api/donors/:id/availability` - Toggle availability

### Admin APIs
- `POST /api/admin/login` - Admin login
- `GET /api/admin/donors` - Get all donors
- `GET /api/admin/statistics` - Get statistics
- `DELETE /api/admin/donors/:id` - Delete donor

### Utility
- `GET /api/health` - Health check

---

## 💡 Usage Tips

1. **Server हमेशा running रखें** - Browser में page खोलने से पहले
2. **Window बंद न करें** - Server window बंद करने से server stop हो जाएगा
3. **Server stop करने के लिए** - Terminal में `Ctrl + C` दबाएं
4. **Database reset करने के लिए** - `donors.db` file delete करें और server restart करें

---

## 🎯 Testing Checklist

- [ ] Node.js installed है
- [ ] Dependencies installed हैं (`npm install`)
- [ ] Server start किया (`npm start`)
- [ ] Browser में `http://localhost:3000` खोला
- [ ] Home page दिख रहा है
- [ ] Registration form काम कर रहा है
- [ ] Search page काम कर रहा है
- [ ] Login काम कर रहा है
- [ ] Admin panel accessible है

---

## 📞 Support

अगर कोई problem हो:
1. `QUICK_START.md` file देखें
2. `SERVER_START_HINDI.md` file देखें
3. `AUTO_SETUP.bat` run करें - यह automatically problems detect करेगा

---

## 🎉 Success!

अगर सब कुछ ठीक है:
- ✅ Server running है
- ✅ Browser में pages खुल रहे हैं
- ✅ Forms submit हो रहे हैं
- ✅ Database working है

**आपका Blood Donor Matching System ready है!** 🩸❤️

---

## 📝 Notes

- Server को background में run करने के लिए: `start /B node server.js`
- Production में PORT और credentials change करें
- Regular database backups लें
- Security के लिए HTTPS use करें

---

**Made with ❤️ for saving lives**

