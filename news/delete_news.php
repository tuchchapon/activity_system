<?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
if( !empty($_GET["id"]) ){
    $sql->table = "news";
    $sql->condition="WHERE news_id={$_GET["id"]}";
    if( $sql->delete() ){
      $alert = "ลบข้อมูลเรียบร้อยแล้ว";
      $location = URL."news/newsmanage.php";
    }
    else{
      $alert = "ไม่สามารถลบข้อมูลได้";
      $location = URL."news/newsmanage.php";
    }
}
else{
    $location = URL."news/newsmanage.php";
}
include("../layouts/footer.php");
