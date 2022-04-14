<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <br><br>

        <?php
            //Get the ID of Order to be updated
            $id = $_GET['id'];

            //Create SQL Query to get the details from database
            $sql = "SELECT * FROM tbl_order WHERE id=$id";

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
                    $tech = $row['tech'];
                    $price = $row['price'];
                    $qty = $row['qty']; 
                    $total = $row['total'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];  
                }
                else
                {
                    //Redirect to Manage Admin Page
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                    <tr>
                        <td>Product: </td>
                        <td>
                            <input type="text" name="tech" value="<?php echo $tech; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Price (CAD): </td>
                        <td>
                            <input type="text" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Quantity </td>
                        <td>
                            <input type="text" name="qty" value="<?php echo $qty; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Status </td>
                        <td>
                            <input type="text" name="status" value="<?php echo $status; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name </td>
                        <td>
                            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Contact (#) </td>
                        <td>
                            <input type="tel" name="customer_contact" value="<?php echo $customer_contact; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Email </td>
                        <td>
                            <input type="email" name="customer_email" value="<?php echo $customer_email; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Address </td>
                        <td>
                            <input type="text" name="customer_address" value="<?php echo $customer_address; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Order" class="btn-primary">
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
                $tech = $_POST['tech'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty; // total = price x qty
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];   

                //Create a SQL Query to Update Admin
                $sql2 = "UPDATE tbl_order SET
                    tech = '$tech',
                    price = '$price',
                    qty = '$qty',
                    total = '$total',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id= '$id'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether the query executed successfully or not
                if($res2==true)
                {
                    //Query Executed and Order Updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";

                    //Redirect Page to Manage Order
                    header("location:".SITEURL.'admin/manage-order.php');
                }
                else 
                {
                    //Failed to update Order
                    $_SESSION['update'] = "<div class='error'>Order Update Failed.</div>";

                    //Redirect Page
                    header("location:".SITEURL.'admin/manage-order.php');
                }
            }
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>