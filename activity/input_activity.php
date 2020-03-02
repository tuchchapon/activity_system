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
if( !empty($_GET["id"]) ){
  $title = "แก้ไข";
  $sql->field="*";
  $sql->condition="WHERE ac_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());
}

/* SUBMIT */
if( !empty($_POST) ){
  if( !empty($_POST["id"]) ){
    $sql->value="ac_title='{$_POST["ac_title"]}', news_type_id='{$_POST["news_type_id"]}', news_detail='{$_POST["news_detail"]}'";
    $sql->condition="WHERE news_id={$_POST["id"]}";
    if( $sql->update() ){
      $alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
      $location = URL."news/newsmanage.php";
    }
    else{
      $alert = "ไม่สามารถบันทึกข้อมูลได้";
    }
  }
  else{
    $sql->table= "activity";
    $sql->field= "ac_title, news_type_id, news_detail";
    $sql->value= "'{$_POST["ac_title"]}','{$_POST["news_type_id"]}','{$_POST["news_detail"]}'";
    if( $sql->insert() ){
        $alert = "บันทึกข้อมูลเรียบร้อยแล้ว";
        $location = URL."news/newsmanage.php";
    }
    else{
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
    <form  method="POST">
  <div class="form-group" method="POST">
    <label for="ac_title">หัวข้อกิจกรรม</label>
    <input type="type" class="form-control" id="ac_title" name="ac_title" placeholder="หัวข้อกิจกรรม"value="<?php echo !empty($res["ac_title"]) ? $res["ac_title"] : "" ?>">
  </div>
  <div class="form-group" method="POST">
    <label for="year_stu">ปีการศึกษา</label>
    <input type="type" class="form-control" id="year_stu" name="year_stu" placeholder="ปีการศึกษา"value="<?php echo !empty($res["year_stu"]) ? $res["year_stu"] : "" ?>">
  </div>  <div class="form-group" method="POST">
    <label for="ac_start">วันที่เริ่มต้น</label>
    <input type="type" class="form-control" id="ac_start" name="ac_start" placeholder="วันที่เริ่มต้น"value="<?php echo !empty($res["ac_start"]) ? $res["ac_start"] : "" ?>">
  </div>  <div class="form-group" method="POST">
    <label for="ac_end">วันที่สิ้นสุด</label>
    <input type="type" class="form-control" id="ac_end" name="ac_end" placeholder="วันที่สิ้นสุด"value="<?php echo !empty($res["ac_end"]) ? $res["ac_end"] : "" ?>">
  </div>
  <div class="form-group">
    <label for="ac_status">สถานะกิจกรรม</label>
    <?php 
    $sql->table = "activity";
    $sql->field = "*";
    $sql->condition = "";
    $typeQuery = $sql->select();
    ?>
    <select class="form-control" id="ac_status" name="ac_status">
      <option value="">-- เลือกประเภท --</option>
      <?php
      while($type = mysqli_fetch_assoc($typeQuery)
      ){
        $sel = "";
        $ac_status_select = "";
        if( !empty($res["ac_status"]) ){
          if( $res["ac_status"] == $type["ac_status"] )
          $sel = 'selected';
        }
        ?>
        <option <?=$sel?> value="<?=$type["ac_status"]?>"><?=$type["ac_status"]?></option>
        <?php
      }
      ?>
    </select>
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
      while($type = mysqli_fetch_assoc($typeQuery)){
        $sel = "";
        if( !empty($res["ac_type_id"]) ){
          if( $res["ac_type_id"] == $type["ac_type_id"] ) $sel = 'selected';
        }
        ?>
        <option <?=$sel?> value="<?=$type["ac_type_id"]?>"><?=$type["ac_type_name"]?></option>
        <?php
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="news_detail">รายละเอียดกิจกรรม</label>
    <textarea class="form-control textarea"COLS=50 ROWS=6 id="news_detail" placeholder="รายละเอียดกิจกรรม"><?php echo !empty($res["ac_detail"]) ? nl2br($res["ac_detail"]) : "" ?></textarea>
   
  </div>
  <?php 
  if( !empty($res) ){
    echo '<input type="hidden" name="id" value="'.$res["ac_id"].'">';
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