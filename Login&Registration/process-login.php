<?php
include("../Databussy/connection.php");
session_start();
    if(FindUser())
    {
        header("Location: ../book-of-faces.php");
    }
    else
    {
        header("Location: login.php");
    }

function FindUser()
{
    $userExists = false;
    global $connect;
    $email = $_POST["email"];
    $password = hash("sha256",$_POST["password"]);

    $selectQuery = "SELECT * FROM users WHERE email='$email' AND pass='$password'";

    $results = $connect->query($selectQuery);

    while($result = $results->fetch_assoc())
    {
        if($result["email"] == $email && $result["pass"] == $password)
        {
            $userExists = true;
            echo "You logged in successfully!";
            $_SESSION["username"] = $result['username'];
        }
        else
        {
            $_SESSION["forgotPassword"] = true;
        }
    }
    return $userExists;
}
?>