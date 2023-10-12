<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Contact</title>
</head>
<body>
    <?php
        //insertion du header
        include_once('components/header.php');
    ?>
    <main class="main-contact">
    <h2>Contactez-nous</h2>
        <form class="contact-form" action="contact.php" method="POST">
            <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
            </div>
            <div>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>
            </div>
            <div>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
            </div>
            <div>
            <label for="message">Message :</label>
            <textarea name="message" id="message" cols="30" rows="10" required></textarea>
            </div>
            <input class="boutonModifier" type="submit" value="Envoyer">
        </form>
    </main>
    <?php
        //insertion du footer
        include_once('components/footer.php');
    ?>
</body>
</html>