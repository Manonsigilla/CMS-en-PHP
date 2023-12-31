<?php
require_once('connect.php');
$message = "";
$errorMessage = "";
// on récupère l'id de l'article dans l'url
$id = $_GET['id'];

// on écrit la requête qui permet de récupérer les données de l'article dans la base de données
$requete = "SELECT * FROM articles WHERE article_id = :id";

// on prépare la requête
$requete = $db->prepare($requete);

// on exécute la requête
$requete->execute(array(
    "id" => $id
));

// on récupère les données
$article = $requete->fetch(PDO::FETCH_OBJ);

// on vérifie si l'article existe
if (!$article) {
    // si l'article n'existe pas, on redirige vers la page listearticles.php
    header('Location: listearticles.php');
    exit();
}

if(!empty($_FILES['image_article'])){
    // on récupère le nom de l'image
    $nomImage = $_FILES['image_article']['name'];
    // on récupère le chemin de l'image
    $cheminImage = $_FILES['image_article']['tmp_name'];
    // on récupère l'extension de l'image
    $extensionImage = pathinfo($nomImage, PATHINFO_EXTENSION);
    // on crée un tableau avec les extensions autorisées
    $extensionArray = array('png', 'jpg', 'jpeg');
    // si l'image est supérieure à 2Mo alors on affiche un message d'erreur
    if($_FILES['image_article']['size'] > 2000000){
        $errorMessage = "La taille de l'image doit être inférieure à 2Mo !";
    }
    // si l'extension de l'image n'est pas autorisée alors on affiche un message d'erreur
    if(!in_array($extensionImage, $extensionArray)){
        $errorMessage = "L'extension de l'image doit être au format png, jpg ou jpeg !";
    }
}

// on vérifie si le formulaire a été envoyé
if (isset($_POST['titre']) && isset($_POST['image']) && isset($_POST['contenu']) && isset($_POST['categorie']) && isset($_POST['statut'])) {
    // on récupère les données du formulaire
    $titre = $_POST['titre'];
    $image = $_POST['image'];
    $contenu = $_POST['contenu'];
    $categorie = $_POST['categorie'];
    $statut = $_POST['statut'];

    // on écrit la requête qui permet de modifier les données de l'article dans la base de données
    $requete = "UPDATE articles SET titre_article = :titre, image_article = :img, contenu_article = :contenu, categorie_article = :categorie, statut_article = :statut WHERE article_id = :id";

    // on prépare la requête
    $requete = $db->prepare($requete);

    // on exécute la requête avec les bonnes données
    $requete->execute(array(
        "titre" => $titre,
        "img" => $image,
        "contenu" => $contenu,
        "categorie" => $categorie,
        "statut" => $statut,
        "id" => $id
    ));

    // on confirme que l'article a bien été modifié et on lui mets un lien pour retourner à la liste des articles
    $message = "L'article a bien été modifié ! <a class='lien-retour' href='listearticles.php'>Retour</a>";
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Modification d'article</title>
</head>
<body>
    <?php
        //insertion du header
        include_once('headeradmin.php');
    ?>
    <h1>Modifier l'article</h1>
    <section class="articleContent">
        <?php echo $message; ?>
        <form class="articleDetail" enctype="multipart/form-data" method="post" action="">
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="<?php echo $article->titre_article; ?>">
            <label for="image">Image</label>
            <input type="text" name="image" id="image" value="<?php echo $article->image_article; ?>">
            <input type="file" name="image" id="image" value="<?php echo $article->image_article; ?>">
            <label for="contenu">Contenu</label>
            <textarea name="contenu" id="contenu" cols="30" rows="10"><?php echo $article->contenu_article; ?></textarea>
            <label for="categorie">Catégorie</label>
            <select name="categorie" id="categorie">
                <option value="Culture" <?php if($article->categorie_article == 'Culture'){ echo "selected"; } ?>>Culture</option>
                <option value="Economie" <?php if($article->categorie_article == 'Economie'){ echo "selected"; } ?>>Economie</option>
                <option value="Politique" <?php if($article->categorie_article == 'Politique'){ echo "selected"; } ?>>Politique</option>
            </select>
            <label for="statut">Statut</label>
            <select name="statut" id="statut">
                <option value="publié" <?php if($article->statut_article == 'publié'){ echo "selected"; } ?>>Publié</option>
                <option value="brouillon" <?php if($article->statut_article == 'brouillon'){ echo "selected"; } ?>>Brouillon</option>
                <option value="en attente de relecture" <?php if($article->statut_article == 'en attente de relecture'){ echo "selected"; } ?>>En attente de relecture</option>
            </select>
            <input type="submit" value="Modifier l'article">
        </form>
    </section>
</body>
</html>