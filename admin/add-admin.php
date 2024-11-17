<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        
        <br /><br />
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Full Name"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter Username"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
    // process the value from form and save it in database
    // check wheter the submit button is clicked or not

    if(isset($_POST['submit'])){

        // get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // password envrytion with MD5

        // query sql to save data to database
        $sql ="INSERT INTO tbl_admin SET 
        full_name='$full_name',
        username='$username',
        password='$password'
        ";
        
        // execute query and save data in database
        $res = mysqli_query($conn, $sql) ;

        // check whether the (query is exected) data is inserted or not and display appropriate message
        if($res == true){
            // data inserted
            
            // create a session variable to display message
            $_SESSION['add'] = "Admin added successfully";
            // Redirect Page to Manage admin
            header("location:".SITEURL.'admin/manage-admin.php');

        }
        else{
            // create a session variable to display message
            $_SESSION['add'] = "Admin added failed";
            // Redirect Page to Manage admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }

?>