<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Of Faces!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div>
            <form class="form-inline my-2 my-lg-0 float-right" method="POST">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="search-bar" name="search-bar">
                <input type="submit" id="search-for-users" hidden>
            </form>
        </div>
    </nav>
        <div id="results">
            
        </div>


    <script
        src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
        crossorigin="anonymous">
    </script>
    <script>
        $("#search-bar").bind('input', function(){
                                                    let searchTerm = $("#search-bar").val();
                                                    $.post("return-users.php", {searchTerm: searchTerm},
                                                    function(returnHTML) {
                                                        $("#results").html(returnHTML);
                                                    })});

    </script>
    
</body>
</html>