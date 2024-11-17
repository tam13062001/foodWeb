<?php include('partials/menu.php'); ?>

        <!-- Main Content section starts -->
         <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>

                <br />
                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];// display message
                        unset($_SESSION['add']);// remove message
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];// display message
                        unset($_SESSION['delete']);// remove message
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];// display message
                        unset($_SESSION['update']);// remove message
                    }

                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];// display message
                        unset($_SESSION['user-not-found']);// remove message
                    }

                    if(isset($_SESSION['pwd-not-patch'])){
                        echo $_SESSION['pwd-not-patch'];// display message
                        unset($_SESSION['pwd-not-patch']);// remove message
                    }

                    if(isset($_SESSION['change-pwd'])){
                        echo $_SESSION['change-pwd'];// display message
                        unset($_SESSION['change-pwd']);// remove message
                    }
                ?>
                <br /><br /><br />
                
                <!-- button to Add Admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br /><br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                    
                    <?php 
                        $sql = "SELECT * FROM tbl_admin";

                        $res = mysqli_query($conn, $sql);


                            // count rows to check whether we have data in database or not 
                            $rowcount = mysqli_num_rows($res);
                            $sn =1;
                            if($rowcount > 0){
                                while($rows = mysqli_fetch_assoc($res)){

                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];

                                    // display data in tables
                                    ?>

                                        <tr>
                                            <td><?php echo $sn++ ?></td>
                                            <td><?php echo $full_name ?></td>
                                            <td><?php echo $username ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                                <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            </td>
                                        </tr>

                                    <?php 
                                    
                                    
                                    
                                }
                            }                       
                    ?>

                    
                </table>
                
            </div>            
         </div>
        <!-- Main Content starts -->
        
<?php include('partials/footer.php'); ?>