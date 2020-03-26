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

echo $_POST['submit'];
echo $_POST['id'];
echo $_POST['mdp'];

if (isset($_POST['submit']))
{
    if( !isset($_POST['id']) && !isset($_POST['mdp']) ){
        echo "<span class='invalid-feedback'>Les variables id et mdp ne sont pas définis!</span>";
    }
        $id = htmlspecialchars($_GET['id']);
        $mdp = htmlspecialchars($_GET['mdp']);

        $errorEmpty = false;
        $errorId = false;

        if (empty($id) || empty($mdp)) {
            echo "<span class='invalid-feedback'>Remplissez toutes les cases !</span>"; //déplacer ce code dans le js
            $errorEmpty = true;
        } elseif (filter_var($id, FILTER_VALIDATE_EMAIL)) {
            echo "<span class='invalid-feedback'>Entrez un mail valide !</span>"; //depalcer ce
            $errorId = true;
        } else {
            echo "<span class='valid-feedback'>Formulaire valide !</span>";
        }

        //VERIF BD

    $cryptmdp = sha1($mdp);


    $req = $bdd->prepare('SELECT id, mdp FROM user WHERE user.id = ? AND user.mdp = ?');
    $req->execute($id, $cryptmdp);


    $donnees = $req->fetch();



    $found = isset($donnees['id'] ) && isset($donnees['mdp']);
    if ($found)
    {
        session_start();
        $_SESSION[$id] = $id;
        $obj -> success = true;
    }
    else
    {
        echo "<span class='invalid-feedback'>Pas de correspondance pour l'id et/ou le mot de passe. PHP side</span>";
    }

}
    else {
        echo "<span class='invalid-feedback'>Erreur lors de l'envoi du formulaire !</span>";
    }








/*header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

json_encode($obj); */

