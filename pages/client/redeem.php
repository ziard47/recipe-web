<?php
	require("../../db_connection.php");
	require("../../code_lib.inc.php");
  	require("validate_customer.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Recipe</title>
	<link href="https://fonts.googleapis.com/css?family=Gotu&display=swap" rel="stylesheet">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">
	
	 <link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css" />
	 <link href="../../css/ken-burns.css" rel="stylesheet" type="text/css" media="all" />
    <script src="../../js/jquery-2.1.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
  </head>
<body>
<section id="header_top">
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <div class="header_top_1">
          <ul>
		  	<li><a href="../../customer_login_1.php">Login</a></li>
            <li><a href="../../customer_signup_1.php">Sign Up</a></li>
            <li><a href="../admin-panel/dashboard.php">Admin</a></li>
			<li><a href="../../logout_cus.php">Log Out</a></li>
          </ul>
        </div>
      </div>
      <div class="col-sm-5">
        <div class="header_top_2">
          <ul>
            <li class="dropdown">
              <ul class="dropdown-menu drop_1">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="header_top_3">
          <form action="/websites/recipe-web/pages/client/search.php" method="GET" class="input-group">
            <input type="text" class="form-control" name="search_name" placeholder="Keywords">
            <span class="input-group-btn">
              <button class="btn btn-primary" type="submit">SEARCH</button>
            </span>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="header">
	<nav class="navbar">
		   <div class="container">
			   <!-- Brand and toggle get grouped for better mobile display -->
			 <div class="navbar-header page-scroll">
				   <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					   <span class="sr-only">Toggle navigation</span>
					   <span class="icon-bar"></span>
					   <span class="icon-bar"></span>
					   <span class="icon-bar"></span>
				   </button>
			   <!-- <a class="navbar-brand" href="index.html">FOOD RECIPE</a>            </div> -->
   
			   <!-- Collect the nav links, forms, and other content for toggling -->
			   <div class="navbar-wrapper">
				   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					   <ul class="nav navbar-nav">
						 <li ><a href="../../index.php">Home</a></li>
						 <li><a href="recipe.php">Recipe</a></li>
						 <li><a href="customer_account.php">Account</a></li>
						<li ><a href="about.php">About</a></li>
						<li class="active_1 clearfix"><a href="redeem.php">Redeem</a></li>
				  </ul>
				 </div>
			   </div>
			   
			   <!-- /.navbar-collapse -->
		   </div>
		   <!-- /.container-fluid -->
	   </nav>
</section>
<section id="about">
 <div class="container">
  <div class="row">
   <div class="col-sm-12">
    <div class="about_1">
	   <ul>
	       <li><a href="#"><i class="fa fa-home"></i></a></li>
		   <li><span class="panel_1">Redeem Points</span></li>
	   </ul>
	</div>
   </div>
   <div class="col-sm-12">
    <div class="about_2">
	  <h3 class="text-center">Total Points</h3>
		<div class="container">
			<div class="row" style="display: flex; justify-content: center;">
				<div class="col-md-3">
					<div class="card-counter danger">
						<i class="fa fa-ticket"></i>
						<?php
						if (isset($_SESSION['email'])) {
							$email = $_SESSION['email'];

							$sql = "SELECT * FROM cus_log WHERE email = '$email'";
							$result = $mysqli->query($sql);

							if ($result && mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
						?>
						<span class="count-numbers"><?php echo $row['points']; ?> pts</span>
						<?php
							}
							} else {
							echo "No customer details found.";
							}
						} else {
							echo "User not logged in.";
						}
						?>
						<span class="count-name">Total Points</span>
					</div>
				</div>
			</div>
		</div>
	
	  <p class="text-center"></p>
		

	</div>

	<div class="about_2">
		<h3 class="text-center">Redeem Coupens</h3>
		<section id="recipe">
			<div class="container">
				<div class="row">
					<div class="recipe_2 clearfix">
					<?php
					require("../../db_connection.php");

					// Retrieve the recipe data from the database
					$query = "SELECT * FROM coupons";
					$result = $mysqli->query($query);

					if ($result && $result->num_rows > 0) {
					// Loop through each recipe record
					while ($row = $result->fetch_assoc()) {
						$coupon_id = $row['coupon_id'];
						$title = $row['title'];
						$description = $row['description'];
						$price = $row['price'];
					
						// Generate the HTML code for each ingredient
						$html = <<<HTML
						<div class="col-sm-3" style="margin-bottom:25px">
							<div class="recipe_2_i clearfix">
								<a href=""><img src="../../img/coupen.jpg" class="iw"></a>
								<h5 >{$title}</h5>
								<p>{$description}</p>
								<p style="color: green">Price : {$price} pts</p>
									<form method="POST" action="redeem_coupon.php">
										<input type="hidden" name="coupon_id" value="{$coupon_id}">
										<button type="submit" class="btn btn-danger" name="redeem_coupon">Redeem</button>
									</form>
							</div>
						</div>
					HTML;
	
						echo $html;
					}
					} else {
					echo "No coupens found.";
					}
					?>
					</div>
				</div>
			</div>
		</section>
	
	</div>

	<div class="about_2">
		<h3 class="text-center">Coupen Inventory</h3>
		<section id="inventory">
			<div class="container">
				<div class="row">
					<div class="recipe_2 clearfix">
						<?php
						// Check if the user is logged in
						if (!isset($_SESSION['email'])) {
							// Redirect to the login page or display an error message
							header("Location: ../../customer_login_1.php");
							exit();
						}

						$email = $_SESSION['email'];

						// Retrieve the cusId based on the email
						$query = "SELECT cusId FROM cus_log WHERE email = '$email'";
						$result = $mysqli->query($query);

						if ($result && $result->num_rows > 0) {
							$row = $result->fetch_assoc();
							$cusId = $row['cusId'];

							// Retrieve the coupons owned by the user from the inventory table
							$query = "SELECT i.coupon_id, c.title, c.description, i.code FROM inventory i INNER JOIN coupons c ON i.coupon_id = c.coupon_id WHERE i.cusId = '$cusId'";
							$result = $mysqli->query($query);
						} else {
							// Handle the case where cusId is not found for the email
							// Redirect to an error page or display an error message
							header("Location: error.php");
							exit();
						}
						if ($result && $result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$coupon_id = $row['coupon_id'];
								$title = $row['title'];
								$description = $row['description'];
								$code = $row['code'];

								// Generate the HTML code for each coupon card
								$html = <<<HTML
								<div class="col-sm-3" style="margin-bottom:25px">
									<div class="recipe_2_i clearfix">
										<a href=""><img src="../../img/coupen.jpg" class="iw"></a>
										<h5>$title</h5>
										<p>$description</p>
										<p>Code: $code</p>
									</div>
								</div>
							HTML;

								echo $html;
							}
						} else {
							echo "<p>No coupons found in your inventory.</p>";
						}
						?>
					</div>
				</div>
			</div>
		</section>


	</div>
   </div>
   </div>
  </div>
 </div>
