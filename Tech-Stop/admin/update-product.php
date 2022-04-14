<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Product</h1>

        <br><br>

        <?php
            //Get the ID of Category to be updated
            $id = $_GET['id'];

            //Create SQL Query to get the details from database
            $sql = "SELECT * FROM tbl_tech WHERE id=$id";

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
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $category = $row['category'];
                    $featured = $row['featured'];
                    $active = $row['active'];  
                }
                else
                {
                    //Redirect to Manage Admin Page
                    header('location:'.SITEURL.'admin/manage-product.php');
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
                        <td>Description: </td>
                        <td>
                            <input type="text" name="description" value="<?php echo $description; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="text" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <img src="<?php echo SITEURL; ?>images/techpics/<?php echo $image_name; ?>" width="150px">
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
                $description = $_POST['description'];
                $price = $_POST['price'];
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
                        $image_name = "Tech_Name_".rand(000, 999).'.'.$ext; //e.g. Tech_Name_234.jpg
                        
                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/techpics/".$image_name;

                        //Upload image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether image uploaded or not
                        if($upload==false)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to change photo.</div>";

                            //Redirect Page to Add category
                            header("location:".SITEURL.'admin/manage-product.php');

                            //Stop process
                            die();
                        }

                        //Remove old image
                        $remove_path = ".../images/techpics/".$current_image;

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

                //Create a SQL Query to Update Admin
                $sql2 = "UPDATE tbl_tech SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
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
                    //Query Executed and Product Updated
                    $_SESSION['update'] = "<div class='success'>Product Updated Successfully.</div>";

                    //Redirect Page to Manage Product
                    header("location:".SITEURL.'admin/manage-product.php');
                }
                else 
                {
                    //Failed to update Product
                    $_SESSION['update'] = "<div class='error'>Product Update Failed.</div>";

                    //Redirect Page
                    header("location:".SITEURL.'admin/manage-product.php');
                }
            }
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>