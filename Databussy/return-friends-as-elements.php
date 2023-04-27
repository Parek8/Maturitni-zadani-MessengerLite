<?php
include 'connection.php';

global $connect;
$selectQuery = "SELECT id, username FROM users WHERE username != '".$_SESSION['username']."'";
$results = $connect->query($selectQuery);
global $myId;
$tmpFriendId = -1;
$tmpFriendName = "Nigglet";
$scriptString = '<script>';
while($result = $results->fetch_assoc())
    {
        $tmpFriendId = $result['id'];
        $tmpFriendName = $result['username'];
       
                    if(AreFriends($result['id']))
                    {
                       echo '<div class="friend-box">';
                        echo '<div class="friend-name">'.$tmpFriendName.'</div>';
                        echo'<button class="message-btn" name='.$result["id"].'>Message</button>';
                        echo"<button class='remove-friend-btn' onclick=\"location.href='?delete=" . $result["id"] . "'\">Remove Friend</button>";;
                        echo '</div>';
                        $scriptString .= '
                        $("[name='.$tmpFriendId.']").bind("click", function()
                        {
                            window.location.href = "send-a-message.php?id='.$tmpFriendId.'&name='.$tmpFriendName.'"
                        });
                        $("[name=d'.$tmpFriendId.']").bind("click", function()
                        {
                            window.location.href = "book-of-faces.php?delete='.$tmpFriendId.'"
                        });
                        ';
                        
                    }
    }
    echo $scriptString . '</script>';

if (isset($_GET["delete"])) {
    $realId = $myId['id'];
    $delete_id = $_GET["delete"];
    $sql = "DELETE FROM friends WHERE (sender_id = ".$myId['id']." AND reciever_id = ".$delete_id.") OR (reciever_id = ".$myId['id']." AND sender_id = ".$delete_id.");";
    $connect->query($sql);
    header("location: book-of-faces.php");
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
?>