<?php
    session_start(); // Démarre la session

    // Vérifie si la variable existe avant de la supprimer
    if (isset($_SESSION['loggedin'])) {
        unset($_SESSION['loggedin']); // Supprime uniquement la variable 'loggedin'
    }

    // Redirection vers la page de connexion
    header("Location: ../admin-login.php");
    exit();
?>
