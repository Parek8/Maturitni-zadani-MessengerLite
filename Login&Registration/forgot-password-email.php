<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password?</title>
    <style>
        input
        {
            border: none;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body style="background-color: #EEEEEE; height: 93vh;">

    <h1 style="position: absolute; top: 20%; left: 50%; transform: translate(-50%, -50%);">FORGOT PASSWORD</h1>

    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" class="w-25 shadow-lg ">
        <form action="../Databussy/return-verification-question.php" method="POST" class="d-flex flex-column align-items-center mt-4">

            <input type="email" name="forgotEmail" placeholder="Email you used to log in with: " class="w-75" required><br>
            <input type="hidden" name="function" value="ReturnQuestion">

            <a href="login.php">Missclicked? Login here!</a>

            <input type="submit" value="Verify E-mail" id="submit" class="bg-warning rounded mb-3" style="border: none">
        </form>
    </div>

</body>
<footer  style="position: fixed; bottom: 0px; width: 100vw">
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-end">
    <span class="col">Made by <i>Párek8&AdamMakoun&copy </i> </span>
    </nav>
</footer>
</html>