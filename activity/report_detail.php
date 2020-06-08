<?php 
// HEADER
include("../layouts/header.php");

if( !empty($_GET["id"]) ){
    $sql->field = "a.*, at.ac_type_name";
    $sql->table = "activity a LEFT JOIN ac_type at ON a.ac_type_id=at.ac_type_id";
    $sql->field="*";
    $sql->condition="WHERE ac_id={$_GET["id"]}";
    $activity = mysqli_fetch_assoc($sql->select());
  }
  else{
    header("location:".URL."activity/activitymanage.php");
}

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
// SET TABLE //
?>
<!-- Content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="clearfix">
						<h4 class="m-0 text-dark float-left">จัดการนักศึกษาในกิจกรรม</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<label class="ml-3 mt-3"><i class="fas fa-snowboarding"></i> ข้อมูลกิจกรรม</label>
				<ul>
					<li><span style="font-weight: bold;">หัวข้อกิจกรรม :</span> <?=$activity["ac_title"]?></li>
					<li><span style="font-weight: bold;">ประเภท :</span> <?=$activity["ac_type_name"]?></li>
				</ul>
            </div>
            <div class="card">
				<form class="form-submit" action="<?=URL?>activity/reload_stu.php" method="POST">

                    </div>
                    <input type="hidden" name="id" value="<?=$activity["ac_id"]?>">
				</form>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="float-right filter">
						<select for="year" class="form-control" name="year">
							<option value="">- เลือกชั้นปี -</option>
							<?php
							$sql->table = "ac_stu_status";
							$sql->field = "year_stu";
							$sql->condition = "WHERE ac_id = {$_GET["id"]} GROUP BY year_stu  ORDER BY year_stu ASC";
							$query = $sql->select();
							while($year = mysqli_fetch_assoc($query)){
								$sel = "";
								if( !empty($_GET["year"]) ) {
									if( $_GET["year"] == $year["year_stu"] ) $sel = 'selected';
								}
								?>
								<option <?=$sel?> value="<?=$year["year_stu"]?>"><?= $year["year_stu"]==5 ? "ศิษย์เก่า" : "ปี ".$year["year_stu"] ?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="card">
				<form class="form-submit" action="<?=URL?>activity/set_status.php" method="POST">
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr class="table-primary text-center">
									<th width="10%">ลำดับ</th>
									<th width="20%">รหัสนักศึกษา</th>
									<th width="40%">ชื่อ-นามสกุล</th>
									<th width="10%">ชั้นปี</th>
									<th width="20%">การเข้าร่วม</th>

									
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								$condition = '';
								if( !empty($_GET["year"]) ) $condition = " AND year_stu='{$_GET["year"]}'";
								$sql->table = "ac_stu_status ast LEFT JOIN student s ON ast.stu_id=s.stu_id";
								$sql->field = "ast.*, s.stu_code, s.stu_name";
								$sql->condition = "WHERE ac_id={$_GET["id"]}".$condition;
								$query = $sql->select();
								while($result = mysqli_fetch_assoc($query)){
								?>
								<tr>
									<td class="text-center"><?=$no?></td>
									<td class="text-center"><?=$result["stu_code"]?></td>
									<td><?=$result["stu_name"]?></td>
									<td class="text-center"><?= $result["year_stu"] == 5 ? "ศิษย์เก่า" : "ปี ".$result["year_stu"] ?></td>
									<td class="text-center">                                   
                  
                                            <?php 
                                            if($result["status"] == 0){
                                                echo '<a class="btn btn-sm">รอผล</a>';
                                            }
                                            if($result["status"] == 1){
                                                echo '<a class="btn btn-success btn-sm text-white">เข้าร่วม</a>';
                                            } 
                                            if($result["status"] == 2){
                                                echo '<a class="btn btn-danger btn-sm text-white">ไม่เข้าร่วม</a>';
                                            }
                                            ?>
                
                                    </td>

								
								</tr>
								<?php $no++; } ?>
							</tbody>
						</table>
					</div>
					<div class="card-footer">
					
						<div class="clearfix">
						<a href="<?=URL?>/activity/activity_report.php" class="btn btn-success">ย้อนกลับ</a>

						</div>
						
					</div>
					<input type="hidden" name="ac_id" value="<?=$activity["ac_id"]?>">
				</form>
			</div>
		</div>
	</section>
</div>
<!-- End Content -->
<?php
//FOOTER
include("../layouts/footer.php");
?>
<script>
$(".filter").change(function(){
  var year = $("[name=year]").val();

  if( year == "" ){
    window.location.href = "<?=URL?>activity/report_detail.php?id=<?=$_GET["id"]?>";
  }
  else{
    window.location.href = "<?=URL?>activity/report_detail.php?id=<?=$_GET["id"]?>&year=" + year;
  }
});
</script>