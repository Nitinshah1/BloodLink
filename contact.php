<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | BloodLink</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --red: #c41e3a; --green: #4caf50; --gray: #f5f5f5; }
        body { font-family: 'Inter', sans-serif; background-color: #e0e0e0; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }

        /* Main Card */
        .contact-card {
            background: white; width: 90%; max-width: 900px; border-radius: 30px;
            overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.2); position: relative;
        }

        /* Top Section with Image */
        .card-header {
            position: relative; height: 300px;
            background: url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80');
            background-size: cover; background-position: center;
        }
        .header-overlay {
            padding: 30px; color: white; display: flex; justify-content: space-between;
        }
        .social-icons a { color: white; margin-left: 10px; font-size: 1.2rem; transition: 0.3s; }
        .social-icons a:hover { color: var(--red); }

        /* Bottom Section */
        .card-body { padding: 40px; display: flex; gap: 40px; }
        .form-side { flex: 1.2; }
        .info-side { flex: 1; }

        @media (max-width: 768px) {
            .card-body { flex-direction: column; padding: 20px; }
            .card-header { height: 200px; }
        }

        /* Form Styling */
        h2 { font-weight: 800; margin: 0; font-size: 1.5rem; }
        p.subtitle { color: #666; margin-bottom: 30px; font-size: 0.9rem; }
        
        .input-group { position: relative; margin-bottom: 20px; border-bottom: 1px solid #ccc; }
        .input-group input, .input-group textarea {
            width: 100%; border: none; padding: 10px 30px 10px 0; outline: none; font-size: 0.9rem;
        }
        .input-group i { position: absolute; right: 5px; top: 12px; color: #888; font-size: 0.9rem; }

        .btn-send {
            background: var(--red); color: white; border: none; padding: 12px 30px;
            border-radius: 50px; font-weight: bold; cursor: pointer; display: flex;
            align-items: center; gap: 10px; margin-top: 20px; transition: 0.3s;
        }
        .btn-send:hover { transform: scale(1.05); box-shadow: 0 5px 15px rgba(196, 30, 58, 0.4); }

        /* Contact Info Cards (Floating Style) */
        .info-box {
            padding: 15px; border-radius: 15px; margin-bottom: 15px;
            display: flex; align-items: center; gap: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05); transition: 0.3s;
        }
        .info-box:hover { transform: translateX(5px); }
        .whatsapp-card { background: #e8f5e9; color: #2e7d32; }
        .phone-card { background: white; border: 1px solid #eee; }
        .address-card { background: white; border: 1px solid #eee; }

        .icon-circle {
            width: 40px; height: 40px; border-radius: 50%; display: flex;
            justify-content: center; align-items: center; font-size: 1.2rem;
        }
        .whatsapp-card .icon-circle { background: #4caf50; color: white; }
        .phone-card .icon-circle { background: #fff1f1; color: var(--red); }
        .address-card .icon-circle { background: #f5f5f5; color: #555; }

        .text-content b { display: block; font-size: 0.9rem; }
        .text-content span { font-size: 0.8rem; opacity: 0.8; }
    </style>
</head>
<body>

<div class="contact-card">
    <div class="card-header">
        <div class="header-overlay">
            <b style="font-size: 1.2rem;">Contact Us</b>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="form-side">
            <h2>WE'RE HERE TO HELP YOU, LIFESAVER</h2>
            <p class="subtitle">Your questions and feedback help us save more lives.</p>
            
            <form action="send_contact.php" method="POST">
                <div class="input-group">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <i class="far fa-user"></i>
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Your Email" required>
                    <i class="far fa-envelope"></i>
                </div>
                <div class="input-group">
                    <input type="text" name="phone" placeholder="Phone Number">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <div class="input-group">
                    <textarea name="msg" placeholder="Your Message"></textarea>
                    <i class="far fa-comment-alt"></i>
                </div>
                <button type="submit" class="btn-send">
                    SEND MESSAGE <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            
        </div>

        

        <div class="info-side">
            <p style="font-weight: bold; margin-bottom: 20px;">Connect With Us Directly</p>
            
            

            <a href="tel:+918475854497" class="info-box phone-card" style="text-decoration: none; color: inherit; display: flex;">
    <div class="icon-circle"><i class="fas fa-phone-alt"></i></div>
    <div class="text-content">
        <b>Emergency Hotline</b>
        <span>+91 8475854497</span>
    </div>
</a>

            <div class="info-box address-card">
                <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
                <div class="text-content">
                    <b>Our Office</b>
                    <span>Hitech City, Hyderabad, India.</span>

                    
                </div>
            </div>
            <br></br>  <br></br>  <br></br>  <br></br>  
            <div style="max-width: 900px; margin: 20px auto 0 auto; padding: 0 10px; position: center;">
    <a href="index.php" style="text-decoration: none; color: #666; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: 0.3s;" onmouseover="this.style.color='#c41e3a'" onmouseout="this.style.color='#666'">
        <i class="fas fa-arrow-left"></i> 
        <span>Back to Home</span>
    </a>
</div>

<div class="contact-card">
        </div>
    </div>
</div>

</body>
</html>