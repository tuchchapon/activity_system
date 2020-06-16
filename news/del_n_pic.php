<?php
include("../config.php");
include("../SQLiManager.php");

$sql = new SQLiManager();

$news_id = $_POST["id"];

if( !empty($_POST["pic_id"]) ){
    foreach($_POST["pic_id"] as $key => $pic_id){
        $sql->table = "news_pic";
        $sql->condition="WHERE pic_id={$pic_id} AND news_id={$news_id}";
        $data = mysqli_fetch_assoc($sql->select());

        if( empty($data) ) continue; //Check Data

        /* DELETE FILE */
        if (file_exists("../img/{$data["news_pic_file"]}")) {
            unlink("../img/{$data["news_pic_file"]}");
        }

        /* DELETE DATABASE */
        $sql->delete();
    }
    $alert = "ลบข้อมูลเรียบร้อยแล้ว";
    $location = URL."news/news_image.php?id=".$news_id;
}
else{
     $alert = "กรุณาเลือกรูปภาพที่ต้องการลบ";
    $location = URL."news/news_image.php?id=".$news_id;

}

include("../JsControl.php");