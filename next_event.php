<?php include("header.php"); ?>

<?php


$sql->table = "activity a LEFT JOIN ac_type ac ON a.ac_type_id=ac.ac_type_id";
$sql->condition = "WHERE ac_status=1";
$query = $sql->select();
?>
<main id="main">
    <div class="container">
        <div class="m-2">
            <h4>กิจกรรมที่กำลังมาถึง : <?= !empty($type["ac_type_name"]) ? : "ทั้งหมด" ?></h4>
        </div>

        <div class="clearfix">
            <div class="card p-2 mb-2">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr class="text-center table-info">
                            <th width="5%">ลำดับ</th>
                            <th width="10%">ประเภท</th>
                            <th width="30%">หัวข้อกิจกรรม</th>
                        
                            <th  width="10%" style="text-emphasis-position: center;" >เวลา</th>
                            <th width="20%">วันที่จัด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $num = 0;
                        $ac_status = "";
                        while ($res = mysqli_fetch_assoc($query)) {
                            $num++;
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $num; ?></td>
                                <td><?php echo $res["ac_type_name"]; ?></td>
                                <td><a href="<?=URL?>show_event.php?id=<?=$res["ac_id"]?>"><?php echo $res["ac_title"]; ?></a></td>
                                
                                <td class="text-center">
                                    <?=date("H:i",strtotime($res["ac_start_time"]))?>
                                    <?php
                                    if( $res["ac_start_time"] != $res["ac_end_time"] ){
                                        echo " - ".date("H:i",strtotime($res["ac_end_time"]));
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?=dateTH($res["ac_start"])?>
                                    <?php
                                    if( $res["ac_start"] != $res["ac_end"] ){
                                        echo " - ".dateTH($res["ac_end"]);
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>