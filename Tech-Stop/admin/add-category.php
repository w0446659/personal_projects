<?php include ('partials/menu.php');?> 

<div class="main-content">
    <div class= "wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php

            if(isset($_SESSION['add'])) 
            {
                echo $_SESSION['add']; 
                unset($_SESSION['add']); 
            }

            if(isset($_SESSION['upload'])) 
            {
                echo $_SESSION['upload']; 
                unset($_SESSION['upload']); 
            }

        ?>

        <br><br>

        <!-- Add Category Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image"> 
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" > Yes
                        <input type="radio" name="active" value="No" > No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Add Category Form Ends -->

        <?php
            //Check whether the submit button sends
            if(isset($_POST['submit']))
            {
                //Get data from form
                $title = $_POST['title'];

                //For radio input, check if button is selected or not
                if(isset($_POST['featured']))
                {

                    //Get value from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Set default value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    //Set default value
                    $active = "No";
                }

                //Check if image is selected or not and the value for image name
                //print_r($_FILES['image']);

                //die(); //Break code here

                if(isset($_FILES['image']['name']))
                {
                    //Upload the Image. We need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    //Auto Rename our Image
                    //Get extension of image
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
                        $_SESSION['upload'] = "<div class='error'>Failed to upload photo.</div>";

                        //Redirect Page to Add category
                        header("location:".SITEURL.'admin/add-category.php');

                        //Stop process
                        die();
                    }
                }
                else
                {
                    //Don't upload image and set image_value name as blank
                    $image_name="";
                }

                //Create SQL Query to insert Category into database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //Execute SQL Query and save into database
                $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                //Check if query executed or not
                if($res==TRUE)
                {
                    //category inserted
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
            
                    //Redirect Page to Manage category
                    header("location:".SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
            
                    //Redirect Page to Add category
                    header("location:".SITEURL.'admin/add-category.php');
                }
            }

        ?>

    </div>
</div>

<?php include ('partials/footer.php');?> 
