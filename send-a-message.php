<!-- TODO if not logged in (session) redirect to login.php! -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send a message!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <style>
        li
        {
            list-style: none;
        }
    </style>
</head>
<body>
    <navbar class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-end align-items-center">
        <div class="nav-item"> SEND A MESSAGE</div>
        <div class="container w-25 d-flex justify-content-end text-justify">
            <li class="nav-item flex-fill text-middle"><a href="login.php" class="nav-link">Log-in</a></li>
            <li class="nav-item flex-fill text-middle"><a href="register.php" class="nav-link">Register</a></li>
        </div>
    </navbar>
        <div id="test"></div>
        <textarea name="" id="messageContent" cols="30" rows="10"></textarea><br>
        <button name="send" value="Send Message">Send</button>
        <div id="test"></div>
        <?php
            echo '<div> THE ID IS: '.$_GET['id'].'</div>';

        ?>
    <script
        src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
        crossorigin="anonymous">
    </script>
    <script>
        let delay = 500;
        $("[name='send']").bind("click", function(){
            let content = document.getElementById("messageContent");
            content.value = "";

            $.post("add-notification.php", {type: 'Message', content: 'Someone sent you a message', sender_id: 8, reciever_id: 11}, function(data){});
        });
        setInterval(() => {
            // $.post return notifications
        }, delay);
    </script>
</body>
</html>