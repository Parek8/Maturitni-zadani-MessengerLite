<?php
    session_start();
    include("connection.php");

    global $connect;
    
    $selectQuery = "SELECT id, username FROM users WHERE username LIKE '%{$_POST['searchTerm']}%' AND username != '".$_SESSION['username']."' LIMIT 5";
    $results = $connect->query($selectQuery);

    global $myId;
    $tmpFriendId = -1;
    $tmpFriendName = "Niglet";
    $scriptString = '<script>';
    while($result = $results->fetch_assoc())
    {
        $tmpFriendId = $result['id'];
        $tmpFriendName = $result['username'];
        echo    '<div class=" w-25 bg-light h-100 d-flex align-items-center" style="position: relative; left: 100%; transform: TranslateX(-100%);" name='.$result["id"].'>
                    <h5 class="flex-grow-1 mx-4">'.$result["username"].'</h5>';

                    if(AreFriends($result['id']))
                    {
                        echo '<button class="btn btn-outline-primary my-2 my-sm-0" type="message">Message</button></div>';
                        $scriptString .= '
                                            $("[type=\'message\']").bind("click", function()
                                            {
                                                window.location.href = "send-a-message.php?id='.$tmpFriendId.'&name='.$tmpFriendName.'"
                                            });';
                        
                    }
                    else if(GotFriendRequest($result["id"]))
                    {
                        echo '<button class="btn btn-outline-success my-2 my-sm-0" type="acceptFriendRequest" name="'.$result["id"].'">Accept Friend Request</button></div>';
                        $scriptString .= '
                                            $("[type=\'acceptFriendRequest\']").bind("click", function(){
                                                $.post("add-friend.php", {newFriendId: $(this).attr("name"), type: "acceptFriendRequest", myId: '.$myId["id"].' }, function(data){});
                                            });';
                    }
                    else if(FriendRequestPending($result["id"]))
                    {
                        echo '<button class="btn btn-outline-success my-2 my-sm-0" type="" name="'.$result["id"].'">Waiting for Accepting</button></div>';
                    }
                    else
                    {
                        echo '<button class="btn btn-outline-warning my-2 my-sm-0" type="addFriend" name="'.$result["id"].'">Add Friend</button></div>';
                        $scriptString .= '
                                            $("[type=\'addFriend\']").bind("click", function(){
                                                $.post("add-friend.php", {newFriendId: $(this).attr("name"), type: "sendFriendRequest"}, function(data){});
                                            });';
                    }
    }
    echo '<script src="script.js"></script>';
    echo $scriptString . '</script>';

    function GotFriendRequest($sender_id)
    {
        global $connect;
        global $myId;
        
        $friendsQuery = "SELECT id FROM friend_requests WHERE reciever_id = ".$myId['id']." AND sender_id = ".$sender_id."";
        $results = ($connect->query($friendsQuery))->fetch_assoc();
        if(is_null($results))
            return false;
        else
            return true;
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
    function FriendRequestPending($sender_id)
    {
        global $connect;
        global $myId;
        
        $friendsQuery = "SELECT id FROM friend_requests WHERE sender_id = ".$myId['id']." AND reciever_id = ".$sender_id."";
        $results = ($connect->query($friendsQuery))->fetch_assoc();
        if(is_null($results))
            return false;
        else
            return true;
    }
?>