<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

   mysqli_query($conn, "UPDATE `users` SET name = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'Confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `users` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'Password updated successfully!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `users` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
      }
   }

}

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
                            <a href="about.ph">ABOUT US</a>
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
   <div class="container">
    <div class="update-profile">

        <?php
        $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
        }
        ?>
        <h2>Edit Profile</h2>

        <form action="" method="post" enctype="multipart/form-data">
        <div class="profile-image-cont">
            <?php
                if($fetch['image'] == ''){
                    echo '<img src="images/default-avatar.png">';
                }else{
                    echo '<img class="update-image" src="uploaded_img/'.$fetch['image'].'">';
                }
            ?>
        </div>
        <div class="messaging">
            <?php
                if(isset($message)){
                    foreach($message as $message){
                        echo '<div class="message">'.$message.'</div>';
                    }
                }
            ?>
        </div>
        <div class="flex">
            <div class="inputBox">
                <span>Username</span> <br>
                <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box"> <br>
                <span>Email</span> <br>
                <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box"> <br>
                <span>Update your pic</span> <br>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box image-box"> <br>
            </div>
            <div class="inputBox">
                <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
                <span>Old password</span><br>
                <input type="password" name="update_pass" placeholder="enter previous password" class="box"><br>
                <span>New password</span><br>
                <input type="password" name="new_pass" placeholder="enter new password" class="box"><br>
                <span>Confirm password</span><br>
                <input type="password" name="confirm_pass" placeholder="confirm new password" class="box"><br>
            </div>
        </div>
        <br>
        <br>
        <div class="bottom">
            <input type="submit" value="update profile" name="update_profile" class="btn">
            <a href="home.php" class="delete-btn">go back</a>
        </div>
        </form>

        </div>
   </div>
</body>
</html>