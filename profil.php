<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Profil</title>
</head>
<body>
<?php
    //insertion du header
    include_once('components/header.php');
?>
<main>
    <div class="page-profil">
        <h1>Profil</h1>
        <p>Bienvenue <?php echo $_SESSION['pseudo']; ?></p>
        <p>Vous êtes connecté en tant que <?php echo $_SESSION['pseudo']; ?></p>
        <section class="profil-content">
            <section class="profil profil-change">
                <!-- // on propose de modifier le pseudo, le mot de passe ou l'avatar -->
                <form action="profil.php" method="post" class="form-profil">
                    <input type="text" name="pseudo" placeholder="pseudo">
                    <input type="password" name="pass" placeholder="Mot de passe">
                    <input type="submit" name="submit" value="Modifier">
                </form>
                <form action="profil.php" method="post" enctype="multipart/form-data" class="form-profil">
                    <input type="file" name="avatar" id="avatar">
                    <input type="submit" name="submit" value="Modifier">
                </form>
            </section>
            <!-- on propose de se déconnecter -->
            <section class="profil">
                <form action="profil.php" method="post" class="form-profil">
                    <input type="submit" name="submit" value="Se déconnecter">
                </form>
            </section>
            <section class="profil">
                <!-- // on propose de supprimer le compte -->
                <form action="profil.php" method="post" class="form-profil">
                    <input type="submit" name="submit" value="Supprimer le compte">
                </form>
            </section>
        </section>
    </div>
</main>
</body>
</html>