<?php
    include("connection.php");
    include("friends.php");

    global $connect;
    
    $selectQuery = "SELECT id, username FROM users WHERE username LIKE '%{$_POST['searchTerm']}%'";
    $results = $connect->query($selectQuery);

    while($result = $results->fetch_assoc())
    {
        echo    '<div class=" w-25 bg-light h-100 d-flex align-items-center" style="position: relative; left: 100%; transform: TranslateX(-100%);" name='.$result["id"].'>
                    <h5 class="flex-grow-1 mx-4">'.$result["username"].'</h5>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="addFriend">Add Friend</button>
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="message">Message</button>
                </div>';
    }
    echo '<script src="script.js"></script>';
?>