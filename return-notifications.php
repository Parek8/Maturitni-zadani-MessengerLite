<?php
session_start();
include("connection.php");
global $myId;
$selectQuery = "SELECT * FROM message_history WHERE sender_id = ".$myId['id']." OR reciever_id = ".$myId['id']."";
global $connect;
$results = $connect->query($selectQuery);
while($result = $results->fetch_assoc())
{
    echo '<div>CONTENT: '.$result["content"].'</div>';
}
?>