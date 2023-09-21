<?php
session_start();
if(isset($_GET['logout'])){
  session_destroy();
  echo "<script>window.location.href='login.php?sucess=You have logged out successfully';</script>";
}