<?php
    // on démarre la session d'utilisateur connecté 
    session_start();
    require_once('connect.php');

    $id = null;
    $nom =null;
    $prenom =null;
    $mail =null;
    $pseudo =null;
    $password =null;
    $niveau =null;
    // on vérifie si l'utilisateur est connecté
    if(isset($_SESSION['pseudo'])){
        // on écrit la requête qui permet de récupérer les données de l'utilisateur
        $requete = "SELECT * FROM users WHERE pseudo_user = :pseudo";
        // on prépare la requête
        $requete = $db->prepare($requete);
        // on exécute la requête avec les bonnes données
        $requete->execute(array(
            "pseudo" => $_SESSION['pseudo']
        ));
        // on récupère les données de la base de données
        $resultat = $requete->fetch();
        // on stocke les données dans des variables
        $id = $resultat['id_user'];
        $nom = $resultat['nom_user'];
        $prenom = $resultat['prenom_user'];
        $mail = $resultat['mail_user'];
        $pseudo = $resultat['pseudo_user'];
        $password = $resultat['pass_user'];
        $niveau = $resultat['niveau_user'];
    } 
    // on vérifie que l'utilisateur connecté sur la page est bien un admin, sinon on affiche la page error 404
    // si c'est l'admin alors on lui attribue un niveau de connexion
    $niveauRequete = "SELECT niveau_user as niveau FROM users WHERE pseudo_user = :pseudo";
    $niveauRequete = $db->prepare($niveauRequete);
    $niveauRequete->execute(array(
        "pseudo" => $pseudo
    ));
    $resultatNiveau = $niveauRequete->fetch();
    if($resultatNiveau['niveau'] != '1') {
        // alors l'utilisateur ne peut pas accéder à la page
        header('Location: ../error404.php');
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Liste utilisateurs</title>
</head>
<body>
<?php
    //insertion du header
    include_once('headeradmin.php');
    // si l'utilisateur est bien un admin alors on affiche la page
    if($resultatNiveau['niveau'] === '1') {
        // connexion à la base de données
        include_once 'connect.php';
        // on récupère les données de la base de données
        $mysql = "SELECT * FROM users";
        $resultat = $db->query($mysql);
        // on affiche un titre
        echo "<h1>Liste des utilisateurs</h1>";
        echo "<section class='listeUtilisateurs'>";
        echo "<table class='tableauUtilisateurs'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Id</th>";
        echo "<th>Avatar</th>";
        echo "<th>Nom</th>";
        echo "<th>Prénom</th>";
        echo "<th>Pseudo</th>";
        echo "<th>Niveau</th>";
        echo "<th>Modifier</th>";
        echo "<th>Supprimer</th>";
        echo "</tr>";
        echo "</thead>";
        // on récupère les données de la base de données et on les affiche dans le tableau déjà créé en html
        echo "<tbody>";
        if ($resultat->rowCount() == 0) {
            echo "<p>Aucun résultat</p>";
        } else {
            while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                    echo "<td>" . $donnees['id_user'] . "</td>";
                    echo "<td><img src='../images/avatars/" . $donnees['avatar_user'] . "' alt='avatar' class='avatar'></td>";
                    echo "<td>" . $donnees['nom_user'] . "</td>";
                    echo "<td>" . $donnees['prenom_user'] . "</td>";
                    echo "<td>" . $donnees['pseudo_user'] . "</td>";
                    echo "<td>" . $donnees['niveau_user'] . "</td>";
                    echo "<td><a class='boutonModifier' href='modifierutilisateur.php?id=" . $donnees['id_user'] . "'>Modifier</a></td>";
                    echo "<td><a class='boutonSupprimer' href='supprimerutilisateur.php?id=" . $donnees['id_user'] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ?\"'>Supprimer</a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</section>";
        }
    }


    ?>
</body>
</html>