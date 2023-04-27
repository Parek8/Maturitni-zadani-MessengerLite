<!-- TODO if not logged in (session) redirect to login.php! -->
<?php
session_start();
include("Databussy/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send a message!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <style>
        body
        {
            overflow: hidden;
        }
    </style>
        <input type="hidden" id="hidden-input-friendName" value="<?php echo $_GET['name'];?>">
    <script
        src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
        crossorigin="anonymous">
    </script>
</head>
<body>
    <navbar class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-left align-items-center">
        <div class="nav-item" style="justify-content: left; display: flex;">
            <?php
            include 'Databussy/return-notifications.php';
            if(!isset($_SESSION["username"]))
            {
                header("Location: Login&Registration\login.php");
                echo "NOT LOGGED IN!   ";
                echo "<a href='Login&Registration\login.php'>Login here!</a>";
            }
            else
            {
                echo  '<p style="float: left; margin-right: 10px">Logged in as: ' . $_SESSION["username"]. '</p>';
                echo 'Notifications:'.GetNumberOfNotifications().'';
            }?>
        </div>
        <li class="col nav-item" style="list-style-type: none; font-size: 1.5rem; text-align: center">
            <a class="nav-link" href="book-of-faces.php">Book Of Faces</a>
        </li>
        <div class="col">
            <form class="form-inline my-2 my-lg-0 float-right" method="POST">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="search-bar" name="search-bar">
                <input type="submit" id="search-for-users" hidden>
            </form>
        </div>
    </navbar>
    <div id="results" style="position: absolute;left: 100%; transform: TranslateX(-100%); "></div>
    <div style="display: inline-flex; width: 100vw; height:90vh; flex-direction: row; justify-content: center;">
        <div style="width: 70vw; height: 90vh; margin-top: 5px; display: flex; justify-content: center;">
            <div style=" display: flex; flex-direction: column;width: 20vw;height: 90vh; background-color: blue; ">
            <?php
            include 'Databussy/return-friends.php';
            ?>
            </div>
            <div style="
            width: 50vw;
            height: 90vh;
            
            background-color: grey;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            margin: auto;">
            <i style=" font-size: 2rem"><?php echo $_GET['name'];?></i>
                <section style="
            width: 50vw;
            height: 80vh;
            margin-top: 10%;
            margin-bottom: 50px;
            overflow: auto;
            box-sizing: border-box;" 
            id="messages"></section>
                <div style="display: flex; background-color: grey; justify-content: center; align-items: end; width: 50vw;; margin-top: 83vh; position: absolute;">
                    <textarea placeholder="Type here: " style="resize: none; height: 4vh; width: 40vw; margin-right: 10px; border: 1px solid white; border-radius: 10px; padding: 5px; text-align: left;" id="messageContent" cols="30" rows="10"></textarea>
                    <button name="send" value="Send Message" style="height: 4vh; width: 10%; border: 1px solid white; border-radius: 10px; padding: 5px;">Send</button>
                </div>
            </div>
        </div>
    </div>

        <input type="hidden" id="hidden-input-friendId" value="<?php echo $_GET['id'];?>">
        <input type="hidden" id="hidden-input-myId" value="<?php echo $_SESSION['username']?>">
    
    <?php
        echo '<script src="script.js"></script>';
        echo $scriptString . '</script>';
    ?>
    <script>

        
        let delay = 1000;
        
        let friendId = $("#hidden-input-friendId").val();
        let myUser = $("#hidden-input-myId").val();

        setInterval(() => {
            <?php GetNumberOfNotifications(); ?>
            $.post("Databussy/process-messages-and-notifications.php", {function: "ReturnMessages", friendId: friendId}, function(data) {
                $("#messages").html(data);
            });
            
            
        }, delay);

        $("document").ready(function(){
            $.post("Databussy/process-messages-and-notifications.php", {function: "RemoveNotification", friendId: friendId}, function(data){});
        });
           $("[name=\'send\']").bind("click", function(){
               let content = document.getElementById("messageContent");
            if(content.value != null && content.value.replace(/^\s+|\s+$/gm,'') != ""){
                
                $.post("Databussy/process-messages-and-notifications.php", {function: 'AddNotification', type: "Message", content: "Someone has sent you a message!", friendId: friendId, method: "Notification"}, function(data){});
                $.post("Databussy/process-messages-and-notifications.php", {function: 'AddNotification', type: null, content: content.value, friendId: friendId, method: "Message"}, function(data){});
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
        function FunctionToBind()
        {
                let searchTerm = $("#search-bar").val();
                $.post("Databussy/return-users.php", {searchTerm: searchTerm},
                function(returnHTML) {
                    $("#results").html(returnHTML);
                })
        }
        
        $(document).click(function(event) {
            if (!$(event.target).closest('.search-result').length) {
                    $('.search-result').remove();
                } 
        });
        $("#search-bar").bind('input', FunctionToBind);
    </script>
    
</body>
<footer  style="position: fixed; bottom: 0px">
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-end">
    <span class="col">Made by <i>Párek8&AdamMakoun&copy </i> </span>
    </nav>
</footer>
</html>