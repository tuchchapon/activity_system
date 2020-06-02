<?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
if( !empty($_GET["id"]) ){
    $sql->table = "student";
    $sql->condition="WHERE stu_id={$_GET["id"]}";
    if( $sql->delete() ){
      $alert = "ลบข้อมูลเรียบร้อยแล้ว";
      $location = URL."users/stu_manage.php";
    }
    else{
      $alert = "ไม่สามารถลบข้อมูลได้";
      $location = URL."users/stu_manage.php";
    }
}
else{
    $location = URL."users/stu_manage.php";
}
include("../layouts/footer.php");
?>