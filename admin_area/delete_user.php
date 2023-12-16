<?php
    if(isset($_GET['delete_user'])){
        $delete_id=$_GET['delete_user'];
        // echo $delete_id;
        //delete query

        $delete_query="Delete from `user_table` where user_id=$delete_id";
        $result_product=mysqli_query($con,$delete_query);
        if($result_product){
            echo "<script>alert('User deleted successfully')</script>";
            echo "<script>window.open('./index.php?view_users', '_self')</script>";
        };
    }
?>