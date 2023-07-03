<?php
  require("validate_admin.php");
  require("../../db_connection.php");

  // Fetch data from the database
  $sql = "SELECT * FROM coupons";
  $result = $mysqli->query($sql);
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

    <link rel="stylesheet" href="css/admin.css">
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
                    <a href="dashboard.php"><span class="las la-igloo"></span>
                        <span>Dashboard</span></a>
                </li>

                <li>
                    <a href="recipes.php"><span class="las la-pizza-slice"></span>
                        <span>Recipes</span></a>
                </li>

                <li>
                    <a href="revision.php"><span class="las la-wine-glass"></span>
                        <span>Recipe Revision</span></a>
                </li>

                <li>
                    <a href="users.php"><span class="las la-users"></span>
                        <span>Users</span></a>
                </li>

                
                <li>
                    <a href="coupens.php" class="active"><span class="las la-ticket-alt"></span>
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
            <button onclick="location.href='coupens/add_coupen_1.php'"> Add Coupen </button>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price (Points)</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                        <tr>
                            <td><?php echo $row["coupon_id"]; ?></td>
                            <td><?php echo $row["title"]; ?></td>
                            <td><?php echo $row["description"]; ?></td>
                            <td><?php echo $row["price"]; ?></td>
                            <td>
                            <button type="button" class="btn btn-success" onclick="location.href='coupens/update_coupen.php?coupon_id=<?php echo $row["coupon_id"]; ?>'"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" onclick="location.href='coupens/delete_coupen.php?coupon_id=<?php echo $row["coupon_id"]; ?>'"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>

                        <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">No data found.</td>
                                </tr>
                                <?php
                            }
                            ?>
                            
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>