<?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
// SET TABLE //
$sql->table = "news_type";

$title = "เพิ่ม";
if (!empty($_GET["id"])) {
  $title = "แก้ไข";
  $sql->field = "*";
  $sql->condition = "WHERE news_type_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());
}

/* SUBMIT */
if (!empty($_POST)) {
  if (!empty($_POST["id"])) {
    $sql->value = "news_type_name='{$_POST["news_type_name"]}'";
    $sql->condition = "WHERE news_type_id={$_POST["id"]}";
    if ($sql->update()) {
      $alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
      $location = URL . "news/nt_manage.php";
    } else {
      $alert = "ไม่สามารถบันทึกข้อมูลได้";
    }
  } else {
    $sql->field = "news_type_name";
    $sql->value = "'{$_POST["news_type_name"]}'";
    if ($sql->insert()) {
      $alert = "บันทึกข้อมูลเรียบร้อยแล้ว";
      $location = URL . "news/nt_manage.php";
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
          <h1 class="m-0 text-dark"><?php echo $title; ?>ประเภทข่าว</h1>
        </div>

      </div>
    </div>
  </div>

  <section class="content">
  <form method="POST" class="form-submit">

          <div class="form-group" method="POST">
        <label for="news_type_name">ประเภทข่าว</label>
        <input type="type" class="form-control" id="news_type_name" name="news_type_name" placeholder="ประเภทข่าว" value="<?php echo !empty($res["news_type_name"]) ? $res["news_type_name"] : "" ?>">
        <message class="text-red"></message>
      </div>
      <?php
      if (!empty($res)) {
        echo '<input type="hidden" name="id" value="' . $res["news_type_id"] . '">';
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
    if ($(this).find("[name=news_type_name]").val().length < 4) {
      $div = $(this).find("[name=news_type_name]").closest('div');
      $div.find('message').text('หัวข้อข่าวต้องมีอย่างน้อย 4 ตัวอักษร');
      $error = true;
    }

    if ($error) {
      return false;
    }
  });

  
  $("[name=news_type_name]").change(function() {
    $div = $(this).closest('div');
    $div.find('message').text('');
  });

</script>