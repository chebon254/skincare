<?php require_once('header.php'); 
?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $banner_cart = $row['banner_cart'];
}
?>

<?php
$error_message = '';
if(isset($_POST['form1'])) {

    $i = 0;
    $statement = $pdo->prepare("SELECT * FROM tbl_product");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $i++;
        $table_product_id[$i] = $row['p_id'];
        $table_quantity[$i] = $row['p_qty'];
    }

    $i=0;
    foreach($_POST['product_id'] as $val) {
        $i++;
        $arr1[$i] = $val;
    }
    $i=0;
    foreach($_POST['quantity'] as $val) {
        $i++;
        $arr2[$i] = $val;
    }
    $i=0;
    foreach($_POST['product_name'] as $val) {
        $i++;
        $arr3[$i] = $val;
    }
    
    $allow_update = 1;
    for($i=1;$i<=count($arr1);$i++) {
        for($j=1;$j<=count($table_product_id);$j++) {
            if($arr1[$i] == $table_product_id[$j]) {
                $temp_index = $j;
                break;
            }
        }
        if($table_quantity[$temp_index] < $arr2[$i]) {
        	$allow_update = 0;
            $error_message .= '"'.$arr2[$i].'" items are not available for "'.$arr3[$i].'"\n';
        } else {
            $_SESSION['cart_p_qty'][$i] = $arr2[$i];
        }
    }
    $error_message .= '\nOther items quantity are updated successfully!';
    ?>
    
    <?php if($allow_update == 0): ?>
    	<script>alert('<?php echo $error_message; ?>');</script>
	<?php else: ?>
		<script>alert('All Items Quantity Update is Successful!');</script>
	<?php endif; ?>
    <?php

}
?>


