<?php include ('partials/menu.php');?> 

<div class="main-content">
    <div class= "wrapper">
        <h1>Add Product</h1>

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

        <!-- Add Tech Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Product Name">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="num" name="price" placeholder="Price of Product">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image"> 
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                //Query to get all the admins
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                //Execute Query
                                $res = mysqli_query($conn, $sql);

                                //Count rows
                                $count = mysqli_num_rows($res); //Function to get all the rows in database

                                if($count>0)
                                {
                                    //We have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //No categories
                                    ?>
                                    <option value="0">No Categories Found</option>
                                    <?php
                                }

                            ?>
                        </select>
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
                        <input type="submit" name="submit" value="Add Product" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Add Tech Form Ends -->

        <?php
            //Check whether the submit button sends
            if(isset($_POST['submit']))
            {
                //Get data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

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

                    //Check if image is selected and upload image if it is
                    if($image_name!="")
                    {
                        //Auto Rename our Image
                        //Get extension of image
                        $ext = end(explode('.', $image_name));

                        //Rename the image
                        $image_name = "Tech_Name_".rand(0000,9999).".".$ext; //e.g. Tech_Category_234.jpg
                    
                        //Get source path
                        $src = $_FILES['image']['tmp_name'];

                        //Get destination for upload
                        $dst = "../images/techpics/".$image_name;

                        //Upload image
                        $upload = move_uploaded_file($src, $dst);

                        //Check whether image uploaded or not
                        if($upload==false)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload photo.</div>";

                            //Redirect Page to Add category
                            header("location:".SITEURL.'admin/add-product.php');

                            //Stop process
                            die();
                        }
                    }
                }
                else
                {
                    //Don't upload image and set image_value name as blank
                    $image_name="";
                }

                //Create SQL Query to insert Category into database
                $sql2 = "INSERT INTO tbl_tech SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute SQL Query and save into database
                $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

                //Check if query executed or not
                if($res2==TRUE)
                {
                    //category inserted
                    $_SESSION['add'] = "<div class='success'>Product Added Successfully.</div>";
            
                    //Redirect Page to Manage category
                    header("location:".SITEURL.'admin/manage-product.php');
                }
                else
                {
                    //failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Product.</div>";
            
                    //Redirect Page to Add category
                    header("location:".SITEURL.'admin/add-product.php');
                }
            }

        ?>

    </div>
</div>

<?php include ('partials/footer.php');?> 
