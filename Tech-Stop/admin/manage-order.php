<?php include ('partials/menu.php');?> 
 
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class= "wrapper">
        <h1>Manage Category</h1>
        <br /> <br />

        <?php

            if(isset($_SESSION['remove'])) 
            {
                echo $_SESSION['remove']; 
                unset($_SESSION['remove']); 

            }

            if(isset($_SESSION['delete'])) 
            {
                echo $_SESSION['delete']; 
                unset($_SESSION['delete']); 

            }

        ?>
        <br><br>

                <!-- Button to add category -->
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
                
                <br /> <br /> <br />
 
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>QTY.</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>

                    </tr>

                    <?php

                        //Query to get all the admins
                        $sql = "SELECT * FROM tbl_order";

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
                                //Get data from form
                                $id = $_row['id'];
                                $tech = $_row['tech'];
                                $price = $_row['price'];
                                $qty = $_row['qty']; 
                                $total = $_row['total'];
                                $order_date = $_row['order_date'];
                                $status = $_row['status'];
                                $customer_name = $_row['customer_name'];
                                $customer_contact = $_row['customer_contact'];
                                $customer_email = $_row['customer_email'];
                                $customer_address = $_row['customer_address']; 

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $tech; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $order_date; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>

                                        <td>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                        </td>
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