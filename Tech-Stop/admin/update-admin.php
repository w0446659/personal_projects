<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
            //Get the ID of Admin to be updated
            $id = $_GET['id'];

            //Create SQL Query to get the details from database
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Check if query executed
            if($res==true) 
            {
                //Check if data is available or not
                $count = mysqli_num_rows($res);

                //Check if we have admin data or not
                if($count==1)
                {
                    // Get details
                    //echo "Admin Available";
                    $row = mysqli_fetch_assoc($res);
                
                    $full_name = $row['full_name'];
                    $username = $row['username'];   
                }
                else
                {
                    //Redirect to Manage Admin Page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php

    //Check whether submit is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Create a SQL Query to Update Admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id= '$id'
        ";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";

            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else 
        {
            //Failed to update Admin
            $_SESSION['update'] = "<div class='error'>Admin Update Failed.</div>";

            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php'); ?>