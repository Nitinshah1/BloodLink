<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Donor Registration - BloodLink</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* --- PREMIUM CSS FOR WIDE LAYOUT --- */
        :root {
            --primary-red: #c41e3a;
            --deep-blue: #22577A;
            --bg-soft: #f4f7f6;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-soft);
            margin: 0;
            padding: 20px;
        }

        .reg-wrapper {
            max-width: 1000px; /* Wide Look */
            margin: 0 auto;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            border-top: 5px solid var(--primary-red);
        }

        .reg-header {
            background: #fff;
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .reg-header h1 {
            color: var(--primary-red);
            margin: 0;
            font-weight: 800;
            font-size: 2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .reg-form {
            padding: 40px;
        }

        /* Grid System for 2-Column Layout */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Two Equal Columns */
            gap: 25px;
        }

        .section-break {
            grid-column: span 2;
            padding: 15px;
            background: #fcfcfc;
            border-left: 5px solid var(--deep-blue);
            margin: 20px 0 10px;
            font-weight: 700;
            color: var(--deep-blue);
            font-size: 1.1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: span 2;
        }

        label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #444;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        input, select, textarea {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: 0.3s;
        }

        input:focus, select:focus {
            border-color: var(--primary-red);
            outline: none;
            box-shadow: 0 0 8px rgba(196, 30, 58, 0.1);
        }

        .help-text {
            font-size: 0.75rem;
            color: #888;
            margin-top: 5px;
        }

        .captcha-box {
            background: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            font-weight: 800;
            font-size: 1.2rem;
            letter-spacing: 5px;
            color: #555;
            user-select: none;
        }

        .btn-submit {
            grid-column: span 2;
            background: var(--primary-red);
            color: white;
            padding: 18px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 800;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 20px;
            text-transform: uppercase;
        }

        .btn-submit:hover {
            background: #a01830;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(196, 30, 58, 0.3);
        }

        /* --- RESPONSIVE FIXES --- */
        @media (max-width: 850px) {
            .form-grid {
                grid-template-columns: 1fr; /* Stacked columns for mobile */
            }
            .form-group.full, .section-break, .btn-submit {
                grid-column: span 1;
            }
            .reg-wrapper {
                margin: 10px;
            }
        }
    </style>
</head>
<body>





    <div class="reg-wrapper">
        <div class="reg-header">
            <h1>Registration Form</h1>
            <p style="color: #666; margin-top: 5px;">Fill your details to save a life today</p>
        </div>

        <form action="register_process.php" method="POST" class="reg-form" onsubmit="return validateForm()">
            <div class="form-grid">
                
                <div class="section-break">👤 Personal Information</div>

                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="full_name" required placeholder="Enter your full name">
                </div>

                <div class="form-group">
                    <label>Father / Husband Name *</label>
                    <input type="text" name="father_name" required placeholder="Enter guardian name">
                </div>

                <div class="form-group">
                    <label>Marital Status *</label>
                    <select name="marital_status" required>
                        <option value="">Select Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Date of Birth *</label>
                    <input type="date" name="dob" required id="dob">
                </div>

                <div class="form-group">
                    <label>Gender *</label>
                    <select name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Blood Group *</label>
                    <select name="blood_group" required>
                        <option value="">Select Blood Group</option>
                        <option value="A+">A+</option><option value="A-">A-</option>
                        <option value="B+">B+</option><option value="B-">B-</option>
                        <option value="O+">O+</option><option value="O-">O-</option>
                        <option value="AB+">AB+</option><option value="AB-">AB-</option>
                    </select>
                </div>

                <div class="section-break">📍 Contact & Location</div>

                <div class="form-group">
                    <label>Phone Number *</label>
                    <input type="tel" name="mobile" id="mobile" required placeholder="10-digit mobile number" oninput="validateMobile()">
                    <span id="mobileError" class="help-text"></span>
                </div>

                <div class="form-group">
                    <label>Email Address (For Forgot Password)</label>
                    <input type="email" name="email" id="email" required placeholder="example@mail.com" oninput="validateEmail()">
                    <span id="emailError" class="help-text"></span>
                </div>

               <div class="form-group">
    <label>State *</label>
    <select name="state" required>
        <option value="">Select State</option>
        <option value="Andhra Pradesh"> Andhra Pradesh</option>
        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
        <option value="Assam">Assam</option>
        <option value="Bihar">Bihar</option>
        <option value="Chhattisgarh">Chhattisgarh</option>
        <option value="Goa">Goa</option>
        <option value="Gujarat">Gujarat</option>
        <option value="Haryana">Haryana</option>
        <option value="Himachal Pradesh">Himachal Pradesh</option>
        <option value="Jharkhand">Jharkhand</option>
        <option value="Karnataka">Karnataka</option>
        <option value="Kerala">Kerala</option>
        <option value="Madhya Pradesh">Madhya Pradesh</option>
        <option value="Maharashtra">Maharashtra</option>
        <option value="Manipur">Manipur</option>
        <option value="Meghalaya">Meghalaya</option>
        <option value="Mizoram">Mizoram</option>
        <option value="Nagaland">Nagaland</option>
        <option value="Odisha">Odisha</option>
        <option value="Punjab">Punjab</option>
        <option value="Rajasthan">Rajasthan</option>
        <option value="Sikkim">Sikkim</option>
        <option value="Tamil Nadu">Tamil Nadu</option>
        <option value="Telangana">Telangana</option>
        <option value="Tripura">Tripura</option>
        <option value="Uttar Pradesh">Uttar Pradesh</option>
        <option value="Uttarakhand">Uttarakhand</option>
        <option value="West Bengal">West Bengal</option>
        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
        <option value="Chandigarh">Chandigarh</option>
        <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
        <option value="Delhi">Delhi</option>
        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
        <option value="Ladakh">Ladakh</option>
        <option value="Lakshadweep">Lakshadweep</option>
        <option value="Puducherry">Puducherry</option>
    </select>
