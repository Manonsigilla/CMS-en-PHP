<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$isUploadOk = true;
$errorMessage = '';
// on vérifie si l'utilisateur qui est connecté est soit un admin (niveau 1) soit un modérateur (niveau 2), si ce n'est pas le cas alors on affiche la page error 404 et si c'est le cas alors on laisse l'utilisateur accéder à la page
if(!isset($_SESSION['admin']) && !isset($_SESSION['modo'])){
    header('Location: ../error404.php');
}
// si c'est un modérateur ou un admin alors on peut ajouter un article dans la base de données
if(isset($_SESSION['admin']) || isset($_SESSION['modo'])){
    // on vérifie si le formulaire a été envoyé
    require_once('connect.php');
    if(isset($_POST['submit_article'])){
        // on récupère les données dans des variables
        $titre = $_POST['titre_article'];
        $image = $_FILES['image_article'];
        $contenu = $_POST['contenu_article'];
        $categorie = $_POST['categorie_article'];
        $statut = $_POST['statut_article'];
        // on vérifie si l'input pour l'image n'est pas vide et s'il contient bien une image png ou jpg ou jpeg de taille inférieure à 2Mo
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
                $isUploadOk = false;
            }
            // si l'extension de l'image n'est pas autorisée alors on affiche un message d'erreur
            if(!in_array($extensionImage, $extensionArray)){
                $errorMessage = "L'extension de l'image doit être au format png, jpg ou jpeg !";
                $isUploadOk = false;
            }
            // si un des champs est vide alors on affiche un message d'erreur
            if(empty($titre) || empty($image) || empty($contenu) || empty($categorie) || empty($statut)){
                $errorMessage = "Veuillez remplir tous les champs !";
                $isUploadOk = false;
            }
            // on vérifie si l'extension de l'image est autorisée
            if(in_array($extensionImage, $extensionArray)){
                // on crée un nouveau nom pour l'image
                $nouveauNomImage = uniqid().'.'.$extensionImage;
                // on crée le chemin de destination de l'image
                $destinationImage = '../uploads/'.$nouveauNomImage;
                // on déplace l'image dans le dossier images
                move_uploaded_file($cheminImage, $destinationImage);
                // on récupère le chemin de l'image
                $image = 'uploads/'.$nouveauNomImage;
            } else {
                $errorMessage = "L'extension de l'image doit être au format png, jpg ou jpeg !";
                $isUploadOk = false;
            }
            // on insère également la date de l'article au moment de l'insertion dans la base de données
            $date = date('Y-m-d');
            if($isUploadOk == true){
                // on écrit la requête qui permet d'insérer les données dans la base de données
                $requete = "INSERT INTO articles (article_id, titre_article, image_article, contenu_article, date_article, categorie_article, statut_article) VALUES (:id, :titre, :img, :contenu, :datearticle, :categorie, :statut)";
                // on prépare la requête
                $requete = $db->prepare($requete);
                // on exécute la requête avec les bonnes données
                $requete->execute(array(
                "id" => NULL,
                "titre" => $titre,
                "img" => $image,
                "contenu" => $contenu,
                "datearticle" => $date,
                "categorie" => $categorie,
                "statut" => $statut
                ));

                // on confirme à l'utilisateur que l'article a bien été ajouté
                $errorMessage = "L'article a bien été ajouté !";
            }
        }
    }

    // l'article a été ajouté dans la base de données, on peut maintenant afficher tous les articles sur cette page
    // on écrit la requête qui permet de récupérer tous les articles de la base de données en partant du dernier publié au premier publié
    $requete = "SELECT * FROM articles ORDER BY article_id DESC";
    // on prépare la requête
    $requete = $db->prepare($requete);
    // on exécute la requête
    $requete->execute();
    // on récupère les données
    $articles = $requete->fetchAll(PDO::FETCH_OBJ);

}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Liste articles</title>
</head>
<body>
    <?php
        //insertion du header
        include_once('headeradmin.php');
    ?>
    <main>
        <h1>Ajouter un article :</h1>
        <form method="post" enctype="multipart/form-data" class="form_article" action="">
            <label for="titre">Titre de l'article :</label>
            <input type="text" name="titre_article" placeholder="Titre de l'article">
            <div>
                <label for="img">Choisissez la photo de votre article :</label>
                <input type="file" name="image_article" id="img">
            </div>
            <textarea name="contenu_article" placeholder="Tapez votre contenu ici"></textarea>
            <input type="text" name="categorie_article" placeholder="Entrez la catégorie">
            <select name="statut_article">
                <option value="publié">Publié</option>
                <option value="en attente de relecture">En attente de relecture</option>
                <option value="en brouillon">En brouillon</option>
            </select>
            <input type="submit" name="submit_article" value="Ajouter">
            <!-- affichage de l'errormessage -->
            <p class="errorMessage"><?php echo $errorMessage; ?></p>
        </form>

        
        <section class="listeArticles">
            <h2>Liste des articles</h2>
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
                <article id="article-<?php echo $article->article_id ?>" style= "background-color: <?= $backgroundColor ?>;">
                    <h3><?php echo $article->titre_article; ?></h3>
                    <p><?php echo $article->date_article; ?></p>
                    <img src="../<?php echo $article->image_article; ?>" alt="image article">
                    <p><?php echo $article->contenu_article; ?></p>
                    <a href="categorie.php?cat=<?php echo $article->categorie_article; ?>"><?php echo $article->categorie_article; ?></a>
                    <p><?php echo $article->statut_article; ?></p>
                    <a class="boutonModifier" href="modifierarticle.php?id=<?php echo $article->article_id; ?>">Modifier</a>
                    <a class="boutonSupprimer" href="supprimerarticle.php?id=<?php echo $article->article_id; ?>">Supprimer</a>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
</body>
</html>