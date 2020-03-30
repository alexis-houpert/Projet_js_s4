<?php
session_start();

try
{
    $bdd = new PDO('mysql:host=mysql-alderise.alwaysdata.net;dbname=alderise_cocktail', 'alderise', 'Alexh342000');
}
catch (Exception $e){
    die('Erreur lors de la connexion à la BD : ' . $e->getMessage());

}

if (isset($_POST['submitconnect']))
{
    $mailconnect = htmlspecialchars($_POST['idconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);

    if (!empty($mailconnect) AND !empty($mdpconnect)) //dupliquer les vérification dans le js
    {
        $req = $bdd->prepare('SELECT * FROM user WHERE id = ? AND mdp = ?');
        $req->execute(array($mailconnect, $mdpconnect));
        $userexist = $req->rowCount();

        if ($userexist == 1)
        {
            $userinfo = $req->fetch();
            $_SESSION['num'] = $userinfo['num'];
            $_SESSION['id'] = $userinfo['id'];
            header("Location: view/userpage.php?id=".$_SESSION['id']);
            exit();
        }
        else
        {
            $erreur = "Mauvais mail ou mot de passe";
        }
    }
    else
    {
        $erreur= "Tous les champs doivent être complétés";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Titre de la page</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <script src="script/login.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" wfd-id="651">
            <span class="navbar-toggler-icon" wfd-id="466"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01" wfd-id="458">
            <ul class="navbar-nav mr-auto" wfd-id="460">
                <li class="nav-item active" wfd-id="464">
                    <a class="nav-link" href="index.php">Home <span class="sr-only" wfd-id="465">(current)</span></a>
                </li>
                <li class="nav-item" wfd-id="463">
                    <a class="nav-link" href="view/inscription.php">Inscription</a>
                </li>
            </ul>
        </div>
    </nav>
</header>


<h2>Boisson à composer</h2>


<legend style="width: 20%; margin-left: auto; margin-right: 5%;">Connexion</legend>

<form action="index.php" method="post" wfd-id="337" style="width: 20%; margin-left: auto; margin-right: 5%;">
    <fieldset>
<div class="form-group" wfd-id="361">
    <label for="exampleInputEmail1" wfd-id="362">Email address</label>
    <input name="mailconnect" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" wfd-id="510">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
</div>
<div class="form-group" wfd-id="359">
    <label for="exampleInputPassword1" wfd-id="360">Password</label>
    <input name="mdpconnect" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" wfd-id="509">
</div>
    </fieldset>
    <button name="submit" type="submit" class="btn btn-primary" wfd-id="575">Submit</button>
</form>

<div id="message"></div>
<?php
if (isset($erreur))
    echo '<label color="red">'.$erreur.'</label>';
?>



</body>
</html>
