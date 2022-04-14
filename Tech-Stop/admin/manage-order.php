<?php include ('partials/menu.php');?> 
 
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class= "wrapper">
        <h1>Manage Orders</h1>
        <br />

        <?php

            if(isset($_SESSION['remove'])) 
            {
                echo $_SESSION['remove']; 
                unset($_SESSION['remove']); 

            }

            if(isset($_SESSION['update'])) 
            {
                echo $_SESSION['update']; 
                unset($_SESSION['update']); 

            }

            if(isset($_SESSION['delete'])) 
            {
                echo $_SESSION['delete']; 
                unset($_SESSION['delete']); 

            }

        ?>
        <br>
                
                <br /> <br />
 
                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
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

                        //Query to get orders
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
                                $id = $row['id'];
                                $tech = $row['tech'];
                                $price = $row['price'];
                                $qty = $row['qty']; 
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address']; 

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $tech; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>

                                        <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id; ?>" class="btn-danger">Cancel Order</a>
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
                                <td colspan="6"><div class="error">No Orders?</div></td>
                            </tr>
                            
                            <?php
                            
                        }

                    ?>


                </table>    
            </div>    
        </div>
        <!-- Main Content Section Ends -->

<?php include ('partials/footer.php');?> 