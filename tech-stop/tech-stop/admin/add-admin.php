<?php include ('partials/menu.php');?> 

<div class="main-content">
    <div class= "wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
         if(isset($_SESSION['add'])) //Check if session is set or not
            {
                echo $_SESSION['add']; //Display System Message
                unset($_SESSION['add']); //Remove Session Message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter Username"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>    

<?php include ('partials/footer.php');?> 

<?php

    //Check whether the submit button sends
    if(isset($_POST['submit']))
    {
        //Get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption

        //SQL Query to save into database
        $sql="INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        //Execute Query and save into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //Check if query executed or not
        if($res==TRUE)
        {
            //data inserted
            //echo "Data Inserted";

            //Create a session variable to display message
            $_SESSION['add'] = "Admin Added Successfully";
            
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //failed to isnert data
            //echo "Failed to Insert data";

            //Create a session variable to display message
            $_SESSION['add'] = "Failed to Add Admin";
            
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }

?>