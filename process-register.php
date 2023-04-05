<?php
include("connection.php");
include("variables.php");

    if(CheckUniqueness())
    {
        AddToDatabase();
    }
    else
    {
        echo "Email and/or username aren't unique!";
        die();
    }

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

// A function we'll use for returning email and username from database, so we can check if the email and username are both unique
function CheckUniqueness()
{
    // "Importing" global variables
    global $username;
    global $email;
    global $connect;
    $unique = true;

    $selectQuery = "SELECT username, email FROM users WHERE username='$username' OR email='$email';";
    $results = $connect->query($selectQuery);

    while($result = $results->fetch_assoc())
    {
        // One more checking just in case
        if((!is_null($result['email']) || !empty($result['email']) || $result['email' == $email]) || (!is_null($result['username']) || !empty($result['username']) || $result['username' == $username]))
        {
            $unique = false;
        }
    }
    
    return $unique;
}

?>