<?php
require("../validate_admin.php");
require("../../../db_connection.php");

if (isset($_GET["cusId"])) {
    $cusId = $_GET["cusId"];

    // Delete the record from the database
    $deleteSql = "DELETE FROM cus_log WHERE cusId = $cusId";
    if ($mysqli->query($deleteSql) === TRUE) {
        
        echo "Record deleted successfully.";

        // Redirect back to the table page
        header("Location: ../users.php");
        exit();
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }
} else {
    echo "Invalid ID parameter.";
}
?>
