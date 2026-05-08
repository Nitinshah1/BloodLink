<?php 
// 1. Database connection 
include 'config.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Connecting Hearts, Saving Lives</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="mobile.css" media="screen and (max-width: 768px)">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <title>BloodLink | Emergency Blood Donor Network</title>
<meta name="description" content="Find emergency blood donors in your city. BloodLink connects life-savers with patients in need.">
<meta name="keywords" content="blood donor, find blood, emergency blood, blood bank india, save lives">
<meta name="author" content="BloodLink Team">

<meta property="og:title" content="BloodLink - Save Lives Today">
<meta property="og:description" content="Urgent blood requirement? Find matching donors instantly.">
<meta property="og:url" content="https://bloodlink.kesug.com/">
    <style>
        




.admin-link-header {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #ffffff !important; 
    text-decoration: none;
    font-weight: 700;
    font-size: 0.9rem;
    padding: 5px 10px;
    background: rgba(255, 255, 255, 0.1); 
    border-radius: 4px;
    margin-right: 15px;
    transition: all 0.3s ease;
}

.admin-link-header:hover {
    background: #e63946; /* Hover pe background red ho jayega [cite: 2025-10-01] */
    color: white !important;
}

.admin-link-header .icon {
    font-size: 1.1rem;
}

.admin-link-header .text {
    display: inline-block !important; /* Forcefully text ko dikhane ke liye [cite: 2026-01-31] */
}





/* Amazon Style Footer [cite: 2026-01-26] */
.amazon-footer {
    background: var(--deep-blue);
    color: white;
    padding: 12px 0; 
    margin-top: auto; 
    margin-bottom: 0 !important; /* Niche ka gap zero karne ke liye [cite: 2026-01-31] */
    border-top: 3px solid #e63946;
    font-family: sans-serif;
    width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
    display: block;
}

html, body {
    height: 100%;
}

body {
    margin: 0;
    padding-top: 100px; /* header height */
    font-family: 'Inter', sans-serif;
    background-color: var(--bg-color);
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
}







.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 40px;
}

.footer-column h3 {
    font-size: 1.2rem;
    margin-bottom: 20px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    padding-bottom: 10px;
}

.footer-column ul {
    list-style: none;
    padding: 0;
}

.footer-column ul li {
    margin-bottom: 12px;
}

.footer-column ul li a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    font-size: 0.95rem;
}

.footer-column ul li a:hover {
    text-decoration: underline;
    color: white;
}

.footer-bottom {
    
    text-align: center;
    padding-top: 40px;
    margin-top: 8px;
    border-top: 1px solid rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.6);
}


/* Amazon Style Full Rectangle Banner [cite: 2026-01-30] – LAPTOP LAYOUT TOUCH NAHI */
.amazon-hero {
    width: 100%;
    min-height: calc(100vh - 100px);
    position: relative;
    background: url('assets/dil.jpg') no-repeat center center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
    padding: 0;
}




.hero-overlay {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(135deg, rgba(34, 87, 122, 0.8) 0%, rgba(251, 54, 64, 0.4) 100%);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
}
        /* Modern Color Palette [cite: 2026-01-26] */
:root {
            --bg-color: #FDE2E4;     /* Light Pinkish Background */
            --primary-red: #FB3640;  /* Vibrant Red */
            --deep-blue: #22577A;    /* Professional Blue */
            --card-grey: #f0f0f0;    /* For subtle matching boards */
        }

/* Balanced Professional Header (Amazon Style) [cite: 2026-01-26] */
.main-header {
    background: var(--deep-blue);
    padding: 10px 0; /* Padding kam ki taaki header patla aur clean dikhe */
    position: fixed; /* Sticky ki jagah Fixed zyada stable hai professional sites mein */
    top: 0;          /* Bilkul top par chipkane ke liye 0 zaroori hai */
    left: 0;
    width: 100%;
    z-index: 1000;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    border-bottom: 3px solid var(--primary-red);
}

/* Body mein padding dena zaroori hai taaki content header ke peeche na chupe */
body {
    padding-top: 100px; /* Header ki height ke barabar gap */
    background-color: var(--bg-color);
}
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1450px; /* Badi screen ke liye width set ki [cite: 2026-01-26] */
            width: 100%;
            margin: 0 auto;
            padding: 0 30px;
        }

        /* Amazon Style: Menu left mein aur Logo uske sath [cite: 2026-01-26] */
        .logo-section { 
            display: flex; 
            align-items: center; 
            gap: 20px; /* Menu aur logo ke beech gap [cite: 2026-01-26] */
        }

        /* Menu Icon Styling [cite: 2026-01-27] */
        .menu-icon-img {
            width: 28px; /* Size bada kiya [cite: 2026-01-26] */
            height: 28px;
            cursor: pointer;
            filter: brightness(0) invert(1); /* White color icons [cite: 2026-01-27] */
        }

        /* Logo Drop Icon [cite: 2026-01-27] */
        .blood-drop-logo {
            width: 45px;
            height: 45px;
            animation: blinker 1.5s linear infinite;
            margin-bottom: -5px; /* Text ke thoda paas lane ke liye [cite: 2026-01-26] */
        }

        .logo-text h1 { 
            font-size: 2.2rem; 
            margin: 0; 
            color: white; 
            font-weight: 900; 
            letter-spacing: 0.8px; 
        }

        /* Navigation Menu [cite: 2026-01-26] */
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px; /* Links ke beech ka gap badha diya [cite: 2026-01-26] */
            margin: 0;
            padding: 0;
            align-items: center;
        }

        .nav-menu li a {
            text-decoration: none;
            color: rgba(255,255,255,0.95);
            font-weight: 600;
            font-size: 1rem; /* Readable font size [cite: 2026-01-26] */
            padding: 8px 12px;
            border-radius: 6px;
            transition: 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px; /* Icon aur text ka gap [cite: 2026-01-27] */
        }

        .nav-menu li a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        /* Icons Control [cite: 2026-01-27] */
        .nav-icon-img {
            width: 30px; /* Icons size bada diya [cite: 2026-01-26] */
            height: 30px;
            object-fit: contain;
        }

        /* Login button ke icon ko white dikhane ke liye [cite: 2026-01-27] */
        .login-user-icon {
            filter: brightness(0) invert(1); 
        }

        .nav-login {
            background: var(--primary-red) !important;
            color: white !important;
            padding: 10px 25px !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 10px rgba(251, 54, 64, 0.4);
        }

        /* Hero & Sections [cite: 2026-01-26] */
        /* 1. Hero Section ke upar ka margin kam karne ke liye */
