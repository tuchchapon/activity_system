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
    if (mysqli_num_rows($query) <= 0) {
        header("location:" . URL . "event_calendar.php");
    }
    $result = mysqli_fetch_assoc($query);
}
?>
<main id="main">
    <div class="container">
        <div class="card mt-2 mb-2">
            <div class="card-header bg-primary text-white">
                <h5><i class="fas fa-snowboarding"></i> ข้อมูลกิจกรรม</h5>
            </div>
            <div class="card-body">
                <ul>
                    <li><span style="font-weight: bold;">หัวข้อกิจกรรม :</span> <?= $result["ac_title"] ?></li>
                    <li><span style="font-weight: bold;">ประเภท :</span> <?= $result["ac_type_name"] ?></li>
                    <li><span style="font-weight: bold;">วันที่จัด :</span> <?= dateTH($result["ac_start"]) ?> <b>ถึง</b> <?= dateTH($result["ac_end"]) ?></li>
                    <li><span style="font-weight: bold;">ปีการศึกษา :</span> <?= $result["year_stu"] ?></li>
                </ul>
                <div class="clearfix">
                    <b class="ml-2">รายละเอียดกิจกรรม</b>
                    <div class="pl-2 pr-2">
                        <?= nl2br($result["ac_detail"]) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $sql->table = "activity_pic";
        $sql->condition = "WHERE ac_id={$_GET["id"]}";
        $query = $sql->select();
        $num = mysqli_num_rows($query);
        if ($num > 0) { ?>
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-image"></i> รูปภาพกิจกรรม</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php
                        while ($row = mysqli_fetch_assoc($query)) {

                        ?>
                            <div class="col-md-3">
                                <div class="card m-1 p-2">
                                    <img src="<?= URL ?>img/<?= $row["pic_file"]; ?>" style="width:100%;">
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</main>
<?php include("footer.php"); ?>