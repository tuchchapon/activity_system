<?php include("header.php"); ?>

<?php
$condition = "";
if (!empty($_GET["type"])) {
    $sql->table = "ac_type";
    $sql->condition = "WHERE ac_type_id={$_GET["type"]}";
    $query = $sql->select();
    if (mysqli_num_rows($query) <= 0) {
        header("location:" . URL . "event_calendar.php");
    }
    $type = mysqli_fetch_assoc($query);

    $condition = "WHERE a.ac_type_id={$_GET["type"]}";
}

$sql->table = "activity a LEFT JOIN ac_type ac ON a.ac_type_id=ac.ac_type_id";
$sql->condition = $condition." ORDER BY year_stu DESC";
$query = $sql->select();
?>
<main id="main">
    <div class="container">
        <div class="m-2">
            <h4>ประเภทกิจกรรม : <?= !empty($type["ac_type_name"]) ? $type["ac_type_name"] : "ทั้งหมด" ?></h4>
        </div>

        <div class="clearfix">
            <div class="card p-2 mb-2">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr class="text-center table-info">
                            <th width="5%">ลำดับ</th>
                            <th width="10%">ประเภท</th>
                            <th width="30%">หัวข้อกิจกรรม</th>
                            <th width="15%">ปีการศึกษา</th>
                            <th width="10%">สถานะ</th>
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
                                <td class="text-center"><?php echo $res["year_stu"]; ?></td>
                                <td class="text-center"><?php
                                                       if ($res["ac_status"] == 1) {
                                                        $color = 'red';
                                                        $ac_status = 'กำลังจะมาถึง';
                                                      } else if ($res["ac_status"] == 2) {
                                                        $color = 'blue';
                                                        $ac_status = 'กำลังดำเนินการ';
                                                      } else if ($res["ac_status"] == 3) {
                                                        $color = 'green';
                                                        $ac_status = 'ผ่านไปแล้ว';
                                                      } else {
                                                        $color = 'gray';
                                                        $ac_status = 'ยังไม่กำหนด';
                                                      }; ?>
                                    <label style="color:<?= $color ?>"><?= $ac_status ?></label>
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