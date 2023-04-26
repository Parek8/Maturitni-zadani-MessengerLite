<?php
    include 'connection.php';

global $myId;
global $connect;

if(isset($_POST["method"])  && $_POST["method"] == "RemoveNotifications")
{
    global $connect;
    global $myId;
    $DeleteQuery = 'DELETE FROM notifications WHERE notifications.sender_id = '. $_POST["friendId"]. ' AND notifications.reciever_id = '. $myId["id"] . ' AND notifications.type = "Message"';
    return $connect->query($DeleteQuery);
}
function GetNumberOfNotifications(){
    
    global $myId;
    global $connect;
    $count = 0;
    $selectCountQuery = 'SELECT COUNT(reciever_id) as count FROM notifications
                         WHERE reciever_id = '. $myId['id'];
    $results = $connect->query($selectCountQuery);
    while($result = $results->fetch_assoc()){
        $count = $result['count'];
    }
    return $count;
}
?>