<!-- == MAIN == -->
<main>
            <section class="cart-pg">
            <?php if(!isset($_SESSION['cart_p_id'])): ?>
                <?php echo '<h2 class="text-center">Cart is Empty!!</h2></br>'; ?>
                <?php echo '<h4 class="text-center">Add products to the cart in order to view it here.</h4>'; ?>
            <?php else: ?>
            <form action="" method="post">
                <?php $csrf->echoInputField(); ?>
                <div class="cart-container container">
                    <div class="cart-pg-listing">
                        <div class="cart-listing-headline">
                            <h1>Shopping Cart</h1>
                            <h1><?php echo $cart_count; ?> Items</h1>
                        </div>
                        <table>
                            <tr class="table-head">
                            <td style="display: none !important;">#</td>
                                <td>PRODUCT DETAILS</td>
                                <td>QUANTITY</td>
                                <td>PRICE</td>
                                <td>TOTAL</td>
                            </tr>
                            <?php
                            $table_total_price = 0;
                            $i=0;
                            foreach($_SESSION['cart_p_id'] as $key => $value) {
                                $i++;
                                $arr_cart_p_id[$i] = $value;
                            }

                            $i=0;
                            foreach($_SESSION['cart_size_id'] as $key => $value) {
                                $i++;
                                $arr_cart_size_id[$i] = $value;
                            }

                            $i=0;
                            foreach($_SESSION['cart_size_name'] as $key => $value) {
                                $i++;
                                $arr_cart_size_name[$i] = $value;
                            }

                            $i=0;
                            foreach($_SESSION['cart_color_id'] as $key => $value) {
                                $i++;
                                $arr_cart_color_id[$i] = $value;
                            }

                            $i=0;
                            foreach($_SESSION['cart_color_name'] as $key => $value) 
                            {
                                $i++;
                                $arr_cart_color_name[$i] = $value;
                            }

                            $i=0;
                            foreach($_SESSION['cart_p_qty'] as $key => $value) 
                            {
                                $i++;
                                $arr_cart_p_qty[$i] = $value;
                            }

                            $i=0;
                            foreach($_SESSION['cart_p_current_price'] as $key => $value) 
                            {
                                $i++;
                                $arr_cart_p_current_price[$i] = $value;
                            }

                            $i=0;
                            foreach($_SESSION['cart_p_name'] as $key => $value) 
                            {
                                $i++;
                                $arr_cart_p_name[$i] = $value;
                            }

                            $i=0;
                            foreach($_SESSION['cart_p_featured_photo'] as $key => $value) 
                            {
                                $i++;
                                $arr_cart_p_featured_photo[$i] = $value;
                            }
                            ?>
                            <?php for($i=1;$i<=count($arr_cart_p_id);$i++): ?>
                            <tr class="product-tr">
                                <td style="display: none !important;"><?php echo $i; ?></td>
                                <td class="table-image">
                                    <img src="assets/uploads/<?php echo $arr_cart_p_featured_photo[$i]; ?>" alt="Cart Image" height="120px" width="120px">
                                    <div class="cart-product-details">
                                        <h4><?php echo $arr_cart_p_name[$i]; ?></h4>
                                        <span>Aloe</span> <br>
                                        <a onclick="return confirmDelete();" href="cart-item-delete.php?id=<?php echo $arr_cart_p_id[$i]; ?>&size=<?php echo $arr_cart_size_id[$i]; ?>&color=<?php echo $arr_cart_color_id[$i]; ?>" class="trash"><i class="fa fa-trash" style="color:red;"></i></a>
                                    </div>
                                </td>
                                <td class="cart-count">
                                    <input type="number" class="input-text qty text" step="1" min="1" max="" name="quantity[]" value="<?php echo $arr_cart_p_qty[$i]; ?>" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
                                </td>
                                <td>Ksh <?php echo $arr_cart_p_current_price[$i]; ?></td>
                                <td>
                                    <?php
                                        $row_total_price = $arr_cart_p_current_price[$i]*$arr_cart_p_qty[$i];
                                        $table_total_price = $table_total_price + $row_total_price;
                                    ?>
                                    Ksh <?php echo $row_total_price; ?>
                                </td>
                            </tr>
                            <?php endfor; ?>
                        </table>
                        <div class="continue-shopping">
                            <a href="index.html"><i class="fa-solid fa-arrow-left-long"></i> Continue Shopping</a>
                        </div>
                    </div>
                    <div class="cart-pg-summary">
                        <div class="cart-summary-headline">
                            <h1 id="summary">Order Summary</h1>
                        </div>
                        <div class="cart-summary-content">
                            <div class="summary-counter">
                                <span>ITEMS <?php echo $cart_count; ?></span>
                                <span>Ksh <?php echo $table_total_price; ?></span>
                            </div>
                            <div class="">
                                <span>SHIPPING</span> <br>
                                <div class="select_wrap">
                                    <ul class="default_option">
                                        <li>
                                            <div class="option pizza">
                                              <p>Standard Delivery - $5</p>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="select_ul">
                                        <li>
                                            <div class="option pizza">
                                              <p>Standard Delivery - $5</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="option burger">
                                              <p>Standard Delivery - $5</p>
                                            </div>  
                                        </li>
                                        <li>
                                            <div class="option ice">
                                              <p>Standard Delivery - $5</p>
                                            </div>  
                                        </li>
                                        <li>
                                            <div class="option fries">
                                              <p>Standard Delivery - $5</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="summary-counter-total">
                                <span>TOTAL COST</span>
                                <span>Ksh <?php echo $table_total_price; ?></span>
                            </div>
                            <div class="summary-counter">
                                <button type="submit" value="<?php echo LANG_VALUE_20; ?>" name="form1">UPDATE</button>
                                <a href="checkout.php" style="display: flex; align-items: center; justify-content: center;height: 42px; width: 160px; border: 2px solid  var(--white); background-color: var(--text); outline: none; font-weight: 600; color: var(--white); letter-spacing: 0.05em; margin: 0px 0px 0px 10px; padding: 0px 6px;">CHECKOUT</a>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
    <?php endif; ?>
            </section>
        </main>
    <!-- == || MAIN == -->

<?php require_once('footer.php'); ?>