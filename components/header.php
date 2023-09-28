<!-- // inclure la base de données pour le header -->
<?php 
// on démarre la session d'utilisateur connecté 
@session_start();
require_once('admin/connect.php');
// on vérifie si l'utilisateur est connecté
if(isset($_SESSION['id_user'])){
    // on écrit la requête qui permet de récupérer les données de l'utilisateur
    $requete = "SELECT * FROM users WHERE id_user = :id";
    // on prépare la requête
    $requete = $db->prepare($requete);
    // on exécute la requête avec les bonnes données
    $requete->execute(array(
        "id" => $_SESSION['id_user']
    ));
    // on récupère les données de la base de données
    $resultat = $requete->fetch();
    // on stocke les données dans des variables
    $id = $resultat['id_user'];
    $nom = $resultat['nom_user'];
    $prenom = $resultat['prenom_user'];
    $mail = $resultat['mail_user'];
    $pseudo = $resultat['pseudo_user'];
    $password = $resultat['password_user'];
    $niveau = $resultat['niveau_user'];
} 

// si l'utilisateur n'est pas connecté alors l'utilisateur peut se connecter via le formulaire dans le header
// on vérifie si l'username et le password sont bons et on crée une session pour l'utilisateur en tenant compte de son niveau d'utilisateur. Si l'utilisateur est un admin alors on le redirige vers la page admin.php et si l'utilisateur est un membre alors on le laisse sur la page index.php

if(isset($_POST['submitConnection'])){
    // on récupère les données dans des variables
    $pseudo = $_POST['username'];
    $password = $_POST['pass'];

    // on vérifie que les champs ne sont pas vides
    if(!empty($_POST['username']) && !empty($_POST['pass'])) {
        require_once('admin/connect.php');
        // On écrit la requête qui permet de récupérer les données de l'utilisateur
        $requete = "SELECT pass_user as pass FROM users WHERE pseudo_user = :pseudo";
        // On prépare la requête
        $requete = $db->prepare($requete);
        // On exécute la requête avec les bonnes données
        $requete->execute(array(
            "pseudo" => $pseudo
        ));
        // on récupère les données de la base de données
        $resultat = $requete->fetch();
        // si on obtient pas de résultat alors on affiche un message d'erreur
        if(!$resultat) {
            $errorMessage = "<p>Mauvais identifiant ou mot de passe !</p>";
        }
        // si c'est bon alors on peut vérifier le mot de passe
        if($resultat){
            if(!password_verify($password, $resultat['pass'])){
                $errorMessage = "<p>Mauvais identifiant ou mot de passe !</p>";
            }
            if(password_verify($password, $resultat['pass'])){
                // on crée une session pour l'utilisateur en tenant compte de son niveau d'utilisateur. Si l'utilisateur est un admin alors on le redirige vers la page admin.php et si l'utilisateur est un membre alors on le laisse sur la page index.php
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['pass'] = $password;
                // si c'est l'admin alors on lui attribue un niveau de connexion
                $niveauRequete = "SELECT niveau_user as niveau FROM users WHERE pseudo_user = :pseudo";
                $niveauRequete = $db->prepare($niveauRequete);
                $niveauRequete->execute(array(
                    "pseudo" => $pseudo
                ));
                $resultatNiveau = $niveauRequete->fetch();
                if($resultatNiveau['niveau'] == "1" || $resultatNiveau['niveau'] == "2"){
                    $_SESSION['admin'] = $resultatNiveau['niveau'];
                    $_SESSION['modo'] = $resultatNiveau['niveau'];
                    // si c'est l'admin alors on le redirige vers la page dashboard.php
                    header('Location: admin/dashboard.php');
                } else {
                    // si c'est un membre alors on le redirige vers la page index.php
                    header('Location: profil.php');
                }
                
            }
        }
    }
}
?>

<header>
    <a href="../creationCMS/index.php"><img src="uploads/logo.png" alt="logo"></a>
    <nav>
        <ul>
            <li><a href="../creationCMS/index.php">Home</a></li>
            <?php if (isset($_SESSION['pseudo'])) : ?>
                <li>
                    <details>
                        <summary class="summary-login">Profil</summary>
                        <ul class="form-login">
                            <li><a href="profil.php">Profil</a></li>
                            <li><a href="../creationCMS/admin/deconnexion.php">Déconnexion</a></li>
                        </ul>
                    </details>
                </li>
            <?php else : ?>
                <li><details>
                <summary class="summary-login">Login</summary>
                <form action="#" method="post" class="form-login">
                    <input type="text" name="username" placeholder="pseudo">
                    <input type="password" name="pass" placeholder="Mot de passe">
                    <input type="submit" name="submitConnection" value="Se connecter">
                </form>
                <?php if (isset($errorMessage)) : ?>
                    <p><?php echo $errorMessage; ?></p>
                <?php endif; ?>
                </details></li>
                <li><a href="inscription.php">Inscription</a></li>
            <?php endif; ?>
            
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>