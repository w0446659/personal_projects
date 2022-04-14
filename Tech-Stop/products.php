<?php include('partials-front/menu.php'); ?>

    <!-- Search Section Starts Here -->
    <section class="tech-search text-center">
        <div class="container">

        <title>Products</title>

        </div>
    </section>
    <!-- Search Section Ends Here -->



    <!-- Menu Section Starts Here -->
    <section class="tech-menu">
        <div class="container">
            <h2 class="text-center">All Products</h2>

            <?php

                //Create SQL Query to Display Categories
                $sql = "SELECT * FROM tbl_tech WHERE active='Yes' AND featured='Yes' LIMIT 6";

                //Execute Query
                $res = mysqli_query($conn, $sql);

                //Count rows to check category available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Categories Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get id, title, image
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];                        
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        $category = $row['category'];
                        ?>

                        <div class="tech-menu-box">
                            <div class="tech-menu-img">
                                <img src="<?php echo SITEURL; ?>images/techpics/<?php echo $image_name; ?>" alt="products" class="img-responsive img-curve">
                            </div>

                            <div class="tech-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="tech-price"><?php echo $price; ?></p>
                                <p class="tech-detail">
                                    <?php echo $description; ?>                                
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?tech_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //Not available
                    echo "<div class='error'>No Products?</div";
                }
            ?>
            </div>


            <div class="clearfix"></div>

        </div>

    </section>
    <!-- Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
