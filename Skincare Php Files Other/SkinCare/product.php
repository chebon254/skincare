<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: index.php');
    exit;
} else {
    // Check the id is valid or not
    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if( $total == 0 ) {
        header('location: index.php');
        exit;
    }
}

foreach($result as $row) {
    $p_name = $row['p_name'];
    $p_old_price = $row['p_old_price'];
    $p_current_price = $row['p_current_price'];
    $p_qty = $row['p_qty'];
    $p_featured_photo = $row['p_featured_photo'];
    $p_description = $row['p_description'];
    $p_short_description = $row['p_short_description'];
    $p_feature = $row['p_feature'];
    $p_condition = $row['p_condition'];
    $p_return_policy = $row['p_return_policy'];
    $p_total_view = $row['p_total_view'];
    $p_is_featured = $row['p_is_featured'];
    $p_is_active = $row['p_is_active'];
    $ecat_id = $row['ecat_id'];
}


$p_total_view = $p_total_view + 1;

$statement = $pdo->prepare("UPDATE tbl_product SET p_total_view=? WHERE p_id=?");
$statement->execute(array($p_total_view,$_REQUEST['id']));


$statement = $pdo->prepare("SELECT * FROM tbl_product_size WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $size[] = $row['size_id'];
}

$statement = $pdo->prepare("SELECT * FROM tbl_product_color WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $color[] = $row['color_id'];
}


if(isset($_POST['form_review'])) {
    
    $statement = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=? AND cust_id=?");
    $statement->execute(array($_REQUEST['id'],$_SESSION['customer']['cust_id']));
    $total = $statement->rowCount();
    
    if($total) {
        $error_message = LANG_VALUE_68; 
    } else {
        $statement = $pdo->prepare("INSERT INTO tbl_rating (p_id,cust_id,comment,rating) VALUES (?,?,?,?)");
        $statement->execute(array($_REQUEST['id'],$_SESSION['customer']['cust_id'],$_POST['comment'],$_POST['rating']));
        $success_message = LANG_VALUE_163;    
    }
    
}

// Getting the average rating for this product
$t_rating = 0;
$statement = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$tot_rating = $statement->rowCount();
if($tot_rating == 0) {
    $avg_rating = 0;
} else {
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
    foreach ($result as $row) {
        $t_rating = $t_rating + $row['rating'];
    }
    $avg_rating = $t_rating / $tot_rating;
}

