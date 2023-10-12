<?php

session_start();
/*
    Cette page ne doit s'afficher que si l'admin est connecté

    Cette page doit permettre : 
        - De créer une nouvelle page
        - De créer un nouvel article
        - De gérer les comptes utilisateurs

    Sur cette page vous devez également afficher :
        - Les derniers articles (les 5 derniers)
        - Les dernières pages (les 5 dernières)
        - Les derniers utilisateurs (les 5 derniers)

    Vous devez avoir la possibilité de :
        - Afficher la liste complète des articles (c'est une page à part entière)
        - Afficher la liste complète des pages (c'est une page à part entière)
        - Afficher la liste complète des utilisateurs (c'est une page à part entière)
*/

// on vérifie si l'utilisateur qui est connecté est soit un admin (niveau 1) soit un modérateur (niveau 2), si ce n'est pas le cas alors on affiche la page error 404 et si c'est le cas alors on laisse l'utilisateur accéder à la page
if(!isset($_SESSION['admin']) && !isset($_SESSION['modo'])){
    header('Location: ../error404.php');
}
// si c'est un modérateur ou un admin alors on peut ajouter un article dans la base de données
if(isset($_SESSION['admin']) || isset($_SESSION['modo'])){
    require_once('connect.php');
    // on écrit la requête qui permet de récupérer les 5 derniers articles
    $requete = "SELECT * FROM articles ORDER BY article_id DESC LIMIT 5";
    // on prépare la requête
    $requete = $db->prepare($requete);
    // on exécute la requête
    $requete->execute();
    // on récupère les données
    $articles = $requete->fetchAll(PDO::FETCH_OBJ);
    // on écrit la requête qui permet de récupérer les 5 dernières pages
    $requetePage = "SELECT * FROM pages ORDER BY id_page DESC LIMIT 5";
    // on prépare la requête
    $requetePage = $db->prepare($requetePage);
    // on exécute la requête
    $requetePage->execute();
    // on récupère les données
    $pages = $requetePage->fetchAll(PDO::FETCH_OBJ);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Dashboard</title>
</head>
<body>
    <?php
        //insertion du header
        include_once('headeradmin.php');
    ?>
    <main>
        <h1>Dashboard</h1>
        <section class="dashboard">
            <div class="listeArticles">
                <h2>Articles</h2>
                <div class="liens-liste">
                <a href="listearticles.php">Voir tous les articles</a>
                <a href="listearticles.php">Ajouter un article</a>
                </div>
                <!-- on affiche les 5 derniers articles -->
                <?php foreach($articles as $article): 
                $backgroundColor = '';
                if($article->statut_article == 'publié'){
                    $backgroundColor = '#4BA254 ';
                } else if($article->statut_article == 'en attente de relecture'){
                    $backgroundColor = '#ED932E ';
                } else if($article->statut_article == 'en brouillon'){
                    $backgroundColor = '#CA6879';
                }
                ?>
                <a href="listearticles.php#article-<?php echo $article->article_id ?>">
                <article id="article-<?php echo $article->article_id ?>" style= "background-color: <?= $backgroundColor ?>;">
                    <h3><?php echo $article->titre_article; ?></h3>
                    <p><?php echo $article->date_article; ?></p>
                    <img src="../<?php echo $article->image_article; ?>" alt="image article">
                    <p><?php echo $article->contenu_article; ?></p>
                    <a href="categorie.php?cat=<?php echo $article->categorie_article; ?>"><?php echo $article->categorie_article; ?></a>
                    <p><?php echo $article->statut_article; ?></p>
                </article>
                </a>
                <?php endforeach; ?>
            </div>
            <div class="listePages">
                <h2>Pages</h2>
                <div class="liens-liste">
                    <a href="listepages.php">Voir toutes les pages</a>
                    <a href="listepages.php">Ajouter une page</a>
                </div>
                <!-- // on affiche les 5 dernières pages -->
                <?php foreach($pages as $page):
                $backgroundColor = '';
                if($page->statut_page == 'publié'){
                    $backgroundColor = '#4BA254 ';
                } else if($page->statut_page == 'en attente de relecture'){
                    $backgroundColor = '#ED932E ';
                } else if($page->statut_page == 'en brouillon'){
                    $backgroundColor = '#CA6879';
                }
                ?>
                <article id="page-<?php echo $page->id_page ?>" style= "background-color: <?= $backgroundColor ?>;">
                    <a href="listepages.php#page-<?php echo $page->id_page ?>">
                    <h3><?php echo $page->titre_page; ?></h3>
                    <p><?php echo $page->date_page; ?></p>
                    <img src="<?php echo $page->image_page; ?>" alt="image page">
                    <p><?php echo $page->contenu_page; ?></p>
                    <p><?php echo $page->statut_page; ?></p>
                    </a>
                </article>
                <?php endforeach; ?>
            </div>
            <div class="dashboard-users">
                <h2>Utilisateurs</h2>
                <div class="liens-liste">
                    <a href="listeutilisateurs.php">Voir tous les utilisateurs</a>
                    <a href="listeutilisateurs.php">Ajouter un utilisateur</a>
                    <a href="listeutilisateurs.php">Supprimer un utilisateur</a>
                </div>
                <div class="listeUtilisateurs">
                    <?php
                    // on écrit la requête qui permet de récupérer les 5 derniers utilisateurs
                    $requeteUtilisateurs = "SELECT * FROM users ORDER BY id_user DESC LIMIT 5";
                    // on prépare la requête
                    $requeteUtilisateurs = $db->prepare($requeteUtilisateurs);
                    // on exécute la requête
                    $requeteUtilisateurs->execute();
                    // on récupère les données
                    $users = $requeteUtilisateurs->fetchAll(PDO::FETCH_OBJ);
                    ?>
                    <!-- // on affiche les 5 derniers utilisateurs -->
                    <?php foreach($users as $user): ?>
                        <article class="listeUtilisateursDash" id="utilisateur-<?php echo $user->id_user ?>">
                            <a href="listeutilisateurs.php#utilisateur-<?php echo $user->id_user ?>">
                            <h3><?php echo $user->pseudo_user; ?></h3>
                            <p><?php echo $user->mail_user; ?></p>
                            <p><?php echo $user->niveau_user; ?></p>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
</body>
</html>