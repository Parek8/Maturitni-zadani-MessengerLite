<?php
include("process-register.php");
$connect = new mysqli("localhost", "management", "management123", "maturita");

// Getting the user info
$first_name = $_GET["first_name"];
$last_name = $_GET["last_name"];
$username = $_GET["username"];
$password = $_GET["password"];
$email = $_GET["email"];
$question = $_GET["question"];
$answer = $_GET["answer"];
$description = $_GET["description"];

if($connect->connect_errno || !$connect || $connect->connect_errno != 0 || $connect->connect_error)
{
    die("There was an error connecting to the database!\nError: " . $connect -> connect_errno);
}

if(CheckUniqueness())
{
    AddToDatabase();
}
else
{
    echo "Email and/or username aren't unique!";
    die();
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
        else
        {
            
        }
    }
    
    return $unique;
}

// Solely for us to keep somewhere the MY_SQL query ^^
function CreateNewDatabase()
{
    $createQuery = "CREATE DATABASE IF NOT EXISTS maturita;
                    USE maturita;
                    
                    CREATE TABLE IF NOT EXISTS users(
                        id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
                        first_name VARCHAR(64) NOT NULL,
                        last_name VARCHAR(64) NOT NULL,
                        username VARCHAR(64) UNIQUE NOT NULL,
                        pass VARCHAR(64) NOT NULL,
                        email VARCHAR(255) UNIQUE NOT NULL,
                        question TEXT NOT NULL,
                        answer TEXT NOT NULL,
                        description TEXT,
                        create_date DATETIME NOT NULL
                    );"; 

    $connect->query($createQuery);
    alert("No problem!");
}
?>