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
	<link href="css/animate.css" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	 <link href="css/ken-burns.css" rel="stylesheet" type="text/css" media="all" />
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
	
	
  </head>
<body>
<section id="header_top">
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <div class="header_top_1">
          <ul>
            <li><a href="customer_login_1.php">Login</a></li>
            <li><a href="customer_signup_1.php">Sign Up</a></li>
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
                        <li class="active_1 clearfix"><a href="index.php">Home</a></li>
                        <li><a href="/websites/recipe-web/pages/client/recipe.php">Recipe</a></li>
                        <li><a href="/websites/recipe-web/pages/client/customer_account.php">Account</a></li>
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
<section id="center">
	  <div class="banner">
		<div id="kb" class="carousel kb_elastic animate_text kb_wrapper" data-ride="carousel" data-interval="6000" data-pause="hover">
			<!-- Wrapper-for-Slides -->
            <div class="carousel-inner" role="listbox">  
                <div class="item active"><!-- First-Slide -->
                    <img src="img/home-image-1.jpg" alt="" class="img-responsive" />
                    <div class="carousel-caption kb_caption kb_caption_right">
                        <h3 data-animation="animated flipInX">CHICKEN FRIED RICE</h3>
                    </div>
                </div>  
                <div class="item"> <!-- Second-Slide -->
                    <img src="img/home-image-2.jpg" alt="" class="img-responsive" />
                    <div class="carousel-caption kb_caption kb_caption_right">
                        <h3 data-animation="animated fadeInDown">CHICKEN LASAGNA</h3>
                        
                    </div>
                </div> 
                <div class="item"><!-- Third-Slide -->
                    <img src="img/home-image-3.jpg" alt="" class="img-responsive"/>
                    <div class="carousel-caption kb_caption kb_caption_center">
                        <h3 data-animation="animated fadeInLeft">SPICY FISH</h3>
                    </div>
                </div> 
            </div> 
            <!-- Left-Button -->
            <a class="left carousel-control kb_control_left" href="#kb" role="button" data-slide="prev">
				<span class="fa fa-angle-left kb_icons" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a> 
            <!-- Right-Button -->
            <a class="right carousel-control kb_control_right" href="#kb" role="button" data-slide="next">
                <span class="fa fa-angle-right kb_icons" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a> 
        </div>
		<script src="js/custom.js"></script>
	</div>

	</section>
<section id="middle">
 
</section>
<section id="products">
 <div class="container">
  <div class="row">
   <div class="products_main clearfix">
     <div class="col-sm-12">
    <div class="products_1">
	  <h3 class="text-center">Latest Recipes </h3>
	</div>
   </div>
     <div class="col-sm-12">
    <div class="products_2">
        <div class="row">
            <div class="col-md-9">
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left" href="#carousel-example-generic" data-slide="prev"></a><a class="right" href="#carousel-example-generic" data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example-generic" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                    <?php
                    require("db_connection.php");

                    // Retrieve the recipe data from the database
                    $query = "SELECT * FROM recipes WHERE status = 'accepted' ORDER BY recipe_id DESC LIMIT 3";
                    $result = $mysqli->query($query);

                    if ($result && $result->num_rows > 0) {
                    // Loop through each recipe record
                    while ($row = $result->fetch_assoc()) {
                        $rid = $row['recipe_id'];
                        $name = $row['title'];
                        $picture = $row['picture'];
                    
                        // Generate the HTML code for each ingredient
                        $html = <<<HTML
                        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="recipe_images/large/{$picture}" class="img-responsive" alt="a">
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                            {$name}</h5>
                                
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left"  >
                                        <p class="btn-details" >
                                        <button type="button" class="btn btn-danger" onclick="location.href='/websites/recipe-web/pages/client/recipe_detail.php?recipe_id={$row['recipe_id']}'">More -></button>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        HTML;

                            echo $html;
                        }
                        } else {
                        echo "No recipe found.";
                        }
                        ?>      
                    </div>
                </div>
            </div>
        </div>
	</div>
   </div>
   </div>
  </div>
 </div>
</section>
<section id="events">
 <div class="container">
  <div class="row">
   <div class="events_main clearfix">
     <div class="col-sm-12">
    <div class="events_1"><h3 class="text-center">Top Recipe</h3></div>
   </div>
     <div class="col-sm-12">
    <div class="col-sm-6">
	 <div class="events_2"><div class="grid">
					<figure class="effect-duke">
						<img src="img/home-image-4.jpg" alt="img17"/>
						<figcaption>
							<h2>CHICKEN  <span> AMBULTHIYAL</span></h2>
							<p>Spicy, sour chicken infused with flavours of goraka and fragrant spices slow cooked on a banana leaf.</p>
						<a href="#">View more</a>						</figcaption>			
		  </figure>
	  </div></div>
	</div>
	<div class="col-sm-6">
	 <div class="events_2"><div class="grid">
					
					<figure class="effect-duke">
						<img src="img/home-image-5.jpg" alt="img17"/>
						<figcaption>
							<h2>CHICKEN <span> KOTTU</span></h2>
							<p>An all-time Sri Lankan favourite! You can now make spicy chicken kottu from scratch, in the comfort of your own home!</p>
						<a href="#">View more</a>						</figcaption>			
		  </figure>
	  </div></div>
	</div>
   </div>
   </div>
  </div>
 </div>
</section>
<section id="latest">
</section>
<section id="reviews">
</section>
<section id="discounts">
 <div class="container">
  <div class="row">
   <div class="col-sm-12">
    <div class="discounts_1">
	 <h4 class="text-center">Subscribe to our Newsletter</h4>
	 <p class="text-center"></p>
	</div>
   </div>
   <div class="col-sm-12">
    <div class="col-sm-3"></div>
	<div class="col-sm-6">
	 <div class="col-sm-12">
	  <div class="col-sm-8">
	   <div class="discounts_2"><input type="text" class="form-control" placeholder="Enter your email"></div>
	  </div>
	  <div class="col-sm-4">
	   <div class="discounts_3"><p class="text-center"><a href="#">Subscribe</a></p></div>
	  </div>
	 </div>
	</div>
	<div class="col-sm-3"></div>
   </div>
   <div class="col-sm-12">
    <div class="discounts_4">
	</div>
   </div>
   <div class="col-sm-12">
    <div class="discounts_5">
	    <div class="hi-icon-wrap hi-icon-effect-4 hi-icon-effect-4b"></div>
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
