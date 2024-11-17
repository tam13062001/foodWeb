<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1> Update Category</h1>
        <br><br>

        <?php 
        
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_category WHERE id =$id";
                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);
                if($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['Image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
            }
            else
            {
                $_SESSION['no-category-found'] ="<div class='error'> Category not found.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title : </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>" width="100px" alt="">
                                <?php
                            }else
                            {
                                echo "<div class='error'> Image Not Added</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured : </td>
                    <td>
                        <input <?php if($featured=="Yes") echo "checked";?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No") echo "checked";?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active : </td>
                    <td>
                        <input <?php if($active=="Yes") echo "checked"; ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No") echo "checked"; ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php $current_image ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    <?php
        if(isset($_POST['submit']))
        {
            $title = $_POST['title'];
            $current_image = $_POST['Image_name'];
            $featured =$_POST['featured'];
            $active =$_POST['active'];

            // update new image
            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];

                if($image_name != "")
                {
                    $ext = end(explode('.',$image_name));

                    // rename image
                    $image_name = "food_category_".rand(000,999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path= "../images/category/".$image_name;

                    $upload = move_uploaded_file($source_path,$destination_path);

                    // if the image is not uploaded then we will stop the proccess and redirect with error message
                    if($upload == false){
                        $_SESSION['upload'] = "<div class='error'> upload image failed</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');

                        // stop process
                        die();
                        }
                    // remove current image
                    if($current_image != "")
                    {
                        $remove_path = "../images/category/".$current_image;

                        $remove = unlink($remove_path);

                        if($remove == false)
                        {
                            $_SESSION['failed-remove'] = "<div class='error'> Failed to remove current image. </div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }
                    }
                    
                }else{
                    $image_name = $current_image;
                }
            }else{
                $image_name = $current_image;
            }
            // update new db
                $sql2 = "UPDATE tbl_category SET 
                title ='$title',
                Image_name='$image_name',
                featured ='$featured',
                active ='$active' 
                WHERE id =$id
                ";

                $res2 = mysqli_query($conn,$sql2);
                if($res2 == true){
                    $_SESSION['update'] ="<div class='success'> Update successfully </div>";
                    header('location:'.SITEURL.'admin/manage-category.php');

                }else{
                    $_SESSION['update'] ="<div class='error'> Update failed </div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

        }
    ?>
                
    </div>    
</div>

<?php include('partials/footer.php');?>