/* Hero section ko saaf aur bada dikhane ke liye [cite: 2026-01-26] */
.hero-section {
    padding: 80px 20px;
    text-align: center;
    background: var(--card-grey);
    border-radius: 30px;
    max-width: 1100px;
    margin: 40px auto; /* Header ke niche gap [cite: 2026-01-26] */
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
}

/* Stats Section: Overlap hata kar niche set kiya [cite: 2025-10-01] */
.stats-wrapper {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin: 40px 0; /* Hero aur Stats ke beech barabar gap */
}

.stat-item {
    background: white;
    padding: 30px 50px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    text-align: center;
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px); /* Hover effect professional portal ki tarah [cite: 2025-10-01] */
}

.stat-item h3 {
    margin: 0;
    color: var(--primary-red);
    font-size: 2.5rem;
    font-weight: 800;
}

.stat-item p {
    margin: 5px 0 0;
    color: #555;
    font-size: 1.1rem;
    font-weight: 600;
}
/* 2. Header ke niche ka padding check karne ke liye */
.main-header {
    padding-bottom: 5px; /* Isse header ke niche ki extra jagah khatam hogi */
}
        .btn { padding: 16px 40px; border-radius: 12px; text-decoration: none; font-weight: 700; transition: 0.3s ease; display: inline-block; }
        .btn-primary { background: var(--primary-red); color: white; box-shadow: 0 5px 15px rgba(251, 54, 64, 0.3); }
        .btn-secondary { border: 2.5px solid var(--deep-blue); color: var(--deep-blue); background: white; }

        .ticker-section {
            background: #fff;
            border-top: 2px solid var(--primary-red);
            border-bottom: 2px solid var(--primary-red);
            padding: 12px 0;
            margin: 30px 0; /* Pehle jaisa spacing */
            width: 100%;
            overflow: visible; /* marquee content dikhne ke liye */
        }
        .ticker-section marquee {
            display: block;
            width: 100%;
            white-space: nowrap;
        }

        /* Ticker banner ke andar – stats (2+) pe overlap NAHI, sab theek */
        .amazon-hero { position: relative; }
        /* Hero content ke niche itna space – ticker stats ko cover na kare */
        .amazon-hero .hero-content { padding-bottom: 56px; }
        .ticker-in-banner {
            position: absolute !important;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 12px 16px !important;
            min-height: 46px;
            box-sizing: border-box;
            background: rgba(34, 87, 122, 0.92);
            border-top: 3px solid var(--primary-red);
            border-bottom: none;
            z-index: 10;
        }
        .ticker-in-banner marquee {
            color: #fff !important;
            font-weight: 800;
            font-size: 0.95rem;
        }
        
        .request-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; max-width: 1200px; margin: 0 auto; padding: 20px; }
        .request-card { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 8px 30px rgba(0,0,0,0.05); border-top: 5px solid var(--deep-blue); }
        
        .map-btn { display: block; width: 100%; text-align: center; background: #f0f7ff; color: var(--deep-blue); padding: 12px; border-radius: 8px; text-decoration: none; font-weight: 700; margin-top: 15px; border: 1px solid #d0e4f5; }
        .call-btn { display: block; width: 100%; text-align: center; background: var(--primary-red); color: white; padding: 12px; border-radius: 8px; text-decoration: none; font-weight: 600; margin-top: 10px; }
    




        /* Normal State: Jaisa abhi dikh raha hai */
.map-btn { 
    display: block; 
    width: 100%; 
    text-align: center; 
    background: #f0fff5; /* Light Blue Background */
    color: var(--deep-blue); 
    padding: 12px; 
    border-radius: 8px; 
    text-decoration: none; 
    font-weight: 700; 
    margin-top: 15px; 
    border: 1px solid #d0e4f5;
    transition: 0.3s ease; /* Smooth change ke liye */
}

/* Hover State: Mouse le jaane par color change */
.map-btn:hover { 
    background: var(--deep-blue) !important; /* Blue background ho jayega */
    color: white !important; /* Text white ho jayega */
    box-shadow: 0 4px 12px rgba(34, 87, 122, 0.2); /* Thoda shadow effect */
}
    


/* Stats section ka main dabba [cite: 2025-10-01] */
.stats-container {
    display: flex;
    justify-content: center;
    gap: 25px;
    /* Negative (-) margin hi gap ko khatam karke cards ko image ke upar le jayega [cite: 2026-01-30] */
    margin-top: -650px !important; 
    position: relative;
    z-index: 10;
    margin-bottom: 50px;
}

/* Har ek individual stats card [cite: 2025-10-01] */
.stat-card {
    background: white;
    padding: 20px 40px;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    text-align: center;
    min-width: 180px;
    border-bottom: 4px solid var(--primary-red); /* Niche ek patli red line professional look ke liye */
}

.stat-card h3 {
    margin: 0;
    color: #c41e3a;
    font-size: 2.2rem;
    font-weight: 900;
}

.stat-card p {
    margin: 5px 0 0;
    color: #666;
    font-weight: 600;
    font-size: 0.95rem;
}




/* How It Works - Global Layout  */
.how-section {
    /*padding: 0px 0;*/
    width: 100vw; 
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
    overflow: hidden;

    min-height: auto !important; /* 100vh hata kar auto kar do */
    padding: 100px 0 !important; /* Space margin se nahi, padding se do */
    margin-bottom: 0 !important;
}




.how-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 80px;
    padding: 0 0px;
}

