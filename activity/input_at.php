<?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");


// SET TABLE //
$sql->table = "ac_type";

$title = "เพิ่ม";
if (!empty($_GET["id"])) {
  $title = "แก้ไข";
  $sql->field = "*";
  $sql->condition = "WHERE ac_type_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());
}

/* SUBMIT */
if (!empty($_POST)) {
  if (!empty($_POST["id"])) {
    $sql->value = "ac_type_name='{$_POST["ac_type_name"]}'";
    $sql->condition = "WHERE ac_type_id={$_POST["id"]}";
    if ($sql->update()) {
      $alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
      $location = URL . "activity/at_manage.php";
    } else {
      $alert = "ไม่สามารถบันทึกข้อมูลได้";
    }
  } else {
    $sql->field = "ac_type_name";
    $sql->value = "'{$_POST["ac_type_name"]}'";
    if ($sql->insert()) {
      $alert = "บันทึกข้อมูลเรียบร้อยแล้ว";
      $location = URL . "activity/at_manage.php";
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
          <h1 class="m-0 text-dark"><?php echo $title; ?>ประเภทกิจกรรม</h1>
        </div>

      </div>
    </div>
  </div>

  <section class="content">

    <form name="formck" class="form" method="POST" >

    <div class="form-group" method="POST">
        <label for="ac_type_name">ประเภทกิจกรรม</label>
        <input type="text" class="form-control" pattern="^[A-Za-zก-๏\s0-9]+$" title="กรุณากรอกภาษาอังกฤษ ภาษาไทย และตัวเลขเท่านั้น" id="ac_type_name" name="ac_type_name" placeholder="หัวข้อกิจกรรม" value="<?php echo !empty($res["ac_type_name"]) ? $res["ac_type_name"] : "" ?>">
        <message class="text-red"></message>
      </div>
      <?php
      if (!empty($res)) {
        echo '<input type="hidden" name="id" value="' . $res["ac_type_id"] . '">';
      }
      ?>
      <div class="clearfix"><button type="submit" class="btn btn-primary mb-2">ยืนยัน</button></div>
    </form>
  </section>
</div>
<!-- End Content -->
<?php
//FOOTER
include("../layouts/footer.php");
?>
<script language="javascript">
  $("form").submit(function() {
    var $error = false;
    if ($(this).find("[name=ac_type_name]").val().length < 4 ) {
      $div = $(this).find("[name=ac_type_name]").closest('div');
      $div.find('message').text('ชื่อประเภทกิจกรรมต้องมีอย่างน้อย 4 ตัวอักษร');
      $error = true;
    }

    if ($error) {
      return false;
    }
  });
  $("[name=ac_type_name]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
</script>