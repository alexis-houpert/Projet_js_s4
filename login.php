<?php
session_start();

//$obj = new stdClass;
//$obj->success = false;
//$obj->message = 'Erreur, le username ou le mdp il faut se débrouiller dans la vie';


try
{
    $bdd = new PDO('mysql:host=mysql-alderise.alwaysdata.net;dbname=alderise_cocktail', 'alderise', 'Alexh342000');
}
catch (Exception $e){
    die('Erreur lors de la connexion à la BD : ' . $e->getMessage());


}

if (isset($_POST['submit']))
{
    if (!empty($_POST['id']) && !empty($_POST['mdp']))
    {
        $id = htmlspecialchars($_POST['id']);
        $mdp = htmlspecialchars($_POST['mdp']);

        $cryptmdp = sha1($mdp);


        $req = $bdd->prepare('SELECT id, mdp FROM user WHERE user.id = ? AND user.mdp = ?');
        $req->execute($id, $cryptmdp);


        $donnees = $req->fetch();



        $found = isset($donnees['id'] ) && isset($donnees['mdp']);
        if ($found)
        {
            //$obj -> success = true;
            $_SESSION[$id] = $id;
        }
        else
        {
            echo "Pas de correspondance pour l'id et/ou le mot de passe";
        }
    }
    else
    {
        echo'Les champs envoyés sont vides';
    }
}
else
{
    echo'Erreur : ';
}


header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($obj);
