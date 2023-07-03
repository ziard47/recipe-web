<?php
require("validate_customer.php");
require("../../db_connection.php");

// Get the logged user's email
$loggedInEmail = $_SESSION['email']; // Update this with the actual session variable storing the email

// Fetch the username from the database based on the email
$sql = "SELECT username FROM cus_log WHERE email = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $loggedInEmail);
$stmt->execute();
$stmt->bind_result($loggedInUsername);
$stmt->fetch();
$stmt->close();

// Fetch data from the database for the logged user
$sql = "SELECT * FROM recipes WHERE uploaded_by = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $loggedInUsername);
$stmt->execute();
$result = $stmt->get_result();


?>

<!DOCTYPE html>
<html lang="en">
<!-- ... -->
<body>
<!-- Header section -->
<!-- ... -->

<!-- Account details section -->
<section id="account-details">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1>Account Details</h1>
      </div>
    </div>
    <?php
    if (isset($_SESSION['email'])) {
      $email = $_SESSION['email'];

      $sql = "SELECT * FROM cus_log WHERE email = ?";
      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="recipe_detail_main_inner_1 clearfix">
                <h4 class="heading_2">Name:</h4>
                <p class="label mx-1" for="name"><?php echo $row['name']; ?></p>
                <h4 class="heading_2">Email:</h4>
                <p class="label mx-1" for="name"><?php echo $row['email']; ?></p>
                <h4 class="heading_2">Phone No.:</h4>
                <p class="label mx-1" for="name"><?php echo $row['phone']; ?></p>
                <br><br>
              </div>
            </div>
          </div>
    <?php
        }
      } else {
        echo "No customer details found.";
      }
    } else {
      echo "User not logged in.";
    }
    ?>
  </div>
</section>

<!-- Recipe table section -->
<section id="recipe-table">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Title</th>
              <th scope="col">Description</th>
              <th scope="col">Picture</th>
              <th scope="col">Uploaded Date</th>
              <th scope="col">Views</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                // Display the recipe details in each row
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td><img src='" . $row['picture'] . "' alt='Recipe Picture' width='100'></td>";
                echo "<td>" . $row['uploaded_date'] . "</td>";
                echo "<td>" . $row['views'] . "</td>";
                echo "<td><a href='edit_recipe.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete_recipe.php?id=" . $row['id'] . "'>Delete</a></td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='7'>No recipes found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Footer section -->
<!-- ... -->
</body>
</html>
