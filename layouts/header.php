<?php include($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "activity_system" . DIRECTORY_SEPARATOR . "config.php"); ?>
<?php
##check Login
if (empty($_SESSION["admin_id"])) {
  header("location:" . URL . "login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicons -->
  <link href="<?=URL?>img/unnamed.png" rel="icon">
  <link href="<?=URL?>img/unnamed.png" rel="apple-touch-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= PLUGINS ?>fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= PLUGINS ?>tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= PLUGINS ?>icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= PLUGINS ?>jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= CSS ?>/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= PLUGINS ?>overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= PLUGINS ?>daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= PLUGINS ?>summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTable -->
  <link rel="stylesheet" href="<?= PLUGINS ?>datatables-bs4/css/dataTables.bootstrap4.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">