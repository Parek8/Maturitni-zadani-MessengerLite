<?php
session_start();
include("connection.php");
global $connect;
global $myId;
$friendId = $_POST["friendId"];
if($_POST['method'] == "Notification")
{
    $notificationQuery = 'INSERT INTO notifications(type, content, sender_id, reciever_id) VALUES("'.$_POST["type"].'", "'.$_POST["content"].'", '.$myId["id"].', '.$friendId.');';
    $connect->query($notificationQuery);
}
if($_POST['method'] == "Message")
{
    $messageQuery = 'INSERT INTO message_history(content, sender_id, receiver_id, sent_date) VALUES("'.$_POST["content"].'", '.$myId["id"].', '.$friendId.', now());';
    $connect->query($messageQuery);
}
?>