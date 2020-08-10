<?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
// SET TABLE //
$sql->table = "news";

$title = "เพิ่ม";
if (!empty($_GET["id"])) {
  $title = "แก้ไข";
  $sql->field = "*";
  $sql->condition = "WHERE news_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());
}

/* SUBMIT */
if (!empty($_POST)) {
  if (!empty($_POST["id"])) {
    $sql->value = "news_title='{$_POST["news_title"]}', news_type_id='{$_POST["news_type_id"]}', news_detail='{$_POST["news_detail"]}'";
    $sql->condition = "WHERE news_id={$_POST["id"]}";
    if ($sql->update()) {
      $alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
      $location = URL . "news/newsmanage.php";
    } else {
      $alert = "ไม่สามารถบันทึกข้อมูลได้";
    }
  } else {
    $sql->table = "news";
    $sql->field = "news_title, news_type_id, news_detail";
    $sql->value = "'{$_POST["news_title"]}','{$_POST["news_type_id"]}','{$_POST["news_detail"]}'";
    if ($sql->insert()) {
      $alert = "บันทึกข้อมูลเรียบร้อยแล้ว";
      $location = URL . "news/newsmanage.php";
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
          <h1 class="m-0 text-dark"><?php echo $title; ?>ข่าว</h1>
        </div>

      </div>
    </div>
  </div>

  <section class="content">
    <form method="POST" class="form-submit">
      <div class="form-group" method="POST">
        <label for="news_title">หัวข้อข่าว</label>
        <input type="type" class="form-control" id="news_title" name="news_title" placeholder="หัวข้อข่าว" value="<?php echo !empty($res["news_title"]) ? $res["news_title"] : "" ?>">
        <message class="text-red"></message>
      </div>

      <div class="form-group">
        <label for="newstype">เลือกประเภทข่าว</label>
        <?php
        $sql->table = "news_type";
        $sql->field = "*";
        $sql->condition = "";
        $typeQuery = $sql->select();
        ?>
        <select class="form-control" id="newstype" name="news_type_id">
          <option value="">-- เลือกประเภท --</option>
          <?php
          while ($type = mysqli_fetch_assoc($typeQuery)) {
            $sel = "";
            if (!empty($res["news_type_id"])) {
              if ($res["news_type_id"] == $type["news_type_id"]) $sel = 'selected';
            }
          ?>
            <option <?= $sel ?> value="<?= $type["news_type_id"] ?>"><?= $type["news_type_name"] ?></option>
          <?php
          }
          ?>
        </select>
        <message class="text-red"></message>
      </div>

      <div class="form-group">
        <label for="news_detail">รายละเอียดข่าว</label>
        <textarea class="form-control textarea" rows="6" id="news_detail" placeholder="รายละเอียดข่าว" name="news_detail"><?php echo !empty($res["news_detail"]) ? nl2br($res["news_detail"]) : "" ?></textarea>
        <message class="text-red"></message>
      </div>
      <message class="text-red"></message>
      <?php
      if (!empty($res)) {
        echo '<input type="hidden" name="id" value="' . $res["news_id"] . '">';
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
    if ($(this).find("[name=news_title]").val().length < 4) {
      $div = $(this).find("[name=news_title]").closest('div');
      $div.find('message').text('หัวข้อข่าวต้องมีอย่างน้อย 4 ตัวอักษร');
      $error = true;
    }
    if ($(this).find("[name=news_type_id]").val() == "") {
      $div = $(this).find("[name=news_type_id]").closest('div');
      $div.find('message').text('กรุณาเลือกข้อมูลประเภทข่าว');
      $error = true;
    }
    if ($(this).find("[name=news_detail]").val() == "") {
      $div = $(this).find("[name=news_detail]").closest('div');
      $div.find('message').text('กรุณากรอกข้อมูลรายละเอียดข่าว');
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
  $("[name=news_type_id]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
  $("[name=news_detail]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });
</script>