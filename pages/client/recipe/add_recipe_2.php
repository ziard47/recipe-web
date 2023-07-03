<?php
require("../validate_customer.php");
require("../../../db_connection.php");
require("../../../code_lib.inc.php");

// Get the logged user email from the session
$loggedEmail = $_SESSION['email']; // Update this with the actual session variable storing the email

// Prepare the SQL query to retrieve the username based on the email
$query = "SELECT username FROM cus_log WHERE email = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $loggedEmail);
$stmt->execute();
$stmt->bind_result($username);

if ($stmt->fetch()) {
    // Get the username of the logged-in user

    $title = $_POST['title'];
    $description = $_POST['description'];
    $preparationTime = $_POST['preparation_time'];
    $cookingTime = $_POST['cooking_time'];
    $servings = $_POST['servings'];
    $ingredients = $_POST['ingredient_name'];
    $quantities = $_POST['quantity'];
    $steps = $_POST['step_description'];

    // Insert the recipe details into the 'recipes' table
    $sql = "INSERT INTO recipes (title, description, preparation_time, cooking_time, servings, uploaded_by)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt->close(); // Close the previous statement
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssiiis", $title, $description, $preparationTime, $cookingTime, $servings, $username);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Get the recipe ID of the newly inserted recipe
        $recipeId = $stmt->insert_id;

        // Upload the image
        if ($_FILES['picture']['error'] == 0 && $_FILES['picture']['type'] == "image/jpeg") {
            $filename = $_FILES['picture']['tmp_name'];
            $imagePath = "../../../recipe_images/large/";
            $imageName = $recipeId . "_" . uniqid() . ".jpg";
            $destination = $imagePath . $imageName;

            if (move_uploaded_file($filename, $destination)) {
                // Update the 'recipes' table with the image name
                $sql = "UPDATE recipes SET picture = ? WHERE recipe_id = ?";
                $stmt->close(); // Close the previous statement
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("si", $imageName, $recipeId);
                $stmt->execute();
            }
        }

        // Insert the ingredients into the 'recipe_ingredients' table
        $sql = "INSERT INTO recipe_ingredients (recipe_id, ingredient_name, quantity)
                VALUES (?, ?, ?)";

        $stmt->close(); // Close the previous statement
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iss", $recipeId, $ingredient, $quantity);

        for ($i = 0; $i < count($ingredients); $i++) {
            $ingredient = $ingredients[$i];
            $quantity = $quantities[$i];

            $stmt->execute();
        }

        $stmt->close();

        // Insert the steps into the 'recipe_steps' table
        $sql = "INSERT INTO recipe_steps (recipe_id, step_number, description)
                VALUES (?, ?, ?)";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iis", $recipeId, $stepNumber, $stepDescription);

        for ($i = 0; $i < count($steps); $i++) {
            $stepNumber = $i + 1;
            $stepDescription = $steps[$i];

            $stmt->execute();
        }

        $stmt->close();
        $mysqli->close();

        header("location:add_recipe_3.php?status=pass");
        exit();
    } else {
        echo "Error adding recipe.";
    }
} else {
    echo "Error retrieving username.";
}

$stmt->close();
$mysqli->close();
?>
