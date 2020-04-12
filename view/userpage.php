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
    <script src="../script/addCocktail.js"></script>
    
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse show" id="navbarColor01" style="">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../json/logout.php">Deconnexion <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $_SESSION['pseudo']?> <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="/json/addCocktail.php">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</header>


<h1>Composez votre cocktail</h1> <br>
<section id="selection" style="display: flex; flex-wrap: wrap; ">
 
</section>
<section id="selection-submit">
    <div id="search_form" class="form-inline my-2 my-lg-0">
        <div id="search_box" class="btn btn-secondary my-2 my-sm-0">Search</div>
    </div>
    <div id="add_form" class="form-inline my-2 my-lg-0">
        <button type="button" class="btn btn-success">Ajouter</button>
    </div>
    <div style="display: none" id="message" class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <div id="text_message"><strong>Well done!</strong> Connection successful </div>
    </div>
</section>

<section id="content" style="display: flex; ">

<section id="list_cocktail" class="listCocktail">
</section>

<section id="desc_cocktail" class="desc-Cocktail">
</section>

</section>

</body>
</html>;
<?php
?>