<?php 
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");

$sql->table = "news_type";
$sql->field = "*";
$query=$sql->select();
?>
<!-- Content -->
<div class="content-wrapper">
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">จัดการประเภทข่าวสาร</h1>
          </div>
          <div class="col-sm-6">
            <a href="<?=URL?>news/input_nt.php" class="btn btn-primary text-white float-right">เพิ่มประเภทข่าว 
               </a>
            
          </div>
        </div>
      </div>
    </div>

    <section class="content">
    <div class="card p-3">
      <div class="container-fluid">
          <table class="table table-bordered">
              <thead>
                  <tr class="text-center table-info">
                      <th width="10%">#</th>
                      <th width="70%">หัวข้อข่าวสาร</th>
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
                      <td><?php echo $res["news_type_name"];?></td>
                      <td class="text-center">
                          <a href="<?=URL?>news/input_nt.php?id=<?php echo $res["news_type_id"];?>" class="btn btn-warning">แก้ไข</a>
                          <a onclick="return confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่')" href="<?=URL?>news/delete_nt.php?id=<?php echo $res["news_type_id"];?>" class="btn btn-danger">ลบ</a>
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