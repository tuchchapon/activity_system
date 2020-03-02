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
if( !empty($_GET["id"]) ){
  $title = "แก้ไข";
  $sql->field="*";
  $sql->condition="WHERE news_type_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());
}

/* SUBMIT */
if( !empty($_POST) ){
  if( !empty($_POST["id"]) ){
    $sql->value="news_type_name='{$_POST["news_type_name"]}'";
    $sql->condition="WHERE news_type_id={$_POST["id"]}";
    if( $sql->update() ){
      $alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
      $location = URL."news/nt_manage.php";
    }
    else{
      $alert = "ไม่สามารถบันทึกข้อมูลได้";    
    }
  }
  else{
    $sql->field= "news_type_name";
    $sql->value= "'{$_POST["news_type_name"]}'";
    if( $sql->insert() ){
        $alert = "บันทึกข้อมูลเรียบร้อยแล้ว";
        $location = URL."news/nt_manage.php";
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
            <h1 class="m-0 text-dark"><?php echo $title; ?>ประเภทข่าว</h1>
          </div>

        </div>
      </div>
    </div>

    <section class="content">
    <form class="form-inline" method="POST">

  <div class="form-group mx-sm-3 mb-2">
    <label for="news_type_name" class="sr-only">Password</label>
    <input type="text" class="form-control" id="news_type_name" name="news_type_name" placeholder="ประเภทข่าว" value="<?php echo !empty($res["news_type_name"]) ? $res["news_type_name"] : "" ?>">
  </div>
  <?php 
  if( !empty($res) ){
    echo '<input type="hidden" name="id" value="'.$res["news_type_id"].'">';
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