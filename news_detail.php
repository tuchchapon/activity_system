<?php include("header.php"); ?>

<?php
if (empty($_GET["id"])) {
    header("location:" . URL . "show_news.php");
} else {
    $sql->field = "n.*, nt.news_type_name";
    $sql->table = "news n LEFT JOIN news_type nt ON n.news_type_id=nt.news_type_id";
    $sql->field = "*";
    $sql->condition = "WHERE news_id={$_GET["id"]}";
    $query = $sql->select();
    if (mysqli_num_rows($query) <= 0) {
        header("location:" . URL . "show_news.php");
    }
    $result = mysqli_fetch_assoc($query);
}
?>
<main id="main">
    <div class="container">
        <div class="card mt-2 mb-2">
            <div class="card-header bg-primary text-white">
                <h5><i class="fas fa-snowboarding"></i> ข้อมูลข่าว</h5>
            </div>
            <div class="card-body">
                <ul>
                    <li><span style="font-weight: bold;">หัวข้อข่าว :</span> <?= $result["news_title"] ?></li>
                    <li><span style="font-weight: bold;">ประเภท :</span> <?= $result["news_type_name"] ?></li>
                    <li><span style="font-weight: bold;">วันที่จัด :</span> <?= dateTH($result["news_create"]) ?> <b>ถึง</b> <?= dateTH($result["news_update"]) ?></li>
                </ul>
                <div class="clearfix">
                    <b class="ml-2">รายละเอียดข่าว</b>
                    <div class="pl-2 pr-2">
                        <?= nl2br($result["news_detail"]) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $sql->table = "news_pic";
        $sql->condition = "WHERE news_id={$_GET["id"]}";
        $query = $sql->select();
        $num = mysqli_num_rows($query);
        if ($num > 0) { ?>
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-image"></i> รูปภาพข่าว</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php
                        while ($row = mysqli_fetch_assoc($query)) {

                        ?>
                            <div class="col-md-3">
                                <div class="card m-1 p-2">
                                    <img src="<?= URL ?>img/<?= $row["news_pic_file"]; ?>" style="width:100%;">
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