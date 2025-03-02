<?php
    // Database connection
    $conn = new mysqli("localhost", "root", "", "tuniverse_db");

    //Checking the connection
    if($conn->connect_error)
    {
        die("Connection failed: ".$conn->connect_error);
    }

    // Geting the data from 'login.html'
    $username = $_POST['username'];
    
?>