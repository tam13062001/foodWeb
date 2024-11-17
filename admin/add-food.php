<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1> Add Food</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
        ?>
        <br><br>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title : </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter the title">
                    </td>
                </tr>
                
                <tr>
                    <td>Description </td>
                    <td>
                        <textarea name="description" placeholder="Description of the Food" rows="5" cols="30"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" >
                            <?php   
                                // create php code to display vategories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count > 0){
                                    while($row = mysqli_fetch_assoc($res))
                                    {

                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else{
                                    ?>
                                        <option value="0">No  Category Found</option>
                                    <?php
                                }
                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured : </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active : </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])){

                // get value from form 
                $title = $_POST['title'];
                $description =$_POST['description'];
                $price =$_POST['price'];
                $category = $_POST['category'];

                // for radio input, need check the button is selected or not
                if(isset($_POST['featured'])){

                    $featured = $_POST['featured'];

                }
                else{

                    $featured = "No";

                }
                if(isset($_POST['active'])){

                    $active = $_POST['active'];

                }
                else{

                    $active = "No";

                }

                // check image is selected or not and set the value for image name accoridingly
                if(isset($_FILES['image']['name']))
                {
                    // upload image
                    $image_name = $_FILES['image']['name'];

                    // upload the image only if image is seleceted
                    if($image_name != "")
                    {
                   
                    // auto rename our image
                    // get the extensions of our image(jpg,png,gif,etc) 
                    $ext = end(explode('.',$image_name));

                    // rename image
                    $image_name = "food-name".rand(000,999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path= "../images/food/".$image_name;

                    $upload = move_uploaded_file($source_path,$destination_path);

                    // if the image is not uploaded then we will stop the proccess and redirect with error message
                    if($upload == false){
                        $_SESSION['upload'] = "<div class='error'> upload image failed</div>";
                        header('location:'.SITEURL.'admin/add-category.php');

                        // stop process
                        die();
                        }

                    }
                }
                else{
                    // dont upload image and set the image_name value as blank
                    $image_name="";
                }

                $sql2 = "INSERT INTO tbl_food SET 
                        title ='$title',
                        description = '$description',
                        price = '$price',
                        Image_name='$image_name',
                        category_id ='$category',
                        featured = '$featured',
                        active = '$active'";
                
                $res2 = mysqli_query($conn,$sql2);

                if($res2 == true){

                    $_SESSION['add'] = "<div class='success'> Food added successfullt</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else {
                    $_SESSION['add'] = "<div class='error'> Food added failed</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        ?>
                
    </div>    
</div>

<?php include('partials/footer.php');?>