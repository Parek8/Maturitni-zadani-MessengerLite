<?php
session_start();
include("connection.php");
$type = $_POST['type'];
global $myId;
if($type == "sendFriendRequest")
{
    $inserted = true;
    global $connect;
    global $myId;
    if($inserted){
        $insertQuery = "INSERT INTO friend_requests(sender_id, reciever_id) VALUES(".$myId['id'].", ".$_POST['newFriendId'].");";
        $notifQuery = " INSERT INTO notifications VALUES(null, 'Friend Request', 'Someone has sent you a friend request!',".$myId['id'].", ".$_POST['newFriendId'].")";
        $connect->query($insertQuery);
        $connect->query($notifQuery);
        $inserted = false;
    }   
    
}
else if($type == "acceptFriendRequest")
{
    global $connect;
    global $myId;
    
    $findRequests = "SELECT * FROM friend_requests WHERE reciever_id = ".$_POST["myId"]." AND sender_id = ".$_POST["newFriendId"]."";
    $results = $connect->query($findRequests);
    while($result = $results->fetch_assoc())
    {
        $friendId = intval($_POST["newFriendId"]);
        $mineId = intval($_POST["myId"]);
        $addFriendQuery = "INSERT INTO friends(sender_id, reciever_id) VALUES(".$_POST["newFriendId"].",".$_POST["myId"].");";
        $removeFriendRequestNotificationQueryFromDeliciousDataBussy = 'DELETE FROM notifications WHERE (notifications.sender_id = '.$mineId.' AND notifications.reciever_id = '.$friendId.' AND notifications.type = "Friend Request") OR (notifications.sender_id = '.$friendId.' AND notifications.reciever_id = '.$mineId.' AND notifications.type = "Friend Request")';
        $deleteQuery = "DELETE FROM friend_requests WHERE id = ".$result['id']."";
        $connect->query($addFriendQuery);
        $connect->query($deleteQuery);
        $connect->query($removeFriendRequestNotificationQueryFromDeliciousDataBussy);
    }
}
?>