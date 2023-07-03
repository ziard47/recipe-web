<?php
// add_coupen_2.php
require("../validate_admin.php");
require("../../../db_connection.php");

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Check the connection
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute the SQL query
    $sql = "INSERT INTO coupons (title, description, price) VALUES ('$title', '$description', '$price')";

    if (mysqli_query($mysqli, $sql)) {
        // Insert successful
        mysqli_close($mysqli);

        // Redirect the user back to the original page or any other page
        header("Location: ../coupens.php");
        exit();
    } else {
        // Insert failed
        echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
    }
}
?>
