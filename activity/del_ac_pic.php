<?php
include("../config.php");
include("../SQLiManager.php");

$sql = new SQLiManager();

$ac_id = $_POST["id"];

if( !empty($_POST["pic_id"]) ){
    foreach($_POST["pic_id"] as $key => $pic_id){
        $sql->table = "activity_pic";
        $sql->condition="WHERE pic_id={$pic_id} AND ac_id={$ac_id}";
        $data = mysqli_fetch_assoc($sql->select());

        if( empty($data) ) continue; //Check Data

        /* DELETE FILE */
        if (file_exists("../img/{$data["pic_file"]}")) {
            unlink("../img/{$data["pic_file"]}");
        }

        /* DELETE DATABASE */
        $sql->delete();
    }
    $alert = "ลบข้อมูลเรียบร้อยแล้ว";
    $location = URL."activity/activity_images.php?id=".$ac_id;
}
else{
     $alert = "กรุณาเลือกรูปภาพที่ต้องการลบ";
    $location = URL."activity/activity_images.php?id=".$ac_id;

}

include("../JsControl.php");