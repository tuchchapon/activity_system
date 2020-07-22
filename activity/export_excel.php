<?php
require '../vendor/autoload.php';
 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
// mockup data by json file ex. you can use retrive data from db.
 
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// $sql->table = "activity a LEFT JOIN ac_type at ON a.ac_type_id=at.ac_type_id";
// $sql->field="*";
// $sql->condition="WHERE ac_id={$_GET["id"]}";
// $activity = mysqli_fetch_assoc($sql->select());
// $query = $sql->select();

// header
$spreadsheet->getActiveSheet()->setCellValue('A1', 'รหัสนักศึกษา')
    ->setCellValue('B1', 'ชื่อ-นามสกุล')
    ->setCellValue('C1', 'ชั้นปี')
    ->setCellValue('D1', 'อีเมล์')
    ->setCellValue('E1', 'เพศ')
    ->setCellValue('F1', 'เงินเดือน')
    ->setCellValue('G1', 'เบอร์โทรศัพท์');
 
// cell value
 
// style$spreadsheet->getActiveSheet()->getStyle('F2:F' . $last_row)
//BUILD
$writer = new Xlsx($spreadsheet);
 
// save file to server and create link
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="customers-'.date("Y_m_d").'.xlsx"');
$writer->save('php://output');
