<?php include('partials-front/menu.php'); ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">

        <title>Categories</title>

        <h2 class="text-center">All Product Categories</h2>

        <?php
            //Create SQL Query to Display Categories
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' ";

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
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="products" class="img-responsive img-curve">

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

        </div>

        <div class="clearfix"></div>

    </section>
    <!-- Categories Section Ends Here -->
    
    <?php include('partials-front/footer.php');