/* Background Colors [cite: 2026-01-31] */
.bg-white { background-color: #ffffff; }
.bg-light { background-color: #f9f9f9; }

/* Z-Pattern (Image Left/Right) [cite: 2026-01-31] */
.reverse .how-container {
    flex-direction: row-reverse;
}

.how-text { flex: 1; }
.how-image { flex: 1; text-align: center; }

.how-text h3 {
    color: #e63946; 
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: 2px;
    margin-bottom: 10px;
}

.how-text h2 {
    font-size: 3rem;
    color: #1a3a5a;
    margin-bottom: 25px;
    line-height: 1.1;
}

.how-text p {
    font-size: 1.2rem;
    color: #555;
    line-height: 1.8;
}

.how-image img {
    width: 100%;
    max-width: 500px;
    height: auto;
    border-radius: 20px;
    filter: drop-shadow(0 20px 30px rgba(0,0,0,0.1));
}

/* Mobile responsive [cite: 2026-01-31] */
/* --- Header FIXED + COMPACT on mobile: choti height, banner neeche hi shuru --- */
@media (max-width: 768px) {
    /* 1. Header fixed at top, COMPACT height (choti kro) */
    .main-header {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        z-index: 1000;
        padding: 6px 0 8px !important;
        height: auto !important;
    }

    .header-container {
        flex-direction: column !important;
        gap: 8px !important;
        padding: 0 8px !important;
    }

    /* Logo chota + ek line mein (height kam) */
    .logo-section, .logo-section > div { flex-direction: row !important; align-items: center; gap: 8px !important; }
    .logo-section .blood-drop-logo { width: 28px !important; height: 28px !important; }
    .logo-section .logo-text h1, .logo-text h1 { font-size: 1.2rem !important; }

    /* 2. Nav: 3 columns = 2 rows (height kam) */
    .nav-menu {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 6px !important;
        width: 100% !important;
        justify-content: center !important;
    }

    .nav-menu li { width: 100% !important; }

    .nav-menu li a, .admin-link-header, .nav-link-header {
        justify-content: center !important;
        font-size: 0.7rem !important;
        padding: 6px 4px !important;
        margin: 0 !important;
        width: 100% !important;
    }

    .nav-menu .nav-icon-img { width: 16px !important; height: 16px !important; }

    /* Login button compact, full width */
    .nav-login {
        grid-column: span 3 !important;
        width: 100% !important;
        text-align: center !important;
        padding: 8px 12px !important;
        font-size: 0.85rem !important;
    }

    /* 3. Hero/Banner: header ke neeche, ticker ke liye niche space */
    .amazon-hero {
        height: auto !important;
        min-height: 360px !important;
        padding: 20px 12px 50px !important;
        margin-top: 0 !important;
    }

    .amazon-hero h2 {
        font-size: 2.2rem !important;
        margin-top: 0 !important;
    }

    /* 4. Hero Buttons: responsive mein vertically stacked (image jaisa) */
    .hero-content div[style*="display: flex"] {
        flex-direction: column !important;
        gap: 12px !important;
        width: 100% !important;
        max-width: 320px;
        margin: 0 auto;
        align-items: center !important;
        justify-content: center !important;
    }

    .hero-content a, .hero-content button {
        width: 100% !important;
        max-width: 280px;
        padding: 14px 20px !important;
        font-size: 1rem !important;
        text-align: center;
    }

    /* 5. Stats Cards (Registered Donors) Vertical stacking [cite: 2025-10-01] */
    .stats-container {
        flex-direction: column !important;
        margin-top: 20px !important;
        gap: 10px !important;
        width: 100% !important;
        position: static !important;
    }

    .stat-card {
        width: 90% !important;
        margin: 0 auto !important;
    }
}


/* 1. Page smooth scroll karne ke liye [cite: 2026-02-01] */
html {
    scroll-behavior: smooth;
}

/* 2. Header link aur icon ka style [cite: 2026-01-31] */
.nav-link-header {
    text-decoration: none;
    color: white; 
    font-weight: 600;
    margin-right: 20px;
    display: inline-flex;
    align-items: center;
    gap: 8px; 
    font-size: 0.95rem;
    transition: 0.3s ease;
}

.nav-link-header:hover {
    color: #ffcccc; /* Hover karne par halka color change [cite: 2025-10-01] */
}

/* 3. Full Screen Section Setup [cite: 2026-01-31] */
.how-section {
    padding: 100px 0;
    width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
    overflow: hidden;
    background-color: #ffffff;
}

.how-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 80px;
    padding: 0 40px;
}



/* --- MOBILE RESPONSIVE FIXES --- */
@media (max-width: 768px) {
    /* 1. Header aur Menu Fix */
    .header-container {
        flex-direction: column; /* Logo upar, menu niche */
        padding: 10px;
    }
    
    .nav-menu {
        flex-wrap: wrap; /* Links screen ke andar rahein */
        justify-content: center;
        gap: 15px;
        margin-top: 10px;
    }

    .nav-menu li a {
        font-size: 0.8rem; /* Chota font mobile ke liye */
        padding: 5px 8px;
    }

    /* 2. Hero Section Fix */
    .amazon-hero h2 {
        font-size: 2.5rem !important; /* Text chota kiya */
    }

    /* 3. Amazon Hero Overlap Fix */
    .how-container {
        flex-direction: column !important; /* Step images ek ke niche ek */
        text-align: center;
        gap: 30px;
    }

    /* 4. Ticker Section Fix – proper space (not for ticker-in-banner) */
    .ticker-section:not(.ticker-in-banner) {
        font-size: 0.9rem;
        margin-top: 24px;
        margin-bottom: 24px;
        padding: 14px 16px;
        min-height: 48px;
    }

    /* 5. Width Fix + Footer no gap (Ye zaroori hai) */
    .amazon-footer, .how-section {
        width: 100%; 
        margin-left: 0;
        margin-right: 0;
        left: 0;
    }
    .amazon-footer { margin-bottom: 0 !important; }
    .premium-footer { margin-bottom: 0 !important; padding-bottom: 16px; }
}
/* Eligibility Main Wrapper */
.eligibility-wrapper {
    width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
    margin-top: 100px;
    background: #fff;
    overflow-x: hidden;

    margin-top: 0px !important; 
    padding-top: 60px !important; 
    margin-bottom: 0 !important;
}

/* Base Section */
.section-full {
    display: flex;
    width: 100%;
    height: 500px; /* Tera perfect size */
    align-items: stretch;

    

}

/* Photo Side: 35% Width */
.side-img {
    flex: 0 0 35%; 
    height: 100%;
}

.side-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Text Side: 65% Width */
.side-text {
    flex: 0 0 65%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 8%; 
    background: #fff;
}

.side-text .content {
    max-width: 550px;
}

.side-text h2 {
    font-size: 2.5rem;
    color: #1a1a1a;
    margin-bottom: 15px;
    font-weight: 800;
}

.side-text p {
    font-size: 1.1rem;
    color: #555;
    line-height: 1.6;
}

/* Manual Reverse Force */
.reverse-row {
    flex-direction: row-reverse !important;
}

/* Alternate Background */
.bg-light {
    background: #f9f9f9 !important;
}



/* FAQ */
/* FAQ Section - Final Forceful Fix */
/* FAQ SECTION - THE PRO VERSION */
.faq-section {
    width: 100vw !important;
    min-height: 100vh !important;
    display: flex !important;
    align-items: center !important;
    background: #ffffff !important;
    padding: 100px 0 !important;
    margin: 0 !important;
    left: 50% !important;
    right: 50% !important;
    margin-left: -50vw !important;
    margin-right: -50vw !important;
    position: relative !important;
    overflow: hidden !important;
}


/* 2. Footer ko FAQ se "Join" karo */
footer {
    margin-top: 10px !important; 
    padding-top: 60px !important; 
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
    background: #1a1a1a; 
}

/* 3. Global Reset (Kahin kisi hidden padding ki wajah se gap na ho) */
* {
    box-sizing: border-box;
}
.faq-container {
    width: 100% !important;
    max-width: 1400px !important;
    margin: 0 auto !important;
    display: flex !important;
    justify-content: space-between !important;
    gap: 80px !important;
    padding: 0 50px !important;
}

.faq-visual {
    flex: 0 0 40% !important;
}

.faq-intro h2 {
    font-size: 3.8rem !important;
    font-weight: 900 !important;
    line-height: 1.1 !important;
    color: #1a1a1a !important;
    margin-top: 20px !important;
}

/* Accordion Side - Sirf Questions Dikhenge */
.faq-accordion {
    flex: 1 !important;
}

.accordion-item {
    border-bottom: 2px solid #f0f0f0 !important;
    margin-bottom: 10px !important;
}

.accordion-header {
    width: 100% !important;
    padding: 30px 0 !important;
    background: none !important;
    border: none !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    cursor: pointer !important;
    font-size: 1.4rem !important;
    font-weight: 700 !important;
    color: #1a1a1a !important;
    text-align: left !important;
    transition: 0.3s !important;
}

.accordion-header:hover {
    color: #c41e3a !important;
}

/* Answer hidden by default - Magic yahan hai */
.accordion-body {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease-out !important;
}

.accordion-body p {
    padding: 0 0 30px 0 !important;
    color: #666 !important;
    line-height: 1.8 !important;
    font-size: 1.1rem !important;
}

/* Mobile Fix */
@media (max-width: 992px) {
    .faq-container {
        flex-direction: column !important;
        padding: 0 20px !important;
    }
    .faq-intro h2 { font-size: 2.5rem !important; }
}




.premium-footer {
    background: #09121d !important; /* Ekdam midnight blue */
    padding: 40px 10px;
    text-align: center;
    margin-bottom: 0 !important;
}

/* Premium footer ke andar ke paragraph ka bottom margin hatao
   taaki niche pink background ka gap na aaye */
.premium-footer p {
    margin: 0;
}

.brand-signature {
    margin-top: 15px;
    display: flex;
    flex-direction: column; /* Mobile pe ek ke niche ek */
    align-items: center;
    gap: 5px;
}

.prefix-tag {
    font-size: 0.7rem;
    color: rgba(255,255,255,0.4);
    text-transform: uppercase;
    letter-spacing: 3px;
}

.final-brand {
    font-size: 1.1rem;
    color: #ffffff;
    font-weight: 700;
    letter-spacing: 4px;
    text-transform: uppercase;
}

.divider {
    color: #FB3640; /* Red divider point */
    margin: 0 5px;
}

/* Laptop pe side-by-side */
@media screen and (min-width: 768px) {
    .brand-signature {
        flex-direction: row;
        justify-content: center;
        gap: 15px;
    }
}

/* ========== INDEX PAGE ONLY: Responsive – LAPTOP (1024px+) LAYOUT BILKUL SAME ========== */
@media (max-width: 1023px) {
    .page-index .header-container { padding: 0 20px; }
    .page-index .logo-text h1 { font-size: 1.85rem; }
    .page-index .nav-menu { gap: 18px; }
    .page-index .nav-menu li a { font-size: 0.9rem; padding: 6px 10px; }
    .page-index .amazon-hero { padding-bottom: 50px; }
    .page-index .amazon-hero .hero-content { padding-bottom: 56px; }
    .page-index .amazon-hero h2 { font-size: 3rem; }
    .page-index .hero-content p { font-size: 1.3rem; }
    .page-index .how-text h2 { font-size: 2.2rem; }
    .page-index .how-container { gap: 40px; padding: 0 24px; }
    .page-index .request-section { margin-top: 28px; padding-top: 24px; }
    .page-index .request-grid { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); padding: 16px; }
    .page-index .eligibility-wrapper .section-full { flex-direction: column; height: auto; min-height: 400px; }
    .page-index .eligibility-wrapper .side-img { flex: 0 0 auto; height: 220px; }
    .page-index .eligibility-wrapper .side-text { flex: 1 1 auto; padding: 30px 20px; }
    .page-index .eligibility-wrapper .side-text h2 { font-size: 1.85rem; }
    .page-index .faq-container { flex-direction: column; padding: 0 24px; gap: 40px; }
    .page-index .faq-intro h2 { font-size: 2.5rem; }
    .page-index .footer-container { gap: 28px; padding: 0 20px; }
}

