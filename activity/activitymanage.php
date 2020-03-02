<?php 
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");

$sql->table = "activity n LEFT JOIN ac_type nt ON n.ac_type_id=nt.ac_type_id";
$sql->field = "n.*, nt.ac_type_name";
$query=$sql->select();
?>
<!-- Content -->
<div class="content-wrapper">
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">จัดการกิจกรรม</h1>
          </div>
          <div class="col-sm-6">
            <a href="<?=URL?>activity/input_activity.php" class="btn btn-primary text-white float-right">เพิ่มกิจกรรม 
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
                      <th width="10%">ลำดับ</th>
                      <th width="10%">ประเภทกิจกรรม</th>
                      <th width="30%">หัวข้อกิจกรรม</th>
                      <th width="10%">ปีการศึกษา</th>
                      <th width="15%">สถานะกิจกรรม</th>
                      <th width="10%">วันที่</th>
                      <th width="15%">จัดการ</th>
                  </tr>
              </thead> 
              <tbody>
                  <?php
                  $num =0;
                  $ac_status = "";
                  while($res=mysqli_fetch_assoc($query)){
                      $num++;
                  ?>
                  <tr>
                      <td class="text-center"><?php echo $num;?></td>
                      <td><?php echo $res["ac_type_name"];?></td>
                      <td><?php echo $res["ac_title"];?></td>
                      <td><?php echo $res["year_stu"];?></td>
                      <td class="text-center"><?php
                       if($res["ac_status"] == 1   ){
                         $color = 'red';
                         $ac_status = 'กำลังจะมาถึง';
                      }
                       else if($res["ac_status"] == 2   ){
                        $color = 'green';
                        $ac_status = 'ผ่านไปแล้ว';
                     }
                       else {
                        $color = 'gray';
                        $ac_status = 'ยังไม่กำหนด';
                       }; ?>
                      <label style="color:<?=$color?>"><?=$ac_status?></label> 
                      </td>
                      <td class="text-center"><?php echo $res["created"];?></td>
                      <td class="text-center">
                          <a href="<?=URL?>activity/input_activity.php?id=<?php echo $res["ac_id"];?>" class="btn btn-warning">แก้ไข</a>
                          <a onclick="return confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่')" href="<?=URL?>activity/delete_activity.php?id=<?php echo $res["ac_id"];?>" class="btn btn-danger">ลบ</a>
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