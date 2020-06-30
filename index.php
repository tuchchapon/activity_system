<?php include("header.php"); ?>
<link href='packages/core/main.css' rel='stylesheet' />
<link href='packages/daygrid/main.css' rel='stylesheet' />
<link href='packages/bootstrap/main.css' rel='stylesheet' />
<style>
.mySlides {display:none;}
</style>
<body>
  
<div class="container">
<div class="w3-content w3-section">
  <img class="mySlides" src="img/software1.jpg" style="width:100%">
  <img class="mySlides" src="img/software2.jpg" style="width:100%">
  <img class="mySlides" src="img/software3.jpg" style="width:100%">
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
  if (slideIndex > x.length) {slideIndex = 1} 
  x[slideIndex-1].style.display = "block"; 
  setTimeout(carousel, 2000); 
}
</script>


</body>
<?php include("footer.php"); ?>
