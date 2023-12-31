<?php
    // Manipulation de base de données avec PDO

    // Connexion à la base de données

    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=wordpress;charset=utf8',
            'admin_wordpress', // nom d'utilisateur
            'Touslesdroits', // password
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Active la gestion des erreurs
            ]
        );
    } catch (Exception $e) {
        echo "Connexion refusée à la base de données";
        // écriture de la vraie erreur dans un fichier log
        // echo "Error: ".$e->getMessage();
        exit();
    }
?>