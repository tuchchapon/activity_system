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


<?php
$sql->table = "activity a LEFT JOIN ac_type ac ON a.ac_type_id=ac.ac_type_id";
$sql->condition = " WHERE ac_status = 1 ORDER BY ac_start ASC limit 2 ";
$query = $sql->select();
?>
<div class="container mt-3">
  <div class="w3-content w3-section">
    <img class="mySlides" src="img/software1.jpg" style="width:100%; height:400px;border-radius: 25px;">
    <img class="mySlides" src="img/software2.jpg" style="width:100%; height:400px;border-radius: 25px;">
    <img class="mySlides" src="img/software3.jpg" style="width:100%; height:400px;border-radius: 25px;">

  </div>


  <div class="clearfix mt-2 mb-2" style="margin-bottom: 100px;">
    <div class="row">

      <div class="col-md-3">
        <div class="card" style="margin-top: 18px;">
          <div id="calendar"></div>
        </div>
      </div>
      <div class="col-md-9">


        <main id="main">
          <div class="container" style="margin-bottom: 100px;">

            <div class="m-2">

              <div class="clearfix">


                <div class="row no-gutter">
                  <!-- row -->


                  <div class="col-lg-9 col-md-9 col-xs-12">
                    <!-- upcoming events wrapper -->

                    <div class="col-padded" style="margin-bottom: 25px;">
                      <!-- inner custom column -->

                      <ul class="list-unstyled clear-margins thai-font">
                        <!-- widgets -->
                        <li class="widget-container widget_recent_news">
                          <!-- widgets list -->

                          <h1 class="title-widget">กิจกรรมที่กำลังมาถึง</h1>

                          <?php
                          $num = 0;
                          $ac_status = "";
                          while ($res = mysqli_fetch_assoc($query)) {
                            $num++;
                          ?>
                            <div class="tab-content">
                              <!-- starts tab containers -->

                              <div id="news-tab-02" class="tab-pane fade  active  in">
                                <!-- tab 1 starts -->

                                <p>
                                  <ul class="list-unstyled">
                                    <li class="recent-news-wrap">
                                      <div class="recent-news-content clearfix">

                                        <div class="recent-news-text">
                                          <h1 class="title-median"><a href="#" title="ทดสอบ">[<strong><?php echo $res["ac_type_name"] ?></strong>] <?php echo $res["ac_title"] ?></a></h1>
                                          <div class="recent-news-meta">
                                            <div class="recent-news-date"><?= dateTH($res["ac_start"]) ?> <?php if ($res["ac_start"] != $res["ac_end"]) {
                                                                                                            echo " ถึง " . dateTH($res["ac_end"]);
                                                                                                          } ?>
                                              เวลา <?= date("H:i",strtotime($res["ac_start_time"])) ?> <?php if ($res["ac_start_time"] != $res["ac_end_time"]) {
                                                                                                            echo " - " . date("H:i",strtotime($res["ac_end_time"]));
                                                                                                          } ?>
                                            </div>

                                          </div>
                                          <a href="#" class="moretag" title="read more">อ่านรายละเอียด</a>
                                </p>
                              </div>

                            </div>
                          <?php } ?>


                          <!-- ------------------TAB----------------  -->



                          <div class="tab-content">
                            <!-- starts tab containers -->


                        </li>


                        <p>
                          <a href="#" class="btn btn-danger btn-sm pull-right" title="Button">ดูเพิ่มเติม</a>
                        </p>
                      </ul>
                      </p>
                    </div><!-- tab 1 ends -->

                  </div><!-- upcoming events wrapper end -->

                </div><!-- row end -->

              </div><!-- container end -->

            </div><!-- content wrapper end -->

          </div>


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