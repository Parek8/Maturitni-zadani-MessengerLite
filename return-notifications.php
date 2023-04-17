<?php
session_start();
include("connection.php");
global $myId;
$selectQuery = "SELECT * FROM (SELECT * FROM message_history WHERE (sender_id = ".$myId['id']." AND receiver_id = ".$_POST['friendId'].") OR (receiver_id = ".$myId['id']." AND sender_id = ".$_POST['friendId'].") ORDER BY sent_date DESC LIMIT 50) as t ORDER BY sent_date ASC";
global $connect;
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
?>