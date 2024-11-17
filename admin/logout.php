<?php 
     include('partials/menu.php');
    // detroy session
    session_destroy();

    // redirect to login page
    header('location:'.SITEURL.'admin/login.php');
?>