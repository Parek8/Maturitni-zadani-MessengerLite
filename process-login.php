<?php
include("connection.php");
    if(FindUser())
    {
        header("Location: book-of-faces.php");
    }
    else
    {
        header("Location: login.php");
    }

function FindUser()
{
    $userExists = false;
    global $connect;
    $username = $_POST["username"];
    $password = $_POST["password"];

    $selectQuery = "SELECT * FROM users WHERE username='$username' AND pass='$password'";

    $results = $connect->query($selectQuery);

    while($result = $results->fetch_assoc())
    {
        if($result["username"] == $username && $result["pass"] == $password)
        {
            $userExists = true;
            echo "You logged in successfully!";
        }
    }
    return $userExists;
}
?>