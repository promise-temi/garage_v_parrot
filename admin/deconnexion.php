<?php

session_start(); // Nécessaire pour manipuler les variables de session
session_unset(); // Supprimer toutes les variables de session
session_destroy(); // Détruire la session
setcookie(session_name(), "", time() - 3600); // Supprimer le cookie de session

header('Location: ../public/login.php');
exit;

?>