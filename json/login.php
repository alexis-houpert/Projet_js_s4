<?php
session_start();

$obj = new stdClass;
$obj->success = false;
$obj->message = 'Erreur !';


try
{
    $bdd = new PDO('mysql:host=mysql-alderise.alwaysdata.net;dbname=alderise_cocktail', 'alderise', 'Alexh342000');
}
catch (Exception $e){
    die('Erreur lors de la connexion à la BD : ' . $e->getMessage());


}

if (!isset($_SESSION['pseudo']) | empty($_SESSION['pseudo']))
{
    header("Location: /index.php");
}

if (isset($_POST['submitconnect']))
{
    if (!empty($_POST['mailconnect']) && !empty($_POST['mdpconnect']))
    {
        $id = htmlspecialchars($_POST['mailconnect']);
        $mdp = htmlspecialchars($_POST['mdpconnect']);

        $cryptmdp = sha1($mdp);


        $req = $bdd->prepare('SELECT mail, motdepasse FROM user WHERE mail = ? AND motdepasse = ?');
        $req->execute($id, $cryptmdp);


        $donnees = $req->fetch();



        $found = isset($donnees['id'] ) && isset($donnees['mdp']);
        if ($found)
        {
            $obj -> success = true;
            $obj-> message = 'Success';
            $_SESSION[$id] = $id;
            //header("Location:");
        }
        else
        {
            $obj->message = 'Pas de correspondance id / mdp';
            echo "Pas de correspondance pour l'id et/ou le mot de passe";
        }
    }
    else
    {
        $obj->message = 'Les champs envoyés sont vides';
        echo'Les champs envoyés sont vides';
    }
}
else
{
    $obj->message = 'Erreur sur submit';
}


header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($obj);

