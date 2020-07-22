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
if( !empty($_GET["id"]) ){
  $title = "แก้ไข";
  $sql->field="*";
  $sql->condition="WHERE ac_type_id={$_GET["id"]}";
  $res = mysqli_fetch_assoc($sql->select());
}

/* SUBMIT */
if( !empty($_POST) ){
  if( !empty($_POST["id"]) ){
    $sql->value="ac_type_name='{$_POST["ac_type_name"]}'";
    $sql->condition="WHERE ac_type_id={$_POST["id"]}";
    if( $sql->update() ){
      $alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
      $location = URL."activity/at_manage.php";
    }
    else{
      $alert = "ไม่สามารถบันทึกข้อมูลได้";
    }
  }
  else{
    $sql->field= "ac_type_name";
    $sql->value= "'{$_POST["ac_type_name"]}'";
    if( $sql->insert() ){
        $alert = "บันทึกข้อมูลเรียบร้อยแล้ว";
        $location = URL."activity/at_manage.php";
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
            <h1 class="m-0 text-dark"><?php echo $title; ?>ประเภทกิจกรรม</h1>
          </div>

        </div>
      </div>
    </div>

    <section class="content">
    <form name="formck" class="form-inline" method="POST" onsubmit="return check();" >

  <div class="form-group mx-sm-3 mb-2">
    <label for="ac_type_name" class="sr-only">Password</label>
    <input type="text" pattern="^[A-Za-zก-๏\s]+$" class="form-control" id="ac_type_name" name="ac_type_name" placeholder="ประเภทกิจกรรม" value="<?php echo !empty($res["ac_type_name"]) ? $res["ac_type_name"] : "" ?>">
  </div>
  <?php 
  if( !empty($res) ){
    echo '<input type="hidden" name="id" value="'.$res["ac_type_id"].'">';
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
    function check() {
      if (formck.ac_type_name.value == "") {
        alert('กรุณากรอกชื่อประเภทกิจกรรม')
        formck.ac_type_name.focus()
        return false
      }

      else if(document.formck.ac_type_name.value.length <2) {
        alert("กรอกชื่อประเภทกิจกรรมมากกว่า 2 ตัวอักษร");
        document.formck.ac_type_name.focus() ;
        return false;
      }

    }
  </script>