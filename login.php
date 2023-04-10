<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body style="background-color: #EEEEEE;">

    <h1 style="position: absolute; top: 20%; left: 50%; transform: translate(-50%, -50%);">LOGIN</h1>

    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" class="w-25 shadow-lg ">
        <form action="process-login.php" method="POST" class="d-flex flex-column align-items-center mt-4">
            <input type="text" name="username" placeholder="Username" class="w-75"><br>

            <input type="password" name="password" placeholder="Password: " class="w-75"><br>

            <a href="register.php">Not registered? Register here!</a>

            <input type="submit" value="Log in" id="submit"  class="bg-warning rounded mb-3" style="border: none">
        </form>
    </div>



    <script
    src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
    crossorigin="anonymous">
    </script>
    <script src="script.js"></script>

    <script>

        $(document).ready(function(){  
                $("#submit").click(function(e){
                if(!Validate())
                    e.preventDefault();
                else
                    $(this).unbind('click').click();
                });  
            });
    </script>
</body>
</html>