@media (max-width: 768px) {
    /* Banner header ke bilkul niche natural – zyada shift nahi, headline upar hi */
    body.page-index { padding-top: 200px !important; }
    .page-index .header-container { flex-direction: column; gap: 8px; padding: 0 8px; }
    .page-index .nav-menu { display: grid !important; grid-template-columns: repeat(3, 1fr) !important; gap: 6px; width: 100%; }
    .page-index .nav-menu li { width: 100% !important; }
    .page-index .nav-menu li a,
    .page-index .admin-link-header,
    .page-index .nav-link-header { justify-content: center !important; font-size: 0.7rem !important; padding: 6px 4px !important; width: 100% !important; }
    .page-index .nav-login { grid-column: span 3 !important; width: 100% !important; text-align: center !important; padding: 8px 12px !important; }
    /* Banner layout image jaisa: flex column, content upar se, ticker flow mein neeche – sab dikhe */
    .page-index .amazon-hero { min-height: auto !important; padding: 24px 12px 0 !important; margin-top: 0 !important; display: flex !important; flex-direction: column !important; align-items: center !important; justify-content: flex-start !important; }
    .page-index .amazon-hero h2 { font-size: 2rem !important; margin-top: 0 !important; margin-bottom: 0; }
    .page-index .amazon-hero .hero-content { padding-bottom: 0 !important; padding-top: 16px; }
    .page-index .hero-content p { font-size: 1.1rem !important; margin: 12px 0 20px !important; }
    /* Buttons vertically stacked, stats neeche – exact image layout */
    .page-index .hero-content div[style*="display: flex"] { flex-direction: column !important; gap: 12px !important; width: 100% !important; max-width: 320px; margin: 0 auto !important; align-items: center !important; }
    .page-index .hero-content a,
    .page-index .hero-content button { width: 100% !important; max-width: 280px; padding: 14px 20px !important; font-size: 1rem !important; text-align: center; }
    .page-index .hero-content > div:last-of-type { flex-direction: row !important; flex-wrap: wrap !important; justify-content: center !important; gap: 16px 24px !important; padding: 20px 16px !important; width: 90% !important; max-width: 340px; margin-top: 28px !important; }
    .page-index .hero-content > div:last-of-type h3 { font-size: 1.75rem !important; }
    .page-index .hero-content > div:last-of-type > div:nth-child(2) { display: block !important; height: 40px; }
    .page-index .container { padding: 20px 12px; max-width: 100%; overflow-x: hidden; }
    /* Ticker flow mein – banner ke andar neeche, hamesha show hoga */
    .page-index .ticker-in-banner { position: static !important; width: 100% !important; margin: 0 !important; margin-top: 0 !important; padding: 12px 16px !important; min-height: 46px; border-top: 3px solid var(--primary-red); }
    .page-index .ticker-in-banner marquee { color: #fff !important; font-size: 0.9rem; font-weight: 800; }
    .page-index .request-section { overflow-x: hidden; max-width: 100%; padding-left: 12px; padding-right: 12px; margin-top: 28px !important; padding-top: 24px !important; }
    .page-index .request-section h2 { font-size: 1.6rem !important; margin-bottom: 24px !important; margin-top: 0; padding-left: 0; }
    .page-index .request-grid { grid-template-columns: 1fr; gap: 20px; padding: 12px 0; }
    .page-index .request-card { padding: 20px; }
    .page-index .how-container { flex-direction: column !important; text-align: center; gap: 24px; padding: 0 16px; }
    .page-index .how-section.reverse .how-container { flex-direction: column !important; }
    .page-index .how-text h2 { font-size: 1.75rem; }
    .page-index .how-text p { font-size: 1rem; }
    .page-index .how-image img { max-width: 100%; }
    .page-index .eligibility-wrapper { padding-top: 40px !important; margin-top: 0 !important; }
    .page-index .section-full { flex-direction: column !important; height: auto !important; min-height: auto !important; }
    .page-index .section-full.reverse-row { flex-direction: column !important; }
    .page-index .side-img { flex: none; height: 200px; }
    .page-index .side-text { flex: none; padding: 24px 16px; }
    .page-index .side-text h2 { font-size: 1.5rem; }
    .page-index .side-text .content h2:first-of-type { font-size: 1rem; }
    .page-index .faq-section { padding: 60px 0 !important; min-height: auto !important; }
    .page-index .faq-container { padding: 0 16px; gap: 28px; }
    .page-index .faq-intro h2 { font-size: 2rem !important; }
    .page-index .accordion-header { font-size: 1.1rem !important; padding: 20px 0 !important; }
    /* Footer: no gap below, stick to bottom in responsive */
    body.page-index { padding-bottom: 0 !important; margin-bottom: 0 !important; min-height: 100vh; display: flex; flex-direction: column; }
    body.page-index .container { flex: 1 1 auto; }
    .page-index .amazon-footer { padding: 24px 0 12px; margin-bottom: 0 !important; width: 100%; left: 0; right: 0; margin-left: 0; margin-right: 0; }
    .page-index .premium-footer { margin-bottom: 0 !important; padding-bottom: 16px; width: 100%; }
    .page-index .footer-container { grid-template-columns: 1fr; gap: 24px; text-align: center; padding: 0 16px; }
    .page-index .footer-column h3 { font-size: 1.1rem; }
    .page-index #compModal > div { margin: 15% 12px; width: calc(100% - 24px); padding: 24px 16px; }
    .page-index #compModal select { margin-bottom: 16px; }
    .page-index #compModal div[style*="display: flex"] { flex-direction: column !important; }
    .page-index #scrollTopBtn { bottom: 20px; right: 20px; padding: 12px 16px; font-size: 18px; }
}

@media (max-width: 480px) {
    .page-index .logo-text h1 { font-size: 1.5rem; }
    .page-index .blood-drop-logo { width: 36px; height: 36px; }
    .page-index .amazon-hero h2 { font-size: 1.65rem !important; }
    .page-index .hero-content p { font-size: 1rem !important; }
    .page-index .hero-content a,
    .page-index .hero-content button { width: 100% !important; font-size: 0.95rem !important; }
    .page-index .request-section h2 { font-size: 1.4rem !important; }
    .page-index .how-text h2 { font-size: 1.5rem; }
    .page-index .side-text h2 { font-size: 1.35rem; }
    .page-index .faq-intro h2 { font-size: 1.65rem !important; }
    .page-index .accordion-header { font-size: 1rem !important; }

}



  </style>

</head>
<body class="page-index">

<?php 
include('config.php'); 
// Stats fetch karna [cite: 2026-01-29]
$donors_query = mysqli_query($conn, "SELECT * FROM donors");
$donors_count = $donors_query ? mysqli_num_rows($donors_query) : 0;

$requests_query = mysqli_query($conn, "SELECT * FROM blood_requests");
$requests_count = $requests_query ? mysqli_num_rows($requests_query) : 0;
?>
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

<style>
    .contact-link-header {
        transition: all 0.3s ease; /* Smooth movement ke liye */
    }
    .contact-link-header:hover {
        background: #c41e3a !important; /* Background red ho jayega */
        transform: translateY(-2px); /* Halksa upar uthega */
        box-shadow: 0 4px 12px rgba(196, 30, 58, 0.2); /* Shadow aayegi */
    }
    .contact-link-header:hover .text, 
    .contact-link-header:hover i {
        color: white !important; /* Text aur Icon white ho jayenge */
    }
</style>

<a href="contact.php" class="contact-link-header" style="text-decoration: none; display: flex; align-items: center; gap: 8px; padding: 8px 18px; background: #fdf2f2; border-radius: 50px; border: 1px solid #ffcccc;">
    <i class="fas fa-headset" style="color: #c41e3a; font-size: 1.1rem; transition: 0.3s;"></i>
    <span class="text" style="font-weight: 700; color: #333; font-size: 0.9rem; transition: 0.3s;">Contact Us</span>
</a>
                    <li><a href="login.php" class="nav-login">
                        <img src="assets/user.png" class="nav-icon-img login-user-icon"> Login
                    </a></li>
                </ul>
            </nav>
        </div>
    </header>

<section class="amazon-hero">
    <div class="hero-overlay"></div>
    
    <div class="hero-content">
        <h2 style="font-size: 4.5rem; font-weight: 900; margin: 0; text-shadow: 3px 3px 15px rgba(0,0,0,0.4);">
            Every Drop Counts
        </h2>
        <p style="font-size: 1.6rem; margin: 20px 0 30px; opacity: 0.9;">
            Your blood donation can give someone a second chance at life.
        </p>
       
        
        <div style="display: flex; gap: 20px; justify-content: center; margin-bottom: 50px;">
            <a href="register.php" style="background: #FB3640; color: white; padding: 15px 40px; border-radius: 50px; text-decoration: none; font-weight: 800; font-size: 1.1rem; box-shadow: 0 10px 20px rgba(251, 54, 64, 0.3);">
                Start Donating
            </a>
            <a href="search.php" style="padding: 15px 40px; border-radius: 50px; background: rgba(255,255,255,0.2); color: white; border: 2px solid white; text-decoration: none; font-weight: 800; font-size: 1.1rem; backdrop-filter: blur(5px);">
                Find Donors
            </a>

            <button onclick="openModal()" style="background: #FB3640; color: white; padding: 15px 40px; border-radius: 50px; text-decoration: none; font-weight: 800; font-size: 1.1rem; box-shadow: 0 10px 20px rgba(251, 54, 64, 0.3);">
    Check Compatibility
</button>

<div id="compModal" style="display:none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); backdrop-filter: blur(5px);">
    
    <div style="background-color: #fff; margin: 10% auto; padding: 30px; border-radius: 15px; width: 90%; max-width: 600px; position: relative; text-align: center; box-shadow: 0 5px 30px rgba(0,0,0,0.3);">
        
        <span onclick="closeModal()" style="position: absolute; right: 20px; top: 10px; font-size: 28px; font-weight: bold; cursor: pointer; color: #666;">&times;</span>
        
        <h2 style="color: #c41e3a; margin-bottom: 10px;">Blood Compatibility Checker</h2>
        <p style="margin-bottom: 20px; color: #555;">Select your blood group to know your match.</p>

        <select id="bloodGroupSelector" style="width: 100%; padding: 12px; font-size: 1rem; border-radius: 8px; border: 2px solid #ddd; margin-bottom: 25px;">
            <option value="">-- Select Blood Group --</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
        </select>


        <div style="display: flex; gap: 15px; text-align: left;">
            <div style="flex: 1; background: #e8f5e9; padding: 15px; border-radius: 10px; border-left: 5px solid #2e7d32;">
                <strong style="color: #2e7d32;">Can Give To:</strong>
                <div id="giveList" style="margin-top: 10px; font-weight: bold; color: #2e7d32;">---</div>
            </div>
            <div style="flex: 1; background: #fffde7; padding: 15px; border-radius: 10px; border-left: 5px solid #fbc02d;">
                <strong style="color: #fbc02d;">Can Receive From:</strong>
                
<div id="receiveList" style="margin-top: 10px; font-weight: bold; color: #f9a825;">---</div>
            </div>
        </div>
        
        <button onclick="closeModal()" style="margin-top: 25px; padding: 10px 30px; background: #666; color: white; border: none; border-radius: 5px; cursor: pointer;">Close</button>
    </div>
</div>

            
        </div>

        <div style="display: flex; justify-content: center; gap: 60px; background: rgba(255, 255, 255, 0.1); padding: 25px 50px; border-radius: 20px; backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.2); width: fit-content; margin: 0 auto;">
            
            <div style="text-align: center;">
                <h3 style="margin: 0; font-size: 2.5rem; color: #fff; font-weight: 900;"><?php echo $donors_count; ?>+</h3>
                <p style="margin: 0; color: rgba(255,255,255,0.8); font-weight: 600; font-size: 0.9rem; text-transform: uppercase;">Registered Donors</p>
            </div>

            <div style="width: 1px; background: rgba(255,255,255,0.3); height: 50px;"></div>

            <div style="text-align: center;">
                <h3 style="margin: 0; font-size: 2.5rem; color: #fff; font-weight: 900;"><?php echo $requests_count; ?>+</h3>
                <p style="margin: 0; color: rgba(255,255,255,0.8); font-weight: 600; font-size: 0.9rem; text-transform: uppercase;">Active Requests</p>
            </div>
        </div>
    </div>

    <div class="ticker-section ticker-in-banner">
        <marquee behavior="scroll" direction="left" scrollamount="5"><?php
            $ticker_sql = "SELECT patient_name, blood_group, city FROM blood_requests ORDER BY posted_at DESC LIMIT 5";
            $ticker_res = mysqli_query($conn, $ticker_sql);
            if($ticker_res && mysqli_num_rows($ticker_res) > 0) {
                while($ticker = mysqli_fetch_assoc($ticker_res)) {
                    echo "🚨 URGENT: " . htmlspecialchars($ticker['blood_group']) . " required for " . htmlspecialchars($ticker['patient_name']) . " in " . htmlspecialchars($ticker['city']) . " |      ";
                }
            } else { echo "📢 Help save a life! Register today as a Blood Donor."; }
        ?></marquee>
    </div>

</section>


    
    <div class="container">
        <main>

            <section class="request-section">
                <h2 style="text-align: center; font-weight: 800; color: var(--deep-blue); margin-bottom: 40px; font-size: 2.2rem;">📢 Live Emergency Requests</h2>
                <div class="request-grid">
                    <?php
                    $sql = "SELECT * FROM blood_requests ORDER BY posted_at DESC LIMIT 6";
                    $res = mysqli_query($conn, $sql);
                    if($res && mysqli_num_rows($res) > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $urgency = $row['urgency_level'] ?? 'Normal';
                            $cardClass = ($urgency == 'Critical') ? "card-critical" : "";
                    ?>
                    <div class="request-card <?php echo $cardClass; ?>">
                        <div style="background: <?php echo ($urgency == 'Critical' ? '#FB3640' : '#22577A'); ?>; color: white; padding: 6px 15px; border-radius: 5px; font-size: 0.8rem; font-weight: 800; display: inline-block; margin-bottom: 15px;">
                            <?php echo strtoupper($urgency); ?>: <?php echo htmlspecialchars($row['blood_group']); ?>
                        </div>
                        <h3 style="margin: 0; font-size: 1.5rem; color: #1a1a1a;"><?php echo htmlspecialchars($row['patient_name']); ?></h3>
                        <p style="color: #666; margin: 10px 0;">📍 <?php echo htmlspecialchars($row['hospital_name']); ?>, <?php echo htmlspecialchars($row['city']); ?></p>
                        
                        <a href="https://www.google.com/maps/search/<?php echo urlencode($row['hospital_name']." ".$row['city']); ?>" target="_blank" class="map-btn">📍 View on Google Maps</a>
                        <a href="tel:<?php echo $row['contact_no']; ?>" class="call-btn">Call to Help</a>
                    </div>
                    <?php } } ?>
                </div>
            </section>

      <section id="how-it-works-section" class="how-section bg-white">
    <div class="how-container">
        <div class="how-text">
            <h3>STEP 01</h3>
            <h2>Create Your Life-Saving Profile</h2>
            <p>Join our mission by registering as a donor or seeker. It takes less than a minute to set up your profile and blood group details so we can connect you with the right people.</p>
        </div>
        <div class="how-image">
            <img src="assets/re.png" alt="Register">
        </div>
    </div>
