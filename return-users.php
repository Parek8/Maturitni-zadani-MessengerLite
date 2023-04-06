<?php
    include("connection.php");

    global $connect;
    
    $selectQuery = "SELECT username FROM users WHERE username LIKE '%{$_POST['searchTerm']}%'";
    $results = $connect->query($selectQuery);

    while($result = $results->fetch_assoc())
    {
        echo    '<div class=" w-50 bg-light h-100 d-flex align-items-center">
                    <h5 class="flex-grow-1 mx-4">'.$result["username"].'</h5>
                    <button class="btn btn-outline-success my-2 my-sm-0">Add Friend</button>
                    <button class="btn btn-outline-primary my-2 my-sm-0">Message</button>
                </div>';
    }
?>