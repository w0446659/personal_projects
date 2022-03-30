<?php

    //include constants.php file
    include('../config/constants.php');

    //Get the ID of Admin to be deleted
    $id = $_GET['id'];

    //Create SQL Query
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if($res==true)
    {
        //Query executed successfully
        //echo "Admin Deleted";

        //Create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";

        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else
    {
        //Failed to delete Admin
        //echo "Failed to delete admin";

        //Create session variable to display message
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again.</div>";

        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>