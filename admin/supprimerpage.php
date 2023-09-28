<?php
require_once('connect.php');
$id = $_GET['id'];

$requete = "DELETE FROM pages WHERE id_page = :id";

$requete = $db->prepare($requete);

$requete->execute(array(
    "id" => $id
));

header('location: listepages.php');

?>