</section>

<section class="how-section bg-light reverse">
    <div class="how-container">
        <div class="how-text">
            <h3>STEP 02</h3>
            <h2>Search & Post Requests</h2>
            <p>Find donors nearby by filtering through blood groups and locations. In case of emergency, post a request that alerts all eligible donors in your area instantly.</p>
        </div>
        <div class="how-image">
            <img src="assets/post.png" alt="Search">
        </div>
    </div>
</section>

<section class="how-section bg-white">
    <div class="how-container">
        <div class="how-text">
            <h3>STEP 03</h3>
            <h2>Connect & Save Lives</h2>
            <p>Directly communicate with donors or seekers. Coordinate the donation process through our system and help make a real difference in someone's life today.</p>
        </div>
        <div class="how-image">
            <img src="assets/cc.png" alt="Connect">
        </div>
    </div>
</section>
        
<div class="eligibility-wrapper">
    
    <section class="section-full">
        <div class="side-img">
            <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?q=80&w=1000" alt="Age Weight">
        </div>
        <div class="side-text">
            <div class="content">
                <h2 style="color: #c41e3a; font-size: 1.2rem; text-transform: uppercase;">01 / Requirements</h2>
                <h2>Age and Weight Standards</h2>
                <p>Donors must be aged between 18-65 years and weigh at least 50kg. A healthy weight ensures a safe recovery after your life-saving contribution.</p>
            </div>
        </div>
    </section>

    <section class="section-full reverse-row">
        <div class="side-img">
            <img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?q=80&w=1000" alt="Health Status">
        </div>
        <div class="side-text bg-light">
            <div class="content">
                <h2 style="color: #c41e3a; font-size: 1.2rem; text-transform: uppercase;">02 / Health Check</h2>
                <h2>General Health Status</h2>
                <p>You should be in good health and feeling well on the day of donation. Ensure you are free from infectious diseases, fever, or any current medications.</p>
            </div>
        </div>
    </section>

    <section class="section-full">
        <div class="side-img">
            <img src="assets/Healthy.jpg" alt="Habits">
        </div>
        <div class="side-text">
            <div class="content">
                <h2 style="color: #c41e3a; font-size: 1.2rem; text-transform: uppercase;">03 / Lifestyle</h2>
                <h2>Lifestyle & Habits</h2>
                <p>Maintain a healthy diet and stay hydrated. Avoid alcohol consumption 24 hours prior to donation and ensure you have a nutritious meal before your appointment.</p>
            </div>
        </div>
    </section>

    <section class="section-full reverse-row">
        <div class="side-img">
            <img src="assets/image.jpg" alt="Interval">
        </div>
        <div class="side-text bg-light">
            <div class="content">
                <h3 style="color: #c41e3a; font-size: 1.2rem; text-transform: uppercase;">04 / Frequency</h3>
                <h2>Donation Interval</h2>
                <p>To keep your iron levels healthy, a mandatory gap of 90 days is required between whole blood donations. Your body needs this time to fully replenish.</p>
                
               
            </div>
        </div>
    </section>

