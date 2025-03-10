<?php
include "config.php";
include "SQLiManager.php";
$sql = new SQLiManager();

$data = [];

$start = date("Y-m-d", strtotime($_GET["start"]));
$end = date("Y-m-d", strtotime($_GET["end"]));

$sql->table = "activity";
$sql->condition = "WHERE ac_start BETWEEN '{$start}' AND '$end'";
$query = $sql->select();

while($result = mysqli_fetch_assoc($query)){
    $color = '';
    if( $result["ac_status"] == 1 ){
        $color = '#24D0DA';
        //สถานะกิจกรรม กำลังจัดกิจกรรม
    }
    if( $result["ac_status"] == 2 ){
        $color = 'blue';
        //สถานะกิจกรรม กำลังจัดกิจกรรม
    }
    if( $result["ac_status"] == 3 ){
        $color = 'green';
        //สถานะกิจกรรม ผ่านไปแล้ว
    }
    if( $result["ac_status"] == 4 ){
        $color = '#F3EAF1 ';
        //สถานะกิจกรรม ผ่านไปแล้ว
    }

    $data[] = [
        "title" => $result["ac_title"],
        "start" => $result["ac_start"],
        "end" => date("Y-m-d", strtotime($result["ac_end"] . "+1 days")),
        "color" => $color,
        "url" => URL."show_event.php?id=".$result["ac_id"]
    ];
}

echo json_encode($data);
