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
          </ul>
        </div>
      </div>
      <div class="col-sm-5">
        <div class="header_top_2">
          <ul>
            <li class="dropdown">
              <ul class="dropdown-menu drop_1">
                <li><a href="../../index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="header_top_3">
          <form action="search.php" method="GET" class="input-group">
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
						<li><a href="../../index.php">Home</a></li>
						<li><a href="recipe.php">Recipe</a></li>
						<li><a href="customer_account.php">Account</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="redeem.php">Redeem</a></li>
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
		   <li><span class="panel_1">Search Result</span></li>
	   </ul>
	</div>
   </div>
  </div>
 </div>
</section>
<section id="recipe">
 <div class="container">
  <div class="row">
   <div class="recipe_2 clearfix">
   <?php
	require("../../db_connection.php");

	// Check if the search_name parameter is set
	if (isset($_GET['search_name'])) {
		// Get the search query from the GET parameter
		$searchName = $_GET['search_name'];

		// Create the SQL query to search for records with matching name
		$query = "SELECT * FROM recipes WHERE title LIKE '%$searchName%'";
		$result = $mysqli->query($query);

		// Check if any records were found
		if (mysqli_num_rows($result) > 0) {
			// Loop through the search results and display them
			while ($row = mysqli_fetch_assoc($result)) {
				$name = $row['title'];
				$picture = $row['picture'];
				?>
		<div class="col-sm-3">
			<div class="recipe_2_i clearfix">
				<a href=""><img src="../../recipe_images/large/<?php echo $picture; ?>" class="iw"></a>
				<h4><a href="recipe_detail.php?recipe_id=<?php echo $row['recipe_id']; ?>"><?php echo $row['title']; ?></a></h4>
				<button type="button" class="btn btn-danger" onclick="location.href='recipe_detail.php?recipe_id=<?php echo $row['recipe_id']; ?>'">More -></button>
			</div>
		</div>
	<?php
				}
			} else {
				// No records found
				echo '<p>No results found.</p>';
			}

			// Free the result set
			mysqli_free_result($result);
		}
		?>
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
