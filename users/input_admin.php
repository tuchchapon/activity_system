<?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
// SET TABLE //
$sql->table = "user";

$title = "เพิ่ม";
if (!empty($_GET["id"])) {
  $title = "แก้ไข";
  $sql->field = "*";
  $sql->condition = "WHERE user_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());
}

/* SUBMIT */
if (!empty($_POST)) {
  $sql->table = "user";
  if (!empty($_POST["id"])) {
    $sql->value = "username='{$_POST["username"]}', password='{$_POST["password"]}', Name='{$_POST["Name"]}'";
    $sql->condition = "WHERE user_id={$_POST["id"]}";
    if ($sql->update()) {
      $alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
      $location = URL . "users/admin_manage.php";
    } else {
      $alert = "ไม่สามารถบันทึกข้อมูลได้";
    }
  } else {
    $sql->field = "username,password,Name,Status";
    $sql->value = "'{$_POST["username"]}','{$_POST["password"]}','{$_POST["Name"]}','user'";
    if ($sql->insert()) {
      $alert = "บันทึกข้อมูลเรียบร้อยแล้ว";
      $location = URL . "users/admin_manage.php";
    } else {
      $alert = "ไม่สามารถบันทึกข้อมูลได้";
    }
  }
}
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo $title; ?>นักศึกษา</h1>
        </div>

      </div>
    </div>
  </div>

  <section class="content">
    <form method="POST">
      <div class="form-group" method="POST">
        <label for="username">Username</label>
        <input type="type" class="form-control" id="username" name="username" placeholder="username" value="<?php echo !empty($res["username"]) ? $res["username"] : "" ?>">
      </div>
      <div class="form-group" method="POST">
        <label for="password">รหัสผ่าน</label>
        <input type="type" class="form-control" id="password" name="password" placeholder="รหัสผาน" value="<?php echo !empty($res["password"]) ? $res["password"] : "" ?>">
      </div>
      <div class="form-group" method="POST">
        <label for="Name">ชื่อ-นามสกุล</label>
        <input type="type" class="form-control" id="Name" name="Name" placeholder="ชื่อ-นามสกุล" value="<?php echo !empty($res["Name"]) ? $res["Name"] : "" ?>">
      </div>

      <?php
      if (!empty($res)) {
        echo '<input type="hidden" name="id" value="' . $res["user_id"] . '">';
      }
      ?>
      <button type="submit" class="btn btn-primary mb-2">ยืนยัน</button>
    </form>
  </section>
</div>
<!-- End Content -->
<?php
//FOOTER
include("../layouts/footer.php");
?>