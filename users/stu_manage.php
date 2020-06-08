<?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");

$condition = "";
if (!empty($_GET)) {
  foreach ($_GET as $key => $value) {
    $condition .= !empty($condition) ? " AND " : "";
    $condition .= "{$key}='{$value}'";
  }
}

$condition = !empty($condition) ? "WHERE {$condition}" : "";

$sql->table = "student";
$sql->field = "*";
$sql->condition = $condition;
$query = $sql->select();
?>
<!-- Content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">
          <h1 class="m-0 text-dark">จัดการนักศึกษา</h1>
          <div class="row mb-2">
            <div class="filter">
              <div class="form-group">
                <label for="stu_level">เลือกนักศึกษาตามชั้นปี</label>
                <?php
                $sYear[] = array("id" => 1, "name" => "ปี 1 ");
                $sYear[] = array("id" => 2, "name" => "ปี 2 ");
                $sYear[] = array("id" => 3, "name" => "ปี 3");
                $sYear[] = array("id" => 4, "name" => "ปี 4");
                $sYear[] = array("id" => 5, "name" => "ศิษย์เก่า");
                ?>
                <select class="form-control" id="stu_level" name="stu_level">
                  <option value="">-- เลือกชั้นปี --</option>
                  <?php
                  foreach ($sYear as $year) {
                    $sel = "";
                    if (!empty($_GET["stu_level"])) {
                      if ($_GET["stu_level"] == $year["id"])
                        $sel = 'selected';
                    }
                  ?>
                    <option <?= $sel ?> value="<?= $year["id"] ?>"><?= $year["name"] ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <a href="<?= URL ?>users/input_stu.php" class="btn btn-primary text-white float-right">เพิ่มนักศึกษา
          </a>

        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card p-3">
        <table class="table table-bordered datatable">
          <thead>
            <tr class="text-center table-info">
              <th width="10%">ลำดับ</th>
              <th width="20%">รหัสนักศึกษา</th>
              <th width="20%">ชื่อ</th>
              <th width="10%">ชั้นปี</th>
              <th width="20%">สถานะ</th>
              <th width="20%">จัดการ</th>
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
                <td><?php echo $res["stu_code"]; ?></td>
                <td><?php echo $res["stu_name"]; ?></td>
                <td class="text-center"><?php if ($res["stu_level"] <= 4) {
                                          echo $res["stu_level"];
                                        } else echo "ศิษย์เก่า " ?></td>
                <td class="text-center"><?php
                                        if ($res["stu_status"] == 1) {
                                          $color = 'green';
                                          $ac_status = 'กำลังศึกษา';
                                        } else if ($res["stu_status"] == 2) {
                                          $color = 'red';
                                          $ac_status = 'ออกโดยวัดผล';
                                        } else {
                                          $color = 'blue';
                                          $ac_status = 'จบการศึกษาแล้ว';
                                        }; ?>
                  <label style="color:<?= $color ?>"><?= $ac_status ?></label>
                </td>
                <td class="text-center">
                  <a href="<?= URL ?>users/input_stu.php?id=<?php echo $res["stu_id"]; ?>" class="btn btn-warning">แก้ไข</a>
                  <a onclick="return confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่')" href="<?= URL ?>users/delete_stu.php?id=<?php echo $res["stu_id"]; ?>" class="btn btn-danger">ลบ</a>
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
<script>
  $(".filter").change(function() {
    var stu_level = $("[name=stu_level]").val();

    if (stu_level == "") {
      window.location.href = "<?= URL ?>users/stu_manage.php";
    } else {
      window.location.href = "<?= URL ?>users/stu_manage.php?stu_level=" + stu_level;
    }
  });
</script>