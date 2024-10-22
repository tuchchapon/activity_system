<?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
// SET TABLE //
$sql->table = "student";

$title = "เพิ่ม";
if (!empty($_GET["id"])) {
  $title = "แก้ไข";
  $sql->field = "*";
  $sql->condition = "WHERE stu_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());
}

/* SUBMIT */
if (!empty($_POST)) {
  $sql->table = "student";
  if (!empty($_POST["id"])) {
    $sql->value = "stu_code='{$_POST["stu_code"]}', stu_name='{$_POST["stu_name"]}', stu_level='{$_POST["stu_level"]}',stu_status='{$_POST["stu_status"]}'";
    $sql->condition = "WHERE stu_id={$_POST["id"]}";
    if ($sql->update()) {
      $alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
      $location = URL . "users/stu_manage.php";
    } else {
      $alert = "ไม่สามารถบันทึกข้อมูลได้";
    }
  } else {
    $sql->field = "stu_code,stu_name,stu_level,stu_status";
    $sql->value = "'{$_POST["stu_code"]}','{$_POST["stu_name"]}','{$_POST["stu_level"]}','{$_POST["stu_status"]}'";
    if ($sql->insert()) {
      $alert = "บันทึกข้อมูลเรียบร้อยแล้ว";
      $location = URL . "users/stu_manage.php";
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
    <form method="POST" class="form-submit" >
      <div class="form-group" method="POST">
        <label for="stu_code">รหัสนักศึกษา</label>
        <input type="number" class="form-control" id="stu_code" name="stu_code" placeholder="รหัสนักศึกษา" value="<?php echo !empty($res["stu_code"]) ? $res["stu_code"] : "" ?>">
        <message class="text-red"></message>
      </div>
      <div class="form-group" method="POST">
        <label for="stu_name">ชื่อนักศึกษา</label>
        <input type="type" class="form-control" id="stu_name" name="stu_name" placeholder="ชื่อนักศึกษา" value="<?php echo !empty($res["stu_name"]) ? $res["stu_name"] : "" ?>">
        <message class="text-red"></message>
      </div>
      <div class="form-group">
        <label for="stu_level">ระดับชั้นปีนักศึกษา</label>
        <?php
        $sType[] = array("id" => 1, "name" => "ปี 1 ");
        $sType[] = array("id" => 2, "name" => "ปี 2 ");
        $sType[] = array("id" => 3, "name" => "ปี 3");
        $sType[] = array("id" => 4, "name" => "ปี 4");
        $sType[] = array("id" => 5, "name" => "ศิษย์เก่า");
        ?>
        <select class="form-control" id="stu_level" name="stu_level">
          <option value="">-- เลือกชั้นปี --</option>
         
          <?php
          foreach ($sType as $type) {
            $sel = "";
            if (!empty($res["stu_level"])) {
              if ($res["stu_level"] == $type["id"])
                $sel = 'selected';
            }
          ?>
            <option <?= $sel ?> value="<?= $type["id"] ?>"><?= $type["name"] ?></option>
          <?php
          }
          ?>
        </select>
        <message class="text-red"></message>
      </div>
      <div class="form-group">
        <label for="stu_status">สถานะนักศึกษา</label>
        <?php
        $status[] = array("id" => 1, "name" => "กำลังศึกษา ");
        $status[] = array("id" => 2, "name" => "ออกโดยวัดผล ");
        $status[] = array("id" => 3, "name" => "จบการศึกษา");
        ?>
        <select class="form-control" id="stu_status" name="stu_status">
          <option value="">-- เลือกสถานะ --</option>
          <?php
          foreach ($status as $type) {
            $sel = "";
            if (!empty($res["stu_status"])) {
              if ($res["stu_status"] == $type["id"])
                $sel = 'selected';
            }
          ?>
            <option <?= $sel ?> value="<?= $type["id"] ?>"><?= $type["name"] ?></option>
          <?php
          }
          
          ?>
        </select>
        <message class="text-red"></message>  
      </div>

      <?php
      if (!empty($res)) {
        echo '<input type="hidden" name="id" value="' . $res["stu_id"] . '">';
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
<script language="javascript">
  $(".form-submit").submit(function() {
    var $error = false;
    if ($(this).find("[name=stu_code]").val().length != 11) {
      $div = $(this).find("[name=stu_code]").closest('div');
      $div.find('message').text('รหัสนักศึกษาต้องมี 11 ตัวเท่านั้น');
      $error = true;
    }
    if ($(this).find("[name=stu_name]").val() == "") {
      $div = $(this).find("[name=stu_name]").closest('div');
      $div.find('message').text('กรุณากรอกชื่อ-สกุล');
      $error = true;
    }  
    if ($(this).find("[name=stu_level]").val() == "") {
      $div = $(this).find("[name=stu_level]").closest('div');
      $div.find('message').text('กรุณาเลือกข้อมูลชั้นปี');
      $error = true;
    }
    if ($(this).find("[name=stu_status]").val() == "") {
      $div = $(this).find("[name=stu_status]").closest('div');
      $div.find('message').text('กรุณาเลือกข้อมูลสถานะนักศึกษา');
      $error = true;
    }
    if ($(this).find("[name=ac_detail]").val() == "") {
      $div = $(this).find("[name=ac_detail]").closest('div');
      $div.find('message').text('กรุณากรอกรายละเอียด');
      $error = true;
    }
    if ($error) {
      return false;
    }
  });

  
  $("[name=stu_code]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
  $("[name=stu_name]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
  $("[name=stu_level]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
  $("[name=stu_status]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
</script>