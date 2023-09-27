<!-- gérer la déconnexion de l'utilisateur, de l'admin ou d'un modérateur sur cette page mais en le redirigeant sur la page index lorsque l'utilisateur se déconnecte -->

<?php
session_start();
session_destroy();
header('Location: ../index.php');
exit();
?>