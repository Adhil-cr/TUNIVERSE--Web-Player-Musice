<?php

    //Start a session
    session_start();

    // Database connection
    $conn = new mysqli("localhost", "root", "", "tuniverse_db");

    //Checking the connection
    if($conn->connect_error)
    {
        die("Connection failed: ".$conn->connect_error);
    }

    // Geting the data from 'login.html'
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Secure the query using the prepared statement
    $stmt = $conn->prepare("SELECT * from user_info WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0)
    {
        $user = $result->fetch_assoc();

        // Verify the password using password_verify()
        if(password_verify($password,$user['password']))
        {
            $_SESSION['username'] = $user['username'];
            header("Location: index.html");
        } else {
            echo "Invalid username or password";
        }

    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
?>