<?php include ('partials/menu.php');?> 
 
        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class= "wrapper">
                <h1>Manage Admin</h1>

                <br />

                <?php
                    if(isset($_SESSION['add'])) //Check if session is set or not
                    {
                        echo $_SESSION['add']; //Display System Message
                        unset($_SESSION['add']); //Remove Session Message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                ?>

                <br><br><br>

                <!-- Button to add admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                
                <br /> <br /> <br />
 
                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //Query to get all the admins
                        $sql = "SELECT * FROM tbl_admin";

                        //Execute Query
                        $res = mysqli_query($conn, $sql);

                        //Check if query executed
                        if($res==TRUE)
                        {
                            //Count Rounds
                            $rows = mysqli_num_rows($res); //Function to get all the rows in database

                            $sn=1; // create a variable and assign the value

                            //Check the num of rows
                            if($rows>0)
                            {
                                //we have data in database
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //Using while loop to get all data from database

                                    //Get individual data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Display the values in our table
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                            else
                            {
                                //we do not have data in database
                                ?>

                                <tr>
                                    <td colspan="6"><div class="error">No Admins?</div></td>
                                </tr>
                                
                                <?php
                            }
                        }

                    ?>

                </table>    
            </div>    
        </div>
        <!-- Main Content Section Ends -->

<?php include ('partials/footer.php');?> 