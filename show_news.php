<?php include("header.php"); ?>


<?php
$condition = "";
if (!empty($_GET["type"])) {
    $sql->table = "news_type";
    $sql->condition = "WHERE news_type_id={$_GET["type"]}";
    $query = $sql->select();
    if (mysqli_num_rows($query) <= 0) {
        header("location:" . URL . "show_news.php");
    }
    $type = mysqli_fetch_assoc($query);

    $condition = "WHERE n.news_type_id={$_GET["type"]}";
}

$sql->table = "news n LEFT JOIN news_type nt ON n.news_type_id=nt.news_type_id";
$sql->condition = $condition." ORDER BY news_update DESC";
$query = $sql->select();
?>
<main id="main">
    <div class="container">
        <div class="m-2">
            <h4>ประเภทข่าวสาร : <?= !empty($type["news_type_name"]) ? $type["news_type_name"] : "ทั้งหมด" ?></h4>
        </div>

        <div class="clearfix">
            <div class="card p-2 mb-2">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr class="text-center table-info">
                            <th width="5%">ลำดับ</th>
                            <th width="20%">ประเภทข่าว</th>
                            <th width="50%">หัวข้อข่าว</th>
                            <th width="25%">วันที่เพิ่ม</th>
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
                                <td><?php echo $res["news_type_name"]; ?></td>
                                <td><a href="<?=URL?>news_detail.php?id=<?=$res["news_id"]?>"><?php echo $res["news_title"]; ?></a></td>
                                <td class="text-center"><?php echo $res["news_create"]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>