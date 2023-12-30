<?php


require_once __DIR__ . "/vendor/autoload.php";

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->selectDatabase('car');
$userCollection = $database->selectCollection('user');

?>