</div>


                        
                </div>

                <div class="form-group">
                    <label>City *</label>
                    <input type="text" name="city" required placeholder="Your City">
                </div>

                <div class="form-group">
                    <label>Pincode *</label>
                    <input type="text" name="pincode" required placeholder="6-digit Pincode">
                </div>

                <div class="form-group">
                    <label>Last Donation History</label>
                    <input type="date" name="last_donation">
                    <span class="help-text">Leave blank if never donated</span>
                </div>

                <div class="form-group full">
                    <label>Full Address *</label>
                    <textarea name="address" rows="3" required placeholder="Enter your detailed address"></textarea>
                </div>

                <div class="section-break">🔒 Account Security</div>

                <div class="form-group">
                    <label>Password *</label>
                    <input type="password" name="password" id="password" required placeholder="Min. 6 characters" oninput="validatePassword()">
                    <span id="passwordError" class="help-text"></span>
                </div>

                <div class="form-group">
                    <label>Confirm Password *</label>
                    <input type="password" name="confirm_password" id="cpassword" required placeholder="Re-type password" oninput="matchPassword()">
                    <span id="matchError" class="help-text"></span>
                </div>

              

                <div class="form-group">
                    <label>Captcha Verification</label>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <div id="captchaDisp" style="
                            background: #f0f0f0; 
                            padding: 12px 25px; 
                            border-radius: 10px; 
                            font-family: 'Courier New', monospace; 
                            font-size: 1.6rem; 
                            font-weight: 900; 
                            color: #c41e3a; 
                            letter-spacing: 8px; 
                            font-style: italic; 
                            user-select: none; 
                            border: 2px dashed #bbb;
                            background-image: repeating-linear-gradient(45deg, transparent, transparent 5px, rgba(0,0,0,0.03) 5px, rgba(0,0,0,0.03) 10px);
                            text-shadow: 3px 3px 4px rgba(0,0,0,0.1);
                            ">
                            <span id="captchaText"></span>
                        </div>
                        <button type="button" onclick="generateCaptcha()" style="background: #eee; border: 1px solid #ccc; padding: 10px; border-radius: 8px; cursor: pointer;">🔄</button>
                    </div>
                </div>

                <div class="form-group">
                    <label>Enter Characters Shown Above *</label>
                    <input type="text" id="captchaInput" name="captcha_input" required placeholder="Type the characters here" style="text-transform: uppercase;">
                </div>

                <button type="submit" class="btn-submit">Register as Donor ✅</button>

            </div> </form>

        <div style="text-align: center; padding-bottom: 30px;">
            <a href="index.php" style="color: var(--primary-red); text-decoration: none; font-weight: 700;">← Back to Home</a>
        </div>
    </div>

    <script>
        let generatedCaptcha = "";

        function generateCaptcha() {
            // Confusion dur karne ke liye O, 0, I, 1 hata diye hain
            const chars = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789"; 
            let result = "";
            for (let i = 0; i < 6; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            generatedCaptcha = result;
            document.getElementById('captchaText').innerText = result;
        }

        // Page load pe captcha generate karo
        window.onload = function() {
            generateCaptcha();
        };

        function validateForm() {
            // User ka input aur generated captcha match karna
            let uInput = document.getElementById('captchaInput').value.trim().toUpperCase();
            
            if (uInput !== generatedCaptcha) {
                alert("Invalid Captcha! Please enter the correct characters.");
                generateCaptcha(); // Galti pe captcha badal do
                document.getElementById('captchaInput').value = "";
                return false;
            }

            // Password matching logic (aapka purana wala)
            var pass = document.getElementById("password").value;
            var cpass = document.getElementById("cpassword").value;
            if (pass !== cpass) {
                alert("Passwords do not match!");
                return false;
            }

            return true;
        }

        // Mobile validation (aapka purana logic)
        function validateMobile() {
            var mobile = document.getElementById("mobile").value;
            var error = document.getElementById("mobileError");
            if (mobile.length === 10) { error.innerHTML = "✓ Valid"; error.style.color = "green"; }
            else { error.innerHTML = "Enter 10 digits"; error.style.color = "orange"; }
        }
    </script>

       

    <script>
      

        // Reuse your existing validation logic
        function validateMobile() {
            var mobile = document.getElementById("mobile").value;
            var error = document.getElementById("mobileError");
            if (mobile.length === 10) { error.innerHTML = "✓ Valid"; error.style.color = "green"; }
            else { error.innerHTML = "Enter 10 digits"; error.style.color = "orange"; }
        }

        function validatePassword() {
            var pass = document.getElementById("password").value;
            var error = document.getElementById("passwordError");
            if (pass.length >= 6) { error.innerHTML = "✓ Strong"; error.style.color = "green"; }
            else { error.innerHTML = "Min 6 chars"; error.style.color = "red"; }
        }

        function matchPassword() {
            var pass = document.getElementById("password").value;
            var cpass = document.getElementById("cpassword").value;
            var error = document.getElementById("matchError");
            if (pass === cpass && cpass !== "") { error.innerHTML = "✓ Match"; error.style.color = "green"; }
            else { error.innerHTML = "No Match"; error.style.color = "red"; }
        }
    </script>
</body>
</html>