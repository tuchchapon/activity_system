<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Flattern Bootstrap Template - Index</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="img/unnamed.png" rel="icon">
    <link href="img/unnamed.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- DataTable -->
    <link rel="stylesheet" href="<?= PLUGINS ?>datatables-bs4/css/dataTables.bootstrap4.css">

    <!-- =======================================================
  * Template Name: Flattern - v2.0.1
  * Template URL: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <header id="header">
        <div class="container d-flex">

            <div class="logo mr-auto">
                <h1 class="text-light"><img src="img/unnamed.png"> <a href="index.php">สาขาวิศวกรรมซอฟต์แวร์</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class=""><a href="index.php">Home</a></li>
                    <li class="drop-down"><a href="event_calendar.php">กิจกรรม</a>
                        <ul>
                            <?php
                            $sql->table = "ac_type";
                            $sql->condition = "";
                            $query = $sql->select();
                            while ($result = mysqli_fetch_assoc($query)) {
                            ?>
                                <li><a href="event_calendar.php?type=<?= $result["ac_type_id"] ?>"><?= $result["ac_type_name"] ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="drop-down"><a href="show_news.php">ข่าวสาร</a>
                        <ul>
                            <?php
                            $sql->table = "news_type";
                            $sql->condition = "";
                            $query = $sql->select();
                            while ($result = mysqli_fetch_assoc($query)) {
                            ?>
                                <li><a href="show_news.php?type=<?= $result["news_type_id"] ?>"><?= $result["news_type_name"] ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li><a href="about.html">ข้อมูลสาขา</a></li>
                    <?php
                    if (empty($_SESSION["admin_id"])) {
                    ?>
                        <li><a href="login.php">LOGIN</a></li>
                    <?php
                    } else {
                    ?>
                        <li><a href="<?= URL ?>activity/activitymanage.php"><i class="fas fa-cogs"></i> จัดการระบบ</a></li>
                        <li><a href="<?= URL ?>logout.php" onClick="return confirm('คุณต้องการอแอกจากระบบ ใช่หรือไม่ ?')"><i class="fas fa-user-times"></i> ออกจากระบบ</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav><!-- .nav-menu -->
        </div>
    </header><!-- End Header -->