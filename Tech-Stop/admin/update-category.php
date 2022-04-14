<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php
            //Get the ID of Category to be updated
            $id = $_GET['id'];

            //Create SQL Query to get the details from database
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Check if query executed
            if($res==true) 
            {
                //Check if data is available or not
                $count = mysqli_num_rows($res);

                //Check if we have category data or not
                if($count==1)
                {
                    // Get details
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];  
                }
                else
                {
                    //Redirect to Manage Admin Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="150px">
                        </td>
                    </tr>

                    <tr>
                        <td>New Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if ($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if ($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if ($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes" > Yes
                            <input <?php if ($active=="No"){echo "checked";} ?> type="radio" name="active" value="No" > No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-primary">
                        </td>
                    </tr>
            </table>

        </form>

        <?php

            //Check whether submit is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";
                //Get all the values from form to update
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //Updating Image
                if(isset($_FILES['image']['name']))
                {
                    //Get image details
                    $image_name = $_FILES['image']['name'];

                    //Check if it is available or not
                    if($image_name != "")
                    {
                        //Image is available
                        //Upload new image

                        $ext = end(explode('.', $image_name));

                        //Rename the image
                        $image_name = "Tech_Category_".rand(000, 999).'.'.$ext; //e.g. Tech_Category_234.jpg
                        
                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Upload image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether image uploaded or not
                        if($upload==false)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to change photo.</div>";

                            //Redirect Page to Add category
                            header("location:".SITEURL.'admin/manage-category.php');

                            //Stop process
                            die();
                        }

                        //Remove old image
                        $remove_path = ".../images/category/".$current_image;

                        $remove = unlink($remove_path);
                    }
                    else
                    {
                        $image_name = $current_image; 
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                //Create a SQL Query to Update Category
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id= '$id'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether the query executed successfully or not
                if($res2==true)
                {
                    //Query Executed and Category Updated
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";

                    //Redirect Page to Manage Category
                    header("location:".SITEURL.'admin/manage-category.php');
                }
                else 
                {
                    //Failed to update Category
                    $_SESSION['update'] = "<div class='error'>Category Update Failed.</div>";

                    //Redirect Page
                    header("location:".SITEURL.'admin/manage-category.php');
                }
            }
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>