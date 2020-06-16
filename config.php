<?php
session_start();
date_default_timezone_set("Asia/Bangkok");

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', 'http://localhost/activity_system/');

define('DB_HOST', 'localhost');
define('DB_NAME', 'activity_sys');
define('DB_USER', 'root');
define('DB_PASS', '');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('WWW_PATH', ROOT . DS );

define('CSS', URL . 'public/css/');
define('JS', URL . 'public/js/');
define('IMAGES', URL . 'public/images/');
define('PLUGINS', URL . 'public/plugins/');

function dateTH($strDate, $full=null, $time=null)
{
	$dateTH = "";
	$strYear = date("Y", strtotime($strDate)) + 543;
	$strMonth = date("n", strtotime($strDate));
	$strDay = date("j", strtotime($strDate));

	$strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
	$strMonthThai = $strMonthCut[$strMonth];

	if( !empty($full) ){
		$strMonthFull = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		$strMonthThai = $strMonthFull[$strMonth];
	}

	$dateTH = "$strDay $strMonthThai $strYear";

	if( !empty($time) ){
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$dateTH .= " ($strHour:$strMinute น.)";
	}

	return $dateTH;
}

## SQLi Manager And DB ##
include( ROOT.DS."SQLiManager.php" );
$sql = new SQLiManager();