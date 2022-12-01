<?php
    include 'config.php';
    session_start();
    $user_id = $_SESSION['user_id'];
?>
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
                            <a class="active-link" href="home.php">HOME</a>
                            <a href="about.php">ABOUT US</a>
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
                                    <?php if(!isset($_SESSION['user_id']))
                                    echo "<div class=\"account-access\">
                                            <a href=\"login.php\">SignIn</a>
                                            <span>|</span>
                                            <a href=\"sign_up.php\">Register</a>
                                        </div>"; ?> 

                                    <?php if(isset($_SESSION['user_id'])) 
                                        $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
                                        if(mysqli_num_rows($select) > 0){
                                            $fetch = mysqli_fetch_assoc($select);
                                        }
                                        if($fetch['image'] == ''){
                                            echo '<img src="images/default-avatar.png">';
                                        }else{
                                            $userName = $fetch['name'];
                                            echo '<div class="dropdown">
                                                    <button class="dropbtn color"><img style="height: 40px; width: 40px; border-radius: 20px;" src="uploaded_img/'.$fetch['image'].'"></button>
                                                    <div class="drop">
                                                        <span>Hi, '. $userName .'</span>
                                                        <a href="profile.php"><i class="fa-solid fa-user"></i> Update Profile</a>
                                                        <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                                                    </div>
                                                </div>';
                                        }
                                    ?>
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
            <section class="banner">
                <div class="container banner-container">
                    <div class="banner-text reveal-fixed">
                        <h1>Skin beauty and care <br> is our priority  for<br><mark>Everyone.</mark></h1>
                        <p>Shop with us today and leave us <br class="break"> a comment online.<br></p>
                        <button onclick="slowScroll()">Shop Now</button>
                    </div>
                    <div class="banner-img">
                        <img src="css/img/collection.png" alt="Product collection">
                    </div>
                </div>
            </section>
            <section class="benefits reveal">
                <div class="benefits-container container">
                    <div class="benefit">
                        <div class="benefit-title">
                            <p>Why Aloe Vera Oil For Your Face?</p>
                        </div>
                        <div class="benefit-hold">
                            <div class="benefit-response">
                                <p>Its antioxidant properties, along with several other compounds, help inhibit the growth of certain bacteria that can cause infections on your skin.</p>
                            </div>
                            <div class="benefit-click">
                                <button onclick="slowScroll()"><i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="products" id="products">
                <div class="products-headline reveal container">
                    <span>Products</span>
                    <h1>Our Products</h1>
                </div>
                <div class="products-container reveal">
                    <div class="product" onclick="productClick()">
                        <div class="product-image">
                            <img src="css/img/aloe gel transparent.png" alt="Product Aloe Vera">
                        </div>
                        <div class="product-info">
                            <h1 class="product-title">STARBERRY</h1>
                            <p class="product-description">Capturing strawberry's fruity scent requires true artistry for your skin</p>
                            <div class="product-pricing">
                                <a href="#"><i class="fa-solid fa-cart-shopping"></i> BUY NOW</a>
                                <span>|</span>
                                <span>ksh52.99</span>
                            </div>
                        </div>
                    </div>
                    <div class="product" onclick="productClick()">
                        <div class="product-image">
                            <img src="css/img/aloe gel transparent two.png" alt="Product Aloe Vera">
                        </div>
                        <div class="product-info">
                            <h1 class="product-title">PASSION</h1>
                            <p class="product-description">The best product in the shop perfect <br> for your skin</p>
                            <div class="product-pricing">
                                <a href="#"><i class="fa-solid fa-cart-shopping"></i> BUY NOW</a>
                                <span>|</span>
                                <span>ksh52.99</span>
                            </div>
                        </div>
                    </div>
                    <div class="product" onclick="productClick()">
                        <div class="product-image">
                            <img src="css/img/dark aloe gel.png" alt="Product Aloe Vera">
                        </div>
                        <div class="product-info">
                            <h1 class="product-title">ERBA VITA</h1>
                            <p class="product-description">The best product in the shop perfect <br> for your skin</p>
                            <div class="product-pricing">
                                <a href="#"><i class="fa-solid fa-cart-shopping"></i> BUY NOW</a>
                                <span>|</span>
                                <span>ksh52.99</span>
                            </div>
                        </div>
                    </div>
                    <div class="product" onclick="productClick()">
                        <div class="product-image">
                            <img src="css/img/gel boxed.png" alt="Product Aloe Vera">
                        </div>
                        <div class="product-info">
                            <h1 class="product-title">FORMULA</h1>
                            <p class="product-description">The best product in the shop perfect <br> for your skin</p>
                            <div class="product-pricing">
                                <a href="#"><i class="fa-solid fa-cart-shopping"></i> BUY NOW</a>
                                <span>|</span>
                                <span>ksh52.99</span>
                            </div>
                        </div>
                    </div>
                    <div class="product" onclick="productClick()">
                        <div class="product-image">
                            <img src="css/img/gel mix.png" alt="Product Aloe Vera">
                        </div>
                        <div class="product-info">
                            <h1 class="product-title">DISINFECTANT</h1>
                            <p class="product-description">The best product in the shop perfect <br> for your skin</p>
                            <div class="product-pricing">
                                <a href="#"><i class="fa-solid fa-cart-shopping"></i> BUY NOW</a>
                                <span>|</span>
                                <span>ksh52.99</span>
                            </div>
                        </div>
                    </div>
                    <div class="product" onclick="productClick()">
                        <div class="product-image">
                            <img src="css/img/hand gel.png" alt="Product Aloe Vera">
                        </div>
                        <div class="product-info">
                            <h1 class="product-title">ORGANIC</h1>
                            <p class="product-description">The best product in the shop perfect <br> for your skin</p>
                            <div class="product-pricing">
                                <a href="#"><i class="fa-solid fa-cart-shopping"></i> BUY NOW</a>
                                <span>|</span>
                                <span>ksh52.99</span>
                            </div>
                        </div>
                    </div>
                    <div class="product" onclick="productClick()">
                        <div class="product-image">
                            <img src="css/img/percent gel.png" alt="Product Aloe Vera">
                        </div>
                        <div class="product-info">
                            <h1 class="product-title">PLANTERS</h1>
                            <p class="product-description">The best product in the shop perfect <br> for your skin</p>
                            <div class="product-pricing">
                                <a href="#"><i class="fa-solid fa-cart-shopping"></i> BUY NOW</a>
                                <span>|</span>
                                <span>ksh52.99</span>
                            </div>
                        </div>
                    </div>
                    <div class="product" onclick="productClick()">
                        <div class="product-image">
                            <img src="css/img/planters gel.png" alt="Product Aloe Vera">
                        </div>
                        <div class="product-info">
                            <h1 class="product-title">COSMETICS</h1>
                            <p class="product-description">The best product in the shop perfect <br> for your skin</p>
                            <div class="product-pricing">
                                <a href="#"><i class="fa-solid fa-cart-shopping"></i> BUY NOW</a>
                                <span>|</span>
                                <span>ksh52.99</span>
                            </div>
                        </div>
                    </div>
                    <div class="product" onclick="productClick()">
                        <div class="product-image">
                            <img src="css/img/brown gel.png" alt="Product Aloe Vera">
                        </div>
                        <div class="product-info">
                            <h1 class="product-title">PEPPERMINT</h1>
                            <p class="product-description">The best product in the shop perfect <br> for your skin</p>
                            <div class="product-pricing">
                                <a href="#"><i class="fa-solid fa-cart-shopping"></i> BUY NOW</a>
                                <span>|</span>
                                <span>ksh52.99</span>
                            </div>
                        </div>
                    </div>

                    <div class="browse-more">
                        <button onclick="location.href='product-categories.php'">Browse Categories</button>
                    </div>
                </div>
            </section>
            <section class="testimonials">
                <div class="testimonials-headline reveal container">
                    <span>Testimonials</span>
                    <h1>What Our Clients Say <br> About Us</h1>
                </div>
                <div class="testimonial-container container reveal">
                    <div class="testimonial">
                        <div class="testimony">
                            <div class="testimony-text">
                                <span class="quote"><i class="fas fa-solid fa-quote-left"></i></span>
                                <p>"They have the best Products. And this the suitable platform to buy from."</p>
                                <p>Lani Lake - <span>Client</span></p>
                            </div>
                            <div class="testimony-img">
                                <img src="css/img/luis.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="testimonial">
                        <div class="testimony">
                            <div class="testimony-text">
                                <span class="quote"><i class="fas fa-solid fa-quote-left"></i></span>
                                <p>"I will be buying with them from now on because they are what they claim to be."</p>
                                <p>Sishi Chii - <span>C.E.O</span></p>
                            </div>
                            <div class="testimony-img">
                                <img src="css/img/michael.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="testimonial">
                        <div class="testimony">
                            <div class="testimony-text">
                                <span class="quote"><i class="fas fa-solid fa-quote-left"></i></span>
                                <p>"They are the best lulu. And this the suitable platform to buy products from."</p>
                                <p>Brandon Lake - <span>Client</span></p>
                            </div>
                            <div class="testimony-img">
                                <img src="css/img/villasmil.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="testimony-select">
                        <div class="span" onclick="plusSlides(-1)"><i class="fas fa-solid fa-angle-left"></i></div>
                        <div class="span" onclick="plusSlides(1)"><i class="fas fa-solid fa-angle-right"></i></div>
                    </div>
                </div>
            </section>
        </main>
    <!-- == || MAIN == -->

    <!-- == FOOTER == -->
        <footer>
            <div class="footer-container container reveal">
                <div class="footer-col col-1 reveal">
                    <a class="footer-logo" href="#"><img src="css/img/Skin care footer logo.png" alt="Skin Care logo" width="280px">
                        </a>
                    <p class="col-1-p">Alternative skin care products<br> good for your skin.</p>
                    <div class="footer-social-icons">
                        <a href="#"><i class="fab fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-brands fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-brands fa-twitter"></i></a>
                    </div>
                </div>
                <div class="footer-col col-2 reveal">
                    <h4>COMPANY</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Learn</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-col col-3 reveal">
                    <h4>OTHER MENU</h4>
                    <ul>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>
                <div class="footer-col footer-col-4 reveal">
                    <h4>SUPPORT</h4>
                    <ul>
                        <li><i class="fas fa-solid fa-phone"></i> +254 715 925 156</li>
                        <li><i class="fas fa-solid fa-envelope"></i> skincare@info.com</li>
                        <li><i class="fas fa-solid fa-map-marker-alt"></i> Nairobi City</li>
                    </ul>
                </div>
            </div>
            <div class="footer-copyright container reveal">
                <p>Copyright &copy; 2022 All rights reserved</p>
            </div>
        </footer>
        <?php } ?>
    <!-- == || FOOTER == -->
    <!-- == Cursor == -->
    <!-- <div class="cursor"><i class="fa-solid fa-location-arrow"></i></div> -->

    <!-- == To TOP == -->
        <a class="to-top reveal" onclick="topFunction()" href="#header-top"><i class="fas fa-solid fa-chevron-up"></i></a>
    <!-- == To TOP == -->

    <!-- == Script == -->
    <script src="js/script.js"></script>
</body>
</html>
