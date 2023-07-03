<?php
session_start();

if (isset($_SESSION['email'])) {
    // Check if the redeem_coupon form was submitted
    if (isset($_POST['redeem_coupon'])) {
        require("../../db_connection.php");

        $email = $_SESSION['email'];
        $coupon_id = $_POST['coupon_id'];

        // Retrieve customer's points from cus_log table
        $points_query = "SELECT points FROM cus_log WHERE email = '$email'";
        $points_result = $mysqli->query($points_query);

        if ($points_result && $points_result->num_rows > 0) {
            $row = $points_result->fetch_assoc();
            $customer_points = $row['points'];

            // Retrieve coupon's price from coupons table
            $coupon_query = "SELECT price FROM coupons WHERE coupon_id = $coupon_id";
            $coupon_result = $mysqli->query($coupon_query);

            if ($coupon_result && $coupon_result->num_rows > 0) {
                $row = $coupon_result->fetch_assoc();
                $coupon_price = $row['price'];

                // Check if customer has enough points to redeem the coupon
                if ($customer_points >= $coupon_price) {
                    // Generate a random code
                    $code = generateRandomCode();

                    // Reduce customer's points
                    $new_points = $customer_points - $coupon_price;
                    $update_points_query = "UPDATE cus_log SET points = $new_points WHERE email = '$email'";
                    $mysqli->query($update_points_query);

                    // Add a record to the inventory table
                    $redeemed_date = date("Y-m-d");
                    $inventory_query = "INSERT INTO inventory (cusId, coupon_id, redeemed_date, code) VALUES ((SELECT cusId FROM cus_log WHERE email = '$email'), $coupon_id, '$redeemed_date', '$code')";
                    $mysqli->query($inventory_query);

                    // Display a success message and the generated code if the customer redeemed successfully
                    $success_message = "You have successfully redeemed the coupon. Your code is: $code";
                    echo "<script>alert('".$success_message."'); window.location.href = 'redeem.php';</script>";
                    exit();
                } else {
                    // Display an error message if the customer doesn't have enough points
                    $error_message = "You do not have enough points to redeem this coupon.";
                    echo "<script>alert('".$error_message."'); window.location.href = 'redeem.php';</script>";
                }
            } else {
                // Display an error message if the coupon is not found
                $error_message = "Coupon not found.";
                echo "<script>alert('".$error_message."'); window.location.href = 'redeem.php';</script>";
            }
        } else {
            // Display an error message if customer details are not found
            $error_message = "Customer details not found.";
            echo "<script>alert('".$error_message."'); window.location.href = 'redeem.php';</script>";
        }
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: ../../customer_login_1.php");
    exit();
}

// Function to generate a random code in the format ZTVYM-VJKBK-KWKWZ
function generateRandomCode() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';

    for ($i = 0; $i < 5; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    $code .= '-';

    for ($i = 0; $i < 5; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    $code .= '-';

    for ($i = 0; $i < 5; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $code;
}
?>
