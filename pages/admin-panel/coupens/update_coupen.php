<?php
require("../validate_admin.php");
require("../../../db_connection.php");

if (isset($_GET["coupon_id"])) {
    $coupon_id = $_GET["coupon_id"];

    // Fetch the record based on the provided ID
    $sql = "SELECT * FROM coupons WHERE coupon_id = $coupon_id";
    $result = $mysqli->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Process the form submission
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $newTitle = $_POST["title"];
            $newDescription = $_POST["description"];
            $newPrice = $_POST["price"];

            // Update the record in the database
            $updateSql = "UPDATE coupons SET title = '$newTitle', description = '$newDescription', price = $newPrice WHERE coupon_id = $coupon_id";
            if ($mysqli->query($updateSql) === TRUE) {
                echo "Record updated successfully.";

                // Redirect back to the table page
                header("Location: ../coupens.php");
                exit();
            } else {
                echo "Error updating record: " . $mysqli->error;
            }
        }
    } else {
        echo "No record found with the provided ID.";
    }
} else {
    echo "Invalid ID parameter.";
}
?>


<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org" >
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta neme="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>

    <input type="checkbox" name="" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft"></span> <span>Recipe Admin</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
            <li>
                    <a href="../dashboard.php"><span class="las la-igloo"></span>
                        <span>Dashboard</span></a>
                </li>

                <li>
                    <a href="../recipes.php"><span class="las la-pizza-slice"></span>
                        <span>Recipes</span></a>
                </li>

                <li>
                    <a href="../ingredients.php" ><span class="las la-wine-glass"></span>
                        <span>Ingredients</span></a>
                </li>

                <li>
                    <a href="../users.php"><span class="las la-users"></span>
                        <span>Users</span></a>
                </li>
                
                <li>
                    <a href="../coupens.php" class="active"><span class="las la-ticket-alt"></span>
                        <span>Coupens</span></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="span las la-bars"></span>
                </label>
                Coupens
            </h2>

            <div class="search-wrapper">
                <span class="span las la-search"></span>
                <input type="search" placeholder="search here" />
            </div>

            <div class="user-wrapper">
                <div>
                <a href="../../logout.php"><h4 style="color: #2885DA;">Logout</h4></a>
                </div>
            </div>
        </header>

        <main>
            <form class="form" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Coupen Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="" value="<?php echo $row["title"]; ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="" value="<?php echo $row["description"]; ?>">
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="" value="<?php echo $row["price"]; ?>">
                </div>

                <button type="submit" class="btn btn-primary mb-2" name="submit" id="submit">Update</button>
                <button type="reset" class="btn btn-danger mb-2" name="reset" id="reset">Clear</button>
            </form>
        </main>
    </div>
</body>
</html>