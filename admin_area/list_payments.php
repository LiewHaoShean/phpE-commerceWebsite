<h3 class="text-center text-success">All Payments</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
            $get_payments="Select * from `user_payments`";
            $result=mysqli_query($con,$get_payments);
            $row_count=mysqli_num_rows($result);
            echo "
            <tr>
                <th>Sl No</th>
                <th>PaymentId</th>
                <th>Invoice Number</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Order Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>";

            if($row_count==0){
                echo "<h2 class='bg-danger text-center mt-5s'>No payments yet</h2>";
            }else{
                $number=0;
                while($row_data=mysqli_fetch_assoc($result)){
                    $invoice_id=$row_data['invoice_number'];
                    $payment_id=$row_data['payment_id'];
                    $amount=$row_data['amount'];
                    $payment_mode=$row_data['payment_mode'];
                    $order_date=$row_data['date'];
                    $number++;
                    echo "
                    <tr class='bg-secondary text-light'>
                        <td>$number</td>
                        <td>$payment_id</td>
                        <td>$invoice_id</td>
                        <td>$amount</td>
                        <td>$payment_mode</td>
                        <td>$order_date</td>
                        <td><a href='index.php?delete_payment=$payment_id' class='text-dark'><i class='fa-solid fa-trash'></i></a></td>
                    </tr>";
                }
            }
        ?>
    </tbody>
</table>