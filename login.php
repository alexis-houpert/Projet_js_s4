<?php
session_start();

try
{
    $bdd = new PDO('mysql:host=mysql-alderise.alwaysdata.net;dbname=alderise_cocktail', 'alderise', 'Alexh342000');
}
catch (Exception $e){
    die('Erreur lors de la connexion à la BD : ' . $e->getMessage());

}

$obj = new stdClass;
$obj->success = false;
$obj->message = '';
$obj->pseudo = '';

if (isset($_POST['submitconnect']))
{
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdp = $_POST['mdpconnect'];

    $mdpconnect = sha1($mdp);

    if (!empty($mailconnect) AND !empty($mdpconnect)) //dupliquer les vérification dans le js
    {
        $req = $bdd->prepare('SELECT * FROM user WHERE mail = ? AND motdepasse = ?');
        $req->execute(array($mailconnect, $mdpconnect));



        $userexist = $req->rowCount();

        $result = $req->fetch();


        if ($userexist > 0)
        {
            $_SESSION['id'] = $result['id'];
            $_SESSION['pseudo'] = $result['pseudo'];

            $obj-> success = true;
            $obj-> message = 'Connexion réussie';
            $obj->pseudo = $result['pseudo'];
            echo json_encode($obj);
            //header('Location: /view/userpage.php?id=' . $result['pseudo']);
            exit();
        }
        else
        {
            $obj-> success = false;
            $obj-> message = 'Le mail et le mot de passe sont incorrects    ';
            echo json_encode($obj);
            exit();
        }
    }
    else
    {
        $obj-> success = false;
        $obj-> message = 'Tous les champs doivent être complétés';
        echo json_encode($obj);
        //$erreur= "Tous les champs doivent être complétés";
        exit();
    }
}
else
{
    $obj-> success = false;
    $obj-> message = 'Le formulaire est corrompu !';
    exit();
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($obj);
