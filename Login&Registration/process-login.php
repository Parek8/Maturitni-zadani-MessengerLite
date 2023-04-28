<?php
include("../Databussy/connection.php");
session_start();
function FindUser()
{
    $userExists = false;
    global $connect;
    $email = $_POST["email"];
    $password = hash("sha256",$_POST["password"]);

    $selectQuery = "SELECT * FROM users WHERE email='$email' AND pass='$password'";

    $results = $connect->query($selectQuery);

    // TADY SE VÁŽNĚ OMLOUVÁM
    $_SESSION["forgotPassword"] = true;
    $_SESSION["logged"] = false;

    while($result = $results->fetch_assoc())
    {
        if($result["email"] == $email && $result["pass"] == $password)
        {
            $userExists = true;
            echo "You logged in successfully!";
            $_SESSION["username"] = $result['username'];
            $_SESSION["logged"] = true;
            $_SESSION["wrongLogin"] = false;
        }
        else
        {
            $_SESSION["wrongLogin"] = false;
        }
    }
    return $userExists;
}


if(FindUser())
{
    header("Location: ../book-of-faces.php");
}
else
{
    header("Location: login.php");
}
?>