<?php
session_start();


$jsonString = file_get_contents('cocktail.json');
$jsonImg = file_get_contents('cocktail2.json');


$data = json_decode($jsonString, true);




$obj = new stdClass;
$obj->success = false;
$obj->message = '';

if(empty($_POST['name']) | empty($_POST['glass']) | empty($_POST['preparation']) | empty($_POST['category']))
{
    $obj->success = false;
    $obj->message = 'Certains champs doivent etre completes';
    echo json_encode($obj);
    exit();
}

$name = htmlspecialchars($_POST['name']);
$glass = htmlspecialchars($_POST['glass']);
$category = htmlspecialchars($_POST['category']);
$garniture = htmlspecialchars($_POST['garniture']);
$preparation = htmlspecialchars($_POST['preparation']);
$ingredients[] = htmlspecialchars($_POST['ingredients']);
$author = htmlspecialchars($_POST['author']);
$date = htmlspecialchars($_POST['date']);
$image = htmlspecialchars($_POST['image']);




$array = array('name' => $name,
    'glass' => $glass,
    'category' => $category,
    'ingredient' => $ingredients,
    'garnish' => $garniture,
    'preparation' => $preparation,
    'author' => $author,
    'image' => $image,
    'dateModify' => $date
    );

array_push($data, $array); //OK

$newJsonString = json_encode($data);
file_put_contents('cocktail.json', $newJsonString);







header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');


$obj->success = true;
$obj->message = 'Modification effectuee';
echo json_encode($obj);
exit();

