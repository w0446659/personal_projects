<?php include('partials-front/menu.php'); ?>

    <!-- Search Section Starts Here -->
    <section class="tech-search text-center">
        <div class="container">
            
            
            <form action="tech-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Products.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Search Section Ends Here -->

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order']; 
            unset($_SESSION['order']); 
        }
    ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Some of our Products</h2>

            <?php
                //Create SQL Query to Display Categories
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

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

                        <a href="category-tech.php">
                        <div class="box-3 float-container">
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Laptops" class="img-responsive img-curve">

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //Not available
                    echo "<div class='error'>Category not found.</div";
                }
            ?>
        </div>

        <div class="clearfix"></div>

    </section>
    <!-- Categories Section Ends Here -->


    <!-- Menu Section Starts Here -->
    <section class="tech-menu">
        <div class="container">
            <h2 class="text-center">Product List</h2>

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
                        ?>

                        <div class="tech-menu-box">
                            <div class="tech-menu-img">
                                <img src="images/keyboards/tech-keyboard-2.jpg" alt="products" class="img-responsive img-curve">
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
                    echo "<div class='error'>Product not found.</div";
                }
            ?>

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="products.php">See All Products</a>
        </p>
    </section>
    <!-- Menu Section Ends Here -->

    <?php include('partials-front/footer.php');