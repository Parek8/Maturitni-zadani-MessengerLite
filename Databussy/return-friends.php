<?php
session_start();
include("connection.php");
global $connect;
$selectQuery = "SELECT id, username FROM users WHERE username != '".$_SESSION['username']."'";
$results = $connect->query($selectQuery);
global $myId;
$tmpFriendId = -1;
$tmpFriendName = "Niglet";
$scriptString = '<script>';

while($result = $results->fetch_assoc())
{
    $tmpFriendId = $result['id'];
    $tmpFriendName = $result['username'];
    
    if(AreFriends($result['id']))
    {
        $messageUrl = "send-a-message.php?id=".$result['id']."&name=".$result['username'];
        echo    '<div style=" cursor: pointer; position: inline-block;" name='.$result["id"].'>
        <span style="color: White; position: inline; font-size: 1.25rem; margin-left: 5px;">'.$tmpFriendName.'</span></div>';

        $scriptString .= '
                        $("[name='.$tmpFriendId.']").bind("click", function()
                        {
                            window.location.href = "send-a-message.php?id='.$tmpFriendId.'&name='.$tmpFriendName.'"
                        });';
    }
}
if(isset($_POST["method"]) && $_POST["method"] == "ReturnFriends")
{
    global $connect;
    global $myId;
    $selectQuery = "SELECT * FROM friends;";

    $results = $connect->query($selectQuery);
    $tmpFriendId = -1;
    $tmpFriendName = "Niglet";
    $scriptString = '<script>';

    while($result = $results->fetch_assoc())
    {
        $tmpFriendId = $result['id'];
        $tmpFriendName = $result['username'];
        
        if(AreFriends($result['id']))
        {
            $messageUrl = "send-a-message.php?id=".$result['id']."&name=".$result['username'];
            echo    '<div style=" cursor: pointer; position: inline-block;" name='.$result["id"].'>
            <span style="color: White; position: inline; font-size: 1.25rem; margin-left: 5px;">'.$tmpFriendName.'</span>
            <button class="btn btn-outline-primary my-2 my-sm-0" type="message">Message</button></div>
            </div>';

            $messageUrl .= '
                            $("[type="message"]").bind("click", function()
                            {
                                window.location.href = "send-a-message.php?id='.$tmpFriendId.'&name='.$tmpFriendName.'"
                            });';
        }
    }
    echo $messageUrl . "</script>";
}

function AreFriends($reciever_id)
{
    global $connect;
    global $myId;

    $friendsQuery = "SELECT id FROM friends WHERE (sender_id = ".$myId['id']." AND reciever_id = ".$reciever_id.") OR (reciever_id = ".$myId['id']." AND sender_id = ".$reciever_id.");";
    $results = ($connect->query($friendsQuery))->fetch_assoc();

    if(is_null($results))
        return false;
    else
        return true;
}