if(isset($_POST['form_add_to_cart'])) {

	// getting the currect stock of this product
	$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$current_p_qty = $row['p_qty'];
	}
	if($_POST['p_qty'] > $current_p_qty):
		$temp_msg = 'Sorry! There are only '.$current_p_qty.' item(s) in stock';
		?>
		<script type="text/javascript">alert('<?php echo $temp_msg; ?>');</script>
		<?php
	else:
    if(isset($_SESSION['cart_p_id']))
    {
        $arr_cart_p_id = array();
        $arr_cart_size_id = array();
        $arr_cart_color_id = array();
        $arr_cart_p_qty = array();
        $arr_cart_p_current_price = array();

        $i=0;
        foreach($_SESSION['cart_p_id'] as $key => $value) 
        {
            $i++;
            $arr_cart_p_id[$i] = $value;
        }

        $i=0;
        foreach($_SESSION['cart_size_id'] as $key => $value) 
        {
            $i++;
            $arr_cart_size_id[$i] = $value;
        }

        $i=0;
        foreach($_SESSION['cart_color_id'] as $key => $value) 
        {
            $i++;
            $arr_cart_color_id[$i] = $value;
        }


        $added = 0;
        if(!isset($_POST['size_id'])) {
            $size_id = 0;
        } else {
            $size_id = $_POST['size_id'];
        }
        if(!isset($_POST['color_id'])) {
            $color_id = 0;
        } else {
            $color_id = $_POST['color_id'];
        }
        for($i=1;$i<=count($arr_cart_p_id);$i++) {
            if( ($arr_cart_p_id[$i]==$_REQUEST['id']) && ($arr_cart_size_id[$i]==$size_id) && ($arr_cart_color_id[$i]==$color_id) ) {
                $added = 1;
                break;
            }
        }
        if($added == 1) {
           $error_message1 = 'Product is already added to the shopping cart.';
        } else {

            $i=0;
            foreach($_SESSION['cart_p_id'] as $key => $res) 
            {
                $i++;
            }
            $new_key = $i+1;

            if(isset($_POST['size_id'])) {

                $size_id = $_POST['size_id'];

                $statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_id=?");
                $statement->execute(array($size_id));
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                foreach ($result as $row) {
                    $size_name = $row['size_name'];
                }
            } else {
                $size_id = 0;
                $size_name = '';
            }
            
            if(isset($_POST['color_id'])) {
                $color_id = $_POST['color_id'];
                $statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id=?");
                $statement->execute(array($color_id));
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                foreach ($result as $row) {
                    $color_name = $row['color_name'];
                }
            } else {
                $color_id = 0;
                $color_name = '';
            }
          

            $_SESSION['cart_p_id'][$new_key] = $_REQUEST['id'];
            $_SESSION['cart_size_id'][$new_key] = $size_id;
            $_SESSION['cart_size_name'][$new_key] = $size_name;
            $_SESSION['cart_color_id'][$new_key] = $color_id;
            $_SESSION['cart_color_name'][$new_key] = $color_name;
            $_SESSION['cart_p_qty'][$new_key] = $_POST['p_qty'];
            $_SESSION['cart_p_current_price'][$new_key] = $_POST['p_current_price'];
            $_SESSION['cart_p_name'][$new_key] = $_POST['p_name'];
            $_SESSION['cart_p_featured_photo'][$new_key] = $_POST['p_featured_photo'];

            $success_message1 = 'Product added to the cart successfully!';
        }
        
    }
    else
    {

        if(isset($_POST['size_id'])) {

            $size_id = $_POST['size_id'];

            $statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_id=?");
            $statement->execute(array($size_id));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
            foreach ($result as $row) {
                $size_name = $row['size_name'];
            }
        } else {
            $size_id = 0;
            $size_name = '';
        }
        
        if(isset($_POST['color_id'])) {
            $color_id = $_POST['color_id'];
            $statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id=?");
            $statement->execute(array($color_id));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
            foreach ($result as $row) {
                $color_name = $row['color_name'];
            }
        } else {
            $color_id = 0;
            $color_name = '';
        }
        

        $_SESSION['cart_p_id'][1] = $_REQUEST['id'];
        $_SESSION['cart_size_id'][1] = $size_id;
        $_SESSION['cart_size_name'][1] = $size_name;
        $_SESSION['cart_color_id'][1] = $color_id;
        $_SESSION['cart_color_name'][1] = $color_name;
        $_SESSION['cart_p_qty'][1] = $_POST['p_qty'];
        $_SESSION['cart_p_current_price'][1] = $_POST['p_current_price'];
        $_SESSION['cart_p_name'][1] = $_POST['p_name'];
        $_SESSION['cart_p_featured_photo'][1] = $_POST['p_featured_photo'];

        $success_message1 = 'Product added to the cart successfully!';
    }
	endif;
}
?>

