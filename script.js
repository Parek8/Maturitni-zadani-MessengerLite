function Validate(event)
{
    

    let fname = $("[name='first_name']").val();
    let lname = $("[name='first_name']").val();

    return (fname == "");
}

function MistakesFound()
{
    alert("Mistake found!");
}