<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>

            <br><br>
            <!-- login start -->
             <form action="" method="POST" class="text-center">
                Username :<br>
                <input type="text" name="username" placeholder="Enter Username"> <br>
                <br>
                Password : <br>
                <input type="password" name="password" placeholder="Enter Password"><br>
                
                <br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
             </form>
             <br>
             <!-- login end -->
            <p class="text-center">Created By - <a href="https://github.com/tam13062001">TamDXT</a></p>
        </div>

    </body>
</html>

<?php 
    if(isset($_POST['submit'])){

        // get data from form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // sql to check whether the user with username and password
        $sql = "SELECT * FROM tbl_admin WHERE username ='$username' AND password ='$password'";

        // excute query
        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);
        if($count ==1){

            $_SESSION['login'] = "<div class ='success'> Login Success </div>";
            $_SESSION['user'] = $username;// check whether the user is logged in or not
            header('location:'.SITEURL.'admin/');

        }else{

            $_SESSION['login'] = "<div class ='error'> Username or Password not correct </div>";
            header('location:'.SITEURL.'admin/login.php');

        }
    }
?>