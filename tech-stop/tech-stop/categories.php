<?php include('partials-front/menu.php'); ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
        <h2 class="text-center">Product Categories</h2>

        <?php
            //Create SQL Query to Display Categories
            $sql = "SELECT * FROM tbl_category";

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
                echo "<div class='error'>Category not found.</div";
            }
        ?>

        </div>

        <div class="clearfix"></div>

    </section>
    <!-- Categories Section Ends Here -->
    
    <?php include('partials-front/footer.php');