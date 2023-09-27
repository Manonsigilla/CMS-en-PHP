<?php
require_once('admin/connect.php');

//on affiche seulement les articles qui sont en statut publiés
$requete = "SELECT * FROM articles WHERE statut_article = 'publié' ORDER BY article_id DESC";
$requete = $db->prepare($requete);
$requete->execute();
$articles = $requete->fetchAll(PDO::FETCH_OBJ);

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
            <?php foreach($articles as $article): ?>
                <article>
                    <h3><?php echo $article->titre_article; ?></h3>
                    <p><?php echo $article->date_article; ?></p>
                    <img src="<?php echo $article->image_article; ?>" alt="image article">
                    <p><?php echo $article->contenu_article; ?></p>
                    <p><?php echo $article->categorie_article; ?></p>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
</body>
</html>