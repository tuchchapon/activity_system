<?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");


$sql->table = "activity a LEFT JOIN ac_type at ON a.ac_type_id=at.ac_type_id";
$sql->field = "a.*, at.ac_type_name";
$sql->condition = "WHERE ac_status =3 ";
$query = $sql->select();
// $sql->table = "ac_stu_status";
// $sql->field = "*";
// $sql->condition = "";
// $check_st = $sql->select();

?>
<!-- Content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">รายงานผลกิจกรรม</h1>
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
                            <th width="5%">ลำดับ</th>
                            <th width="10%">ประเภทกิจกรรม</th>
                            <th width="30%">หัวข้อกิจกรรม</th>  
                            <th width="20%">เวลา</th>  
                            <th width="10%">เข้าร่วม/ทั้งหมด</th>
                            <th width="10%">วันที่</th>
                            <th width="15%">รายงาน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $count1=0;
                        // $count2 = 0;
                        $num = 0;
                        // while($res2 = mysqli_fetch_assoc($check_st)){
                        //     if($res2["status"]==1 OR $res2["status"]==0){
                        //         $count1++;
                        //         printf("if แรก");
                            
                        //     }
                        //      if($res2["status"]==2){
                        //         $count2++;
                        //         printf("if สอง");
                        //     }
                            
                        // };
                        // $ac_status = "";

                        while ($res = mysqli_fetch_assoc($query)) {
                            $num++;

                        ?>
                            <tr>
                                <td class="text-center"><?php echo $num; ?></td>
                                <td class="text-center"><?php echo $res["ac_type_name"]; ?></td>
                                <td class="text-center"><?php echo $res["ac_title"]; ?></td>
                                <td class="text-center"><?php echo $res["ac_start_time"].'-'.$res["ac_end_time"]; ?></td>
                                <td class="text-center">
                                    <?php 
                                    $sql->table = "ac_stu_status";
                                    $sql->field = "stu_id";
                                    $sql->condition = "WHERE ac_id=".$res["ac_id"]." AND status=1";
                                    echo $sql->countRow();
                                    ?>
                                    /
                                    <?php 
                                    $sql->table = "ac_stu_status";
                                    $sql->field = "stu_id";
                                    $sql->condition = "WHERE ac_id=".$res["ac_id"]."";
                                    echo $sql->countRow();
                                    ?>
                                </td>
                                <td class="text-center"><?php echo $res["created"]; ?></td>
                                <td class="text-center">
                                    <a class="btn btn-primary" href="<?= URL ?>activity/report_detail.php?id=<?php echo $res["ac_id"]; ?>" style="color:white;">รายชื่อนักศึกษา</a> 
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