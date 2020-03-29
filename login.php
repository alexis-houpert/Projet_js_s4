<?php
session_start();


$obj = new stdClass;
$obj->success = false;
$obj->message = 'Erreur, pas de correspondance  id mdp. Il faut se débrouiller dans la vie';


try
{
    $bdd = new PDO('mysql:host=mysql-alderise.alwaysdata.net;dbname=alderise_cocktail', 'alderise', 'Alexh342000');
}
catch (Exception $e){
    die('Erreur lors de la connexion à la BD : ' . $e->getMessage());


}

    if( !isset($_POST['id']) && !isset($_POST['mdp']) ){
        echo "<span class='invalid-feedback'>Les variables id et mdp ne sont pas définis!</span>";
    }
        $id = htmlspecialchars($_POST['id']);
        $mdp = htmlspecialchars($_POST['mdp']);

        $errorEmpty = false;
        $errorId = false;

        if (empty($id) || empty($mdp)) {
            echo "<span class='invalid-feedback'>Remplissez toutes les cases !</span>"; //déplacer ce code dans le js
            $errorEmpty = true;
        } elseif (filter_var($id, FILTER_VALIDATE_EMAIL)) {
            echo "<span class='invalid-feedback'>Entrez un mail valide !</span>"; //depalcer ce
            $errorId = true;
        } /*else {
            echo "<span class='valid-feedback'>Formulaire valide !</span>";
        }*/

        //VERIF BD

    $cryptmdp = sha1($mdp);
    //echo $cryptmdp;

    $req = $bdd->prepare('SELECT id, mdp FROM user WHERE user.id = :id AND user.mdp = :mdp');
    $req->bindParam(':id', $id);
    $req->bindParam(':mdp', $cryptmdp);
    $req->execute();


    $donnees = $req->fetch();

    if (true)
    {
        session_start();
        $_SESSION[$id] = 123;
        $obj -> success = true;
    }
    else
    {
        echo "<span class='invalid-feedback'>Pas de correspondance pour l'id et/ou le mot de passe. PHP side</span>";
    }




header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

json_encode($obj);

