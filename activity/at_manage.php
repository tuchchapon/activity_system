<?php 
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");

$sql->table = "ac_type";
$sql->field = "*";
$query=$sql->select();
?>
<!-- Content -->
<div class="content-wrapper">
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">จัดการประเภทกิจกรรม</h1>
          </div>
          <div class="col-sm-6">
            <a href="<?=URL?>activity/input_at.php" class="btn btn-primary text-white float-right">เพิ่มประเภทกิจกรรม
               </a>
            
          </div>
        </div>
      </div>
    </div>

    <section class="content">
    <div class="card p-3">
      <div class="container-fluid">
          <table class="table table-bordered datatable">
              <thead>
                  <tr class="text-center table-info">
                      <th width="10%">ลำดับ</th>
                      <th width="70%">หัวข้อกิจกรรม</th>
                      <th width="20%">จัดการ</th>
                  </tr>
              </thead> 
              <tbody>
                  <?php
                  $num =0;
                  while($res=mysqli_fetch_assoc($query)){
                      $num++;
                  ?>
                  <tr>
                      <td class="text-center"><?php echo $num;?></td>
                      <td><?php echo $res["ac_type_name"];?></td>
                      <td class="text-center">
                          <a href="<?=URL?>activity/input_at.php?id=<?php echo $res["ac_type_id"];?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                          <a onclick="return confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่')" href="<?=URL?>activity/delete_at.php?id=<?php echo $res["ac_type_id"];?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                      </td>
                  </tr>
                  <?php } ?>
              </tbody>
          </table>
      </div>
      </div>
  </section>
</div>
<!-- End Content -->
<?php
//FOOTER
include("../layouts/footer.php");
?>