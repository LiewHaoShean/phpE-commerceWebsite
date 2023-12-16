<?php
include("../includes/connect.php");
include_once("../functions/common_function.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment page</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<style>
    .paypal-img {
        width: 100%;
        margin: auto;
        display: block;
    }
</style>
<body>
    <!-- php code to access user id -->
    <?php
    // $user_ip=getIPAddress();
    $username=$_SESSION['username'];
    $get_user="Select * from `user_table` where username='$username'";
    $result=mysqli_query($con, $get_user);
    $run_query=mysqli_fetch_array($result);
    $user_id=$run_query["user_id"];

    ?>
    <div class="container">
        <h2 class="text-center text-info">Payment Option</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6">
                <a href="https://www.paypal.com" target="_blank"><img src="../images/paypal-img.png" class="paypal-img" alt=""></a>
            </div>
            <div class="col-md-6">
                <a href="order.php?user_id=<?php echo $user_id?>"><h2 class="text-center">Pay Offline</h2></a>
            </div>
        </div>
    </div>
</body>
</html>