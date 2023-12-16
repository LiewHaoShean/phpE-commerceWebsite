<?php
include("../includes/connect.php");
include("../functions/common_function.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        .admin_image {
            width: 100px;
            object-fit: contain;
        }
        .footer {
            position: absolute;
            bottom: 0;
        }
        .body {
            overflow-x: hidden;
        }
        .product_img{
            width: 200px;
            height: 200px;
            object-fit: contain;
        }
        .edit_img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <!-- bootstrap js link -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-exapand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/logo.png" alt="" class="logo">
                <nav class="navbar navbar-exapand-lg ">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link">Welcome Guest</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
        <!-- second child -->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>
        <!-- third child -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3">
                    <a href="#"><img src="../images/admin.jpeg" alt="" class="admin_image"></a>
                    <p class="text-light text-center">Admin Name</p>
                </div>
                <div class="button text-center">
                    <button class="my-3 mx-3"><a href="insert_product.php" class="nav-link text-light bg-info my-1 mx-3">Insert Products</a></button>
                    <button class="my-3 mx-3"><a href="index.php?view_products" class="nav-link text-light bg-info my-1 mx-3">View Products</a></button>
                    <button class="my-3 mx-3"><a href="index.php?insert_categories" class="nav-link text-light bg-info my-1 mx-3">Insert Categories</a></button>
                    <button class="my-3 mx-3"><a href="index.php?view_categories" class="nav-link text-light bg-info my-1 mx-3">View Categories</a></button>
                    <button class="my-3 mx-3"><a href="index.php?insert_brands" class="nav-link text-light bg-info my-1 mx-3">Insert Brands</a></button>
                    <button class="my-3 mx-3"><a href="index.php?view_brands" class="nav-link text-light bg-info my-1 mx-3">View Brands</a></button>
                    <button class="my-3 mx-3"><a href="index.php?list_orders" class="nav-link text-light bg-info my-1 mx-3">All orders</a></button>
                    <button class="my-3 mx-3"><a href="index.php?list_payments" class="nav-link text-light bg-info my-1 mx-3">All payment</a></button>
                    <button class="my-3 mx-3"><a href="index.php?view_users" class="nav-link text-light bg-info my-1 mx-3">List users</a></button>
                    <button class="my-3 mx-3"><a href="" class="nav-link text-light bg-info my-1 mx-3">Logout</a></button>
                </div>
            </div>
        </div>

        <!-- fourth child -->
        <div class="container my-3">
            <?php
            if(isset($_GET['insert_categories'])){
                include('insert_categories.php');
            }
            if(isset($_GET['insert_brands'])){
                include('insert_brands.php');
            }
            if(isset($_GET['view_products'])){
                include('view_products.php');
            }
            if(isset($_GET['edit_products'])){
                include('edit_products.php');
            }
            if(isset($_GET['delete_product'])){
                include('delete_product.php');
            }
            if(isset($_GET['view_categories'])){
                include('view_categories.php');
            }
            if(isset($_GET['view_brands'])){
                include('view_brands.php');
            }
            if(isset($_GET['edit_category'])){
                include('edit_category.php');
            }
            if(isset($_GET['edit_brand'])){
                include('edit_brand.php');
            }
            if(isset($_GET['delete_category'])){
                include('delete_category.php');
            }
            if(isset($_GET['delete_brand'])){
                include('delete_brand.php');
            }
            if(isset($_GET['list_orders'])){
                include('list_orders.php');
            }
            if(isset($_GET['delete_order'])){
                include('delete_order.php');
            }
            if(isset($_GET['list_payments'])){
                include('list_payments.php');
            }
            if(isset($_GET['delete_payment'])){
                include('delete_payment.php');
            }
            if(isset($_GET['view_users'])){
                include('view_users.php');
            }
            if(isset($_GET['delete_user'])){
                include('delete_user.php');
            }
            ?>
        </div>

    </div>
    <!-- last child -->
    <div class="bg-info p-3 text-center">
        <p>All rights reserved @- Designed by Evan-2023</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>