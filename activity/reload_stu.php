<?php 
include("../config.php");
include("../SQLiManager.php");

$sql = new SQLiManager();

$sql->table = "ac_stu_status";
$sql->condition = "WHERE ac_id={$_POST["id"]}";
$query = $sql->select();
if( mysqli_fetch_assoc($query) > 0 ){
    $sql->delete();
}

foreach($_POST["year"] as $key => $level){
    $sql->table = "student";
    $sql->field = "*";
    $sql->condition = "WHERE stu_level = {$level}";
    $query = $sql->select();
    if( mysqli_num_rows($query) > 0 ){
        while($stu = mysqli_fetch_assoc($query)){
            $sql->table = "ac_stu_status";
            $sql->field = "ac_id, stu_id, status, year_stu";
            $sql->value = "'{$_POST["id"]}', '{$stu["stu_id"]}', '0', '{$stu["stu_level"]}'";
            $sql->insert();
        }
    }
}

$alert = "บันทึกข้อมูลนักศึกษาเรียบร้อยแล้ว";
$location = "activity_stu_manage.php?id=".$_POST["id"];

include("../JsControl.php");