<?php
require '../vendor/autoload.php';
include("../config.php");


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// mockup data by json file ex. you can use retrive data from db.

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sql->field = "a.*, at.ac_type_name";
$sql->table = "activity a LEFT JOIN ac_type at ON a.ac_type_id=at.ac_type_id";
$sql->field = "*";
$sql->condition = "WHERE ac_id={$_GET["id"]}";
$activity = mysqli_fetch_assoc($sql->select());
$time = dateTH($activity["ac_start"]) . " - " . dateTH($activity["ac_end"]);
// header
$spreadsheet->getActiveSheet()
    ->setCellValue('B1', 'ชื่อกิจกรรม')
    ->setCellValue('C1', $activity["ac_title"])
    ->setCellValue('B3', 'วันที่')
    ->setCellValue('C3',  $time)
    ->setCellValue('B2', 'สถานที่')
    ->setCellValue('C2', $activity["ac_location"])
    ->setCellValue('A5', 'ลำดับ')
    ->setCellValue('B5', 'รหัสนักศึกษา')
    ->setCellValue('C5', 'ชื่อ-นามสกุล')
    ->setCellValue('D5', 'ชั้นปี')
    ->setCellValue('E5', 'สถานะการเข้าร่วม');

// cell value
$cell = 6;
$sql->table = "ac_stu_status ast LEFT JOIN student s ON ast.stu_id=s.stu_id";
$sql->field = "ast.*, s.*";
$sql->condition = "WHERE ac_id={$_GET["id"]}";
$query = $sql->select();
$numRows = mysqli_num_rows($query);

$num = 0;
while ($result = mysqli_fetch_assoc($query)) {
    $num++;

    $spreadsheet->getActiveSheet()
        ->setCellValue('A' . $cell, $num)
        ->setCellValue('B' . $cell, $result["stu_code"])
        ->setCellValue('C' . $cell, $result["stu_name"]);
    if ($result["stu_level"] > 4) {
        $spreadsheet->getActiveSheet()
            ->setCellValue('D' . $cell, 'ศิษย์เก่า');
    } else {
        $spreadsheet->getActiveSheet()
            ->setCellValue('D' . $cell, "ปี " . $result["stu_level"]);
    };
    if ($result["status"] == 1) {
        $spreadsheet->getActiveSheet()
            ->setCellValue('E' . $cell, 'เข้าร่วม');
    }
    if ($result["status"] == 2) {
        $spreadsheet->getActiveSheet()
            ->setCellValue('E' . $cell, 'ไม่เข้าร่วม');
    }
    if ($result["status"] == 0) {
        $spreadsheet->getActiveSheet()
            ->setCellValue('E' . $cell, 'ไม่ระบุ');
    }
    //->setCellValue('D' . $cell, $result["stu_level"]);


    $cell++;
}

$lastRow = $numRows + 5;
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);


$sheet->getStyle('A5:E5')->getAlignment()->setHorizontal('center');
$sheet->getStyle('A2:A' . $lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('B2:B' . $lastRow)->getAlignment()->setHorizontal('center');
//$sheet->getStyle('C6:C' . $lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('D2:D' . $lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('E2:E' . $lastRow)->getAlignment()->setHorizontal('center');
// //BUILD
$writer = new Xlsx($spreadsheet);

// save file to server and create link
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="student-' . date("Y_m_d") . '.xlsx"');
$writer->save('php://output');
