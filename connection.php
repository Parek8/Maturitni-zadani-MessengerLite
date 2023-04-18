<?php
$connect = new mysqli("localhost", "management", "management123", "maturita");

if($connect->connect_errno || !$connect || $connect->connect_errno != 0 || $connect->connect_error)
{
    die("There was an error connecting to the database!\nError: " . $connect -> connect_errno);
}

$findMyIdQuery = "SELECT id FROM users WHERE username='".$_SESSION['username']."'";
$myId = ($connect->query($findMyIdQuery)->fetch_assoc());

// Solely for us to keep the MY_SQL query somewhere ^^
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
                    );
                    
                    CREATE TABLE IF NOT EXISTS message_history(
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        content VARCHAR(1024) NOT NULL,
                        sender_id INT NOT NULL,
                        reciever_id INT NOT NULL,
    					sent_date DATETIME NOT NULL,
                        FOREIGN KEY (sender_id) REFERENCES users(id),
                        FOREIGN KEY (reciever_id) REFERENCES users(id)      
                    );
                    
                    CREATE TABLE IF NOT EXISTS friends(
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        sender_id INT NOT NULL,
                        reciever_id INT NOT NULL,
                        FOREIGN KEY(sender_id) REFERENCES users(id),
                        FOREIGN KEY(reciever_id) REFERENCES users(id)
                    );
                    
                    CREATE TABLE IF NOT EXISTS friend_requests(
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        sender_id INT NOT NULL,
                        reciever_id INT NOT NULL,
                        FOREIGN KEY(sender_id) REFERENCES users(id),
                        FOREIGN KEY(reciever_id) REFERENCES users(id)
                    );
                    
                    CREATE TABLE IF NOT EXISTS notifications(
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        type ENUM('Friend Request', 'New Post', 'Remove Friend', 'Message') NOT NULL,
                        content VARCHAR(512) NOT NULL,
                        sender_id INT NOT NULL,
                        reciever_id INT NOT NULL,
                        FOREIGN KEY(sender_id) REFERENCES users(id),
                        FOREIGN KEY(reciever_id) REFERENCES users(id)
                    );";

    // $connect->query($createQuery);
    // alert("No problem!");
}
?>