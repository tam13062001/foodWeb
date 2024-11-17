<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>updated</h1>
        <br><br>

        <?php 

            // get id of admin selected
            $id =$_GET['id'];

            // create sql query to get the details
            $sql ="SELECT * FROM tbl_admin WHERE id =$id";

            // excute query
            $res = mysqli_query($conn,$sql);

            // check whether the query is excuted or not 
            if($res == true){
                // check whether date is available or not
                $count = mysqli_num_rows($res);
                if($count == 1){
                    // get detail;
                    $row =mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }else{
                    // redirect to manage admin page;
                    header('location'.SITEURL.'admin/manage-admin.php');
                }
            }
            else{

            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>"/>
                    </td>
                </tr>
                
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>"/>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 

     // check submit
     if(isset($_POST['submit'])){
        
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // create query to update admin
        $sql = "UPDATE tbl_admin SET 
        full_name = '$full_name',
        username = '$username' 
        WHERE id ='$id'
        ";

        // excute query
        $res = mysqli_query($conn,$sql);
        if($res == true){
            $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else {
            $_SESSION['update'] = "<div class='error'>Failed to update admin</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
     }      
            
?>

<?php include('partials/footer.php'); ?>