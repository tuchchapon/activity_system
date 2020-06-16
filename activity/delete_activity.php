   <?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
if( !empty($_GET["id"]) ){
    $sql->table = "activity";
    $sql->condition="WHERE ac_id={$_GET["id"]}";
    if( $sql->delete() ){
      $alert = "ลบข้อมูลเรียบร้อยแล้ว";
      $location = URL."activity/activitymanage.php";
    }
    else{
      $alert = "ไม่สามารถลบข้อมูลได้";
      $location = URL."activity/activitymanage.php";
    }
}
else{
    $location = URL."activity/activitymanage.php";
}
include("../layouts/footer.php");
?>