</section>

<section id="store">
	<div class="container">
	 <div class="row">
	  <div class="store_main clearfix">
		<div class="col-sm-12">
	   <div class="store_1"></div>
	  </div>
		<div class="col-sm-12">
	   <div class="col-sm-3">
		<div class="store_2">
		<h5>Terms</h5>
		 <ul>
			 <li><a href="#">Terms</a></li>
			 <li><a href="#">Conditions</a></li>
			 <li><a href="#">Cookies</a></li>
			 <li><a href="#">Copyrights</a></li>
		 </ul>
	   </div>
	   </div>
	   <div class="col-sm-3">
		<div class="store_2">
		<h5>Quick Links</h5>
		 <ul>
			 <li><a href="#">Home</a></li>
			 <li><a href="#">Recipes</a></li>
			 <li><a href="#">Ingredients</a></li>
			 <li><a href="#">About</a></li>
		 </ul>
	   </div>
	   </div>
	   <div class="col-sm-3">
	   <div class="store_2">
	   <h5>Social</h5>
		   <ul>
			   <li><a href="#">Facebook</a></li>
			   <li><a href="#">Instagram</a></li>
			   <li><a href="#">Youtube</a></li>
		   </ul>
	   </div>
	   </div>
	   <div class="col-sm-3">
		   <div class="store_2">
		   <h5>About</h5>
		   	<p class="footer-about">From quick meals to gourmet delights, our curated collection has something for everyone. Happy cooking!</p>
		   </div>
		   </div>
	  </div>
	  </div>
	  <div class="col-sm-12">
	   <div class="store_3"><p class="text-center">© 2023 Designed & Developed by Mohomed Ziard</p></div>
	  </div>
	 </div>
	</div>
</section>

<script>
	$(document).ready(function() {
    $('#myCarousel').carousel({
	    interval: 10000
	})
});
	</script>
</body>
</html>
