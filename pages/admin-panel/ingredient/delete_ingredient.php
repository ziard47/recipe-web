<?php
require("../validate_admin.php");
require("../../../db_connection.php");

if (isset($_GET["ingId"])) {
    $ingId = $_GET["ingId"];

    // Fetch the record to get the image filename
    $fetchSql = "SELECT * FROM ingredient WHERE ingId = $ingId";
    $result = $mysqli->query($fetchSql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $imageFilename = $row["picture"];

        // Delete the record from the database
        $deleteSql = "DELETE FROM ingredient WHERE ingId = $ingId";
        if ($mysqli->query($deleteSql) === TRUE) {
            // Delete the corresponding image files (if needed)
            $destinationLarge = "../../../ingredient_images/large/" . $imageFilename;
            $destinationThumb = "../../../ingredient_images/thumb/" . $imageFilename;

            if (file_exists($destinationLarge)) {
                unlink($destinationLarge);
            }
            if (file_exists($destinationThumb)) {
                unlink($destinationThumb);
            }

            echo "Record and image deleted successfully.";

            // Redirect back to the table page
            header("Location: ../ingredients.php");
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
