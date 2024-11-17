<?php 
    // start session
    session_start();
    // create constants to store non repeating values
    define('SITEURL','http://localhost/WEBFOOD/');
    define('LOCALHOST','locahost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');
    
    $conn = mysqli_connect('localhost',DB_USERNAME,DB_PASSWORD) ;//database connection

    $db_select = mysqli_select_db($conn,DB_NAME);//selecting database
?>