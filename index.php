<?php include("header.php"); ?>
<link href='packages/core/main.css' rel='stylesheet' />
<link href='packages/daygrid/main.css' rel='stylesheet' />
<link href='packages/bootstrap/main.css' rel='stylesheet' />
<style>
  .mySlides {
    display: none;
  }

  #calendar {
    width: 100%;
    margin: 0 auto;
    font-size: 10px;
  }

  .fc-header-title h2 {
    font-size: .9em;
    white-space: normal !important;
  }

  .fc-view-month .fc-event,
  .fc-view-agendaWeek .fc-event {
    font-size: 0;
    overflow: hidden;
    height: 2px;
  }

  .fc-view-agendaWeek .fc-event-vert {
    font-size: 0;
    overflow: hidden;
    width: 2px !important;
  }

  .fc-agenda-axis {
    width: 20px !important;
    font-size: .7em;
  }

  .fc-button-content {
    padding: 0;
  }
</style>

<body>
  <?php
  $sql->table = "activity a LEFT JOIN ac_type ac ON a.ac_type_id=ac.ac_type_id";
   $sql->condition = " WHERE ac_status = 1 ORDER BY ac_start ASC limit 3 ";
  $query = $sql->select();
  ?>
  <div class="container mt-3">
    <div class="w3-content w3-section">
      <img class="mySlides" src="img/software1.jpg" style="width:100%; height:400px;">
      <img class="mySlides" src="img/software2.jpg" style="width:100%; height:400px;">
      <img class="mySlides" src="img/software3.jpg" style="width:100%; height:400px;">
    </div>

    <div class="clearfix mt-2 mb-2">
      <div class="row">
        <div class="col-md-3">
          <div id="calendar"></div>
        </div>
        <div class="col-md-9">
          <h3>
            <center>กิจกรรมที่กำลังจะมาถึง</center>
          </h3>

          <main id="main">
            <div class="container">
              <div class="m-2">
              </div>
              <div class="clearfix">
                <div class="card p-2 mb-2">
                  <table class="table table-bordered ">
                    <thead>
                      <tr class="text-center table-info">
                        <th width="5%">ลำดับ</th>
                        <th width="10%">ประเภท</th>
                        <th width="30%">หัวข้อกิจกรรม</th>
                        <th width="20%">สถานะ</th>
                        <th width="25%">วันที่จัด</th>
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
                          <td><a href="<?= URL ?>show_event.php?id=<?= $res["ac_id"] ?>"><?php echo $res["ac_title"]; ?></a></td>
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
                            <?= dateTH($res["ac_start"]) ?>
                            <?php
                            if ($res["ac_start"] != $res["ac_end"]) {
                              echo " - " . dateTH($res["ac_end"]);
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
        </div>
      </div>
    </div>
  </div>

  <script>
    var slideIndex = 0;
    carousel();

    function carousel() {
      var i;
      var x = document.getElementsByClassName("mySlides");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > x.length) {
        slideIndex = 1
      }
      x[slideIndex - 1].style.display = "block";
      setTimeout(carousel, 2000);
    }
  </script>

</body>
<?php include("footer.php"); ?>
<script src='packages/core/main.js'></script>
<script src='packages/daygrid/main.js'></script>
<script src='packages/bootstrap/main.js'></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      timeZone: 'local',
      plugins: ['dayGrid'],
      locale: 'th',
      events: 'calendar.php',
      header: {
        left: 'today',
        center: 'title',
        right: 'prev,next'
      },
      buttonText: {
        today: 'วันนี้',
        month: 'เดือน',
        week: 'สัปดาห์',
        day: 'วัน',
        list: 'รายการ'
      }
    });
    calendar.render();
  });
</script>