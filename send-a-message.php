<!-- TODO if not logged in (session) redirect to login.php! -->
<?php
session_start();
include("connection.php");
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
</head>
<body>
    <navbar class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-end align-items-center">
        <div class="nav-item">
            <?php
            if(!isset($_SESSION["username"]))
            {
                header("Location: login.php");
                echo "NOT LOGGED IN!   ";
                echo "<a href='login.php'>Login here!</a>";
            }
            else
            {
                echo  "Logged in as: " . $_SESSION["username"];
            }?>
        </div>
    </navbar>
    <div style="
    width: 50vw;
    height: 90vh;
    background-color: grey;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    margin: auto;
    margin-top: 5px;
    ">
    <h3 style="position: absolute; transform: translate(-50%, -50%); top: 3%; left: 50%;"><?php echo $_GET['name'];?></h3>
            <section id="messages"></section>
        <div style="display: flex; background-color: grey; justify-content: center; align-items: end; width: 50vw;; margin-top: 83vh; position: absolute;">
            <textarea placeholder="Type here: " style="resize: none; height: 4vh; width: 40vw; margin-right: 10px; border: 1px solid white; border-radius: 10px; padding: 5px; text-align: left;" id="messageContent" cols="30" rows="10"></textarea>
            <button name="send" value="Send Message" style="height: 4vh; width: 10%; border: 1px solid white; border-radius: 10px; padding: 5px;">Send</button>
        </div>
    </div>


        <input type="hidden" id="hidden-input-friendId" value="<?php echo $_GET['id'];?>">
        <input type="hidden" id="hidden-input-friendName" value="<?php echo $_GET['name'];?>">
    <script
        src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
        crossorigin="anonymous">
    </script>
    <script>
        let delay = 1000;
        let friendId = $("#hidden-input-friendId").val();
        let friendName = $("#hidden-input-friendName").val();
        setInterval(() => {
            $.post("process-messages-and-notifications.php", {function: "ReturnMessages", friendId: friendId}, function(data) {
                $("#messages").html(data);
            });
        }, delay);

           $("[name=\'send\']").bind("click", function(){
               let content = document.getElementById("messageContent");
            if(content.value != null && content.value.replace(/^\s+|\s+$/gm,'') != ""){
                
                $.post("process-messages-and-notifications.php", {function: 'AddNotification', type: "Message", content: friendName+" has sent you a message!", friendId: friendId, method: "Notification"}, function(data){});
                $.post("process-messages-and-notifications.php", {function: 'AddNotification', type: null, content: content.value, friendId: friendId, method: "Message"}, function(data){});
            }
        });
    </script>
</body>
</html>