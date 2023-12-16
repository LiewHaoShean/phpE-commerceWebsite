<?php
    if(isset($_GET['delete_payment'])){
        $delete_payment_id=$_GET['delete_payment'];
        
    }

    $delete_qeury="Delete from `user_payments` where payment_id=$delete_payment_id";
        $result=mysqli_query($con,$delete_qeury);
        if($result){
            echo "<script>alert('Payment deleted successfully')</script>";
            echo "<script>window.open('./index.php?list_payments', '_self')</script>";
        }
?>