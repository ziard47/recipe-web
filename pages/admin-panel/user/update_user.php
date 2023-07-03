<?php
require("../validate_admin.php");
require("../../../db_connection.php");
require("../../../code_lib.inc.php");

if (isset($_GET["cusId"])) {
    $cusId = $_GET["cusId"];
    
    // Fetch the record based on the provided ID
    $sql = "SELECT * FROM cus_log WHERE cusId = $cusId";
    $result = $mysqli->query($sql);
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // Process the form submission
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $newName = $_POST["name"];
            $newEmail = $_POST["email"];
            $newPhone = $_POST["phone"];
            $newPassword = crypt($_POST['password'],"x07h");
            
            // Update the record in the database
            $updateSql = "UPDATE cus_log SET name = '$newName', email = '$newEmail', phone = '$newPhone', password = '$newPassword' WHERE cusId = $cusId";
            if ($mysqli->query($updateSql) === TRUE) {
                echo "Record updated successfully.";
                
                // Redirect back to the table page
                header("Location: ../users.php");
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
                    <a href="../revision.php" ><span class="las la-wine-glass"></span>
                        <span>Recipe Revision</span></a>
                </li>

                <li>
                    <a href="../users.php" class="active"><span class="las la-users"></span>
                        <span>Users</span></a>
                </li>

                <li>
                    <a href="../coupens.php"><span class="las la-ticket-alt"></span>
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
                Users
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
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="john doe" value="<?php echo $row["name"]; ?>">
                </div>

                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="john@gmail.com" value="<?php echo $row["email"]; ?>">
                </div>

                <div class="form-group">
                    <label for="name">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="0769784454" value="<?php echo $row["phone"]; ?>">
                </div>

                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="123465" value="<?php echo $row["password"]; ?>">
                </div>

                <button type="submit" class="btn btn-primary mb-2" name="submit" id="submit">Update</button>
                <button type="reset" class="btn btn-danger mb-2" name="reset" id="reset">Clear</button>
            </form>
        </main>
    </div>
</body>
</html>