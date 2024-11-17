<?php 
// include constants.php 
    include('../config/constants.php'); 

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            $path = "../images/food/".$image_name;

            $remove = unlink($path);

            if($remove == false){
                $_SESSION['remove'] = "<div class='error'> Failed to remove category image. </div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }
    }

// create sql query to deleted admin
    $sql = "DELETE FROM tbl_food WHERE id =$id";

// excute query
    $res = mysqli_query($conn, $sql);

// check whether the query excuted successfully or not
if($res == true){
    // create session variable to display maessage
    $_SESSION['delete'] = "<div class='success'> Food deleted successfully. </div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}
else {
    $_SESSION['delete'] = "<div class='error'>Failed to deleted Food.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

  
?>