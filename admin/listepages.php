<?php
session_start();
$errorMessage = '';
$isEverythingOk = true;

if(!isset($_SESSION['admin']) && !isset($_SESSION['modo'])){
    header('Location: ../error404.php');
}

// si c'est un admin ou un modo alors on peut ajouter une page dans la base de données
if(isset($_SESSION['admin']) || isset($_SESSION['modo'])) {
    require_once('connect.php');
    if(isset($_POST['submit_page'])){
        // on récupère les données dans des variables
        $titre = $_POST['titre_page'];
        $image = $_FILES['image_page'];
        $contenu = $_POST['contenu_page'];
        $statut = $_POST['statut_page'];
        // on vérifie si l'input pour l'image n'est pas vide et s'il contient bien une image png ou jpg ou jpeg de taille inférieure à 2Mo
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
                $isEverythingOk = false;
            }
            // si l'extension de l'image n'est pas autorisée alors on affiche un message d'erreur
            if(!in_array($extensionImage, $extensionArray)){
                $errorMessage = "L'extension de l'image doit être au format png, jpg ou jpeg !";
                $isEverythingOk = false;
            }
            // si un des champs est vide alors on affiche un message d'erreur
            if(empty($titre) || empty($image) || empty($contenu) || empty($statut)){
                $errorMessage = "Veuillez remplir tous les champs !";
                $isEverythingOk = false;
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
                $image = '../uploads/'.$nouveauNomImage;
            } else {
                $errorMessage = "L'extension de l'image doit être au format png, jpg ou jpeg !";
                $isEverythingOk = false;
            }
            if($isEverythingOk == true){
                // on écrit la requête qui permet d'ajouter une page dans la base de données
                $requete = "INSERT INTO pages (id_page, titre_page, image_page, contenu_page, statut_page, date_page) VALUES (:id, :titre, :img, :contenu, :statut, :datepage)";
                // on prépare la requête
                $requete = $db->prepare($requete);
                // on insère également la date de la page au moment de l'insertion dans la base de données
                $date = date('Y-m-d');
                // on exécute la requête avec les bonnes données
                $requete->execute(array(
                    "id" => NULL,
                    "titre" => $titre,
                    "img" => $image,
                    "contenu" => $contenu,
                    "statut" => $statut,
                    "datepage" => $date
                ));
                // on confirme à l'utilisateur que la page a bien été ajoutée
                $errorMessage = "La page a bien été ajoutée !";
            }
        }
    }
    // la page a été ajoutée à la base de données, on peut donc afficher la liste des pages
    // on écrit la requête qui permet de récupérer toutes les pages
    $requete = "SELECT * FROM pages ORDER BY id_page DESC";
    // on prépare la requête
    $requete = $db->prepare($requete);
    // on exécute la requête
    $requete->execute();
    // on récupère les données
    $pages = $requete->fetchAll(PDO::FETCH_OBJ);
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Liste pages</title>
</head>
<body>
    <?php
        //insertion du header
        include_once('headeradmin.php');
    ?>
    <main>
        <section class="pages">
            <h1>Ajoutez une page :</h1>
            <form action="" enctype="multipart/form-data" method="post" class="form_page">
                <label for="titre">Titre de la page :</label>
                <input type="text" name="titre_page" placeholder="Titre de la page">
                <div>
                    <label for="img">Choisissez la photo de votre page :</label>
                    <input type="file" name="image_page" id="img">
                </div>
                <textarea name="contenu_page" placeholder="Tapez votre contenu ici"></textarea>
                <select name="statut_page">
                    <option value="publié">Publié</option>
                    <option value="en attente de relecture">En attente de relecture</option>
                    <option value="en brouillon">En brouillon</option>
                </select>
                <input type="submit" name="submit_page" value="Ajouter">
                <!-- affichage de l'errormessage -->
                <p class="errorMessage"><?php echo $errorMessage; ?></p>
            </form>
        </section>
        <section class="listePages">
            <h2>Liste des pages</h2>
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
                <h3><?php echo $page->titre_page; ?></h3>
                <p><?php echo $page->date_page; ?></p>
                <img src="<?php echo $page->image_page; ?>" alt="image page">
                <p><?php echo $page->contenu_page; ?></p>
                <p><?php echo $page->statut_page; ?></p>
                <a class="boutonModifier" href="modifierpage.php?id=<?php echo $page->id_page; ?>">Modifier</a>
                <a class="boutonSupprimer" href="supprimerpage.php?id=<?php echo $page->id_page; ?>">Supprimer</a>
            </article>
            <?php endforeach; ?>
        </section>
    </main>
</body>
</html>