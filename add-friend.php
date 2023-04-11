<?php
session_start();
include("connection.php");
$type = $_POST['type'];
$findMyIdQuery = "SELECT id FROM users WHERE username='".$_SESSION['username']."'";
$myId = ($connect->query($findMyIdQuery)->fetch_assoc());
if($type == "sendFriendRequest")
{
    global $connect;
    global $myId;

    $insertQuery = "INSERT INTO friend_requests(sender_id, reciever_id) VALUES(".$myId['id'].", ".$_POST['newFriendId'].")";
    $connect->query($insertQuery);
}
else if($type == "acceptFriendRequest")
{
    global $connect;
    global $myId;
    
    $findRequests = "SELECT id FROM friend_requests WHERE reciever_id = ".$_POST["myId"]." AND sender_id = ".$_POST["newFriendId"]."";
    $results = $connect->query($findRequests);
    while($result = $results->fetch_assoc())
    {
        $addFriendQuery = "INSERT INTO friends(sender_id, reciever_id) VALUES(".$_POST["myId"].",".$_POST["newFriendId"].")";
        $connect->query($addFriendQuery);
    }
}

?>