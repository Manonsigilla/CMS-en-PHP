// inclure la base de données pour le header
<?php require_once('connect.php'); ?>

<header>
    <a href="index.php"><img src="uploads/logo.png" alt="logo"></a>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php if (isset($_SESSION['id_user'])) : ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else : ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="inscription.php">Inscription</a></li>
            <?php endif; ?>
            
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>