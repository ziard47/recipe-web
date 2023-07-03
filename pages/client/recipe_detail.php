<?php
require("../../db_connection.php");

session_start();

// Retrieve recipe details
$recipeId = $_GET['recipe_id'];

// Retrieve recipe details from 'recipes' table
$sql = "SELECT * FROM recipes WHERE recipe_id = $recipeId";
$result = $mysqli->query($sql);

if ($result->num_rows == 0) {
    echo "Recipe not found.";
    $mysqli->close();
    exit();
}

$row = $result->fetch_assoc();
$title = $row['title'];
$description = $row['description'];
$preparationTime = $row['preparation_time'];
$cookingTime = $row['cooking_time'];
$servings = $row['servings'];
$picture = $row['picture'];
$date = $row['date'];
$uploaded_by = $row['uploaded_by'];
$views = $row['views'];

// Update the views column in the recipes table
$sql = "UPDATE recipes SET views = views + 1 WHERE recipe_id = $recipeId";
$result = $mysqli->query($sql);

if ($result) {
    // Retrieve the uploader's user_id from the recipes table
    $uploaderId = $row['uploaded_by'];

    // Update the points column for the uploader in the users table
    $sql = "UPDATE cus_log SET points = points + 10 WHERE username = '$uploaderId'";
    $result = $mysqli->query($sql);

    if (!$result) {
        // Handle the case where the points update fails
        echo "Failed to update the points for the uploader.";
    }
} else {
    // Handle the case where the views update fails
    echo "Failed to update the views for the recipe.";
}


// Retrieve ingredients from 'recipe_ingredients' table
$sql = "SELECT * FROM recipe_ingredients WHERE recipe_id = $recipeId";
$result = $mysqli->query($sql);
$ingredients = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ingredients[] = array(
            'ingredient_name' => $row['ingredient_name'],
            'quantity' => $row['quantity'],
            'unit' => $row['unit']
        );
    }
}

// Retrieve steps from 'recipe_steps' table
$sql = "SELECT * FROM recipe_steps WHERE recipe_id = $recipeId";
$result = $mysqli->query($sql);
$steps = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $steps[] = array(
            'step_number' => $row['step_number'],
            'description' => $row['description']
        );
    }
}

$mysqli->close();
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
						<li class="active_1 clearfix"><a href="recipe.php">Recipe</a></li>
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
		   <li><span class="panel_1">Recipe Detail</span></li>
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
	   <h1>RECIPE DETAIL</h1>
	 </div>
   </div>
   <div class="recipe_detail clearfix">
     <div class="col-sm-12">
	   <h3><?php echo $title; ?></h3>
	   <h4><i class="fa fa-calendar"></i><?php echo $date; ?></h4>
	   <h4><i class="fa fa-user"></i><?php echo $uploaded_by; ?></h4>
	   <h4><i class="fa fa-eye"></i><?php echo $views; ?></h4>
	   <img src="../../recipe_images/large/<?php echo $picture; ?>" class="iw">
	 </div>
   </div>
   <div class="recipe_detail_main_inner_1 clearfix">
   	<h4 class="heading_2">Description </h4>
			<p><?php echo $description; ?></p>
   			<h4 class="heading_2">Preparation Time: </h4>
			<p><?php echo $preparationTime; ?> minutes</p>
			<h4 class="heading_2">Cooking Time: </h4>
			<p><?php echo $cookingTime; ?> minutes</p>
			<h4 class="heading_2">Servings: </h4>
			<p><?php echo $servings; ?></p>

			
			<h4 class="heading_2">Ingredients </h4>
            <ul>
				<?php foreach ($ingredients as $ingredient) { ?>
					<li><p><?php echo $ingredient['quantity'] . ' ' . $ingredient['unit'] . ' ' . $ingredient['ingredient_name']; ?></p></li>
				<?php } ?>
    		</ul>
	
			<h4 class="heading_2">Instructions</h4>
			<ol>
				<?php foreach ($steps as $step) { ?>
					<li><p style="text-align: justify;"><?php echo $step['description']; ?></p></li>
				<?php } ?>
    		</ol>
			<br>
			 <h5 class="text-center heading_tag_1">Share It</h5>
			 <div class="contact_icon contact_icon_detail text-center clearfix">
					<ul class="social-network social-circle">
						<li><a href="#" class="icoRss" title="Rss"><i class="fa fa-instagram"></i></a></li>
						<li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
						
					</ul>				
				</div>
		</div>
  </div>
  <h4 class="heading_3 text-center"><a href="recipe.php">VIEW OTHER RECIPES  <i class="fa fa-caret-right"></i></a></h4>

  	<div id="disqus_thread" style="margin-top:50px"></div>
	<script>
		/**
		*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
		*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
		var disqus_config = function () {
			this.page.url = '<?php echo 'http://localhost/websites/recipe-web/pages/client/recipe_detail.php?recipe_id=' . $recipeId; ?>';
			this.page.identifier = '<?php echo $recipeId; ?>';
		};
		(function() { // DON'T EDIT BELOW THIS LINE
			var d = document, s = d.createElement('script');
			s.src = 'https://recipe-web.disqus.com/embed.js';
			s.setAttribute('data-timestamp', +new Date());
			(d.head || d.body).appendChild(s);
		})();
	</script>
	<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

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