</div>
        



<section class="faq-section">
    <div class="faq-container">
        <div class="faq-visual">
            <div class="faq-intro">
                <span class="tag" style="color: #c41e3a; font-size: 13px; font-weight: 800; text-transform: uppercase; letter-spacing: 3px; border-left: 2px solid #c41e3a; padding-left: 10px; display: inline-block; line-height: 1; margin-bottom: 15px;">Support</span>
                <h2>Frequently Asked <br>Questions!</h2>
    
                <p style="font-family: 'Poppins', sans-serif; font-size: 1.1rem; color: #444; line-height: 1.6; border-left: 3px solid #fbdada; padding-left: 20px; margin-top: 15px; font-style: italic;">
    Have questions about blood donation? We've gathered the most common queries to help you feel confident and informed.
</p>
                <div class="support-box">
                    <p style="font-family: 'Poppins', sans-serif; font-size: 1.1rem; color: #444; line-height: 1.6; border-left: 3px solid  padding-left: 20px; margin-top: 15px; font-style: italic;">
    Still have questions?
</p>
                   <a href="mailto:shahnitin1214@gmail.com" class="contact-btn" style="
    display: inline-block;
    padding: 14px 32px;
    background: #c41e3a;
    color: #ffffff;
    text-decoration: none;
    font-size: 15px;
    font-weight: 700;
    border-radius: 6px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 10px 20px rgba(196, 30, 58, 0.2);
    border: 2px solid #c41e3a;
