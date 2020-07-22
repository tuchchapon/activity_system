<?php
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
$sql->table = "user";
$sql->field = "*";
$query = $sql->select();
?>
<!-- Content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">จัดการผู้ดูแลระบบ</h1>
        </div>
        <div class="col-sm-6">
          <a href="<?= URL ?>users/input_admin.php" class="btn btn-primary text-white float-right">เพิ่มผู้ดูแลระบบ
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
              <th width="30%">username</th>
              <th width="30%">ชื่อ</th>
              <th width="30%">จัดการ</th>
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
                <td><?php echo $res["username"]; ?></td>
                <td><?php echo $res["Name"]; ?></td>
                <td class="text-center">
                  <a href="<?= URL ?>users/input_admin.php?id=<?php echo $res["user_id"]; ?>" class="btn btn-warning">แก้ไข</a>
                  <a onclick="return confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่')" href="<?= URL ?>users/delete_admin.php?id=<?php echo $res["user_id"]; ?>" class="btn btn-danger">ลบ</a>
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