<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Tech Stop</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

        <div class="login">
            <h1 class="text-center">Login</h1><br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>

            <br><br>

            <!-- Login Form Starts -->
            <form action="" method="POST" class="text-center">
            Username:
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password:
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>
            <!-- Login Form Ends -->
            <br><br>

            <p class="text-center">Created By Shannon Buglar </p>
        </div>

    </body>
</html>

<?php

    //Check whether submit is clicked or not
    if(isset($_POST['submit']))
    {
        //Process for login

        //Get data from form
       $username = $_POST['username'];
       $password = md5($_POST['password']);

       //SQL to check if user with username and password exists
       $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

       //Execute query
       $res = mysqli_query($conn, $sql);

       //Count rows to check if user exists or not
       $count = mysqli_num_rows($res);

       if($count==1)
       {
            //User available and login success
            $_SESSION['login'] = "<div class='success'>Login Success.</div>";
            $_SESSION['user'] = $username; //To check if user is logged in or out

            //Redirect to homepage/dashboard
            header('location:'.SITEURL.'admin/');
       }
       else 
       {
            //User available and login fail
            $_SESSION['login'] = "<div class='error'>User not found or Password is incorrect.</div>";

            //Redirect to homepage/dashboard
            header('location:'.SITEURL.'admin/login.php');
       }
    }

?>