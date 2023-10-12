<!-- On supprime l'utilisateur de la base de données ici et l'utilisateur est redirigé automatiquement dans la page listeutilisateurs.php -->

<?php

require_once('connect.php');
$id = $_GET['id'];

$requete = "DELETE FROM users WHERE id_user = :id";

$requete = $db->prepare($requete);

$requete->execute(array(
    "id" => $id
));

header('location: listeutilisateurs.php');

?>