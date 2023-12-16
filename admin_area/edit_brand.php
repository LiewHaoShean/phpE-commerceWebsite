<?php 
    if(isset($_GET['edit_brand'])){
        $brand_id=$_GET['edit_brand'];
        $select_brand_query = "Select * from `brands` where brand_id=$brand_id";
        $brand_result = mysqli_query($con, $select_brand_query);
        $brand = mysqli_fetch_assoc($brand_result);
        $brand_title=$brand["brand_title"];
    }

    if(isset($_POST["edit_brand"])){
        $edited_brand = $_POST["brand_title"];
        $edit_brand_query = "Update `brands` set brand_title='$edited_brand' where brand_id=$brand_id";
        $edit_brand_result = mysqli_query($con, $edit_brand_query);
        if ($edit_brand_query){
            echo "<script>alert('Brand edited successfully')</script>";
            echo "<script>window.open('./index.php?view_brands.php', '_self')</script>";
        }
    }
?>
<div class="container mt-3">
    <h1 class="text-center">Edit Brand</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label">Brand Title</label>
            <input type="text" name="brand_title" id="brand_title" class="form-control" required="required"  value="<?php echo $brand_title?>">
        </div>
        <input type="submit" value="Update Brand" class="btn btn-info px-3 mb-3" name="edit_brand">
    </form>
</div>