<style>
    .message-modal{
        font-family: 'Poppins', sans-serif !important; 
        pointer-events: none;
        height: 140px;
        width: 240px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 100; 
        background-color: #ffffff !important; 
        box-shadow: -4px 2px 12px #00000033, -2px 2px 16px #00000033, 2px 2px 22px #00000033, 4px 2px 32px #00000033; 
        border-radius: 10px;
        text-align: center;
        display: none;
    }
    .message-modal .icon{
        pointer-events: none;
        height: 70px;
        width: 70px;
        border-radius: 35px; 
        display: flex;
        justify-content: center;
        align-items: center;
        margin: -35px auto 0px;
        color: #fff;
        font-size: 31px;
    }
    .message-modal .icon.success-icon{
        background-color: #68e49b;
        box-shadow: -4px 2px 12px #68e49b33, -2px 2px 16px #68e49b33, 2px 2px 22px #68e49b33, 4px 2px 32px #68e49b33, 6px 2px 42px #68e49b33, 20px 2px 52px #68e49b33;
    }
    .message-modal .icon.error-icon{
        background-color: #f82f55;
        box-shadow: -4px 2px 12px #f82f5533, -2px 2px 16px #f82f5533, 2px 2px 22px #f82f5533, 4px 2px 32px #f82f5533, 6px 2px 42px #f82f5533, 20px 2px 52px #f82f5533;
    }
    .message-modal .text{
        font-size: 14px;
        font-weight: 400;
        color: #515151;
        font-family: 'Poppins', sans-serif;
    }
    .message-modal .message{
        font-size: 14px;
        font-weight: 400;
        font-family: 'Poppins', sans-serif;
    }
    .message-modal .text.success-message{
        color: #f82f55;
    }
    .message-modal .text.error-message{
        color: #68e49b;
    }
    .active-message{
        display: block;
    }
</style>


