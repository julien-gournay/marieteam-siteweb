<?php
    include "bdd.php"; // Connexion BDD
    session_start(); // Ouverture d'une session pour stocker les données
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Si le formulaire est rempli, alors ...
        if (isset($_POST['villeD']) && isset($_POST['villeA']) && !empty($_POST['villeD']) && !empty($_POST['villeA'])) {
            $villeDepart = $_POST['villeD']; // Récupérer ville depart du form
            $villeArrivee = $_POST['villeA']; // Récupérer ville arrivée du form
            $dateDepart = $_POST['dateDepart']; // Récupérer date depart du form
    
            echo("$villeDepart + $villeArrivee");

            if($mabase){
                $req = "SELECT * FROM `liaison` WHERE idVilleDepart='$villeDepart' AND idVilleArrivee='$villeArrivee'";
                $res = mysqli_query($cnt,$req);
                if (mysqli_num_rows($res) > 0) {
                    $_SESSION['villeD'] = $villeDepart; // Stock en session la ville départ
                    $_SESSION['villeA'] = $villeArrivee; // Stock en session la ville d'arrivée
                    $_SESSION['dateDepart'] = $dateDepart; // Stock en session la date de départ
                    echo("Réussi");
                    header('Location: booking-step2.php'); // Redirection étape 2 réservation
                    exit();
                } else {
                    $_SESSION['error_message'] = "Oups, il semblerait que ce trajet n'existe pas."; // Stock le message d'erreur à return
                    echo("Oups, il s'emblerais que ce trajet n'existe pas"); 
                    header('Location: booking-step1.php'); // Redirection étape 1 réservation
                    exit();                     
                }
            }
        }
    }
?>