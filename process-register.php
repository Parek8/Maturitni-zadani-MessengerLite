<?php

function AddToDatabase()
{
    // \"Importing\" global variables
    global $first_name;
    global $last_name;
    global $username;
    global $password;
    global $email;
    global $question;
    global $answer;
    global $description;
    global $connect;

    $insertQuery = "INSERT INTO users(first_name, last_name, username, pass, email, question, answer, description, create_date) VALUES(\"$first_name\", \"$last_name\", \"$username\", \"$password\", \"$email\", \"$question\", \"$answer\", \"$description\", now())";
    echo $insertQuery;   
    $connect->query($insertQuery);
    header("Location: login.php");
}
?>