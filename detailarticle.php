<?php
require_once('admin/connect.php');

// on affiche l'article dont l'id est passé en paramètre dans l'url
$requete = "SELECT * FROM articles WHERE article_id = :id";
$requete = $db->prepare($requete);
$requete->execute(array(
    "id" => $_GET['id']
));
$article = $requete->fetch(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Home</title>
</head>
<body>
    <?php
        //insertion du header
        include_once('components/header.php');
    ?>
    <main>
        <section class="listeArticles">
            <a class="lien-retour" href="index.php">Retour à la page d'accueil</a>
            <a href="detailarticle.php">
                <article>
                    <h3><?php echo $article->titre_article; ?></h3>
                    <p><?php echo $article->date_article; ?></p>
                    <img src="<?php echo $article->image_article; ?>" alt="image article">
                    <p><?php echo $article->contenu_article; ?></p>
                    <a href="categorie.php?cat=<?php echo $article->categorie_article; ?>"><?php echo $article->categorie_article; ?></a>
                </article>
            </a>
            <a class="lien-retour" href="index.php">Retour à la page d'accueil</a>
        </section>
    </main>
    <?php
        //insertion du footer
        include_once('components/footer.php');
    ?>
</body>
</html>