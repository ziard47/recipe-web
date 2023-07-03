<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Recipe</title>
	<link href="https://fonts.googleapis.com/css?family=Gotu&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/customer_login.css" rel="stylesheet">
	
	 <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	 <link href="css/ken-burns.css" rel="stylesheet" type="text/css" media="all" />
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
  </head>
<body>
<section id="header_top">
	<div class="container">
		<div class="row">
		<div class="col-sm-12 padding_all">
		<div class="col-sm-4 padding_all">
		<div class="header_top_1">
			<ul>
				<li><a href="/websites/recipe-web/pages/admin-panel/dashboard.php">Admin</a></li>
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
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Keywords">
				<span class="input-group-btn">
				<button class="btn btn-primary" type="button">
					SEARCH</button>
				</span>
				</div>
		</div>
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
                        <li ><a href="index.php">Home</a></li>
                        <li><a href="/websites/recipe-web/pages/client/recipe.php">Recipe</a></li>
                        <li class="active_1 clearfix"><a href="/websites/recipe-web/pages/client/customer_account.php">Account</a></li>
                        <li><a href="/websites/recipe-web/pages/client/about.php">About</a></li>
                        <li><a href="/websites/recipe-web/pages/client/redeem.php">Redeem</a></li>
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
		   <li><span class="panel_1">Sign In</span></li>
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
	 </div>
   </div>
   <div class="recipe_detail clearfix">
     <div class="col-sm-12">
	 </div>
   </div>
   <div class="recipe_detail_main_inner_1 clearfix">
        <div class="login-page">
            <div class="form">
                <div class="login">
					<div class="login-header">
						<h3>Sign In</h3>
						<p>Please enter your credentials to login.</p>
					</div>
                </div>
                <form class="login-form" action="customer_login_2.php" method="post">
					<input type="email" id="email" name="email" placeholder="email"/>
					<input type="password" id="password" name="password" placeholder="password"/>
					<button>login</button>
					<p class="message">Not registered? <a href="customer_signup_1.php">Create an account</a></p>
                </form>
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
			   <p class="footer-about">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, et. Cupiditate similique exercitationem consequatur ex laboriosam.</p>
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
