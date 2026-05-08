<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | BloodLink</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #ffffff;     
            --primary-red: #FB3640;  
            --deep-blue: #22577A;    
            --soft-pink: #FDE2E4;
        }

        body { background-color: var(--bg-color); margin: 0; font-family: 'Inter', sans-serif; color: #1a1a1a; }

        /* --- YOUR EXACT HEADER --- [cite: 2026-01-26] */
        .main-header {
            background: var(--deep-blue);
            padding: 5px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            border-bottom: 3px solid var(--primary-red);
            min-height: 80px;
            display: flex; align-items: center;
        }

        .header-container {
            display: flex; justify-content: space-between; align-items: center;
            max-width: 1450px; width: 100%; margin: 0 auto; padding: 0 30px;
        }

        .logo-section { display: flex; align-items: center; gap: 20px; }
        .menu-icon-img { width: 28px; height: 28px; filter: brightness(0) invert(1); }
        .blood-drop-logo { width: 32px; height: 32px; animation: blinker 1.5s linear infinite; }
        @keyframes blinker { 50% { opacity: 0.1; transform: scale(0.9); } }
        .logo-text h1 { font-size: 1.8rem; margin: 0; color: white; font-weight: 800; }

        .nav-menu { display: flex; list-style: none; gap: 25px; align-items: center; margin: 0; padding: 0; }
        .nav-menu li a { text-decoration: none; color: white; font-weight: 600; display: flex; align-items: center; gap: 8px; font-size: 0.95rem; }
        .nav-icon-img { width: 22px; height: 22px; object-fit: contain; }

        /* --- CLEAN PROFESSIONAL CONTENT --- [cite: 2026-01-27] */
        .about-hero {
            padding: 100px 20px;
            text-align: center;
            background: var(--soft-pink);
        }

        .about-hero h2 { font-size: 4rem; color: var(--deep-blue); margin: 0; font-weight: 800; }
        .about-hero span { color: var(--primary-red); }

        .content-wrap {
            max-width: 900px;
            margin: 60px auto;
            padding: 0 20px;
            line-height: 1.8;
            font-size: 1.2rem;
            color: #444;
        }

        .feature-box {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-top: 80px;
            border-top: 1px solid #eee;
            padding-top: 60px;
        }

        .feature-card h3 { color: var(--primary-red); font-size: 1.5rem; margin-bottom: 15px; }
        .feature-card p { font-size: 1rem; color: #666; }

        footer { background: var(--deep-blue); color: white; padding: 40px 0; text-align: center; margin-top: 100px; }
    </style>
</head>
<body>

    <header class="main-header">

        <div class="header-container">
            <div class="logo-section">
                <!--img src="assets/menu_icon.png" alt="Menu" class="menu-icon-img"--> 
                <div style="display: flex; flex-direction: column; align-items: center; ">
                    <img src="assets/b.png" alt="Drop" class="blood-drop-logo login-user-icon"> <div class="logo-text"><h1>BloodLink</h1></div>
                </div>
            </div>

            <nav>
                <ul class="nav-menu">
                    <li><a href="index.php"><img src="assets/home.png" class="nav-icon-img"> Home</a></li>
                    <li><a href="search.php"><img src="assets/search_icon.png" class="nav-icon-img"> Search</a></li>
                    <li><a href="post_request.php"><img src="assets/request.png" class="nav-icon-img"> Request</a></li>
                    <li><a href="about.php"><img src="assets/About.png" class="nav-icon-img"> About</a></li>

<a href="#how-it-works-section" class="nav-link-header">
    <span class="icon">📑</span> <span class="text">How It Works</span>
</a>

                    <li><a href="login.php" class="nav-login">
                        <img src="assets/user.png" class="nav-icon-img login-user-icon"> Login
                    </a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div style="width: 100%; background: linear-gradient(rgba(196, 30, 58, 0.9), rgba(34, 87, 122, 0.9)), url('https://images.unsplash.com/photo-1536856789559-1bc4bd997eef?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; padding: 120px 0; text-align: center; color: white;">
        <h2 style="font-size: 4rem; font-weight: 900; margin: 0; letter-spacing: 5px; text-transform: uppercase;">Saving Lives Effortlessly</h2>
        <p style="font-size: 1.5rem; margin-top: 20px; font-weight: 300; letter-spacing: 1px;">A smart ecosystem built for heroes, Bridging the gap between Life and Hope.</p>
    </div>

   <section class="hero-section" style="background-image: url('https://images.unsplash.com/photo-1615461066841-6116e61058f4?auto=format&fit=crop&w=1920&q=80');">
    <div class="hero-content">
        <h2 class="main-title">EMPOWERING <br><span class="red-accent">HUMANITY.</span></h2>
        
        <p class="sub-heading">
            BloodLink is not just a platform; it is a movement dedicated to ensuring that no life is lost due to the unavailability of blood. Our sophisticated digital ecosystem connects voluntary donors directly with those in urgent need, eliminating every delay.
        </p>
        
        <div class="center-line"></div>
    </div>
</section>



    <style>
    /* Full Page Reset */
    body, html { 
        margin: 0 !important; 
        padding: 0 !important; 
        width: 100% !important; 
        overflow-x: hidden; 
        font-family: 'Montserrat', sans-serif;
    }

    /* Full Screen Sections */
    .hero-section {
        width: 100vw;
        height: 100vh;
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* Smooth Parallax */
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    /* Dark Cinematic Overlay */
    .hero-section::before {
        content: "";
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.65); /* Rich dark tint */
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: #ffffff;
        padding: 0 5%;
        width: 100%;
    }

    /* Bold Headlines */
    .main-title {
        font-size: clamp(3.5rem, 10vw, 8rem);
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -2px;
        margin: 0;
        line-height: 0.9;
    }

    .red-accent { color: #c41e3a; }

    .sub-heading {
        font-size: clamp(1.5rem, 3vw, 2.5rem);
        font-weight: 300;
        margin-top: 30px;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.4;
    }

    /* Divider */
    .center-line {
        width: 150px;
        height: 10px;
        background: #c41e3a;
        margin: 50px auto 0;
        border-radius: 5px;
    }
</style>

<div class="ultimate-about-layout">

    <section class="hero-section" style="background-image: url('assets/hand.jpg');">
        <div class="hero-content">
            <h1 class="main-title">BEYOND <br><span class="red-accent">TECHNOLOGY.</span></h1>
            <p class="sub-heading">BloodLink is a nationwide digital ecosystem engineered to bridge the gap between life and hope in real-time.</p>
            <div class="center-line"></div>
        </div>
    </section>

    <section class="hero-section" style="background-image: url('assets/donate.png');">
        <div class="hero-content">
            <h2 class="main-title">ELIMINATING <br><span class="red-accent">THE DELAY.</span></h2>
            <p class="sub-heading">In a medical crisis, seconds save lives. We provide direct peer-to-peer connectivity, removing every barrier between a donor and a patient.</p>
            <div class="center-line"></div>
        </div>
    </section>

    <section class="hero-section" style="background-image: url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=1920&q=80');">
         <div class="hero-content">
            <h2 class="main-title" style="color: #fff;">OUR SOLEMN <br><span class="red-accent">PROMISE.</span></h2>
            <p class="sub-heading" style="font-style: italic; opacity: 0.9;">"To ensure that no individual ever has to struggle for life-saving blood. We are the guardians of your emergency needs."</p>
            <div class="center-line" style="background: #fff;"></div>
        </div>
    </section>

</div>

    <footer>
        <p>© 2026 BloodLink Healthcare. Engineered for Humanity.</p>
    </footer>

</body>
</html>