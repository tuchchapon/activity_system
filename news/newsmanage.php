<?php 
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");

$sql->table = "news n LEFT JOIN news_type nt ON n.news_type_id=nt.news_type_id";
$sql->field = "n.*, nt.news_type_name";
$query=$sql->select();
?>
<!-- Content -->
<div class="content-wrapper">
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">จัดการข่าวสาร</h1>
          </div>
          <div class="col-sm-6">
            <a href="<?=URL?>news/input_news.php" class="btn btn-primary text-white float-right">เพิ่มข่าว 
               </a>
            
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
          <table class="table table-bordered datatable">
              <thead>
                  <tr class="text-center table-info">
                      <th width="10%">#</th>
                      <th width="20%">ประเภทข่าว</th>
                      <th width="35%">หัวข้อข่าวสาร</th>
                      <th width="15%">วันที่</th>
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
                      <td><?php echo $res["news_title"];?></td>
                      <td class="text-center"><?php echo $res["news_create"];?></td>
                      <td class="text-center">
                          <a href="<?=URL?>news/input_news.php?id=<?php echo $res["news_id"];?>" class="btn btn-warning">แก้ไข</a>
                          <a onclick="return confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่')" href="<?=URL?>news/delete_news.php?id=<?php echo $res["news_id"];?>" class="btn btn-danger">ลบ</a>
                      </td>
                  </tr>
                  <?php } ?>
              </tbody>
          </table>
      </div>
  </section>
</div>
<!-- End Content -->
<?php
//FOOTER
include("../layouts/footer.php");
?>