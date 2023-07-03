<?php
require("../validate_admin.php");
require("../../../db_connection.php");

if (isset($_GET["coupon_id"])) {
    $coupon_id = $_GET["coupon_id"];

    // Fetch the record to get the image filename
    $fetchSql = "SELECT * FROM coupons WHERE coupon_id = $coupon_id";
    $result = $mysqli->query($fetchSql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Delete the record from the database
        $deleteSql = "DELETE FROM coupons WHERE coupon_id = $coupon_id";
        if ($mysqli->query($deleteSql) === TRUE) {
            echo "Record deleted successfully.";

            // Redirect back to the table page
            header("Location: ../coupens.php");
            exit();
        } else {
            echo "Error deleting record: " . $mysqli->error;
        }
    } else {
        echo "No record found with the provided ID.";
    }
} else {
    echo "Invalid ID parameter.";
}
?>

