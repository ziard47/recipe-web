<?php
  //main database connection code
  $server   = "localhost";
  $username = "root";
  $password = "";
  $db_name  = "db_recipe";

  $mysqli = new mysqli($server,$username,$password,$db_name);

  if($mysqli->connect_error){
    echo $mysqli->errorno . "<br />";
    echo $mysqli->error . "<br />";
    die("connection failed");
  }
  //echo "connection successfull";

 ?>