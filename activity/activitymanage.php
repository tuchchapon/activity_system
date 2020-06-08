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
    $condition .= "a.{$key}='{$value}'";
  }
}

$condition = !empty($condition) ? "WHERE {$condition}" : "";

$sql->table = "activity a LEFT JOIN ac_type at ON a.ac_type_id=at.ac_type_id";
$sql->field = "a.*, at.ac_type_name";
$sql->condition = $condition;
$query = $sql->select();
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
          <a href="<?= URL ?>activity/input_activity.php" class="btn btn-primary text-white float-right">เพิ่มกิจกรรม
          </a>

        </div>
      </div>

      <div class="row mb-2">
        <div class="filter">
          <div class="form-group">
            <label for="ac_type">ประเภทกิจกรรม</label>
            <?php
            $sql->table = "ac_type";
            $sql->field = "*";
            $sql->condition = "";
            $typeQuery = $sql->select();
            ?>
            <select class="form-control" id="ac_type" name="ac_type_id" style="width:170px;">
              <option value="">-- เลือกประเภท --</option>
              <?php
              while ($type = mysqli_fetch_assoc($typeQuery)) {
                $sel = "";
                if (!empty($_GET["ac_type_id"])) {
                  if ($_GET["ac_type_id"] == $type["ac_type_id"]) $sel = 'selected';
                }
              ?>
                <option <?= $sel ?> value="<?= $type["ac_type_id"] ?>"><?= $type["ac_type_name"] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </div>
        <div class="filter">
          <div class="form-group">
            <label for="ac_status">สถานะกิจกรรม</label>
            <?php
            $sType[] = array("id" => 1, "name" => "กำลังจะมาถึง");
            $sType[] = array("id" => 2, "name" => "ผ่านไปแล้ว");
            $sType[] = array("id" => 3, "name" => "ยังไม่กำหนด");
            ?>
            <select class="form-control" id="ac_status" name="ac_status" style="width:170px;">
              <option value="">-- เลือกประเภท --</option>
              <?php
              foreach ($sType as $type) {
                $sel = "";
                if (!empty($_GET["ac_status"])) {
                  if ($_GET["ac_status"] == $type["id"])
                    $sel = 'selected';
                }
              ?>
                <option <?= $sel ?> value="<?= $type["id"] ?>"><?= $type["name"] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </div>
      </div>
      <!-- End Filter -->
    </div>
  </div>


  <section class="content">
    <div class="card p-3">
      <div class="container-fluid">
        <table class="table table-bordered datatable">
          <thead>
            <tr class="text-center table-info">
              <th width="10%">ลำดับ</th>
              <th width="10%">ประเภทกิจกรรม</th>
              <th width="30%">หัวข้อกิจกรรม</th>
              <th width="10%">ปีการศึกษา</th>
              <th width="10%">สถานะกิจกรรม</th>
              <th width="10%">วันที่</th>
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
                <td><?php echo $res["ac_type_name"]; ?></td>
                <td><?php echo $res["ac_title"]; ?></td>
                <td><?php echo $res["year_stu"]; ?></td>
                <td class="text-center"><?php
                                        if ($res["ac_status"] == 1) {
                                          $color = 'red';
                                          $ac_status = 'กำลังจะมาถึง';
                                        } else if ($res["ac_status"] == 2) {
                                          $color = 'green';
                                          $ac_status = 'ผ่านไปแล้ว';
                                        } else {
                                          $color = 'gray';
                                          $ac_status = 'ยังไม่กำหนด';
                                        }; ?>
                  <label style="color:<?= $color ?>"><?= $ac_status ?></label>
                </td>
                <td class="text-center"><?php echo $res["created"]; ?></td>
                <td class="text-center">
                  <a href="<?= URL ?>activity/activity_stu_manage.php?id=<?php echo $res["ac_id"]; ?>" class="btn btn-primary"><i class="fa fa-users"></i></a>
                  <a href="<?= URL ?>activity/activity_images.php?id=<?php echo $res["ac_id"]; ?>" class="btn btn-success"><i class="fa fa-image"></i></a>
                  <a href="<?= URL ?>activity/input_activity.php?id=<?php echo $res["ac_id"]; ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                  <a onclick="return confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่')" href="<?= URL ?>activity/delete_activity.php?id=<?php echo $res["ac_id"]; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
    var ac_type_id = $("[name=ac_type_id]").val();
    var ac_status = $("[name=ac_status]").val();

    var path = '';
    if (ac_type_id != "") {
      path += path == "" ? "?" : "&";
      path += "ac_type_id=" + ac_type_id;
    }
    if (ac_status != "") {
      path += path == "" ? "?" : "&";
      path += "ac_status=" + ac_status;
    }

    if (path == "") {
      window.location.href = "<?= URL ?>activity/activitymanage.php";
    } else {
      window.location.href = "<?= URL ?>activity/activitymanage.php" + path;
    }
  });
</script>