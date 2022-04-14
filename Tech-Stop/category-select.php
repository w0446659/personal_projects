<?php include('partials-front/menu.php'); ?>

    <section class="tech-search text-center">
        <div class="container">

        <title>Category Results</title>

        </div>
    </section>

    <?php
        if(isset($_GET['category_id']))
        {
            //Category ID set and taken
            $category_id = $_GET['category_id'];

            //Get category based on ID to get products
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            //Execute Query
            $res = mysqli_query($conn, $sql);

            //Get value from database
            $row = mysqli_fetch_assoc($res);

            //Get title
            $category_title = $row['title'];
        }
        else
        {
            //Redirect to site if it doesn't go through
            header('location:'.SITEURL);
        }
    ?>

    <!-- Menu Section Starts Here -->
    <section class="tech-menu">
        <div class="container">
            <h2 class="text-center"><?php echo $category_title; ?> </h2>

            <?php

                //Create SQL Query to Display
                $sql2 = "SELECT * FROM tbl_tech WHERE category_id=$category_id";

                //Execute Query
                $res2 = mysqli_query($conn, $sql2);

                //Count rows to check if available or not
                $count2 = mysqli_num_rows($res2);

                if($count2>0)
                {
                    //Categories Available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        //Get id, title, image
                        $title = $row2['title'];
                        $price = $row2['price'];                        
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
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
