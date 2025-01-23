<?php
    include "../bdd.php"; // Connexion BDD
    session_start(); // Ouverture d'une session pour stocker les données
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Si le formulaire est rempli, alors ...
        if (isset($_POST['villeD']) && isset($_POST['villeA']) && !empty($_POST['villeD']) && !empty($_POST['villeA'])) {
            $villeDepart = $_POST['villeD']; // Récupérer ville depart du form
            $villeArrivee = $_POST['villeA']; // Récupérer ville arrivée du form
            $dateDepart = $_POST['dateDepart']; // Récupérer date depart du form
    
            echo("Ville départ : $villeDepart<br>Ville d'arrivée : $villeArrivee<br>");
            echo("Date de départ : $dateDepart<br><br>");

            if($mabase){
                $req = "SELECT * FROM `liaison` WHERE idVilleDepart='$villeDepart' AND idVilleArrivee='$villeArrivee'";
                $res = mysqli_query($cnt,$req);

                // Verification villes doublons
                if($villeDepart == $villeArrivee){
                    $_SESSION['error_message'] = "Vous ne pouvez pas choisir la même ville de destination que la ville de départ."; // Stock le message d'erreur à return
                    echo '<span style="color: red;">❌ Vous ne pouvez pas choisir la même ville de destination que la ville de départ.</span>';
                    header('Location: ../booking-step1.php'); // Redirection étape 1 réservation
                    exit();  
                }

                // Verif période
                $reqPer = "SELECT * FROM `periode`";
                $resPer = mysqli_query($cnt,$reqPer);
                while ($tab = mysqli_fetch_row($resPer)) { // Boucle pour afficher les tarifs selon Type
                    $idPeriode = $tab[0]; // Variable de l'id Type
                    $dateDebutPer = $tab[2]; // Variable nom Type
                    $dateFinPer = $tab[3]; //
                    if ($dateDepart >= $dateDebutPer && $dateDepart <= $dateFinPer) {
                        echo "La date $dateDepart est entre $dateDebutPer et $dateFinPer.";
                        $_SESSION['periode'] = $idPeriode; // Stock en session la ville départ
                    }
                }


                
                if (mysqli_num_rows($res) > 0) {
                    $_SESSION['villeD'] = $villeDepart; // Stock en session la ville départ
                    $_SESSION['villeA'] = $villeArrivee; // Stock en session la ville d'arrivée
                    $_SESSION['dateDepart'] = $dateDepart; // Stock en session la date de départ
                    echo '<span style="color: green;">✅ Réussi, les valeurs ont été mise en session.</span>';
                    header('Location: ../booking-step2.php'); // Redirection étape 2 réservation
                    exit();
                } else {
                    $_SESSION['error_message'] = "Oups, il semblerait que ce trajet n'existe pas."; // Stock le message d'erreur à return
                    echo '<span style="color: red;">❌ Oups, il s\'emblerais que ce trajet n\'existe pas.</span>';
                    header('Location: ../booking-step1.php'); // Redirection étape 1 réservation
                    exit();                     
                }
            }
        }
    } else{
        $_SESSION['error_message'] = "Le formulaire est incomplet ou vide."; // Stock le message d'erreur à return
        echo '<span style="color: red;">❌ Le formulaire est incomplet ou vide.</span>';
        header('Location: ../booking-step1.php'); // Redirection étape 1 réservation
        exit();
    }
?>