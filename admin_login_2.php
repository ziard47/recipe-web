<?php
  //start the session facility
  session_start();
  //connect to database server
  require("db_connection.php");


  /*echo "<pre>";
  print_r($_REQUEST);
  echo "</pre>";*/

  //lets capture values to variables

  $userId     = $_REQUEST['userId'];
  $password = $_REQUEST['password'];

  //lets build the dynamic sql command

  $sql = "select * from admin_log where userId='$userId'";

  //execute the sql command

  $rs = $mysqli->query($sql);

  if(mysqli_num_rows($rs)>0){
    //echo "user id found in db";
    //since the user id found lets check the passwords too
    $row = mysqli_fetch_assoc($rs);

    if($row['password'] == crypt($password,$row['password'])){
      //echo "username and password both are matching...";
      //lets redirect the user to dashboard.php file
      $_SESSION['userId']    = $userId;
      header("location:pages/admin-panel/dashboard.php");
    }
    else{
      //echo "user id is OK but password not matched";
      header("location:invalid_login.php");
    }

  }
  else{
    //echo "user id not found ";
    header("location:invalid_login.php");
  }

 ?>
