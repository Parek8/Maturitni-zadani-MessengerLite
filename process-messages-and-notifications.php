<?php
session_start();
include("connection.php");
global $myId;
global $connect;

if($_POST['function'] == "ReturnMessages")
{
    $selectQuery = "SELECT * FROM (SELECT * FROM message_history WHERE (sender_id = ".$myId['id']." AND reciever_id = ".$_POST['friendId'].") OR (reciever_id = ".$myId['id']." AND sender_id = ".$_POST['friendId'].") ORDER BY sent_date DESC LIMIT 20) as t ORDER BY sent_date ASC";
    $results = $connect->query($selectQuery);
    while($result = $results->fetch_assoc())
    {
        if($result["sender_id"] == $myId["id"])
        {
            echo '<span style="float: right; margin-right: 1vw; color: green;">YOU: '.$result["content"].'</span><br>';
        }
        else
        {
            echo '<span style="float: left; margin-left: 1vw; color: red;">THEM: '.$result["content"].'</span><br>';
        }
    }
}
else if($_POST['function'] == "AddNotification")
{
    $friendId = $_POST["friendId"];
    if($_POST['method'] == "Notification")
    {
        $notificationQuery = 'INSERT INTO notifications(type, content, sender_id, reciever_id) VALUES("'.$_POST["type"].'", "'.$_POST["content"].'", '.$myId["id"].', '.$friendId.');';
        $connect->query($notificationQuery);
    }
    if($_POST['method'] == "Message")
    {
        $messageQuery = 'INSERT INTO message_history(content, sender_id, reciever_id, sent_date) VALUES("'.$_POST["content"].'", '.$myId["id"].', '.$friendId.', now());';
        $connect->query($messageQuery);
    }
}
?>