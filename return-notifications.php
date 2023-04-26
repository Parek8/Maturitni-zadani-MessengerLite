<?php
    include 'connection.php';

global $myId;
global $connect;
/*while($result = $results->fetch_assoc())
{
    if($result["sender_id"] == $myId["id"])
    {
        echo '<span style="float: right;">'.$result["content"].'</span><br>';
    }
    else
    {
        echo '<span style="float: left;">'.$result["content"].'</span><br>';
    }
}*/
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
function RemoveNotifications($sender_id,$myId){
    global $connect;
    

        $DeleteQuery = 'DELETE FROM notifications WHERE notifications.sender_id ='. $sender_id . ' AND notifications.reciever_id = '. $myId ;
        $connect->query($DeleteQuery);
        echo $connect->query($DeleteQuery);
    

}
if(isset($_POST['action']) && $_POST['action'] == 'deleteRecords'){
    global $connect;
    $findMyIdQuery = "SELECT id FROM users WHERE username='".$_POST['myUser']."'";
    $myId = ($connect->query($findMyIdQuery)->fetch_assoc());
    RemoveNotifications(intval($_POST['friendId']),intval($myId['id']));
}
?>