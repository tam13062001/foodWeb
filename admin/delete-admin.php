<?php 
// include constants.php 
    include('../config/constants.php'); 

// get id of admin to be deleted
    $id = $_GET['id'];

// create sql query to deleted admin
    $sql = "DELETE FROM tbl_admin WHERE id =$id";

// excute query
    $res = mysqli_query($conn, $sql);

// check whether the query excuted successfully or not
if($res == true){
    // create session variable to display maessage
    $_SESSION['delete'] = "<div class='success'> Admin deleted successfully. </div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else {
    $_SESSION['delete'] = "<div class='error'>Failed to deleted admin.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

// redirect to manage admin page with message    
?>