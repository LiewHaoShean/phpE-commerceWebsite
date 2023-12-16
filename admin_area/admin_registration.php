<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin registeration</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <style>
        body{
            overflow-x: hidden;
        }
        .img-icon {
            width: 80%;
            height: 80%;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center align-items-center">
                  
            <div class="col-lg-6 text-center">
                <img src="../images/admin.jpeg" alt="Admin Registration" class="img-fluid img-icon">
            </div>

            <div class="col-lg-6">
                <form action="" method="post">
                    <div class="form-outline mb-4 w-50">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required="required" 
                        class="form-control ">
                    </div>
                    <div class="form-outline mb-4 w-50">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required="required" 
                        class="form-control">
                    </div>
                    <div class="form-outline mb-4 w-50">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required="required" 
                        class="form-control">
                    </div>
                    <div class="form-outline mb-4 w-50">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Enter your confirm password" required="required" 
                        class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_registration" value="Register">
                        <p class="small fw-bold mt-2 pt-1">Already have an account?<a href="admin_login.php" class="link-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    if(isset($_POST['admin_registration'])){
        $admin_username=$_POST['username'];
        $admin_email=$_POST['email'];
        $admin_password=$_POST['password'];
        $admin_conf_password=$_POST['confirm_password'];
        $hash_password=password_hash($admin_password,PASSWORD_DEFAULT);
        if($admin_username== '' or $admin_email== '' or $admin_password== '' or $admin_conf_password=''){
            echo "<script>alert('Please fill in all the available fields.')</script>";
            exit();
        }elseif($admin_password != $admin_conf_password){
            echo "<script>alert('Please ensure the password entered in both fields are the same')</script>";
            exit();
        }else{
            //select query
            $select_query="Select * from `admin_table` where admin_name=$admin_username or admin_email=$admin_email";
            $result=mysqli_query($con,$select_query);
            $row_count=mysqli_num_rows($result);
            if ($row_count> 0){
                echo"<script>alert('Username or gmail already exist.')</script>";
            } else {
                $insert_query="insert into `admin_table` (admin_name, admin_email, admin_password) values ('$admin_username', '$admin_email','$hash_password')";
                $result=mysqli_query($con,$insert_query);
                if($result){
                    echo "<script>alert('Data inserted sucessfully')</script>";
                }
            }
        }
    }
?>