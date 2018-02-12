<?php
  session_start();
  unset($_SESSION['userData']);
  header("Location: ../");
  exit();
?>
