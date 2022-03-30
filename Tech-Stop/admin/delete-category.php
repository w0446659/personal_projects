<?php 

    //Include Constants File
    include('../config/constants.php');

    //Check if the id and image_name value is set or not
    if(isset($_GET['id']) AND isset ($_GET['image_name']))
    {
        //Get the value and delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file
        if($image_name != "")
        {
            //Image is available and remove it
            $path = "../images/category/".$image_name;

            //Remove image
            $remove = unlink($path);

            //If it fails, add error message
            if($remove==false)
            {
                //Set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                //Redirect to Manage Category Page
                header("location:".SITEURL.'admin/manage-category.php');
                //Stop the process
                die();
            }
        }

        //Create SQL Query
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query executed successfully
            //echo "Admin Deleted";

            //Create session variable to display message
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";

            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Create session variable to display message
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category. Try Again.</div>";

            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }
    else
    {
        //redirect to Manage Category Page
        header("location:".SITEURL.'admin/manage-category.php');
    }
?> 