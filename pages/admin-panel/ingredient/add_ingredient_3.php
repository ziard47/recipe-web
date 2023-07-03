<?php
  require("../validate_admin.php");
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
                    <a href="../ingredients.php" class="active"><span class="las la-wine-glass"></span>
                        <span>Ingredients</span></a>
                </li>

                <li>
                    <a href="../feedback.php"><span class="las la-sms"></span>
                        <span>Feedbacks</span></a>
                </li>

                <li>
                    <a href="../users.php"><span class="las la-users"></span>
                        <span>Users</span></a>
                </li>

                
                <li>
                    <a href="../coupens.php"><span class="las la-ticket-alt"></span>
                        <span>Coupens</span></a>
                </li>

                <li>
                    <a href="../points.php"><span class="las la-star"></span>
                        <span>Points</span></a>
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
                Ingredients
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
        <?php
            if($_REQUEST['status']=="pass"){
            // echo "<h2 class='text-success'>Record Successfully Added</h2>";
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <h2>Record Successfully Added</h2>
                    <strong>Awesome </strong> adding new record was successfully done.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <br />
                    <a href="add_ingredient_1.php" class="btn btn-success my-3">Add Another Record</a>
                </div>
            <?php
            }
            else{
            // echo "<h2 class='text-danger'>Add new record failed.!</h2>";
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h2>Add new record failed.!</h2>
                    <strong>Sorry</strong> adding new record failed. Pleas try again.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <br />
                    <a href="add_ingredient_1.php" class="btn btn-danger my-3">Try again</a>
                </div>

                <?php
                }

            ?>
        </main>
    </div>
</body>
</html>