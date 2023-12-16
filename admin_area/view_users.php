<h3 class="text-center text-success">All Users</h3>
<style>
    .product_img{
        height: 150px;
        width: 150px;
    }
</style>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
            $get_users="Select * from `user_table`";
            $result=mysqli_query($con,$get_users);
            $row_count=mysqli_num_rows($result);
            echo "
            <tr>
                <th>Sl No</th>
                <th>Username</th>
                <th>User email</th>
                <th>User Image</th>
                <th>User Address</th>
                <th>User Mobile</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>";

            if($row_count==0){
                echo "<h2 class='bg-danger text-center mt-5s'>No Users yet</h2>";
            }else{
                $number=0;
                while($row_data=mysqli_fetch_assoc($result)){
                    $user_id= $row_data["user_id"];
                    $username=$row_data['username'];
                    $user_email=$row_data['user_email'];
                    $user_image=$row_data['user_image'];
                    $user_address=$row_data['user_address'];
                    $user_mobile=$row_data['user_mobile'];
                    $number++;
                    echo "
                    <tr class='bg-secondary text-light'>
                        <td>$number</td>
                        <td>$username</td>
                        <td>$user_email</td>
                        <td><img src='../users_area/user_images/$user_image' class='product_img'/></td>
                        <td>$user_address</td>
                        <td>$user_mobile</td>
                        <td><a href='index.php?delete_user=$user_id' class='text-dark'><i class='fa-solid fa-trash'></i></a></td>
                    </tr>";
                }
            }
        ?>
    </tbody>
</table>