<!-- == MAIN == -->
<main>
            <section class="product-detail-headline">
                    <?php
                        if($error_message1 != '') {
                            echo '  <div class="message-modal active-message" id="php-message"> 
                                    <span class="error-icon icon"><i class="fa-solid fa-triangle-exclamation"></i></span><br>
                                    <span class="error-text text">Error</span>
                                    <p class="message error-message" style="color: red;">'.$error_message1.'</p> </div>';
                        }
                        if($success_message1 != '') {
                            echo ' <div class="message-modal active-message" id="php-message">
                                    <span class="success-icon icon"><i class="fa-solid fa-circle-checkn"></i></span><br>
                                    <span class="success-text text">Success</span>
                                    <p class="message success-message" style="color: red;">'.$success_message1.'</p></div>';
                            header('location: product.php?id='.$_REQUEST['id']);
                        }
                    ?>
                <script>
                    setTimeout(function() {
                        $('#php-message').fadeOut('slow');
                    }, 4000);
                </script>
                <div class="container product-detail-cont">
                    <div class="pagination">
                        <a href="index.php" class="breadcrumb">Home <i class="fa-solid fa-angle-right"></i> </a><span class="breadcrumb-last"><?php echo $p_name; ?></span>
                    </div>
                </div>
            </section>
            <section class="product-detail">
                <div class="product-detail-container container">
                    <div class="product-detail-image reveal-fixed">
                        <div class="product-tab-selection">
                            <img src="assets/uploads/<?php echo $p_featured_photo; ?>" alt="Tab Image" class="tab-image">
                            <img src="assets/uploads/<?php echo $p_featured_photo; ?>" alt="Tab Image" class="tab-image">
                            <img src="assets/uploads/<?php echo $p_featured_photo; ?>" alt="Tab Image" class="tab-image">
                            <img src="assets/uploads/<?php echo $p_featured_photo; ?>" alt="Tab Image" class="tab-image">
                        </div>
                        <div class="product-image-selected">
                            <img src="assets/uploads/<?php echo $p_featured_photo; ?>" alt="" class="product-detail-image">
                        </div>
                    </div>
                    <div class="product-detail-text">
                    <form action="" method="post">
                    <div class="p-quantity" style="display: none !important;">
                                <div class="row">
                                    <?php if(isset($size)): ?>
                                    <div class="col-md-12 mb_20">
                                        <?php echo LANG_VALUE_52; ?> <br>
                                        <select name="size_id" class="form-control select2" style="width:auto;">
                                            <?php
                                            $statement = $pdo->prepare("SELECT * FROM tbl_size");
                                            $statement->execute();
                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $row) {
                                                if(in_array($row['size_id'],$size)) {
                                                    ?>
                                                    <option value="<?php echo $row['size_id']; ?>"><?php echo $row['size_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?php endif; ?>

                                    <?php if(isset($color)): ?>
                                    <div class="col-md-12">
                                        <?php echo LANG_VALUE_53; ?> <br>
                                        <select name="color_id" class="form-control select2" style="width:auto;">
                                            <?php
                                            $statement = $pdo->prepare("SELECT * FROM tbl_color");
                                            $statement->execute();
                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $row) {
                                                if(in_array($row['color_id'],$color)) {
                                                    ?>
                                                    <option value="<?php echo $row['color_id']; ?>"><?php echo $row['color_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?php endif; ?>

                                </div>
                                <div class="p-price">
                                <span style="font-size:14px;"><?php echo LANG_VALUE_54; ?></span><br>
                                <span>
                                    <?php if($p_old_price!=''): ?>
                                        <del><?php echo LANG_VALUE_1; ?><?php echo $p_old_price; ?></del>
                                    <?php endif; ?> 
                                        <?php echo LANG_VALUE_1; ?><?php echo $p_current_price; ?>
                                </span>
                            </div>
                            <input type="hidden" name="p_current_price" value="<?php echo $p_current_price; ?>">
                            <input type="hidden" name="p_name" value="<?php echo $p_name; ?>">
                            <input type="hidden" name="p_featured_photo" value="<?php echo $p_featured_photo; ?>">
							<div class="p-quantity">
                                <?php echo LANG_VALUE_55; ?> <br>
								<input type="number" class="input-text qty" step="1" min="1" max="" name="p_qty" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
							</div>
                            </div>
                        <span class="category-name">SkinCare</span>
                        <h1 class="product-detail-title"><?php echo $p_name; ?></h1>
                        <div class="rating-input">        
                            <span></span><span><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><span> 5 Reviews</span></span>
                        </div>
                        <span class="product-detail-price">Ksh <?php echo $p_current_price; ?></span>
                        <p class="product-detail-description">Shampoo or moisturizer, beauty brands that sell directly to consumers without involving a retailer face multiple challenges. How can you make consumers aware of your brand if you don’t have the visibility</p>
                        <button class="product-detail-btn" type="submit" value="<?php echo LANG_VALUE_154; ?>" name="form_add_to_cart">+ ADD TO CART <i class="fa-solid fa-cart-shopping"></i></button>
                    </form>
                        <button class="product-detail-veiwcart-btn" onclick="location.href='cart.php'">VIEW CART <i class="fa-solid fa-eye"></i></button> <br>
                        <span class="social-share"><span class="share-title">SHARE ON: </span><span><a href="#"><i class="fa-brands fa-twitter"></i></a><a href="#"><i class="fa-brands fa-whatsapp"></i></a><a href="#"><i class="fa-brands fa-instagram"></i></a><a href="#"><i class="fa-brands fa-facebook"></i></a></span></span>
                    </div>
                </div>
            </section>
            <section class="review-product">
                <div class="review-product-container container">
                    <h2 class="review-counter">Reviews(0)</h2>
                    <div class="reviews">
                        <div class="clients-reviews">
                            <h3>REVIEW</h3>
                            <p>No Reviews</p>
                        </div>
                        <div class="review-form">
                            <h3>BE THE FIRST TO REVIEW</h3>
                            <p>Your email address will not be published. Required fields are marked</p>
                            <div class="rating">
                                <form action="GET" method="post">
                                    <div class="rating-input">        
                                        <span>Your Rating: </span><span><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></span>
                                    </div>
                                    <label for="Message">Your review</label> <br>
                                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                                    <br>
                                    <div class="personal">
                                        <label for="name">Name</label> <br>
                                        <input type="text" placeholder="Enter Your Name"> <br>
                                        <label for="name">Email</label> <br>
                                        <input type="email" placeholder="Enter Your Email">
                                    </div>
                                    <input type="submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    <!-- == || MAIN == -->

<?php require_once('footer.php'); ?>
