<?php
    include 'connection.php';

global $myId;
global $connect;

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