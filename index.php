<?php include("header.php"); ?>
<link href='packages/core/main.css' rel='stylesheet' />
<link href='packages/daygrid/main.css' rel='stylesheet' />
<link href='packages/bootstrap/main.css' rel='stylesheet' />
<main id="main">
  <div class="container">
    <div id="calendar" class="m-4"></div>
  </div>
</main>

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