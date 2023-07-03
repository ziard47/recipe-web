<?php
require("../validate_customer.php");
require("../../../db_connection.php");

// Retrieve form data
$recipeId = $_POST['recipe_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$preparationTime = $_POST['preparation_time'];
$cookingTime = $_POST['cooking_time'];
$servings = $_POST['servings'];
$ingredientNames = $_POST['ingredient_name'];
$quantities = $_POST['quantity'];
$units = $_POST['unit'];
$stepDescriptions = $_POST['step_description'];

// Update recipe details in 'recipes' table
$sql = "UPDATE recipes
        SET title = '$title', description = '$description', preparation_time = $preparationTime, cooking_time = $cookingTime, servings = $servings
        WHERE recipe_id = $recipeId";

if ($mysqli->query($sql) === FALSE) {
    echo "Error updating recipe details: " . $mysqli->error;
    $mysqli->close();
    exit();
}

// Delete existing ingredients for the recipe from 'recipe_ingredients' table
$sql = "DELETE FROM recipe_ingredients WHERE recipe_id = $recipeId";

if ($mysqli->query($sql) === FALSE) {
    echo "Error deleting existing ingredients: " . $mysqli->error;
    $mysqli->close();
    exit();
}

// Insert updated ingredients into 'recipe_ingredients' table
for ($i = 0; $i < count($ingredientNames); $i++) {
    $ingredientName = $ingredientNames[$i];
    $quantity = $quantities[$i];
    $unit = $units[$i];

    $sql = "INSERT INTO recipe_ingredients (recipe_id, ingredient_name, quantity, unit)
            VALUES ($recipeId, '$ingredientName', '$quantity', '$unit')";

    if ($mysqli->query($sql) === FALSE) {
        echo "Error inserting ingredient: " . $mysqli->error;
        $mysqli->close();
        exit();
    }
}

// Delete existing steps for the recipe from 'recipe_steps' table
$sql = "DELETE FROM recipe_steps WHERE recipe_id = $recipeId";

if ($mysqli->query($sql) === FALSE) {
    echo "Error deleting existing steps: " . $mysqli->error;
    $mysqli->close();
    exit();
}

// Insert updated steps into 'recipe_steps' table
for ($i = 0; $i < count($stepDescriptions); $i++) {
    $stepNumber = $i + 1;
    $stepDescription = $stepDescriptions[$i];

    $sql = "INSERT INTO recipe_steps (recipe_id, step_number, description)
            VALUES ($recipeId, $stepNumber, '$stepDescription')";

    if ($mysqli->query($sql) === FALSE) {
        echo "Error inserting step: " . $mysqli->error;
        $mysqli->close();
        exit();
    }
}

$mysqli->close();

header("Location: ../customer_account.php");;
?>
