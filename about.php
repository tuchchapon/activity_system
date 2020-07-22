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
.fc-view-month .fc-event, .fc-view-agendaWeek .fc-event {
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
          <a href="https://docs.google.com/forms/d/e/1FAIpQLSccEUZ5jUFaL2f_ivw_bFZSLaoZnwoxz3Gbgaw8Ssmf8HTPtQ/viewform?fbclid=IwAR3Wiu07J0IDCYFlCQ44SiHTunjWd60rY8V2F5vfwA-9YTKy4lxZ6X_MGBU">แบบสำรวจ  </a>
        </div>
        <div class="col-md-9">
          <h3><center>ข้อมูลสาขา</center></h3>
          <?php
          $sql->table = "web_info";
          $query = $sql->select();
          $info = mysqli_fetch_assoc($query);

          echo $info['detail'];
          ?>
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