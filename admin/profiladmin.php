<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Profil</title>
</head>
<body>
<?php
    //insertion du header
    include_once('headeradmin.php');
?>

    <div class="page-profil">
        <h1>Profil</h1>
        <p>Bienvenue <?php echo $_SESSION['pseudo']; ?></p>
        <p>Vous êtes connecté en tant que <?php echo $_SESSION['pseudo']; ?></p>
        <a href="deconnexion.php">Se déconnecter</a>
    </div>
</body>
</html>