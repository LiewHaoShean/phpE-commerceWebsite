<?php
include('./includes/connect.php');
include('./functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website-Cart Details</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles.css">
    <style>
        .cart_img {
            width: 80px;
            height: 80px;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="./images/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Products</a>
                        </li>
                        <?php
                        if(isset($_SESSION['username'])){
                            echo "<li class='nav-item'>
                            <a class='nav-link' href='./users_area/profile.php'>My Account</a>
                        </li>";
                        }else{
                            echo"<li class='nav-item'>
                            <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
                        </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- calling cart function -->
        <?php
        cart();
        ?>
        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
            <?php
                if (!isset($_SESSION['username'])){
                    echo '<li class="nav-item">
                    <a class="nav-link" href="#">Welcome Guest</a>
                </li>';
                }else{
                    echo '<li class="nav-item">
                    <a class="nav-link" href="#">Welcome '.$_SESSION['username'].'</a>
                </li>';
                }
                if (!isset($_SESSION['username'])){
                    echo ' <li class="nav-item">
                    <a class="nav-link" href="./users_area/user_login.php">Login</a>
                </li>';
                }else{
                    echo '<li class="nav-item">
                    <a class="nav-link" href="./users_area/logout.php">Logout</a>
                </li>';
                }
                ?>
            </ul>
        </nav>
        <!-- Third child -->
        <div class="bg-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communication is the heart of e-commerce and community</p>
        </div>
        <!-- Fourth child -->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                <table class="table table-bordered text-center">
                    <tbody>
                        <?php
                            global $con;
                            $get_ip_add = getIPAddress();
                            $total_price = 0;
                            $cart_query = "Select * from `cart_details` where ip_address='$get_ip_add'";
                            $result=mysqli_query($con, $cart_query);
                            $result_count = mysqli_num_rows($result);
                            if($result_count>0){
                                echo'<thead>
                        <th>Product Title</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>ConfirmQuantity</th>
                        <th>Price</th>
                        <th>Remove</th>
                        <th colspan="2">Operations</th>
                    </thead>';
                            while($row=mysqli_fetch_array($result)){
                                $product_id = $row['product_id'];
                                $select_products="Select * from `products` where product_id='$product_id'";
                                $result_products = mysqli_query($con, $select_products);
                                while($row_product=mysqli_fetch_array($result_products)){
                                    $product_title = $row_product['product_title'];
                                    $product_img = $row_product['product_image1'];
                                    $productPrice = $row_product['product_price'];
                                    $product_price=array($row_product['product_price']);
                                    $product_values=array_sum($product_price);
                                    $total_price+=$product_values;
                        ?>
                                    <tr>
                                        <td><?php echo $product_title ?></td>
                                        <td><img src='./images/<?php echo $product_img?>' alt='' class='cart_img'></td>
                                        <td><input type='number' name='qty' class='form-input w-50'></td>
                                        <td><input type='checkbox' name="updatecart[]" value="<?php echo $product_id ?>"></td>
                                        <?php
                                        $get_ip_add = getIPAddress();
                                        if (isset($_POST['update_cart'])){
                                            foreach($_POST['updatecart'] as $update_id){
                                                $quantities = $_POST['qty'];
                                                $update_cart="update `cart_details` set quantity=$quantities where product_id=$update_id";
                                                $result_query = mysqli_query($con, $update_cart);
                                                $total_price=0;
                                                $cart_query="Select * from `cart_details`";
                                                $cart_result_query=mysqli_query($con, $cart_query);
                                                while ($cart_row_product=mysqli_fetch_array($cart_result_query)){
                                                    $cart_product_id = $cart_row_product["product_id"];
                                                    $cart_product_quantity= $cart_row_product["quantity"];
                                                    if($cart_product_quantity==0){
                                                        $cart_product_quantity=1;
                                                    }else{
                                                        $cart_product_quantity= $cart_product_quantity;
                                                    }
                                                    $search_product_price_query="Select * from `products` where product_id=$cart_product_id";
                                                    $result_query = mysqli_query($con, $search_product_price_query);
                                                    while ($result_row = mysqli_fetch_array($result_query)){
                                                        $price_item= $result_row["product_price"];
                                                        $total_price += $price_item*$cart_product_quantity;
                                                    }
                        
                                                }
                                                // echo "$total_price";
                                            }
                                            //bug here
                                        }

                                        ?>
                                        <td><p> <?php echo $productPrice ?></p></td>
                                        <td><input type='checkbox' name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                        <td>
                                            <!-- <button class='bg-info p-3 py-2 border-0 mx-3'>Update</button> -->
                                            <input type="submit" value="Update Cart" class='bg-info p-3 py-2 border-0 mx-3' name="update_cart">
                                            <!-- <button class='bg-info p-3 py-2 border-0 mx-3'>Remove</button> -->
                                            <input type="submit" value="Remove Cart" class='bg-info p-3 py-2 border-0 mx-3' name="remove_cart">
                                        </td>
                                    </tr>
                        <?php }}}
                        else{
                            echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                        }?>
                    </tbody>
                </table>
                <!-- subtotal --> 
                <div class="d-flex mb-4">
                    <?php
                    global $con;
                    $get_ip_add = getIPAddress();
                    $cart_query = "Select * from `cart_details` where ip_address='$get_ip_add'";
                    $result=mysqli_query($con, $cart_query);
                    $result_count = mysqli_num_rows($result);
                    if($result_count>0){
                        echo"<h4 class='px-3'>Subtotal: <strong class='text-info'> $total_price/-</strong></h4>
                        <input type='submit' value='Continue Shopping' class='bg-info p-3 py-2 border-0 mx-3' name='continue_shopping'>
                        <button class='bg-secondary p-3 py-2 border-0 text-light'><a href='./users_area/checkout.php' class='text-light text-decoration-none' >CheckOut</a></button>";
                    }else{
                        echo'<input type="submit" value="Continue Shopping"class="bg-info p-3 py-2 border-0 mx-3" name="continue_shopping">' ;
                    }
                    if(isset($_POST['continue_shopping'])){
                        echo"<script>window.open('index.php', '_self')</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
        </form>
        <!-- function to remove item -->
        <?php
        function remove_cart_item(){
            global $con;
            if(isset($_POST['remove_cart'])){
                foreach($_POST['removeitem'] as $remove_id){
                    echo $remove_id;
                    $delete_query="Delete from `cart_details` where product_id=$remove_id";
                    $run_delete = mysqli_query($con, $delete_query);
                    if($run_delete){
                        echo "<script>window.open('cart.php', '_self')</script>";
                    }
                }
            }
        }
        echo $remove_item=remove_cart_item();
        ?>
        <!-- last child -->
        <div class="bg-info p-3 tex-center">
            <p>All rights reserved @- Designed by Evan-2023</p>
        </div>

        <!-- bootstrap js link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
</body>

</html>