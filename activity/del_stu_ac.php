<?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
if( !empty($_GET["ac_id"]) && !empty($_GET["stu_id"]) ){
    $sql->table = "ac_stu_status";
    $sql->condition="WHERE ac_id={$_GET["ac_id"]} AND stu_id={$_GET["stu_id"]}";
    if( $sql->delete() ){
      $alert = "ลบข้อมูลเรียบร้อยแล้ว";
      $location = URL."activity/activity_stu_manage.php?id=".$_GET["ac_id"];
    }
    else{
      $alert = "ไม่สามารถลบข้อมูลได้";
      $location = URL."activity/activity_stu_manage.php?id=".$_GET["ac_id"];
    }
}
else{
    $location = URL."activity/activity_stu_manage.php?id=".$_GET["ac_id"];
}
include("../layouts/footer.php");
?>