<?php
try
{
    $bdd = new PDO('mysql:host=mysql-alderise.alwaysdata.net;dbname=alderise_cocktail', 'alderise', 'Alexh342000');
}
catch (Exception $e){
    die('Erreur lors de la connexion à la BD : ' . $e->getMessage());

}

if (isset($_POST['submit']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail1 = htmlspecialchars($_POST['mail1']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp1 = $_POST['mdp1'];
    $mdp2 = $_POST['mdp2'];

    $cryptmdp1 = password_hash($mdp1, PASSWORD_DEFAULT);

    if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
    {


        $pseudolenght = strlen($pseudo);
        if ($pseudolenght <= 30)
        {
            if ($mail1 == $mail2)
            {
                if (filter_var($mail1, FILTER_VALIDATE_EMAIL))
                {
                    $reqmail = $bdd->prepare("SELECT mail FROM user WHERE mail = ?");
                    $reqmail->execute(array($mail1));
                    if ($reqmail->rowCount() == 0)
                    {
                        if ($mdp1 == $mdp2)
                        {
                            $insertmbr = $bdd->prepare("INSERT INTO user (pseudo, mail, motdepasse) VALUES(?, ?, ?) ");
                            $insertmbr->execute(array($pseudo, $mail1, $cryptmdp1));
                            $erreur = "Votre compte a été créé !";
                        }
                        else
                        {
                            $erreur = "Les mots de passes ne sont pas validés";
                        }
                    }
                    else
                    {
                        $erreur = "Adresse mail déja utilisé";
                    }

                }
                else
                {
                    $erreur = "Votre adresse mail n'est pas valide";
                }

            }
            else
            {
                $erreur = "Erreur : les adresses mail ne correspondent pas";
            }
        }
        else
        {
            $erreur = 'Votre pseudo ne doit pas dépasser les 30 caractères';
        }

    }
    else
    {
        $erreur = "Certains champs sont vides !";
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
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" wfd-id="651">
            <span class="navbar-toggler-icon" wfd-id="466"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01" wfd-id="458">
            <ul class="navbar-nav mr-auto" wfd-id="460">
                <li class="nav-item active" wfd-id="464">
                    <a class="nav-link" href="../index.php">Home <span class="sr-only" wfd-id="465">(current)</span></a>
                </li>
                <li class="nav-item" wfd-id="463">
                    <a class="nav-link" href="../index.php">Connexion</a>
                </li>
            </ul>
        </div>
    </nav>
</header>


<h2>Boisson à composer</h2>

<a href="login.php">Connexion</a>

<legend style="width: 20%; margin-left: auto; margin-right: auto;">Inscription</legend>

<form action="inscription.php" method="post" wfd-id="337" style="width: 20%; margin-left: auto; margin-right: auto;">
    <fieldset>
        <div class="form-group" wfd-id="361">
            <label for="exampleInputEmail1" wfd-id="362">Pseudo</label>
            <input name="pseudo" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez un pseudo" wfd-id="510">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group" wfd-id="361">
            <label for="exampleInputEmail1" wfd-id="362">Email address</label>
            <input name="mail1" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez un email" wfd-id="510">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group" wfd-id="361">
            <label for="exampleInputEmail1" wfd-id="362">Email address Verification</label>
            <input name="mail2" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Confirmez votre email" wfd-id="510">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group" wfd-id="359">
            <label for="exampleInputPassword1" wfd-id="360">Password</label>
            <input name="mdp1" type="password" class="form-control" id="exampleInputPassword1" placeholder="Entrez mot de passe" wfd-id="509">
        </div>
        <div class="form-group" wfd-id="359">
            <label for="exampleInputPassword1" wfd-id="360">Password Verification</label>
            <input name="mdp2" type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirmer mot de passe" wfd-id="509">
        </div>
    </fieldset>
    <button name="submit" type="submit" class="btn btn-primary" wfd-id="575">S'inscrire</button>
</form>


<div id="message"></div>
<?php
if (isset($erreur))
    echo '<label color="red">'.$erreur.'</label>';
?>



</body>
</html>
