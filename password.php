<?php 
$_title = "เปลี่ยนรหัสผ่าน";

// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");

//EDIT DATA
$sql->table = "users";
$sql->condition = "WHERE id='{$_SESSION["admin"]}' LIMIT 1";
$query = $sql->select();
if( mysqli_num_rows($query) <= 0 ){
	header('location:'.URL.'admin/users/?page='.$_GET['page']);
	exit;
}
$result = mysqli_fetch_assoc($query);
?>

<?php
//FOOTER
include($_pathURL."admin/layouts/footer.php");
?>