<?php
  session_start();
  session_destroy();
  header("location:customer_login_1.php");
 ?>