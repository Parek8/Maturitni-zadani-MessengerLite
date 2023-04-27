<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Of Faces!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles\style.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>
<body class="h-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
        <div class="col">
            <?php
            include 'Databussy/connection.php';
            include 'Databussy/return-notifications.php';
            global $myId;
            if(!isset($_SESSION["username"]))
            {
                header("Location: Login&Registration/login.php");
                echo "NOT LOGGED IN!   ";
                echo "<a href='Login&Registration/login.php'>Login here!</a>";
            }
            else
            {
                echo  "Logged in as: " . $_SESSION["username"]. " | Notifications: ". GetNumberOfNotifications();
            }
            ?>
        </div>
        <li class="col nav-item" style="list-style-type: none; font-size: 1.5rem">
            <a class="nav-link" href="book-of-faces.php">Book Of Faces</a>
        </li>
        <div>
            <form class="form-inline my-2 my-lg-0 float-right" method="POST">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="search-bar" name="search-bar">
                <input type="submit" id="search-for-users" hidden>
            </form>
        </div>
    </nav>
    <div id="results" style="position: absolute;left: 100%; transform: TranslateX(-100%);pointer-events: auto;  z-index: 10; "></div>
    <div style="width: 98vw; height: 86vh; position: absolute; display: flex; flex-wrap: wrap;">
        <?php include 'Databussy\return-friends-as-elements.php';
        ?>
        
    </div>
    
    <script>
        let delay = 1000;
        function FunctionToBind()
        {
                let searchTerm = $("#search-bar").val();
                $.post("Databussy/return-users.php", {searchTerm: searchTerm},
                function(returnHTML) {
                    if(searchTerm != ""){

                    $("#results").html(returnHTML);
                    }
                })
        }
        $(document).click(function(event) {
            if (!$(event.target).closest("#results").length) {
                    $('.search-result').remove();
                } 
        });
        setInterval(() => {
            $.post("Databussy/return-friends.php", {method: "ReturnFriends"}, function(data){
                console.log(data);
            });
        }, delay);
        $("#search-bar").bind('input', FunctionToBind);
    </script>
    <script src="https://kit.fontawesome.com/91a68664b9.js" crossorigin="anonymous"></script>
</body>
<footer style="position: fixed; bottom: 0px">
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-end">
    <span class="col">Made by <i>Párek8&AdamMakoun&copy </i> </span>
    </nav>
</footer>
</html>