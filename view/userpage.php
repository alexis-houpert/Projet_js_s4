<?php
session_start();
if(isset($_POST['logout']))
{
    unset($_SESSION['email']);
}
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <title>Title</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="../script/cocktail-handler.js"></script>
    
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" wfd-invisible="true">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="#">Deconnexion <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</header>
<h1>Composez votre cocktail</h1> <br>
<section id="selection" style="display: flex; flex-wrap: wrap; ">
    <input type="checkbox" class="case" name="filter1" id="case" style="margin-left: 10px;" /> <label name="Gin" for="case" style="margin: 10px;">Gin</label> <br>
    <input type="checkbox" class="case" name="filter2" id="case" /> <label name="White rum" for="case" style="margin: 10px;">White rum</label> <br>
    <input type="checkbox" class="case" name="filter3" id="case" /> <label name="Cognac" for="case" style="margin: 10px;">Cognac</label> <br>
    <input type="checkbox" class="case" name="filter4" id="case" /> <label name="Kirsh" for="case" style="margin: 10px;">Kirsh</label> <br>
    <input type="checkbox" class="case" name="filter4" id="case" /> <label name="Vodka" for="case" style="margin: 10px;">Vodka</label> <br>
    <input type="checkbox" class="case" name="filter4" id="case" /> <label name="Tequila" for="case" style="margin: 10px;">Tequila</label> <br>
    
    <form id="search_form" name="button" class="form-inline my-2 my-lg-0">
                <button id="search_box" class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
</section>
<section id="list_cocktail" style="display:flex; flex-wrap: wrap; padding: 10px;">

</section>
</body>
</html>';
?>