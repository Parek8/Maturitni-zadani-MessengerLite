<?php
$connect = new mysqli("localhost", "management", "management123", "maturita");
$myId;

if($connect->connect_errno || !$connect || $connect->connect_errno != 0 || $connect->connect_error)
{
    die("There was an error connecting to the database!\nError: " . $connect -> connect_errno);
}

if(isset($_SESSION['username'])){
    $findMyIdQuery = "SELECT id FROM users WHERE username='".$_SESSION['username']."'";
    $myId = ($connect->query($findMyIdQuery)->fetch_assoc());
}
?>