<?php
session_start();
include("connection.php");

$notificationQuery = 'INSERT INTO notifications(type, content, sender_id, reciever_id) VALUES("'.$_POST["type"].'", "'.$_POST["content"].'", '.$_POST['sender_id'].', '.$_POST['reciever_id'].');';
global $connect;
$connect->query($notificationQuery);
?>