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
            include 'return-notifications.php';
            if(!isset($_SESSION["username"]))
            {
                header("Location: login.php");
                echo "NOT LOGGED IN!   ";
                echo "<a href='login.php'>Login here!</a>";
            }
            else
            {
                echo  '<p style="float: left; margin-right: 10px">Logged in as: ' . $_SESSION["username"]. '</p>';
                echo '<p>Notifications:'.GetNumberOfNotifications().'</p>';
            }?>
        </div>
    </navbar>
    <div style="display: inline-flex; width: 100vw; height:90vh; flex-direction: row; justify-content: center;">
        <div style="width: 70vw; height: 90vh; margin-top: 5px; display: flex; justify-content: center;">
            <div style=" display: flex; flex-direction: column;width: 20vw;height: 90vh; background-color: blue; ">
            <?php
            include 'return-friends.php';
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
            <h3 style="position: absolute; transform: translate(-50%, -50%); top: 3%; left: 50%;"><?php echo $_GET['name'];?></h3>
                <section style="
            width: 50vw;
            height: 80vh;
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
        let friendName = $("#hidden-input-friendName").val();
        $.post("return-notifications.php", { action: "deleteRecords", friendId: friendId, myUser: myUser }, function(response) {
           console.log(response);
           
        });
        setInterval(() => {
            $.post("process-messages-and-notifications.php", {function: "ReturnMessages", friendId: friendId}, function(data) {
                $("#messages").html(data);
            });
            
            
        }, delay);
        
        var scrolled = false;
        function updateScroll()
        {
            if(!scrolled)
            {
                var sections = document.getElementsByTagName("section");

		    
		        for (var i = 0; i < sections.length; i++) {
			        var section = sections[i];
			        section.style.maxHeight = section.scrollHeight + "px";
			        section.style.overflowY = "scroll";
		        }
            }
        }
        $("section").on('scroll', function(){
            scrolled=true;
        });



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