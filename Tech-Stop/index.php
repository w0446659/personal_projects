<?php include('partials-front/menu.php'); ?>

    <section class="tech-search text-center">
        <div class="container">

        <title>Home</title>

        </div>
    </section>

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order']; 
            unset($_SESSION['order']); 
        }
    ?>

    <?php

    ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Search per Category</h2>

            <?php
                //Create SQL Query to Display Categories
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 6";

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
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-select.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="categories" class="img-responsive img-curve">

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //Not available
                    echo "<div class='error'>No Categories?</div";
                }
            ?>
 <br ><br ><br ><br ><br ><br ><br ><br ><br ><br >

        </div>

        <div class="clearfix"></div>

    </section>
    <!-- Categories Section Ends Here -->


    <!-- Menu Section Starts Here -->
    <section class="tech-menu">
        <div class="container">
            <h2 class="text-center">Sample Products</h2>

            <?php

                $sql = "SELECT * FROM tbl_tech WHERE active='Yes' AND featured='Yes' LIMIT 4";

                //Execute Query
                $res = mysqli_query($conn, $sql);

                //Count rows to check if available or not
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
                        ?>

                        <div class="tech-menu-box">
                            <div class="tech-menu-img">
                            <img src="<?php echo SITEURL; ?>images/techpics/<?php echo $image_name; ?>" alt="Laptops" class="img-responsive img-curve">                            </div>

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

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- Menu Section Ends Here -->

    <?php include('partials-front/footer.php');