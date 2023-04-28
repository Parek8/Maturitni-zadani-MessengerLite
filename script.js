function ValidateRegister()
{
    let fname = $("[name='first_name']").val();
    let lname = $("[name='last_name']").val();
    let username = $("[name='username']").val();
    let password = $("[name='password']").val();
    let confirm_password = $("[name='confirm_password']").val();
    let email = $("[name='email']").val();  /* We have no idea if we will use it for validation, because of htmls automatic validation for email */
    let question = $("[name='question']").val();
    let answer = $("[name='answer']").val();

    let message = "";


    if(fname == null || fname.replace(/^\s+|\s+$/gm,'') == ""){
            message += "You need to input First Name\n";
        }
    if(lname == null || lname.replace(/^\s+|\s+$/gm,'') == ""){
            message += "You need to input Last Name\n";
        }
    if(username.length < 8 || username.replace(/^\s+|\s+$/gm,'') == ""){
            message += "Your Username needs to be atleast 8 characters long\n";
        }
    if(password.length < 8){
            message += "Your Password needs to be atleast 8 characters long\n";
        }
    if(confirm_password != password){
            message += "Your Password needs to match with Confirm Password\n";
        }    
    if(question.replace(/^\s+|\s+$/gm,'') == ""){
            message += "You need to input a question for account recovery\n";
        }
    if(answer.replace(/^\s+|\s+$/gm,'') == ""){
            message += "You need to input an answer for account recovery\n";
        }

    if(message != "" && message != null)
    {
        AlertMistakes(message);
        return false;
    }
    return true;
}
function ValidateLogin()
{
    let email = $("[name='email']").val();
    let password = $("[name='password']").val();
    let message = "";

    if(email.length < 8 || email.replace(/^\s+|\s+$/gm,'') == ""){
        message += "Invalid email\n";
    }
    if(password.length < 8){
        message += "Invalid password\n";
    }
    if((message != ""))
        AlertMistakes(message);

    return (message == "");
}
function AlertMistakes(message)
{
    alert(message);
}