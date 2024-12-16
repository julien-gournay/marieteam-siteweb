<?php
    include "bdd.php"; // Connexion BDD
    session_start(); // Ouverture d'une session pour stocker les données
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['idtrajet'] = $_POST['idtrajet']; 

        //exit();
        echo("Réussi");
        header('Location: booking-step3.php'); // Redirection étape 2 réservation
    }
?>