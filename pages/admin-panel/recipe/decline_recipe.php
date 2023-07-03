<?php
require("../validate_admin.php");
require("../../../db_connection.php");

// Retrieve the recipe ID from the query string
if (isset($_GET['recipe_id'])) {
    $recipeId = $_GET['recipe_id'];

    // Prepare the update query
    $updateQuery = "UPDATE recipes SET status = 'declined' WHERE recipe_id = ?";

    // Create a prepared statement
    $stmt = $mysqli->prepare($updateQuery);

    // Bind the recipe ID parameter
    $stmt->bind_param("i", $recipeId);

    // Execute the update query
    if ($stmt->execute()) {
        header("location:../revision.php");
    } else {
        echo "Failed to update the recipe status: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Recipe ID not provided.";
}

// Close the database connection
$mysqli->close();
?>
