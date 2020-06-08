  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.2
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>

  <!-- jQuery -->
  <script src="<?= PLUGINS ?>jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= PLUGINS ?>jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= PLUGINS ?>bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= PLUGINS ?>chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= PLUGINS ?>sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= PLUGINS ?>jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= PLUGINS ?>jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= PLUGINS ?>jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= PLUGINS ?>moment/moment.min.js"></script>
  <script src="<?= PLUGINS ?>daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= PLUGINS ?>tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= PLUGINS ?>summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= PLUGINS ?>overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= JS ?>adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= JS ?>pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= JS ?>demo.js"></script>

  <script type="https://raw.github.com/jhollingworth/bootstrap-wysihtml5/master/src/bootstrap-wysihtml5.js"></script>

  <!-- DataTable -->
  <script src="<?= PLUGINS ?>datatables/jquery.dataTables.js"></script>
  <script src="<?= PLUGINS ?>datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script>
    $('.datatable').DataTable({
      "oLanguage": {
        "sEmptyTable": "ไม่มีข้อมูลในตาราง",
        "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
        "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
        "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
        "sInfoPostFix": "",
        "sInfoThousands": ",",
        "sLengthMenu": "แสดง _MENU_ แถว",
        "sLoadingRecords": "กำลังโหลดข้อมูล...",
        "sProcessing": "กำลังดำเนินการ...",
        "sSearch": "ค้นหา: ",
        "sZeroRecords": "ไม่พบข้อมูล",
        "oPaginate": {
          "sFirst": "หน้าแรก",
          "sPrevious": "ก่อนหน้า",
          "sNext": "ถัดไป",
          "sLast": "หน้าสุดท้าย"
        },
        "oAria": {
          "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
          "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
        }
      }
    });
    $(".textarea").wysihtml5();
  </script>
  <?php
  // CONTROLLER //
  if (isset($alert)) echo '<script>alert("' . $alert . '")</script>';
  if (isset($location)) echo '<script>window.location="' . $location . '"</script>';
  ?>
  </body>

  </html>