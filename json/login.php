<?php
session_start();

$obj = new stdClass;
$obj->success = false;
$obj->message = 'Erreur, le username ou le mdp il faut se débrouiller dans la vie';

// Ici inclure le code qui recup le user et le mdp
// On recupère l'ID et le mdp de l'utilisateur et on effectue un appel à la bd pour comparer
//ajouter verification

if (isset($_GET['id']) && isset($_Post['mdp']))
{
    $id = htmlspecialchars($_POST['id']);
    $mdp = htmlspecialchars($_POST['mdp']);
    console.log("REcuperation dans l'URL");


}
else
{
    echo "Incorrect id or mdp";
}

$cryptmdp = sha1($mdp);


try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet-web-s4;charset=utf8', 'root', '');

    $req = $bdd->prepare('SELECT id, mdp FROM user WHERE user.id = ? AND user.mdp = ?');
    $req->execute($id, $cryptmdp);


    $donnees = $req->fetch();



    $found = isset($donnees['id'] ) && isset($donnees['mdp']);
    if ($found)
    {
        $obj -> success = true;
        $_SESSION[$id] = $id;
    }
    else
    {
        echo "Pas de correspondance pour l'id et/ou le mot de passe";
    }

} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}




header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($obj);
