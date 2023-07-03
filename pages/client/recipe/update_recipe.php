<?php
    require("../validate_customer.php");
    require("../../../db_connection.php");
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


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Recipe</title>
	<link href="https://fonts.googleapis.com/css?family=Gotu&display=swap" rel="stylesheet">

    <link href="../../../css/bootstrap.min.css" rel="stylesheet">

    <link href="../../../css/style.css" rel="stylesheet">
	
	 <link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css" />
	 <link href="../../../css/ken-burns.css" rel="stylesheet" type="text/css" media="all" />
    <script src="../../../js/jquery-2.1.1.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
	
  </head>
<body>
<section id="header_top">
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <div class="header_top_1">
          <ul>
            <li><a href="../../admin-panel/dashboard.php">Admin</a></li>
            <li><a href="../../../logout_cus.php">Log Out</a></li>
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
						<li ><a href="../../../index.php">Home</a></li>
						<li class="active_1 clearfix" ><a href="../recipe.php">Recipe</a></li>
					<li ><a href="#">Account</a></li>
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
		   <li><span class="panel_1">Update Recipe</span></li>
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
	   <h1>Update Recipe</h1>
	 </div>
   </div>
   <div class="recipe_detail clearfix">
     <div class="col-sm-12">
	 </div>
   </div>
        <div class="recipe_detail_main_inner_1 clearfix">
        <form class="form" action="update_recipe_2.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="recipe_id" value="<?php echo $recipeId; ?>">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input class="form-control" type="text" id="title" name="title" required value="<?php echo $title; ?>">
                </div>
                
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" required><?php echo $description; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="preparation_time">Preparation Time (minutes):</label>
                    <input class="form-control" type="number" id="preparation_time" name="preparation_time" required value="<?php echo $preparationTime; ?>">
                </div>

                <div class="form-group">
                    <label for="cooking_time">Cooking Time (minutes):</label>
                    <input class="form-control" type="number" id="cooking_time" name="cooking_time" required value="<?php echo $cookingTime; ?>">
                </div>

                <div class="form-group">
                    <label for="servings">Servings:</label>
                    <input class="form-control" type="number" id="servings" name="servings" required value="<?php echo $servings; ?>">
                </div>

                <h5>Ingredients:</h5>
                <div id="ingredients">
                    <div class="form-row">
                        <div class="col">
                            <?php foreach ($ingredients as $ingredient) { ?>
                                <input class="form-control" type="text" name="ingredient_name[]" placeholder="Ingredient Name" required value="<?php echo $ingredient['ingredient_name']; ?>"><br>
                            <?php } ?>
                        </div>
                        <div class="col">
                            <?php foreach ($ingredients as $ingredient) { ?>
                                <input class="form-control" type="text" name="quantity[]" placeholder="Quantity" required value="<?php echo $ingredient['quantity']; ?>"><br>
                            <?php } ?>
                        </div>
                        <div class="col">
                            <?php foreach ($ingredients as $ingredient) { ?>
                            <input class="form-control" type="text" name="unit[]" placeholder="Unit" value="<?php echo $ingredient['unit']; ?>"><br>
                            <?php } ?>    
                        </div>
                        
                    </div><br>
                </div>
                <button type="button" class="btn btn-primary mb-2" onclick="addIngredient()">Add Ingredient</button><br><br>

                <h5>Steps:</h5>
                <div id="steps">
                    <?php foreach ($steps as $step) { ?>
                        <textarea class="form-control" name="step_description[]" placeholder="Step Description" required><?php echo $step['description']; ?></textarea><br>
                    <?php } ?>
                    </div>
                <button type="button" class="btn btn-primary mb-2" onclick="addStep()">Add Step</button><br><br>

                <button type="submit" class="btn btn-primary mb-2" name="submit" id="submit">Update Recipe</button>
                <button type="reset" class="btn btn-danger mb-2" name="reset" id="reset">Clear</button>
            </form>
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
<script>
  function addIngredient() {
      var ingredientDiv = document.getElementById("ingredients");
      var newIngredient = document.createElement("div");
      newIngredient.innerHTML = `
          <div class="form-row">
              <div class="col">
                  <input class="form-control" type="text" name="ingredient_name[]" placeholder="Ingredient Name" required>
              </div>
              <div class="col">
                  <input class="form-control" type="text" name="quantity[]" placeholder="Quantity" required>
              </div>
              <div class="col">
                  <input class="form-control" type="text" name="unit[]" placeholder="Unit">
              </div><br><br>
          </div>
      `;
      ingredientDiv.appendChild(newIngredient);
  }

  function addStep() {
      var stepDiv = document.getElementById("steps");
      var newStep = document.createElement("div");
      newStep.innerHTML = `
          <textarea class="form-control" name="step_description[]" placeholder="Step Description" required></textarea><br>
      `;
      stepDiv.appendChild(newStep);
  }
</script>
</body>
</html>