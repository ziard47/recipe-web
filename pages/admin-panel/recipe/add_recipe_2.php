<?php
require("../validate_admin.php");
require("../../../db_connection.php");
require("../../../code_lib.inc.php");

$title = $_POST['title'];
$description = $_POST['description'];
$preparationTime = $_POST['preparation_time'];
$cookingTime = $_POST['cooking_time'];
$servings = $_POST['servings'];
$ingredients = $_POST['ingredient_name'];
$quantities = $_POST['quantity'];
$units = $_POST['unit'];
$steps = $_POST['step_description'];

// Insert the recipe details into the 'recipes' table
$sql = "INSERT INTO recipes (title, description, preparation_time, cooking_time, servings)
        VALUES ('$title', '$description', $preparationTime, $cookingTime, $servings)";

if ($mysqli->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
    $mysqli->close();
    exit();
}

// Get the recipe ID of the newly inserted recipe
$recipeId = $mysqli->insert_id;

// Upload the image
if ($_FILES['picture']['error'] == 0 && $_FILES['picture']['type'] == "image/jpeg") {
  $filename = $_FILES['picture']['tmp_name'];
  $imagePath = "../../../recipe_images/large/";
  $imageName = $recipeId . "_" . uniqid() . ".jpg";
  $destination = $imagePath . $imageName;

  if (move_uploaded_file($filename, $destination)) {
      // Update the 'recipes' table with the image name
      $sql = "UPDATE recipes SET picture = '$imageName' WHERE recipe_id = $recipeId";

      if ($mysqli->query($sql) === FALSE) {
          echo "Error updating recipe picture: " . $mysqli->error;
          $mysqli->close();
          exit();
      }
  }
}

// Insert the ingredients into the 'recipe_ingredients' table
for ($i = 0; $i < count($ingredients); $i++) {
    $ingredient = $ingredients[$i];
    $quantity = $quantities[$i];
    $unit = $units[$i];

    $sql = "INSERT INTO recipe_ingredients (recipe_id, ingredient_name, quantity, unit)
            VALUES ($recipeId, '$ingredient', '$quantity', '$unit')";

    if ($mysqli->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
        $mysqli->close();
        exit();
    }
}

// Insert the steps into the 'recipe_steps' table
for ($i = 0; $i < count($steps); $i++) {
  $stepNumber = $i + 1;
  $stepDescription = $steps[$i];

  $sql = "INSERT INTO recipe_steps (recipe_id, step_number, description)
          VALUES ($recipeId, $stepNumber, '$stepDescription')";

  if ($mysqli->query($sql) === FALSE) {
      echo "Error: " . $sql . "<br>" . $mysqli->error;
      $mysqli->close();
      exit();
  }
}

$mysqli->close();

header("location:add_recipe_3.php?status=pass");