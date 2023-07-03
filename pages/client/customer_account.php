<?php
require("validate_customer.php");
require("../../db_connection.php");
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
						<li ><a href="recipe.php">Recipe</a></li>
					<li class="active_1 clearfix"><a href="#">Account</a></li>
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
		   <li><span class="panel_1">Account Details</span></li>
	   </ul>
	</div>
   </div>
  </div>
 </div>
</section>
<section id="recipe">
 <div class="container">
  <div class="row">
   <div class="recipe_1 clearfix">
     <div class="col-sm-12">
	   <h1>Account Details</h1>
	 </div>
   </div>
   <div class="recipe_detail clearfix">
     <div class="col-sm-12">
	 </div>
   </div>
   <?php
		if (isset($_SESSION['email'])) {
			$email = $_SESSION['email'];

			$sql = "SELECT * FROM cus_log WHERE email = '$email'";
			$result = $mysqli->query($sql);

			if ($result && mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
    ?>

	<div class="recipe_detail_main_inner_1 clearfix">
		<h4 class="heading_2">Name:</h4>
		<p class="label mx-1" for="name"><?php echo $row['name']; ?></p>
		<h4 class="heading_2">Email:</h4>
		<p class="label mx-1" for="name"><?php echo $row['email']; ?></p>
		<h4 class="heading_2">Phone No.:</h4>
		<p class="label mx-1" for="name"><?php echo $row['phone']; ?></p>
		<br><br>
	</div>

	<?php
		}
		} else {
		echo "No customer details found.";
		}
	} else {
		echo "User not logged in.";
	}
	?>

	<button onclick="location.href='recipe/add_recipe_1.php'"> Add Recipe </button>
            
		<div class="container" style="margin-top: 20px">
			<div class="row">
				<div class="col-12">
				<table class="table table-bordered">
					<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Title</th>
						<th scope="col">Description</th>
						<th scope="col">Picture</th>
						<th scope="col">Uploaded Date</th>
						<th scope="col">Views</th>
						<th scope="col">Status</th>
						<th scope="col">Actions</th>
					</tr>
					</thead>
					<tbody>
						<?php
							// Get the logged user's email
							$loggedInEmail = $_SESSION['email']; // Update this with the actual session variable storing the email

							// Fetch the username from the database based on the email
							$sql = "SELECT username FROM cus_log WHERE email = ?";
							$stmt = $mysqli->prepare($sql);
							$stmt->bind_param("s", $loggedInEmail);
							$stmt->execute();
							$stmt->bind_result($loggedInUsername);
							$stmt->fetch();
							$stmt->close();

							// Fetch data from the database for the logged user
							$sql = "SELECT * FROM recipes WHERE uploaded_by = ?";
							$stmt = $mysqli->prepare($sql);
							$stmt->bind_param("s", $loggedInUsername);
							$stmt->execute();
							$result = $stmt->get_result();

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
						?>
							<tr>
								<td><?php echo $row["recipe_id"]; ?></td>
								<td><?php echo $row["title"]; ?></td>
								<td><?php echo $row["description"]; ?></td>
								<td><img src="../../recipe_images/large/<?php echo $row["picture"]; ?>" width="200" height="100" alt="Picture"></td>
								<td><?php echo $row["date"]; ?></td>
								<td><?php echo $row["views"]; ?></td>
								<td style="color:green"><?php echo $row["status"]; ?></td>
								<td>
								<button type="button" style="margin-bottom:10px" class="btn btn-success" onclick="location.href='recipe/update_recipe.php?recipe_id=<?php echo $row["recipe_id"]; ?>'"><i class="fa fa-edit"></i></button><br>
								<button type="button" class="btn btn-danger" onclick="location.href='recipe/delete_recipe.php?recipe_id=<?php echo $row["recipe_id"]; ?>'"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						<?php
							}
						} else {
						?>
							<tr>
							<td colspan="4">No data found.</td>
							</tr>
						<?php
							}
						?>
					</tbody>
				</table>
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
