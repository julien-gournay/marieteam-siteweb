<?php
    include "bdd.php"; // Connexion DB
    session_start(); // Ouverture d'une session pour stocker les données

    // Vérification que le formulaire est bien rempli
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Si aucune valeur du formulaire n'est vide
        if (isset($_POST['villeD']) && isset($_POST['villeA']) && !empty($_POST['villeD']) && !empty($_POST['villeA'])) {
            $villeDepart = $_POST['villeD']; // Récupérer ville depart du form
            $villeArrivee = $_POST['villeA']; // Récupérer ville arrivée du form
            $dateDepart = $_POST['dateDepart']; // Récupérer date depart du form
    
            // Messages Log
            echo("Ville départ : $villeDepart<br>Ville d'arrivée : $villeArrivee<br>");
            echo("Date de départ : $dateDepart<br><br>");

            if($mabase){ // Verification connexion DB
                $req = "SELECT * FROM `liaison` WHERE idVilleDepart='$villeDepart' AND idVilleArrivee='$villeArrivee'"; // Requete : Afficher la liaison selon le choix de l'etape 1
                $res = mysqli_query($cnt,$req); // Execution de la requete

                // Verification villes doublons
                if($villeDepart == $villeArrivee){
                    $_SESSION['error_message'] = "Vous ne pouvez pas choisir la même ville de destination que la ville de départ."; // Stock le message d'erreur
                    echo '<span style="color: red;">❌ Vous ne pouvez pas choisir la même ville de destination que la ville de départ.</span>'; // Message Log
                    header('Location: ../booking-step1.php'); // Redirection étape 1 réservation
                    exit();  
                }

                // Verification de la période
                $reqPer = "SELECT * FROM `periode`"; // Requete : Liste des périodes
                $resPer = mysqli_query($cnt,$reqPer); // Execution requete

                // Boucle pour afficher les tarifs selon Type
                while ($tab = mysqli_fetch_row($resPer)) { 
                    $idPeriode = $tab[0]; // Initialisation des variables Id Periode
                    $dateDebutPer = $tab[2]; // Initialisation des variables date debut
                    $dateFinPer = $tab[3]; // Initialisation des variables date fin

                    // Si la date selectionner par le user est compris entre les dates de Debut et Fin d'une Periode
                    if ($dateDepart >= $dateDebutPer && $dateDepart <= $dateFinPer) {
                        echo "La date $dateDepart est entre $dateDebutPer et $dateFinPer."; // Message Log
                        $_SESSION['periode'] = $idPeriode; // Stock en session l'id Periode de la date du trajet
                    }
                }

                // Verification que la requete "res" renvoi des valeurs de la DB
                if (mysqli_num_rows($res) > 0) {
                    $_SESSION['villeD'] = $villeDepart; // Stock en session la ville départ
                    $_SESSION['villeA'] = $villeArrivee; // Stock en session la ville d'arrivée
                    $_SESSION['dateDepart'] = $dateDepart; // Stock en session la date de départ
                    echo '<span style="color: green;">✅ Réussi, les valeurs ont été mise en session.</span>'; // Mesage Log
                    header('Location: ../booking-step2.php'); // Redirection étape 2 réservation
                    exit();
                } else {
                    $_SESSION['error_message'] = "Oups, il semblerait que ce trajet n'existe pas."; // Stock en session le message d'erreur
                    echo '<span style="color: red;">❌ Oups, il s\'emblerais que ce trajet n\'existe pas.</span>'; // Message Log
                    header('Location: ../booking-step1.php'); // Redirection étape 1 réservation
                    exit();                     
                }
            }
        }
    } else{
        $_SESSION['error_message'] = "Le formulaire est incomplet ou vide."; // Stock le message d'erreur si le formulaire est vide
        echo '<span style="color: red;">❌ Le formulaire est incomplet ou vide.</span>'; // Message Log
        header('Location: ../booking-step1.php'); // Redirection étape 1 réservation
        exit();
    }
?>