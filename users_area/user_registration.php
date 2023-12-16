<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="text" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="user_email"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">Image</label>
                        <input type="file" id="user_image" class="form-control" autocomplete="off" required="required" name="user_image"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control" placeholder="Enter your password again" autocomplete="off" required="required" name="conf_user_password"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">User Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="user_address"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">User Contact</label>
                        <input type="text" id="user_contact" class="form-control" placeholder="Enter your contact" autocomplete="off" required="required" name="user_contact"/>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="submit" name="user_register" id="register" class="btn btn-info mb-3 px-3" value="Register">
                        <p class="small fw-bold mt-2 pt-1">Already have an account?<a class="text-danger"href="user_login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $user_conf_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_ip=getIPAddress();
    if($user_username== '' or $user_email=='' or $user_image=='' or $user_password=='' or $user_conf_password=='' or $user_address=='' or $user_contact==''){
        echo "<script>alert('Please fill in all the available fields')</script>";
        exit();
    }elseif($user_password != $user_conf_password){
        echo "<script>alert('Please ensure the password entered in both fields are the same')</script>";
        exit();
    }else{
        //select query
        $select_query="Select * from `user_table` where username='$user_username' or user_email='$user_email'";
        $result=mysqli_query($con,$select_query);
        $row_count=mysqli_num_rows($result);
        if($row_count> 0){
            echo "<script>alert('Username or gmail already exist.')</script>";
        } else {
            //insert query
            move_uploaded_file($user_image_tmp, "./user_images/$user_image");
            $insert_query = "insert into `user_table`(username, user_email, user_password, user_image, user_ip, user_address ,user_mobile) values('$user_username',  '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
            $result_query = mysqli_query($con, $insert_query);
            if($result_query){
            echo "<script>alert('Data inserted sucessfully')</script>";
        }
        
    }
}

//selecting cart items
$select_cart_items="Select * from `cart_details` where ip_address='$user_ip'";
$result_cart = mysqli_query($con, $select_cart_items);
$row_count=mysqli_num_rows($result_cart);
if($row_count>0){
    $_SESSION["username"]=$user_username;
    echo "<script>alert('You have items in your cart')</script>";
    echo"<script>window.open('checkout.php','_self' )</script>";
}else{
    echo "<script>window.open('../index.php', '_self')</script>";
}
}

?>