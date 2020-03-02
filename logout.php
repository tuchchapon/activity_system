<?php 
include("config.php");
session_destroy();

header("location:".URL."index.php");