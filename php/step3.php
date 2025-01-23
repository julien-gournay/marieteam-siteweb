<?php
    include "../bdd.php"; // Connexion BDD
    session_start(); // Ouverture d'une session pour stocker les données
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idTrajet = $_POST['idtrajet'];
        $categories = $_SESSION['categories']; // Récupère le tableau des catégories depuis la session

        $toutesCategoriesDisponibles = 'O';
        if (isset($categories) && is_array($categories)) {
            foreach ($categories as $idCat => $value) {
                echo "Billet catégorie " . htmlspecialchars($idCat) . " = " . htmlspecialchars($value) . "<br>";
            
                $req="SELECT 
                    capacite.capacite, 
                    COALESCE(
                        (SELECT SUM(billet.quantite) 
                        FROM billet 
                        INNER JOIN reservation ON billet.reference = reservation.reference 
                        WHERE reservation.idTrajet = $idTrajet 
                        AND billet.idType LIKE '$idCat%'), 0) AS total_billets
                FROM 
                    trajet
                INNER JOIN 
                    capacite ON trajet.idBateau = capacite.idBateau AND capacite.idCategorie = '$idCat'
                WHERE 
                    trajet.idTrajet = $idTrajet;
                ";
            
                $res_Quantite = mysqli_query($cnt, $req); // Requête : 
                if ($res_Quantite && mysqli_num_rows($res_Quantite) > 0) {
                    $tab = mysqli_fetch_assoc($res_Quantite); // Récupération d'une seule ligne sans boucle
                    $capacite = $tab['capacite'];
                    $totalBillet = $tab['total_billets'];
                    if($totalBillet == null){
                        $totalBillet = 0;
                    }
        
                    $dispo = $capacite - $totalBillet;
                    $restant = $dispo - $value;
        
                    echo("→ Capactité trajet : $capacite | Total billet vendu : $totalBillet<br>");
                    echo("→ Billet dispo : $dispo<br>");
                    echo("→ Billet restant (si pris) : $restant<br>");
                    if($dispo>=$value){
                        echo("<span style='color: green;'>✅ Place disponible en catégorie $idCat pour ce trajet.</span><br><br>");
                    } else{
                        $toutesCategoriesDisponibles = 'N'; // Une catégorie n'a pas de place
                        echo("<span style='color: red;'>❌ Plus de place disponible en catégorie $idCat pour ce trajet.</span><br><br>");
                        $_SESSION['error_message'] = "Plus de place disponible en catégorie $idCat pour le trajet $idTrajet.<br>Vous avez demandé $value billet(s) pour ce trajet mais il ne reste que $dispo billet(s)."; // Stock le message d'erreur à return
                        header('Location: ../booking-step3.php'); // Redirection étape 3 réservation
                    }
                } else{
                    // Gérer le cas où aucun résultat n'est trouvé
                    $capacite = null;
                    $totalBillet = null;
                    $toutesCategoriesDisponibles = 'N'; // Une catégorie n'a pas de place

                    echo '<span style="color: orange;">⚠️ Aucune capacité trouvée.</span><br><br>';
                    $_SESSION['error_message'] = "Aucun billet trouvée pour le trajet $idTrajet."; // Stock le message d'erreur à return
                    header('Location: ../booking-step3.php'); // Redirection étape 3 réservation
                }
            }
        } else {
            echo '<span style="color: orange;">⚠️ Aucune catégorie à afficher.</span>';
        }
        
        // Si dispo okay alors stocker les valeurs
        if ($toutesCategoriesDisponibles != 'N') {
            echo "<span style='color: green;'>✅ Toutes les catégories sont disponibles pour ce trajet !</span><br>";

            $res = mysqli_query($cnt, "SELECT trajet.heureDepart,trajet.dateArrive,trajet.heureArrive,liaison.duree FROM trajet,liaison WHERE trajet.idTrajet=$idTrajet AND trajet.idLiaison=liaison.idLiai;"); // Requête : Recupére la liste d'indicent du trajet de la boucle
            if (mysqli_num_rows($res) > 0) { 
                while ($tab = mysqli_fetch_row($res)) { 
                    $heureDepart = $tab[0];
                    $dateArrivee = $tab[1];
                    $heureArrivee = $tab[2];
                    $dureeTrajet = $tab[3];

                    $heureDepart = date("H\hi", strtotime($heureDepart));  // H:i correspond à l'heure et minutes uniquement
                    $heureArrivee = date("H\hi", strtotime($heureArrivee));  // H:i correspond à l'heure et minutes uniquement
                    $dureeTrajet = date("H\hi", strtotime($dureeTrajet));  // H:i correspond à l'heure et minutes uniquement

                    $_SESSION['idTrajet'] = $idTrajet;
                    $_SESSION['dureeTrajet'] = $dureeTrajet;
                    $_SESSION['heureDepart'] = $heureDepart;
                    $_SESSION['dateArrivee'] = $dateArrivee;
                    $_SESSION['heureArrivee'] = $heureArrivee;

                    echo "<span style='color: green; '><b>✅ Données sauvegardé en session.</b></span><br>";
                    header('Location: ../booking-step4.php'); // Redirection étape 4 réservation
                }
            }
            else {
                $_SESSION['error_message'] = "Oups, il semblerait qu'une certaines informations n'ont pas pu être récuperé."; // Stock le message d'erreur à return
                echo '<span style="color: red;">❌ Oups, il semblerait qu\'une certaines informations n\'ont pas pu être récuperé.</span><br>';
                header('Location: ../booking-step3.php'); // Redirection étape 3 réservation
                exit();                     
            }
        } else {
            echo "<span style='color: red;'>❌ Certaines catégories n'ont pas suffisament de disponibles pour ce trajet.</span><br>";
        }
    } else{
        $_SESSION['error_message'] = "Le formulaire est incomplet ou vide."; // Stock le message d'erreur à return
        echo '<span style="color: red;">❌ Le formulaire est incomplet ou vide.</span>';
        header('Location: ../booking-step3.php'); // Redirection étape 1 réservation
        exit();
    }
?>