" onmouseover="this.style.background='transparent'; this.style.color='#c41e3a'; this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(196, 30, 58, 0.3)';" 
  onmouseout="this.style.background='#c41e3a'; this.style.color='#ffffff'; this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 20px rgba(196, 30, 58, 0.2)';">
    Contact Support
</a>
                </div>
            </div>
        </div>

        <div class="faq-accordion">
            <div class="accordion-item">
                <button class="accordion-header">
                    <span>01. Is blood donation painful?</span>
                    <i class="plus-icon">+</i>
                </button>
                <div class="accordion-body">
                    <p>Not at all! You’ll only feel a quick, tiny pinch when the needle is inserted. Most donors say it’s no more painful than a regular blood test. Our staff ensures you are comfortable throughout the process.</p>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>02. How long does the entire process take?</span>
                    <i class="plus-icon">+</i>
                </button>
                <div class="accordion-body">
                    <p>The actual donation only takes about 8-10 minutes. However, including registration, a mini-health check, and 15 minutes of rest with refreshments afterward, you should plan for about 45-60 minutes in total.</p>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>03. Can I donate if I have a tattoo or piercing?</span>
                    <i class="plus-icon">+</i>
                </button>
                <div class="accordion-body">
                    <p>Yes, but there is usually a waiting period. In most regions, you can donate if your tattoo or piercing was performed more than 3 to 6 months ago in a licensed facility using sterile needles.</p>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>04. What should I eat before donating?</span>
                    <i class="plus-icon">+</i>
                </button>
                <div class="accordion-body">
                    <p>Eat a healthy, low-fat meal and drink plenty of water (at least 2-3 glasses) before your donation. Avoid fatty foods like burgers or fries, as they can affect the quality of your blood for testing.</p>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>05. Will I feel weak after donating blood?</span>
                    <i class="plus-icon">+</i>
                </button>
                <div class="accordion-body">
                    <p>Most people feel perfectly fine. We provide snacks and juice after donation to help your body recover. As long as you stay hydrated and avoid heavy lifting for the rest of the day, you'll be back to normal quickly.</p>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>06. Why is there a 90-day gap between donations?</span>
                    <i class="plus-icon">+</i>
                </button>
                <div class="accordion-body">
                    <p>This gap is essential to allow your body to replenish its iron levels. Your safety is our priority, and this interval ensures that your red blood cell count returns to normal before you give again.</p>
                </div>
            </div>
        </div>
    </div>
