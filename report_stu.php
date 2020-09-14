<?php include("header.php"); ?>

<?php
if (empty($_GET["id"])) {
    header("location:" . URL . "event_calendar.php");
} else {
    $sql->field = "a.*, at.ac_type_name";
    $sql->table = "activity a LEFT JOIN ac_type at ON a.ac_type_id=at.ac_type_id";
    $sql->field = "*";
    $sql->condition = "WHERE ac_id={$_GET["id"]}";

    $query = $sql->select();
    $sql->table = "ac_stu_status";
    $sql->field = "*";
    $sql->condition = "WHERE ac_id={$_GET["id"]} GROUP BY year_stu ORDER BY year_stu ASC";
    $query2=$sql->select();
    if (mysqli_num_rows($query) <= 0) {
        header("location:" . URL . "event_calendar.php");
    }
    $result = mysqli_fetch_assoc($query);
}
?>
<main id="main">
    <div class="container">
        <div class="card mt-2 mb-2">
            <div class="card-header  text-white" style="background-color: #f03c02 ;">
                <h5><i class="fas fa-snowboarding"></i> ข้อมูลกิจกรรม</h5>
            </div>
            <div class="card-body">
                <ul>
                    <li><span style="font-weight: bold;">หัวข้อกิจกรรม :</span> <?= $result["ac_title"] ?></li>
                    <li><span style="font-weight: bold;">สถานที่จัดกิจกรรม :</span> <?= $result["ac_location"] ?></li>
                    <li><span style="font-weight: bold;">ประเภท :</span> <?= $result["ac_type_name"] ?></li>
                    <li><span style="font-weight: bold;">วันที่จัด :</span> <?= dateTH($result["ac_start"]) ?> <b>ถึง</b> <?= dateTH($result["ac_end"]) ?></li>
                    <li><span style="font-weight: bold;">เวลา :</span> <?=  date("H:i",strtotime($result["ac_start_time"])) ?> <b>-</b> <?= date("H:i",strtotime($result["ac_end_time"])) ?></li>
                    <li><span style="font-weight: bold;">นักศึกษาที่ต้องเข้าร่วม : </span><?php
                    $eYear = '';
                    if( mysqli_num_rows(($query2)) > 0  ){
                        while($result2 = mysqli_fetch_assoc($query2)){
                       
                            $eYear .= !empty($eYear) ? " , " : "";
                           
                            if( $result2["year_stu"] < 5 ){
                               $eYear .= "ปี".$result2["year_stu"];
                            }
                            else {
                               $eYear .= " ศิษย์เก่า ";
                            }
                       }
                    }
                    else{
                        $eYear = 'ผู้ที่สนใจ';
                    }
                    
                    echo $eYear;
                    ?></li>
                </ul>
            </div>
        </div>
        <div class="card mt-2 mb-2">
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
                <div class="card-header">
                    <h5><i class="fas fa-list"></i> รายการเข้าร่วม</h5>
                </div>
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
								$sql->condition = "WHERE ac_id={$_GET["id"]} {$condition} ORDER BY year_stu ASC , stu_code ASC ";
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
                                                echo '<a class="btn btn-sm text-white" style="background-color:red">ไม่เข้าร่วม</a>';
                                            }
                                            ?>
                
                                    </td>

								
								</tr>
								<?php $no++; } ?>
							</tbody>
						</table>
					</div>
            </div>
    </div>
</main>
<?php include("footer.php"); ?>
<script>
$(".filter").change(function(){
  var year = $("[name=year]").val();

  if( year == "" ){
    window.location.href = "<?=URL?>report_stu.php?id=<?=$_GET["id"]?>";
  }
  else{
    window.location.href = "<?=URL?>report_stu.php?id=<?=$_GET["id"]?>&year=" + year;
  }
});
</script>