<?php
        //Start session 
        session_start();

        //Constants
        define('SITEURL', "http://localhost/tech-stop/");
        define('LOCALHOST', "localhost:3306");
        define('DB_USERNAME', "root");
        define('DB_PASSWORD', "");
        define('DB_NAME', "tech-stop");

        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());  //Databse connection
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting Database

?>