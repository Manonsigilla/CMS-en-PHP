<?php
    $errorMessage = "";
    $isEverythingOk = true;
    
    // On vérifie si les champs ne sont pas vides
    if(isset($_POST['submit'])){
        // on récupère les données dans des variables
        $firstname = $_POST['firstname'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $mail = $_POST['email'];
        
        // on vérifie que le mot de passe fasse au moins 8 caractères
        if(strlen($pass) < 8){
            $errorMessage = "Le mot de passe doit faire au moins 8 caractères";
            $isEverythingOk = false;
        }
        // Les champs ne sont pas vides alors on peut vérifier si le mot de passe fait au moins 8 caractères et que l'adresse mail n'existe pas déjà dans la base de données
        if(empty($mail) && empty($pass) && empty($name) && empty($firstname) && empty($username)){
            $errorMessage = "Les champs ne peuvent pas être vides";
            $isEverythingOk = false;
        }
        // on vérifie que l'email est valide
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $errorMessage = "Adresse mail invalide";
            $isEverythingOk = false;
        }
        // on vérifie que l'adresse mail n'existe pas déjà dans la base de données
        if($isEverythingOk){
            session_start();
            require_once('admin/connect.php');
            $requete = "SELECT nom_user as nom, prenom_user as prenom, pseudo_user as pseudo, pass_user as pass, mail_user as mail FROM users WHERE mail_user = :mail";
            $requete = $db->prepare($requete);
            $requete->execute(array(
                "mail" => $mail
            ));
            $result = $requete->fetch();
            if($result){
                $errorMessage = "Quelque chose s'est mal passé, impossible de t'inscrire";
            }
            // Si les champs ne sont pas vides et que le mot de passe fait au moins 8 caractères et que l'adresse mail n'existe pas déjà dans la base de données alors on peut insérer les données dans la base de données
            if(!$result){
                // On hash le mot de passe
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                // On écrit la requête qui permet d'insérer les données dans la base de données
                $requeteInsert = "INSERT INTO users(nom_user, prenom_user, mail_user, pseudo_user, pass_user) VALUES(:nom, :prenom, :mail, :pseudo, :pass)";
                // On prépare la requête
                $requeteInsert = $db->prepare($requeteInsert);
                // On exécute la requête avec les bonnes données
                $requeteInsert->execute(array(
                    "nom" => $name,
                    "prenom" => $firstname,
                    "mail" => $mail,
                    "pseudo" => $username,
                    "pass" => $hash
                ));
                // on connecte l'utilisateur automatiquement et on le redirige vers la page profil.php
                if ($requeteInsert->rowCount() > 0) {
                    // Insertion réussie
                    $_SESSION['pseudo'] = $username;
                    $_SESSION['password'] = $hash;
                    header('Location: profil.php');
                } else {
                    $errorMessage = "Quelque chose s'est mal passé, impossible de t'inscrire";
                }
            }
            
        }
    }

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Inscription</title>
</head>
<body>
    <?php
        //insertion du header
        include_once('components/header.php');
    ?>
    <h1>Formulaire d'inscription</h1>
    <form class="form-inscription" action="" method="post">
        <input type="text" name="name" id="name" placeholder="Nom">
        <input type="text" name="firstname" id="firstname" placeholder="Prénom">
        <input type="text" name="username" id="pseudo" placeholder="pseudo">
        <input type="password" name="pass" id="password" placeholder="Mot de passe">
        <input type="email" name="email" id="email" placeholder="Email">
        <p class="errorMessage"><?= $errorMessage; ?></p>
        <input type="submit" name="submit" value="S'inscrire">
    </form>
</body>
</html>