<?php 

    //Check to see if user is logged in or not
    if(!isset($_SESSION['user'])) //if user is not set
    {
        //User is not logged in
        //Redirect to login with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to Access admin panel.</div>";

        //Redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }

?> 