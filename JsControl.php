<?php
// ============================= JAVASCRIPT CONTROL ================================ //

if (isset ( $alert )) echo "<script type='text/javascript'>alert('$alert');</script>";
if (isset ( $reload )) echo "<script type='text/javascript'>window.location.reload();</script>";
if (isset ( $location )) echo "<script type='text/javascript'>window.location = '$location';</script>";
if (isset ( $localSetTimeout)) echo "<script type='text/javascript'>setTimeout(function(){location.href='$localSetTimeout'},3000);</script>";
if (isset ( $close )) echo "<script type='text/javascript'>window.close();</script>";
	
// =========================== END JAVASCRIPT CONTROL ============================== //
?>