</section>



</main>



<style>
#scrollTopBtn {
    display: none; /* Shuru mein chhupa rahega */
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 99;
    border: none;
    outline: none;
    background-color: #FB3640; /* Tera Primary Red */
    color: white;
    cursor: pointer;
    padding: 15px 20px;
    border-radius: 50%;
    font-size: 20px;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    transition: 0.3s;
}

#scrollTopBtn:hover {
    background-color: #22577A; /* Hover pe Blue */
    transform: scale(1.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById("scrollTopBtn");
    if (!btn) return;

    window.addEventListener('scroll', function() {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            btn.style.display = "block";
        } else {
            btn.style.display = "none";
        }
    });

    btn.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
</script>

<script>
// Modal Open/Close Functions
function openModal() {
    document.getElementById('compModal').style.display = "block";
}

function closeModal() {
    document.getElementById('compModal').style.display = "none";
}

// Medical Data Logic
const compatibilityData = {
    'A+': { give: 'A+, AB+', receive: 'A+, A-, O+, O-' },
    'A-': { give: 'A+, A-, AB+, AB-', receive: 'A-, O-' },
    'B+': { give: 'B+, AB+', receive: 'B+, B-, O+, O-' },
    'B-': { give: 'B+, B-, AB+, AB-', receive: 'B-, O-' },
    'AB+': { give: 'AB+ only', receive: 'Everyone (Universal)' },
    'AB-': { give: 'AB+, AB-', receive: 'A-, B-, AB-, O-' },
    'O+': { give: 'O+, A+, B+, AB+', receive: 'O+, O-' },
    'O-': { give: 'Everyone (Universal Donor)', receive: 'O- only' }
};

document.getElementById('bloodGroupSelector').addEventListener('change', function() {
    const selected = this.value;
    document.getElementById('giveList').innerText = selected ? compatibilityData[selected].give : "---";
    document.getElementById('receiveList').innerText = selected ? compatibilityData[selected].receive : "---";
});

// Modal ke bahar click karne par band ho jaye
window.onclick = function(event) {
    if (event.target == document.getElementById('compModal')) {
        closeModal();
    }
}
</script>



 <footer class="amazon-footer">
    <div class="footer-container">
        <div class="footer-column">
            <h3>BloodLink</h3>
            <p style="font-size: 0.9rem; line-height: 1.6; color: rgba(255,255,255,0.7);">
                Helping to connect donors with patients across the country. Every donation saves a life. 
            </p>
        </div>
        <button id="scrollTopBtn" title="Go to top">↑</button>




      <div class="footer-column">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="about.php">About Us</a></li>
                <li><a href="search.php">Search Donors</a></li>
                <li><a href="login.php">Donor Login</a></li>
            </ul>
        </div>

       
        <div class="footer-column">
            <h3>Contact Us</h3>
            <ul style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">
                <li>📍 Location: Dehradun, Uttarakhand </li>
                <li>📞 Emergency: +91 8475854497 </li>
                <li>✉️ Supoort: helpbloodlink@gmail.com </li>
            </ul>
        </div>
    </div>

    
<footer class="premium-footer">
    <div class="footer-wrap">
        <p class="copyright-text">© 2026 **BloodLink System**. Making a difference, one donation at a time.</p>

        <div class="brand-signature">
    <span class="prefix-tag">Powered by</span>
    <span class="final-brand">
        Z-TECH <span class="divider">|</span>
        <a href="admin_panel.php" style="color: inherit; text-decoration: none; cursor: default;">NITIN</a>
    </span>
</div>


    </div>
</footer> 

    <script>
    // Footer ko sirf tab bottom pe chipkaye jab content kam ho,
    // baaki layout (header / banner) ko touch kiye bina.
    function adjustFooterPosition() {
        const footer = document.querySelector('.premium-footer');
        if (!footer) return;

        // Reset style pehle
        footer.style.position = '';
        footer.style.left = '';
        footer.style.right = '';
        footer.style.bottom = '';

        if (document.body.scrollHeight <= window.innerHeight) {
            footer.style.position = 'fixed';
            footer.style.left = '0';
            footer.style.right = '0';
            footer.style.bottom = '0';
        }
    }

    window.addEventListener('load', adjustFooterPosition);
    window.addEventListener('resize', adjustFooterPosition);
    </script>

    <script>
    // Jab page load/refresh ho 
    window.onload = function() {
        
        if (window.location.hash) {
            window.scrollTo(0, 0); 
            
            history.replaceState(null, null, window.location.pathname); 
        }
    };


    document.querySelectorAll('.accordion-header').forEach(button => {
    button.addEventListener('click', () => {
        const accordionBody = button.nextElementSibling;
        const isOpen = accordionBody.style.maxHeight;

        // Sabko band karne ke liye (Option: Single Open)
        document.querySelectorAll('.accordion-body').forEach(body => body.style.maxHeight = null);

        if (!isOpen) {
            accordionBody.style.maxHeight = accordionBody.scrollHeight + "px";
        }
    });
});
</script>

</body>
</html>