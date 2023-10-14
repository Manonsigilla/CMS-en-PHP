<?php
require_once('connect.php');
$message = "";
$errorMessage = "";
// on récupère l'id de la page dans l'url
$id = $_GET['id'];

// on écrit la requête qui permet de récupérer les données de la page dans la base de données
$requete = "SELECT * FROM pages WHERE id_page = :id";

// on prépare la requête
$requete = $db->prepare($requete);

// on exécute la requête
$requete->execute(array(
    "id" => $id
));

// on récupère les données
$page = $requete->fetch(PDO::FETCH_OBJ);

// on vérifie si la page existe
if (!$page) {
    // si la page n'existe pas, on redirige vers la page listepages.php
    header('Location: listepages.php');
    exit();
}

if(!empty($_FILES['image_page'])){
    // on récupère le nom de l'image
    $nomImage = $_FILES['image_page']['name'];
    // on récupère le chemin de l'image
    $cheminImage = $_FILES['image_page']['tmp_name'];
    // on récupère l'extension de l'image
    $extensionImage = pathinfo($nomImage, PATHINFO_EXTENSION);
    // on crée un tableau avec les extensions autorisées
    $extensionArray = array('png', 'jpg', 'jpeg');
    // si l'image est supérieure à 2Mo alors on affiche un message d'erreur
    if($_FILES['image_page']['size'] > 2000000){
        $errorMessage = "La taille de l'image doit être inférieure à 2Mo !";
    }
    // si l'extension de l'image n'est pas autorisée alors on affiche un message d'erreur
    if(!in_array($extensionImage, $extensionArray)){
        $errorMessage = "L'extension de l'image doit être au format png, jpg ou jpeg !";
    }
}

// on vérifie si le formulaire a été envoyé
if (isset($_POST['titre']) && isset($_POST['image']) && isset($_POST['contenu']) && isset($_POST['statut'])) {
    // on récupère les données du formulaire
    $titre = $_POST['titre'];
    $image = $_POST['image'];
    $contenu = $_POST['contenu'];
    $statut = $_POST['statut'];

    // on écrit la requête qui permet de modifier les données de l'page dans la base de données
    $requete = "UPDATE pages SET titre_page = :titre, image_page = :img, contenu_page = :contenu, statut_page = :statut WHERE id_page = :id";

    // on prépare la requête
    $requete = $db->prepare($requete);

    // on exécute la requête avec les bonnes données
    $requete->execute(array(
        "titre" => $titre,
        "img" => $image,
        "contenu" => $contenu,
        "statut" => $statut,
        "id" => $id
    ));

    // on confirme que l'page a bien été modifié et on lui mets un lien pour retourner à la liste des pages
    $message = "La page a bien été modifié ! <a class='lien-retour' href='listepages.php'>Retour</a>";
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Modification de page</title>
</head>
<body>
    <?php
        //insertion du header
        include_once('headeradmin.php');
    ?>
    <h1>Modifier la page</h1>
    <section class="pageContent">
        <?php echo $message; ?>
        <form class="pageDetail" enctype="multipart/form-data" method="post" action="">
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="<?php echo $page->titre_page; ?>">
            <label for="image">Image</label>
            <input type="text" name="image" id="image" value="<?php echo $page->image_page; ?>">
            <input type="file" name="image" id="image" value="<?php echo $page->image_page; ?>">
            <label for="contenu">Contenu</label>
            <textarea name="contenu" id="contenu" cols="30" rows="10"><?php echo $page->contenu_page; ?></textarea>
            <label for="statut">Statut</label>
            <select name="statut" id="statut">
                <option value="Publié" <?php if($page->statut_page == 'Publié'){ echo "selected"; } ?>>Publié</option>
                <option value="Brouillon" <?php if($page->statut_page == 'Brouillon'){ echo "selected"; } ?>>Brouillon</option>
                <option value="En attente de relecture" <?php if($page->statut_page == 'En attente de relecture'){ echo "selected"; } ?>>En attente de relecture</option>
            </select>
            <input type="submit" value="Modifier la page">
        </form>
    </section>
</body>
</html>