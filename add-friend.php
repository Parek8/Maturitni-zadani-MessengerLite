<?php
session_start();
include("connection.php");
$findMyIdQuery = "SELECT id FROM users WHERE username='".$_SESSION['username']."'";
global $connect;
$myId = ($connect->query($findMyIdQuery)->fetch_assoc());
$insertQuery = "INSERT INTO friend_requests(sender_id, reciever_id) VALUES(".$myId['id'].", ".$_POST['newFriendId'].")";
$connect->query($insertQuery);
?>