<?php
include("connection.php");
session_start();
if(isset($_POST["forgotEmail"]) && isset($_POST["function"]) && $_POST["function"] == "ReturnQuestion" )
{
    $_SESSION["forgotEmail"] = $_POST["forgotEmail"];
    header("Location: ../Login&Registration/forgot-password.php");
}
if(isset($_POST["function"]) && $_POST["function"] == "ReturnQuestion" )
{
    if(isset($_SESSION["forgotEmail"]))
    {
        global $connect;
        $selectQuestionQuery = "SELECT COUNT(id) as count, question FROM users WHERE email = '" . $_SESSION["forgotEmail"] . "'";
        $question = ($connect->query($selectQuestionQuery))->fetch_assoc();
        if($question["count"] > 0)
        {
            echo $question["question"];
        }
        else
        {
            echo "Something went wrong. Check your E-mail!";
        }
    }
}

if(isset($_POST["function"]) && $_POST["function"] == "CheckQuestion" )
{
    if(MrdaMi())
    {
        header("Location: ../Login&Registration/login.php");
    }
    else
    {
        header("Location: ../Login&Registration/forgot-password.php");
    }
}
function MrdaMi()
{
    if(isset($_SESSION["forgotEmail"]))
    {
        global $connect;
        $selectQuestionQuery = "SELECT COUNT(id) as count, question FROM users WHERE email = '" . $_SESSION["forgotEmail"] . "'";
        $selectAnswerQuery = "SELECT COUNT(id) as count, answer FROM users WHERE email = '" . $_SESSION["forgotEmail"] . "'";
        $question = ($connect->query($selectQuestionQuery))->fetch_assoc();
        $answer = ($connect->query($selectAnswerQuery))->fetch_assoc();
        if($question["count"] > 0 && $answer["count"] > 0)
        {
            if(isset($_POST["new_password"]) && isset($_POST["confirm_new_password"]))
            {
                if($_POST["new_password"] == $_POST["confirm_new_password"] && $_POST["answer"] == $answer["answer"])
                {
                    $updateQuery = "UPDATE users SET pass = '" . hash("sha256", $_POST["new_password"]) . "' WHERE email = '" . $_SESSION["forgotEmail"] . "'";
                    $connect->query($updateQuery);
                    return true;
                }
                else
                {
                    echo "1Something went wrong. Check your E-mail!";
                    return false;
                }
            }
            else
            {
                echo "2Something went wrong. Check your E-mail!";
                return false;
            }
        }
        else
        {
            echo "3Something went wrong. Check your E-mail!";
            return false;
        }
    }
    else
    {
        echo "4Something went wrong. Check your E-mail!";
        return false;
    }
}
?>