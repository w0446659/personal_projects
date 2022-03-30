<?php include ('partials/menu.php');?> 
 
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class= "wrapper">
        <h1>Manage Products</h1>
        <br /> <br />

                <!-- Button to add technology -->
                <a href="<?php echo SITEURL; ?>admin/add-product.php" class="btn-primary">Add Product</a>
                
                <br /><br /><br />

                <?php

                    if(isset($_SESSION['add'])) 
                    {
                        echo $_SESSION['add']; 
                        unset($_SESSION['add']);    
                    }

                    if(isset($_SESSION['delete'])) 
                    {
                        echo $_SESSION['delete']; 
                        unset($_SESSION['delete']);    
                    }

                ?>

                <br /> <br /> <br />
 
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                        //Query to get all the admins
                        $sql = "SELECT * FROM tbl_tech";

                        //Execute Query
                        $res = mysqli_query($conn, $sql);

                        //Count rows
                        $count = mysqli_num_rows($res); //Function to get all the rows in database

                        //Create serial Number variable
                        $sn=1;

                        //Check the num of rows
                        if($count>0)
                        {
                            //We have data in database
                            //Get data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $price; ?></td>


                                        <td>
                                            <?php 
                                                //Check if image is available
                                                if($image_name!="")
                                                {
                                                    //Display image
                                                    ?>

                                                    <img src="<?php echo SITEURL; ?>images/techpics/<?php echo $image_name; ?>" width="100px">

                                                    <?php
                                                }
                                                else
                                                {
                                                    //Display message
                                                    echo "<div class='error'>Image not added</div>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>

                                        <td>
                                        <a href="#" class="btn-secondary">Update Product</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-product.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Product</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                        else
                        {
                            //we do not have data in database
                            //Display message
                            ?>

                            <tr>
                                <td colspan="6"><div class="error">No Product Added/</div></td>
                            </tr>
                            
                            <?php
                            
                        }

                    ?>

                </table>    
            </div>    
        </div>
        <!-- Main Content Section Ends -->

<?php include ('partials/footer.php');?> 