<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1> Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">

                <tr>
                    <td>Current Password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Enter your current password">
                    </td>
                </tr>

                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="Enter your new password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">

                        <input type="submit" name="submit" value="change password">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php 

            // check submit
    if(isset($_POST['submit'])){


        // get data from form

            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);
        // check whether the user with current id and current password exists or not 
            $sql = "SELECT * FROM tbl_admin WHERE id =$id AND password = '$current_password'";

            $res = mysqli_query($conn,$sql);
            if($res == true){
                $count = mysqli_num_rows($res);
                if($count ==1){
                    
                    // check new password and confirm are match or not
                    if($new_password == $confirm_password){

                        // update new password
                        $sql2 = "UPDATE tbl_admin SET 
                        password = '$new_password' 
                        WHERE id =$id";

                        $res2 = mysqli_query($conn,$sql2);

                        if($res2 == true){

                            $_SESSION['change-pwd']="<div class='success'>Password change successfully</div>";

                            header('location :'.SITEURL.'admin/manage-admin.php');

                        }
                        else{
                            $_SESSION['change-pwd']="<div class='error'>Failed to change Password</div>";

                            header('location :'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        $_SESSION['pwd-not-patch']="<div class='error'>Password did NOT patch</div>";
                        header('location :'.SITEURL.'admin/manage-admin.php');
                    }   
                }else {
                    $_SESSION['user-not-found']="<div class='error'>Failed to change password</div>";
                    header('location :'.SITEURL.'admin/manage-admin.php');
                }
            }
        // check whether the new password and confirm password match or not 

        // change password if all above is true;
    }

?>

<?php include('partials/footer.php'); ?>