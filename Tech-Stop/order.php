<?php include('partials-front/menu.php'); ?>

    <?php
        //Check if product is set or not
        if(isset($_GET['tech_id']))
        {
            //Get product id and details of it
            $tech_id = $_GET['tech_id'];

            //Get details
            $sql = "SELECT * FROM tbl_tech WHERE id=$tech_id";
                            
            //Execute Query
            $res = mysqli_query($conn, $sql);

            //Count rows to check category available or not
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //We have data
                //Get data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //Redirect to home page
                header('location:'.SITEURL);
            }
        }
        else
        {
            //Redirect to home page
            header('location:'.SITEURL);
        }

    ?>

    <!-- Search Section Starts Here -->
    <section class="tech-search">

    <title>Order Form</title>

        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Product</legend>

                    <div class="tech-menu-img">
                        <img src="<?php echo SITEURL; ?>images/techpics/<?php echo $image_name; ?>" alt="Phone" class="img-responsive img-curve">
                    </div>
    
                    <div class="tech-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="tech" value="<?php echo $title; ?>">

                        <p class="tech-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. John Doe" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 555-555-5555" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. john123@none.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-secondary text-center">
                </fieldset>

            </form>

            <?php

            //Check whether the submit button sends
            if(isset($_POST['submit']))
            {
                //Get data from form
                $tech = $_POST['tech'];
                $price = $_POST['price'];
                $qty = $_POST['qty']; 

                $total = $price * $qty; // total = price x qty

                $order_date = date("Y-m-d h:i:sa"); // order date

                $status = "Ordered"; // Order Status

                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address']; 
 
                //SQL Query to save into database
                $sql2="INSERT INTO tbl_order SET
                    tech = '$tech',
                    price = '$price',
                    qty = '$qty',
                    total = '$total',
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'

                ";

                //Execute Query and save into database
                $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

                //Check if query executed or not
                if($res2==TRUE)
                {
                    //Create a session variable to display message
                    $_SESSION['order'] = "<div class='success text-center'>Product Ordered Successfully</div>";
            
                    //Redirect Page
                    header("location:".SITEURL);
                }
                else
                {
                    //Create a session variable to display message
                    $_SESSION['order'] = "Failed to Order Product";
            
                    //Redirect Page
                    header("location:".SITEURL);
                }

            }

            ?>

        </div>
    </section>
    <!-- Search Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
