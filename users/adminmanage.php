<?php 
// HEADER
include("../layouts/header.php");

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
?>
<!-- Content -->
<div class="content-wrapper">
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">จัดการข่าวสาร</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
          <table class="table table-bordered">
              <thead>
                  <tr class="text-center table-info">
                      <th width="10%">#</th>
                      <th width="50%">หัวข้อข่าวสาร</th>
                      <th width="20%">แก้ไขล่าสุด</th>
                      <th width="20%">จัดการ</th>
                  </tr>
              </thead> 
              <tbody>
                  <tr>
                      <td class="text-center">1</td>
                      <td>ทดสอบข่าวสาร</td>
                      <td class="text-center">01-2563 เวลา 23.59.59</td>
                      <td class="text-center">
                          <a href="" class="btn btn-warning">แก้ไข</a>
                          <a href="" class="btn btn-danger">ลบ</a>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
  </section>
</div>
<!-- End Content -->
<?php
//FOOTER
include("../layouts/footer.php");
?>