<?php
session_start();
include("connection.php");
global $myId;
$selectQuery = "SELECT * FROM message_history WHERE sender_id = ".$myId['id']." OR receiver_id = ".$myId['id']." ORDER BY sent_date DESC LIMIT 2";
global $connect;
$results = $connect->query($selectQuery);
while($result = $results->fetch_assoc())
{
    if($result["sender_id"] == $myId["id"])
    {
        echo '<span style="float: right;">'.$result["content"].'</span><br>';
    }
    else
    {
        echo '<span style="float: left;">'.$result["content"].'</span><br>';
    }
}
?>