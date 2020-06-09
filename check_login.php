<?php
	include("config.php");
	$sql->table = "user";
	$sql->condition = "WHERE username='{$_POST["txtUsername"]}' AND password='{$_POST["txtPassword"]}' AND status='admin'";
	$objQuery = $sql->select();
	$objResult = mysqli_fetch_array($objQuery);
	if(!$objResult)
	{
			echo "Username and Password Incorrect!";
	}
	else
	{
			$_SESSION["admin_id"] = $objResult["user_id"];
			session_write_close();
			header("location:".URL."index.php");
	}
	mysqli_close($conn);
?>
