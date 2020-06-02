<?php
include("../config.php");
include("../SQLiManager.php");

$sql = new SQLiManager();

foreach($_POST["status"] AS $stu_id => $status){
    $sql->table = "ac_stu_status";
    $sql->value = "status='{$status}'";
    $sql->condition = "WHERE ac_id={$_POST["ac_id"]} AND stu_id={$stu_id}";
    $sql->update();
}

$alert = "ปรับสถานะของนักศึกษาเรียบร้อยแล้ว";
$location = "activity_stu_manage.php?id=".$_POST["ac_id"];

include("../JsControl.php");
?>