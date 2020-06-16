<?php
include("../config.php");
include("../SQLiManager.php");

$sql = new SQLiManager();

$count = count($_FILES["image"]['name']);

if( !empty($count) ){
  for($i=0; $i<$count; $i++){
    $typeFile = strtolower(strrchr($_FILES["image"]["name"][$i], "."));
    if( $typeFile != ".jpg" && $typeFile != ".png" && $typeFile != ".jpeg" ) continue;

    $newNameFile = "pic_".date("Y_m_d")."_".rand(100000,999999)."_".$_POST["ac_id"].$typeFile;
    if( move_uploaded_file($_FILES["image"]["tmp_name"][$i], "../img/".$newNameFile) ){
      $sql->table = "activity_pic";
      $sql->field = "ac_id, pic_file";
      $sql->value = "'{$_POST["ac_id"]}', '{$newNameFile}'";
      $sql->insert();
    }
  }

  $alert = "เพิ่มรูปเรียบร้อยแล้ว";
  $location = "activity_images.php?id=".$_POST["ac_id"];
}
else{
  $alert = "กรุณาเลือกไฟล์";
  $location = "activity_images.php?id=".$_POST["ac_id"];
}

include("../JsControl.php");