<?php
require("../../../db_connection.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = crypt($_POST['password'],"x07h");

    // Prepare the SQL statement
    $stmt = $mysqli->prepare("INSERT INTO cus_log (name, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $password);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect the user to a success page or perform any other desired action
        header("location:add_user_3.php?status=pass");
        exit();
    } else {
        // Handle the case when the insertion fails
        header("location:add_user_3.php?status=fail");
    }

    // Close the statement
    $stmt->close();
}