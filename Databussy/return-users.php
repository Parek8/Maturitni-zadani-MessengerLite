<?php
    session_start();
    include("connection.php");

    global $connect;
    
    $selectQuery = "SELECT id, username FROM users WHERE username LIKE '{$_POST['searchTerm']}%' AND username != '".$_SESSION['username']."' LIMIT 5";
    $results = $connect->query($selectQuery);

    global $myId;
    $tmpFriendId = -1;
    $tmpFriendName = "Nigglet";
    $scriptString = '<script>';
    while($result = $results->fetch_assoc())
    {
        $tmpFriendId = $result['id'];
        $tmpFriendName = $result['username'];
        echo  '<div class=" bg-light h-100 d-flex align-items-center search-result" style="position: relative; width: 25vw;" name='.$result["id"].'>
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
                        echo '<button class="btn btn-outline-success my-2 my-sm-0" style="float: right;display: inline-block;"type="acceptFriendRequest" name="'.$result["id"].'">Accept Friend Request</button></div>';
                        $scriptString .= '
                                            $("[type=\'acceptFriendRequest\']").bind("click", function(){
                                                $.post("Databussy/add-friend.php", {newFriendId: $(this).attr("name"), type: "acceptFriendRequest", myId: '.$myId["id"].' }, function(data){});
                                            });';
                    }
                    else if(FriendRequestPending($result["id"]))
                    {
                        echo '<button class="btn btn-outline-success my-2 my-sm-0" style="float: right;display: inline-block;" type="" name="'.$result["id"].'">Waiting for Accepting</button></div>';
                    }
                    else
                    {
                        echo '<button class="btn btn-outline-warning my-2 my-sm-0"style="float: right; display: inline-block;" type="addFriend" name="'.$result["id"].'">Add Friend</button></div>';
                        $scriptString .= '
                                            $("[type=\'addFriend\']").bind("click", function(){
                                                $.post("Databussy/add-friend.php", {newFriendId: $(this).attr("name"), type: "sendFriendRequest"}, function(data){});
                                            });';
                    }
    }
    echo '<script src="script.js"></script>';
    echo '<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>';
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