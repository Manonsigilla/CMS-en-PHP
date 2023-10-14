<?php
require_once('admin/connect.php');
@session_start();
if(!isset($_SESSION['pseudo'])){
    header('Location: ../error404.php');
    exit;
}
$isEverythingOk = true;
$errorMessage = '';
$successMessage = '';

// sur cette page on modifie le pseudo, le mot de passe ou l'avater de l'user, on peut aussi supprimer son compte ou se déconnecter de son compte
// on vérifie si l'utilisateur a cliqué sur le bouton modifier
if (isset($_POST['submit'])) {
    //on récupère les données du formulaire
    $newPseudo = $_POST['pseudo'];
    $newPass = $_POST['pass'];

    // on vérifie si un fichier a été téléchargé
    if (!empty($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
        $avatarFileName = $_FILES['avatar']['name'];
        $avatarFileTmpName = $_FILES['avatar']['tmp_name'];
        $avatarFileSize = $_FILES['avatar']['size'];
        $avatarFileType = $_FILES['avatar']['type'];

        // on récupère l'extension du fichier
        $avatarFileExtension = pathinfo($avatarFileName, PATHINFO_EXTENSION);
        // on crée un tableau avec les extensions autorisées
        $avatarFileAllowedExtension = array('jpg', 'jpeg', 'png', 'gif');
        // on vérifie si l'extension du fichier est autorisée
        if (!in_array($avatarFileExtension, $avatarFileAllowedExtension)) {
            $errorMessage = "L'extension du fichier n'est pas autorisée !";
            $isEverythingOk = false;
        }
        // on vérifie si la taille du fichier est inférieure à 2Mo
        if ($avatarFileSize > 2000000) {
            $errorMessage = "La taille du fichier doit être inférieure à 2Mo !";
            $isEverythingOk = false;
        }
        // on vérifie si $avatarFileTmpName n'est pas vide
        if (empty($avatarFileTmpName)) {
            $errorMessage = "Veuillez sélectionner un fichier !";
            $isEverythingOk = false;
        }
        // on vérifie si tout est ok
        if ($isEverythingOk == true) {
            // on crée un nouveau nom pour le fichier
            $newAvatarFileName = uniqid() . '.' . $avatarFileExtension;
            // on crée le chemin de destination du fichier
            $destination = 'uploads/' . $newAvatarFileName;
            // on déplace le fichier dans le dossier uploads
            move_uploaded_file($avatarFileTmpName, $destination);
            // on récupère le chemin du fichier
            $newAvatar = 'uploads/' . $newAvatarFileName;
            // on écrit la requête qui permet de modifier l'avatar de l'user dans la base de données
            $requete = "UPDATE users SET avatar_user = :avatar WHERE pseudo_user = :pseudo";
            // on prépare la requête
            $requete = $db->prepare($requete);
            // on exécute la requête
            $requete->execute(array(
                "avatar" => $newAvatar,
                "pseudo" => $_SESSION['pseudo']
            ));
            //on met à jour la variable de session
            $_SESSION['avatar'] = $newAvatar;

            $successMessage = "Votre avatar a bien été modifié !";

            if ($isEverythingOk == false) {
                $errorMessage = "Une erreur est survenue lors du téléchargement de votre avatar !";
                $isEverythingOk = false;
            }
        }
    }
}

if (isset($_POST['submit'])) {
    //on récupère les données du formulaire
    $newPseudo = $_POST['pseudo'];
    $newPass = $_POST['pass'];
    // on vérifie si le pseudo ou le mot de passe a été modifié et si c'est le cas on mets à jour dans la base de données
    if(!empty($newPseudo)) {
        $newPseudo = htmlspecialchars($newPseudo);
        // on écrit la requête qui permet de modifier le pseudo de l'user dans la base de données
        $requete = "UPDATE users SET pseudo_user = :pseudo WHERE pseudo_user = :pseudo";
        // on prépare la requête
        $requete = $db->prepare($requete);
        // on exécute la requête
        $requete->execute(array(
            "pseudo" => $newPseudo
        ));
        // on met à jour la variable de session
        $_SESSION['pseudo'] = $newPseudo;
        $resultat = $requete->fetch();

        if (!$resultat) {
            $successMessage = "Votre pseudo a bien été modifié !";
        } else {
            $errorMessage = "Une erreur est survenue lors de la modification de votre pseudo !";
            $isEverythingOk = false;
        }
    }
}

if (isset($_POST['submit'])) {
    //on récupère les données du formulaire
    $newPseudo = $_POST['pseudo'];
    $newPass = $_POST['pass'];
    // on vérifie si le mot de passe a été modifié et si c'est le cas on mets à jour dans la base de données
    if (!empty($newPass)) {
        $newPass = htmlspecialchars($newPass);
        // on hash le mot de passe
        $newPass = password_hash($newPass, PASSWORD_DEFAULT);
        // on écrit la requête qui permet de modifier le mot de passe de l'user dans la base de données
        $requete = "UPDATE users SET pass_user = :pass WHERE pseudo_user = :pseudo";
        // on prépare la requête
        $requete = $db->prepare($requete);
        // on exécute la requête
        $requete->execute(array(
            "pass" => $newPass,
            "pseudo" => $_SESSION['pseudo']
        ));
        // on met à jour la variable de session
        $_SESSION['pass'] = $newPass;
        $resultat = $requete->fetch();

        if ($resultat) {
            $successMessage = "Votre mot de passe a bien été modifié !";
        } else {
            $errorMessage = "Une erreur est survenue lors de la modification de votre mot de passe !";
            $isEverythingOk = false;
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
        <section class="bienvenueSection">
            <?php if(!empty($_SESSION['avatar'])): ?>
                <img src="<?php echo $_SESSION['avatar']; ?>" alt="avatar" class="avatar-profil">
            <?php endif; ?>
            <h2>Bienvenue <?php echo $_SESSION['pseudo']; ?></h2>
        </section>
        <section class="profil-content">
            <!-- //on affiche l'avatar de l'user s'il en a un -->
            <section class="profil profil-change">
                <!-- // on propose de modifier le pseudo, le mot de passe ou l'avatar -->
                <form action="profil.php" method="post" enctype="multipart/form-data" class="form-profil">
                    <input type="text" name="pseudo" placeholder="pseudo" value="<?php echo $_SESSION['pseudo']; ?>">
                    <input type="password" name="pass" placeholder="Mot de passe" value="<?php echo $_SESSION['pass']; ?>">
                    <label for="avatar">Ajoutez ou modifiez votre photo de profil :</label>
                    <input type="file" name="avatar" id="avatar" ">
                    <input class="boutonModifier" type="submit" name="submit" value="Modifier">
                </form>
                <p class="errorMessage"><?php echo $errorMessage; ?></p>
                <p class="successMessage"><?php echo $successMessage; ?></p>
            </section>
            <!-- on propose de se déconnecter -->
            <section class="profil">
                <a href="../creationCMS/admin/deconnexion.php" class="boutonDeconnecter">Se déconnecter</a>
            </section>
            <section class="profil">
                <!-- // on propose de supprimer le compte avec l'id de l'user -->
                <a href="supprimercompte.php?id=<?php echo $_SESSION['pseudo']; ?>" class="boutonSupprimer">Supprimer mon compte</a>
            </section>
        </section>
    </div>
</main>
<?php
    //insertion du footer
    include_once('components/footer.php');
?>
</body>
</html>