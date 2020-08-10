<?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
// SET TABLE //
$sql->table = "activity";

$title = "เพิ่ม";
if (!empty($_GET["id"])) {
  $title = "แก้ไข";
  $sql->field = "*";
  $sql->condition = "WHERE ac_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());
}

/* SUBMIT */
if (!empty($_POST)) {
  $sql->table = "activity";
  if (!empty($_POST["id"])) {
    $sql->value = "ac_title='{$_POST["ac_title"]}',ac_location='{$_POST["ac_location"]}', ac_start_time='{$_POST["ac_start_time"]}', ac_end_time='{$_POST["ac_end_time"]}', ac_start='{$_POST["ac_start"]}',ac_end='{$_POST["ac_end"]}',ac_type_id='{$_POST["ac_type_id"]}',ac_status='{$_POST["ac_status"]}',ac_detail='{$_POST["ac_detail"]}'";
    $sql->condition = "WHERE ac_id={$_POST["id"]}";
    if ($sql->update()) {
      $alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
      $location = URL . "activity/activitymanage.php";
    } else {
      $alert = "ไม่สามารถบันทึกข้อมูลได้";
    }
  } else {
    $sql->field = "ac_title,ac_location,ac_start_time,ac_end_time,ac_start,ac_end,ac_type_id,ac_status,ac_detail";
    $sql->value = "'{$_POST["ac_title"]}','{$_POST["ac_location"]}','{$_POST["ac_start_time"]}','{$_POST["ac_end_time"]}','{$_POST["ac_start"]}','{$_POST["ac_end"]}','{$_POST["ac_type_id"]}','{$_POST["ac_status"]}','{$_POST["ac_detail"]}'";
    if ($sql->insert()) {
      $alert = "บันทึกข้อมูลเรียบร้อยแล้ว";
      $location = URL . "activity/activitymanage.php";
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
          <h1 class="m-0 text-dark"><?php echo $title; ?>กิจกรรม</h1>
        </div>

      </div>
    </div>
  </div>

  <section class="content">
    <form method="POST" class="form-submit">
      <div class="form-group" method="POST">
        <label for="ac_title">หัวข้อกิจกรรม</label>
        <input type="text" class="form-control" pattern="^[A-Za-zก-๏\s0-9]+$" title="กรุณากรอกภาษาอังกฤษ ภาษาไทย และตัวเลขเท่านั้น" id="ac_title" name="ac_title" placeholder="หัวข้อกิจกรรม" value="<?php echo !empty($res["ac_title"]) ? $res["ac_title"] : "" ?>">
        <message class="text-red"></message>
      </div>
      <div class="form-group" method="POST">
        <label for="ac_location">สถานที่จัดกิจกรรม</label>
        <input type="text" class="form-control" pattern="^[A-Za-zก-๏\s0-9]+$" title="กรุณากรอกภาษาอังกฤษ ภาษาไทย และตัวเลขเท่านั้น" id="ac_location" name="ac_location" placeholder="สถานที่จัดกิจกรรม" value="<?php echo !empty($res["ac_location"]) ? $res["ac_location"] : "" ?>">
        <message class="text-red"></message>
      </div>
      <div class="form-group" method="POST">
        <label for="ac_start_time">เวลาเริ่มกิจกรรม</label>
        <input type="time" class="form-control" id="ac_start_time" name="ac_start_time" placeholder="เวลาเริ่มกิจกรรม" value="<?php echo !empty($res["ac_start_time"]) ? $res["ac_start_time"] : "" ?>">
        <message class="text-red"></message>
      </div>
      <div class="form-group" method="POST">
        <label for="ac_end_time">เวลาสิ้นสุดกิจกรรม</label>
        <input type="time" class="form-control" id="ac_end_time" name="ac_end_time" placeholder="เวลาสิ้นสุดกิจกรรม" value="<?php echo !empty($res["ac_end_time"]) ? $res["ac_end_time"] : "" ?>">
        <message class="text-red"></message>
      </div>
      <div class="form-group" method="POST">
        <label for="ac_start">วันที่เริ่มต้น</label>
        <input type="date" class="form-control" id="ac_start" name="ac_start" placeholder="วันที่เริ่มต้น" value="<?php echo !empty($res["ac_start"]) ? $res["ac_start"] : "" ?>">
        <message class="text-red"></message>
      </div>
      <div class="form-group" method="POST">
        <label for="ac_end">วันที่สิ้นสุด <label class="text-red" style="font-size: 13px;">*ในกรณีที่กิจกรรมมี 1 วันให้เลือกวันที่สิ้นสุดเป็นวันเดียวกับวันที่เริ่มต้น</label></label>
        <input type="date" class="form-control" id="ac_end" name="ac_end" placeholder="วันที่สิ้นสุด" value="<?php echo !empty($res["ac_end"]) ? $res["ac_end"] : "" ?>">
        <message class="text-red"></message>
      </div>
      <div class="form-group">
        <label for="ac_status">สถานะกิจกรรม</label>
        <?php
        $sType[] = array("id" => 1, "name" => "กำลังจะมาถึง");
        $sType[] = array("id" => 2, "name" => "กำลังดำเนินการ");
        $sType[] = array("id" => 3, "name" => "ผ่านไปแล้ว");
        $sType[] = array("id" => 4, "name" => "ยังไม่กำหนด");
        ?>
        <select class="form-control" id="ac_status" name="ac_status">
          <option value="">-- เลือกประเภท --</option>
          <?php
          foreach ($sType as $type) {
            $sel = "";
            if (!empty($res["ac_status"])) {
              if ($res["ac_status"] == $type["id"])
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
        <label for="ac_type">ประเภทกิจกรรม</label>
        <?php
        $sql->table = "ac_type";
        $sql->field = "*";
        $sql->condition = "";
        $typeQuery = $sql->select();
        ?>
        <select class="form-control" id="ac_type" name="ac_type_id">
          <option value="">-- เลือกประเภท --</option>
          <?php
          while ($type = mysqli_fetch_assoc($typeQuery)) {
            $sel = "";
            if (!empty($res["ac_type_id"])) {
              if ($res["ac_type_id"] == $type["ac_type_id"]) $sel = 'selected';
            }
          ?>
            <option <?= $sel ?> value="<?= $type["ac_type_id"] ?>"><?= $type["ac_type_name"] ?></option>
          <?php
          }
          ?>
        </select>
        <message class="text-red"></message>
      </div>

      <div class="form-group">
        <label for="ac_detail">รายละเอียดกิจกรรม</label>
        <textarea class="form-control textarea" COLS=50 ROWS=6 id="ac_detail" name="ac_detail" placeholder="รายละเอียดกิจกรรม"><?php echo !empty($res["ac_detail"]) ? $res["ac_detail"] : "" ?></textarea>
        <message class="text-red"></message>
      </div>
      <?php
      if (!empty($res)) {
        echo '<input type="hidden" name="id" value="' . $res["ac_id"] . '">';
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
  // function check() {
  //   if (ac_title.ac_title.value == "") {
  //     alert('กรุณากรอกชื่อกิจกรรม')
  //     ac_title.ac_title.focus()
  //     return false
  //   }

  //   else if(document.ac_title.ac_title.value.length <2) {
  //     alert("กรอกชื่อกิจกรรมมากกว่า 2 ตัวอักษร");
  //     document.ac_title.ac_title.focus() ;
  //     return false;
  //   }
  //   if (year_stu.year_stu.value == "") {
  //     alert('กรุณากรอกปีการศึกษา')
  //     year_stu.year_stu.focus()
  //     return false
  //   }

  //   else if(document.year_stu.year_stu.value.length <4) {
  //     alert("กรอกปีการศึกษา 4 ตัวอักษร");
  //     document.year_stu.year_stu.focus() ;
  //     return false;
  //   }


  // }

  $(".form-submit").submit(function() {
    var $error = false;
    if ($(this).find("[name=ac_title]").val() == "") {
      $div = $(this).find("[name=ac_title]").closest('div');
      $div.find('message').text('กรุณากรอกชื่อกิจกรรม');
      $error = true;
    }
    if ($(this).find("[name=ac_title]").val().length < 4) {
      $div = $(this).find("[name=ac_title]").closest('div');
      $div.find('message').text('ชื่อกิจกรรมต้องมีมากกว่า 4 ตัวอักษร');
      $error = true;
    }
    if ($(this).find("[name=ac_location]").val() == "") {
      $div = $(this).find("[name=ac_location]").closest('div');
      $div.find('message').text('กรุณากรอกสถานที่');
      $error = true;
    }
    if ($(this).find("[name=ac_location]").val().length < 4) {
      $div = $(this).find("[name=ac_location]").closest('div');
      $div.find('message').text('สถานที่ต้องมีมากกว่า 4 ตัวอักษร');
      $error = true;
    }
    if ($(this).find("[name=ac_start_time]").val() == "") {
      $div = $(this).find("[name=ac_start_time]").closest('div');
      $div.find('message').text('กรุณากรอกเวลาเริ่มต้น');
      $error = true;
    }
    if ($(this).find("[name=ac_end_time]").val() == "") {
      $div = $(this).find("[name=ac_end_time]").closest('div');
      $div.find('message').text('กรุณากรอกเวลาสิ้นสุด');
      $error = true;
    }
    if ($(this).find("[name=ac_start]").val() == "") {
      $div = $(this).find("[name=ac_start]").closest('div');
      $div.find('message').text('กรุณากรอกวันที่เริ่มต้น');
      $error = true;
    }
    if ($(this).find("[name=ac_end]").val() == "") {
      $div = $(this).find("[name=ac_end]").closest('div');
      $div.find('message').text('กรุณากรอกวันที่สิ้นสุด');
      $error = true;
    }
    if ($(this).find("[name=ac_status]").val() == "") {
      $div = $(this).find("[name=ac_status]").closest('div');
      $div.find('message').text('กรุณาเลือกสถานะ');
      $error = true;
    }
    if ($(this).find("[name=ac_type_id]").val() == "") {
      $div = $(this).find("[name=ac_type_id]").closest('div');
      $div.find('message').text('กรุณาเลือกประเภทกิจกรรม');
      $error = true;
    }
    if ($(this).find("[name=ac_detail]").val() == "") {
      $div = $(this).find("[name=ac_detail]").closest('div');
      $div.find('message').text('กรุณากรอกรายละเอียด');
      $error = true;
    }
    if ($(this).find("[name=ac_start_time]").val() != "" && $(this).find("[name=ac_end_time]").val() != "") {
      if ($(this).find("[name=ac_start_time]").val() > $(this).find("[name=ac_end_time]").val()) {
        $div = $(this).find("[name=ac_start_time]").closest('div');
        $div.find('message').text('กรุณากรอกข้อมูลเวลาให้ถูกต้อง');
        $div = $(this).find("[name=ac_end_time]").closest('div');
        $div.find('message').text('กรุณากรอกข้อมูลเวลาให้ถูกต้อง');
        $error = true;
      }
    }


    if ($(this).find("[name=ac_start]").val() != "" && $(this).find("[name=ac_end]").val() != "") {
      if ($(this).find("[name=ac_start]").val() > $(this).find("[name=ac_end]").val()) {
        $div = $(this).find("[name=ac_start]").closest('div');
        $div.find('message').text('กรุณากรอกข้อมูลวันที่ให้ถูกต้อง');

        $div = $(this).find("[name=ac_end]").closest('div');
        $div.find('message').text('กรุณากรอกข้อมูลวันที่ให้ถูกต้อง');
        $error = true;
      }
    }

    if ($error) {
      return false;
    }
  });

  $("[name=ac_title]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
  $("[name=ac_location]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
  $("[name=ac_start_time]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
  $("[name=ac_end_time]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
  $("[name=ac_start]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
  $("[name=ac_end]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
  $("[name=ac_status]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
  $("[name=ac_type_id]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
  $("[name=ac_detail]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
</script>