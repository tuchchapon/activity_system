<?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
// SET TABLE //
$sql->table = "web_info";
$sql->field = "*";
$res = mysqli_fetch_assoc($sql->select());

/* SUBMIT */
if (!empty($_POST)) {
    $sql->value = "detail='{$_POST["detail"]}'";
    $sql->condition = "";
    if ($sql->update()) {
      $alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
      $location = URL."webinfo/info.php";
    } else {
      $alert = "ไม่สามารถบันทึกข้อมูลได้";
    }
}
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">จัดการข้อมูลสาขาวิชา</h1>
        </div>

      </div>
    </div>
  </div>

  <section class="content">
    <form method="POST">
    
      <div class="form-group">
        <label for="detail">แก้ไขข้อมูลสาขา</label>
        <textarea class="form-control textarea" rows="50" id="detail" placeholder="ข้อมูลสาขาวิชา" name="detail"><?php echo !empty($res["detail"]) ? $res["detail"] : "" ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary mb-2">ยืนยัน</button>
    </form>
  </section>
</div>
<!-- End Content -->
<?php
//FOOTER
include("../layouts/footer.php");
?>