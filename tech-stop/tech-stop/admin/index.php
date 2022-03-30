<?php include ('partials/menu.php');?> 

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class= "wrapper">
                <h1>DASHBOARD</h1>
                <br><br>
                <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
                <div class="col-4 text-center">

                    <?php
                        //SQL Query
                        $sql = "SELECT * FROM tbl_category";

                        //Execute Query
                        $res = mysqli_query($conn, $sql);

                        //Count rows
                        $count = mysqli_num_rows($res);

                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br />
                    Categories
                </div>

                <div class="col-4 text-center">

                    <?php
                        //SQL Query
                        $sql = "SELECT * FROM tbl_tech";

                        //Execute Query
                        $res = mysqli_query($conn, $sql);

                        //Count rows
                        $count = mysqli_num_rows($res);

                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br />
                    Products
                </div>

                <div class="col-4 text-center">

                <?php
                    //SQL Query
                    $sql = "SELECT * FROM tbl_order";

                    //Execute Query
                    $res = mysqli_query($conn, $sql);

                    //Count rows
                    $count = mysqli_num_rows($res);

                ?>
                    <h1><?php echo $count; ?></h1>
                    <br />
                    Orders
                </div>

            <div class="clearfix"></div>

            </div>    
        </div>
        <!-- Main Content Section Ends -->

<?php include ('partials/footer.php');?> 
