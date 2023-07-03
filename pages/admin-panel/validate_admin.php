<?php
  session_start();
  //lets validate the user
  if($_SESSION['userId'] == ''){
    //redirect the user to invalid login page
    header("location:../../invalid_login.php");
    //echo "invalid login";
  }
 ?>
