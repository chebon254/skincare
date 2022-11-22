<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- == META OG Social Media Ads == -->
    <meta property="og:title" content="SkinCare" />
    <meta property="og:url" content="https://skincare-is-project.web.app" />
    <meta property="og:image" content="https://skincare-is-project.web.app/css/img/facebook.png" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Onestop Shop for Your Skin Care products." />

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@chebon_kibet">
    <meta name="twitter:title" content="SkinCare">
    <meta name="twitter:description" content="Onestop Shop for Your Skin Care products.">
    <meta name="twitter:image" content="https://skincare-is-project.web.app/css/img/twitter.png">
    <meta name="twitter:player" content="https://skincare-is-project.web.app">
    <meta name="twitter:player:width" content="280">
    <meta name="twitter:player:height" content="150">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/mstile-144x144.png">
    <meta name="msapplication-config" content="favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <title>SkinCare</title>

    <!-- == Favicon == -->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="favicon/favicon.ico">

    <!-- == Style Sheet == -->
    <link rel="stylesheet" href="css/style.css">

    <!-- == Fonts == -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">

    <!-- == Icons == -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous" />

</head>
<body>
    <!-- == HEADER == -->
        <header class="header-scroll header">
            <nav id="nav-bar">
                <div class="nav-container container">
                    <!-- == Logo == -->
                        <div class="logo">
                            <a href="home.php"><img src="css/img/Skin care logo.png" alt="Skincare Logo"></a>
                        </div>
                        <div class="links" id="links">
                            <div class="cancel">
                                <span class="cancel-btn"><i class="fas fa-times"></i></span>
                            </div>
                            <a href="home.php">HOME</a>
                            <a class="active-link" href="about.php">ABOUT US</a>
                            <a href="blog.html">BLOG</a>
                            <!-- == Product Listing == -->
                                <div class="nav-prod-listing">
                                    <div class="cart nav-listings">
                                        <span class="cart-listings listing"><i class="fas fa-solid fa-shopping-bag"></i><span class="count">6</span></span>
                                    </div>
                                    <div class="price nav-listings">
                                        <p class="price-total">$0.00</p>
                                    </div>
                                    <div class="account" style="padding-left: 20px;">
                                        <!-- == Acc Access == -->
                                        <div class="account-access\">
                                            <a href="login.php">SignIn</a>
                                            <span>|</span>
                                            <a href="sign_up.php">Register</a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    <div class="menu-bar">
                        <span class="menu-btn"><i class="fas fa-bars"></i></span>
                    </div>
                </div>
            </nav>
        </header>
    <!-- == || HEADER == -->
    <?php if(!isset($_SESSION['user_id']) || isset($_SESSION['user_id'])){ ?>
    <!-- == MAIN == -->
        <main>
        <section class="market-place">
                    <div class=" container mkt-headline">
                        <div class="underline"></div>
                        <h1 class="">About Us</h1>
                        <p class="">Skincare will get you where you want to go. From skin tone through texture.</p>
                    </div>
                    <div class="container market-place-container">
                        <div class="mkt-plc-text">
                            <h3>With SkinCare, improve your look in minutes.</h3>
                            <p>Feel better with our guides to different areas of preventative health. We work with health and wellness experts to offer the best advice and product selections on everything from sleeping better to easing anxiety. </p>
                        </div>
                        <div class="mkt-plc-img">
                            <img src="css/img/hand gel.png" alt="Image">
                        </div>
                    </div>
                </section>
        </main>
    <!-- == || MAIN == -->

    <!-- == FOOTER == -->
        <footer>
            <div class="footer-container container">
                <div class="footer-col col-1">
                    <a class="footer-logo" href="#"><img src="css/img/Skin care footer logo.png" alt="Skin Care logo" width="280px">
                        </a>
                    <p class="col-1-p">Alternative skin care products<br> good for your skin.</p>
                    <div class="footer-social-icons">
                        <a href="#"><i class="fab fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-brands fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-brands fa-twitter"></i></a>
                    </div>
                </div>
                <div class="footer-col col-2">
                    <h4>COMPANY</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Learn</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-col col-3">
                    <h4>OTHER MENU</h4>
                    <ul>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>
                <div class="footer-col footer-col-4">
                    <h4>SUPPORT</h4>
                    <ul>
                        <li><i class="fas fa-solid fa-phone"></i> +254 715 925 156</li>
                        <li><i class="fas fa-solid fa-envelope"></i> skincare@info.com</li>
                        <li><i class="fas fa-solid fa-map-marker-alt"></i> Nairobi City</li>
                    </ul>
                </div>
            </div>
            <div class="footer-copyright container">
                <p>Copyright &copy; 2022 All rights reserved</p>
            </div>
        </footer>
        <?php } ?>
    <!-- == || FOOTER == -->
    <!-- == Cursor == -->
    <!-- <div class="cursor"><i class="fa-solid fa-location-arrow"></i></div> -->

    <!-- == To TOP == -->
        <a class="to-top" onclick="topFunction()" href="#header-top"><i class="fas fa-solid fa-chevron-up"></i></a>
    <!-- == To TOP == -->

    <!-- == Script == -->
    <script src="js/script.js"></script>
</body>
</html>
