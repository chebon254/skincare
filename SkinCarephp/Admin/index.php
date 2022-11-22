<?php
    $conn = mysqli_connect('localhost','root','','skincare') or die('connection failed');
    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
     };
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
    <meta name="msapplication-TileImage" content="../favicon/mstile-144x144.png">
    <meta name="msapplication-config" content="../favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- == Favicon == -->
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="../favicon/site.webmanifest">
    <link rel="mask-icon" href="../favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="../favicon/favicon.ico">

    <!-- == Style Sheet == -->
    <link rel="stylesheet" href="../css/dashboard.css">

    <!-- == Fonts == -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">

    <!-- == Icons == -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous" />

</head>
<body>
    <main class="dashboard">
        <div class="dashboard-side-nav">
            <div class="side-nav-links">
                <div class="nav-links">
                    <div class="logo-top">
                        <a href="#"><img src="../css/img/Skin care footer logo.png" alt="dashboard logo" width="160px"></a>
                        <a href="#"><i class="fa-solid fa-bars"></i></a>
                    </div>
                    <div class="links">
                        <button class="link tablinks"  onclick="openCity(event, 'dashboard')" id="defaultOpen">
                            <div class="icon">
                                <i class="fa-sharp fa-solid fa-qrcode"></i>
                            </div>
                            <div class="text">
                                <span>Dashboard</span>
                            </div>
                        </button>
                        <button class="link tablinks" onclick="openCity(event, 'sys-users')">
                            <div class="icon">
                                <i class="fa-solid fa-user-group"></i>
                            </div>
                            <div class="text">
                                <span>Users</span>
                            </div>
                        </button>
                        <button class="link tablinks" onclick="openCity(event, 'shopping')">
                            <div class="icon">
                            <i class="fa-brands fa-shopify"></i>
                            </div>
                            <div class="text">
                                <span>Shop</span>
                            </div>
                        </button>
                        <button class="link tablinks" onclick="openCity(event, 'ordered')">
                            <div class="icon">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                            <div class="text">
                                <span>Orders</span>
                            </div>
                        </button>
                        <button class="link tablinks" onclick="openCity(event, 'saves')">
                            <div class="icon">
                                <i class="fa-sharp fa-solid fa-heart"></i>
                            </div>
                            <div class="text">
                                <span>Saved</span>
                            </div>
                        </button>
                        <button class="link tablinks" onclick="openCity(event, 'settings')">
                            <div class="icon">
                                <i class="fa-solid fa-gear"></i>
                            </div>
                            <div class="text">
                                <span>Setting</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <?php if(isset($_SESSION['user_id'])) 
                $select = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select) > 0){
                    $fetch = mysqli_fetch_assoc($select);
                }
                if($fetch['image'] == ''){
                    echo '<img src="./images/default-avatar.png">';
                }else{
                    $userName = $fetch['name'];
                    echo '<div class="current-user">
                            <div class="profile">
                                <img src="uploaded_img/'.$fetch['image'].'" alt="Profile Image">
                                <div class="name">
                                    <h4>' . $userName . '</h4>
                                    <p>Admin</p>
                                </div>
                            </div>
                            <div class="logout">
                                <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
                            </div>
                        </div>';
                }
            ?>
        </div>
        <div class="dashboard-content">
            <div class="dash tabcontent" id="dashboard">
                <h1>Dashboard</h1>
            </div>
            <div class="users tabcontent" id="sys-users">
                <h1>Users</h1>
            </div>
            <div class="shop tabcontent" id="shopping">
                <h1>Shop</h1>
            </div>
            <div class="orders tabcontent" id="ordered">
                <h1>Orders</h1>
            </div>
            <div class="saved tabcontent" id="saves">
                <h1>Saved</h1>
            </div>
            <div class="setting tabcontent" id="settings">
                <h1>Setting</h1>
            </div>
        </div>
    </main>
    <!-- == Script == -->
    <script src="js/script.js"></script>
</body>
</html>