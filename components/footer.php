<footer>
    <a href="index.php">Home</a>
    <a href="profil.php">Profil</a>
    <!-- on affiche le lien inscription si l'utilisateur n'est pas connecté, s'il est connecté, on ne l'affiche pas -->
    <?php if(!isset($_SESSION['pseudo'])): ?>
        <a href="inscription.php">Inscription</a>
    <?php endif; ?>
    <a href="contact.php">Contact</a>
</footer>