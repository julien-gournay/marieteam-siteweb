<?php
    include "bdd.php"; // Connexion BDD
    session_start(); // Ouverture d'une session pour stocker les données
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        foreach ($_POST as $key => $value) {
            if($value != NULL){
                echo "La valeur de l'input avec l'id $key est : $value<br>";
                $_SESSION[$key] = $value;
            } else {
                unset($_SESSION['$key']);
            }
        }

        /*// Regrouper les clés correspondant à des billets (comme A2, C1)
        $billet = array();
        foreach ($_SESSION as $key => $value) {
            // Vérifier si la clé correspond au format attendu (lettre majuscule + chiffre)
            if (preg_match('/^[A-Z]\d$/', $key)) {
                $billet[$key] = $value;
            }
        }

        // Ajouter le tableau billet à la session
        $_SESSION['billet'] = $billet;*/
        
        //exit();
        echo("Réussi");
        //var_dump($_SESSION);
        header('Location: booking-step3.php'); // Redirection étape 2 réservation
    }
?>