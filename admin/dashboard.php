<?php

session_start();
/*
    Cette page ne doit s'afficher que si l'admin est connecté

    Cette page doit permettre : 
        - De créer une nouvelle page
        - De créer un nouvel article
        - De gérer les comptes utilisateurs

    Sur cette page vous devez également afficher :
        - Les derniers articles (les 5 derniers)
        - Les dernières pages (les 5 dernières)
        - Les derniers utilisateurs (les 5 derniers)

    Vous devez avoir la possibilité de :
        - Afficher la liste complète des articles (c'est une page à part entière)
        - Afficher la liste complète des pages (c'est une page à part entière)
        - Afficher la liste complète des utilisateurs (c'est une page à part entière)
*/
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Dashboard</title>
</head>
<body>
    <?php
        //insertion du header
        include_once('headeradmin.php');
    ?>
</body>
</html>