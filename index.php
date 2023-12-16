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
    <title>Ecommerce Website using PHP and MySQL.</title>
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
                            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price: <?php total_cart_price();?>/-</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <!-- <button class="btn btn-outline-light" type="submit">Search</button> -->
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>
        <!-- calling caer function -->
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

        <!-- Fourth Child -->
        <div class="row">
            <div class="col-md-10">
                <!-- Products -->
                <div class="row">
                    <?php
                    getproducts();
                    get_unique_categories();
                    get_unique_brands();
                    // $ip = getIPAddress();  
                    // echo 'User Real IP Address - '.$ip;  


                    // $select_query="Select * from `products` order by rand() limit 0,6";
                    // $result_query=mysqli_query($con, $select_query);
                    // while($row=mysqli_fetch_assoc($result_query)){
                    //     $product_id=$row['product_id'];
                    //     $product_title=$row['product_title'];
                    //     $product_des=$row['product_description'];
                    //     $product_keywords=$row['product_keywords'];
                    //     $product_image1=$row['product_image1'];
                    //     $product_price=$row['product_price'];
                    //     $brand_id=$row['brand_id'];
                    //     echo "
                    //     <div class='col-md-4 mb-2'>
                    //     <div class='card' style='height:400px;'>
                    //         <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='...'>
                    //         <div class='card-body'>
                    //             <h5 class='card-title'>$product_title</h5>
                    //             <p class='card-text'>$product_des</p>
                    //             <a href='#' class='btn btn-info my-4'>Add to cart</a>
                    //             <a href='#' class='btn btn-secondary'>View more</a>
                    //         </div>
                    //     </div>
                    // </div>";
                    // }

                    ?>


                </div>
            </div>
            <div class="col-md-2 bg-secondary p-0">
                <!-- brand to be displayed -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light"><h4>Delivery Brand</h4></a>
                    </li>
                    <?php
                    getbrands();
                    // $select_brands="Select * from `brands`";
                    // $result_brands=mysqli_query($con, $select_brands);
                    // //$row_data=mysqli_fetch_assoc($result_brands);
                    // //echo $row_data['brand_title'];
                    // while($row_data=mysqli_fetch_assoc($result_brands)){
                    //     $brand_title=$row_data['brand_title'];
                    //     $brand_id=$row_data['brand_id'];
                    //     echo "<li class='nav-item'>
                    //     <a href='index.php?brand=$brand_id' class='nav-link text-light'><h4>$brand_title</h4></a>
                    // </li>";
                    // }
                    ?>
                    
                </ul>
                <!-- categories to be displayed -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
                    </li>
                    <?php
                    getcategories();
                    // $select_categories="Select * from `categories`";
                    // $result_categories=mysqli_query($con, $select_categories);
                    // while($row_data_cat=mysqli_fetch_assoc($result_categories)){
                    //     $category_title=$row_data_cat['category_title'];
                    //     $category_id=$row_data_cat['category_id'];

                    //     echo "<li class='nav-item'>
                    //     <a href='index.php?category=$category_id' class='nav-link text-light'><h4>$category_title</h4></a>
                    // </li>";
                    // }
                    ?>
                </ul>
            </div>
        </div>
        <!-- last child -->
        <div class="bg-info p-3 text-center">
            <p>All rights reserved @- Designed by Evan-2023</p>
        </div>

        <!-- bootstrap js link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
</body>

</html>