<?php require_once('header.php'); ?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
    $cta_title = $row['cta_title'];
    $cta_content = $row['cta_content'];
    $cta_read_more_text = $row['cta_read_more_text'];
    $cta_read_more_url = $row['cta_read_more_url'];
    $cta_photo = $row['cta_photo'];
    $featured_product_title = $row['featured_product_title'];
    $featured_product_subtitle = $row['featured_product_subtitle'];
    $latest_product_title = $row['latest_product_title'];
    $latest_product_subtitle = $row['latest_product_subtitle'];
    $popular_product_title = $row['popular_product_title'];
    $popular_product_subtitle = $row['popular_product_subtitle'];
    $total_featured_product_home = $row['total_featured_product_home'];
    $total_latest_product_home = $row['total_latest_product_home'];
    $total_popular_product_home = $row['total_popular_product_home'];
    $home_service_on_off = $row['home_service_on_off'];
    $home_welcome_on_off = $row['home_welcome_on_off'];
    $home_featured_product_on_off = $row['home_featured_product_on_off'];
    $home_latest_product_on_off = $row['home_latest_product_on_off'];
    $home_popular_product_on_off = $row['home_popular_product_on_off'];

}


?>

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
                        <img src="assets/img/collection.png" alt="Product collection">
                    </div>
                </div>
            </section>
            <section class="benefits">
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
                <div class="products-headline container">
                    <span>Products</span>
                    <h1>Our Products</h1>
                </div>
                <?php if($home_featured_product_on_off == 1): ?>
                <div class="products-container">
                <?php
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_featured=? AND p_is_active=? LIMIT 9");
                    $statement->execute(array(1,1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                    foreach ($result as $row) {
                        ?>

                    <div class="product" onclick="location.href='product.php?id=<?php echo $row['p_id']; ?>'">
                        <div class="product-image">
                            <img src="assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="Product Aloe Vera">
                        </div>
                        <div class="product-info">
                            <h1 class="product-title"><?php echo $row['p_name']; ?></h1>
                            <p class="product-description">Capturing strawberry's fruity scent requires true artistry for your skin</p>
                            <div class="product-pricing">
                                <a href=""><i class="fa-solid fa-cart-shopping"></i> BUY NOW</a>
                                <span>|</span>
                                <span>Ksh<?php echo $row['p_current_price']; ?> 
                            </div>
                        </div>
                    </div>
                        <?php
                    }
                    ?>
                    <?php endif; ?>

                </div>
                <div class="container">
                    <div class="browse-more container" style="display: flex; justify-content: center;">
                        <button style="margin: auto !important;" onclick="location.href='product-category.php?id=1&type=top-category'">Browse Categories</button>
                    </div>
                </div>
            </section>
            <section class="testimonials">
                <div class="testimonials-headline container">
                    <span>Testimonials</span>
                    <h1>What Our Clients Say <br> About Us</h1>
                </div>
                <div class="testimonial-container container">
                    <div class="testimonial">
                        <div class="testimony">
                            <div class="testimony-text">
                                <span class="quote"><i class="fas fa-solid fa-quote-left"></i></span>
                                <p>"They have the best Products. And this the suitable platform to buy from."</p>
                                <p>Lani Lake - <span>Client</span></p>
                            </div>
                            <div class="testimony-img">
                                <img src="assets/img/luis.jpg" alt="">
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
                                <img src="assets/img/michael.jpg" alt="">
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
                                <img src="assets/img/villasmil.jpg" alt="">
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
<?php require_once('footer.php'); ?>