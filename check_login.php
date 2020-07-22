<?php
	include("config.php");
	$sql->table = "user";
	$sql->condition = "WHERE username='{$_POST["txtUsername"]}' AND password='{$_POST["txtPassword"]}'";
	$objQuery = $sql->select();
	$objResult = mysqli_fetch_array($objQuery);
	if(!$objResult)
	{
			echo "Username and Password Incorrect!";
		
			//header("location:".URL."index.php");
	}
	else
	{
			$_SESSION["admin_id"] = $objResult["Name"];
			$_SESSION["Status"] = $objResult["Status"];
			session_write_close();

			header("location:".URL."index.php");
	}
	//mysqli_close($conn);
?>
