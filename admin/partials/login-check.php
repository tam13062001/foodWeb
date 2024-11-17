<?php 

// Authentication and Access Control
// check whether the user is logged in or not
    if(!isset($_SESSION['user']))
    {
        $_SESSION['no-login-message'] = "<div class='error text-center'> login to access Admin panel </div>";
        header('location:'.SITEURL.'admin/login.php');
    }

?>