<?php
require_once('connect.php');
$id = $_GET['id'];

$requete = "DELETE FROM articles WHERE article_id = :id";

$requete = $db->prepare($requete);

$requete->execute(array(
    "id" => $id
));

header('location: listearticles.php');

?>