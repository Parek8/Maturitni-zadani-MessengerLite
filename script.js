function Validate(event)
{
    let validFname, validLname, validUsername, validPassword, validConfPassword, validQuestion, validAnswer = true ;

    let fname = $("[name='first_name']").val();
    let lname = $("[name='last_name']").val();
    let username = $("[name='username']").val();
    //let password = $("[name='last_name']").val(); Dont know why this doesnt work on validation
    let password = document.getElementById("myPsw").value;
    let confirm_password = $("[name='confirm_password']").val();
    let email = $("[name='email']").val(); /*I have no idea if we will use it for validation, because of htmls automatic validation for email */
    let question = $("[name='question']").val();
    let answer = $("[name='answer']").val();

    if(fname == null || fname.replace(/^\s+|\s+$/gm,'') == ""){
            alert("You need to input First Name");
            validFname= false;    
        }
    if(lname == null || lname.replace(/^\s+|\s+$/gm,'') == ""){
            alert("You need to input Last Name");
            validLname = false;
        }
    if(username.length < 8 || username.replace(/^\s+|\s+$/gm,'') == ""){
            alert("Your Username needs to be atleast 8 characters long");
            validUsername = false;
        }

    if(password.length < 8){
            alert("Your Password needs to be atleast 8 characters long");
            validPassword = false;
        }
    if(confirm_password != password){
            alert("Your Password needs to match with Confirm Password");
            validConfPassword = false;
        }    
    if(question.replace(/^\s+|\s+$/gm,'') == ""){
            alert("You need to input a question for account recovery");
            validQuestion = false;
        }
    if(answer.replace(/^\s+|\s+$/gm,'') == ""){
            alert("You need to input an answer for account recovery");
            validAnswer = false
        }
    
    return (validFname && validLname && validUsername && validPassword && validConfPassword && validQuestion && validAnswer);
}

function MistakesFound()
{
    alert("Mistake found!");
}
