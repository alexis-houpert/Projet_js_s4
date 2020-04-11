<?php
session_start();

try
{
    $bdd = new PDO('mysql:host=mysql-alderise.alwaysdata.net;dbname=alderise_cocktail', 'alderise', 'Alexh342000');
}
catch (Exception $e){
    die('Erreur lors de la connexion à la BD : ' . $e->getMessage());

}

if (!isset($_SESSION['pseudo']) | empty($_SESSION['pseudo']))
{
    header("Location: ../.");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <title>Title</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="../script/cocktail-handler.js"></script>
    <script src="../script/cocktail-filter.js"></script>
    
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
                    <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="../json/logout.php">Deconnexion <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="#"><?php echo $_SESSION['pseudo']?> <span class="sr-only">(current)</span></a>
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
    <input type="checkbox" class="case" name="Gin" id="case" style="margin-left: 10px;" /> <label name="Gin" for="case" style="margin: 10px;">Gin</label> <br>
    <input type="checkbox" class="case" name="White rum" id="case" /> <label name="White rum" for="case" style="margin: 10px;">White rum</label> <br>
    <input type="checkbox" class="case" name="Cognac" id="case" /> <label name="Cognac" for="case" style="margin: 10px;">Cognac</label> <br>
    <input type="checkbox" class="case" name="Kirsh" id="case" /> <label name="Kirsh" for="case" style="margin: 10px;">Kirsh</label> <br>
    <input type="checkbox" class="case" name="Vodka" id="case" /> <label name="Vodka" for="case" style="margin: 10px;">Vodka</label> <br>
    <input type="checkbox" class="case" name="Tequila" id="case" /> <label name="Tequila" for="case" style="margin: 10px;">Tequila</label> <br>
    
    <div id="search_form" class="form-inline my-2 my-lg-0">
                <div id="search_box" class="btn btn-secondary my-2 my-sm-0">Search</div>
            </div>
</section>

<section id="content" style="display: flex; ">

<section id="list_cocktail" class="listCocktail">
</section>

<section id="desc_cocktail" class="desc-Cocktail"></section>

</section>

</body>
</html>;
<?php
?>