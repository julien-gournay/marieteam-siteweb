<?php
include "../bdd.php"; // Inclusion du fichier de connexion à la base de données
session_start(); // Démarrage de la session pour stocker des variables de session

// Vérification que le formulaire a bien été soumis via une requête POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idTrajet = $_POST['idtrajet']; // Récupération de l'ID du trajet sélectionné
    $categories = $_SESSION['categories']; // Récupération des catégories de billets depuis la session

    $toutesCategoriesDisponibles = 'O'; // Variable pour suivre la disponibilité des catégories

    // Vérifie si des catégories existent et sont bien sous forme de tableau
    if (isset($categories) && is_array($categories)) {
        foreach ($categories as $idCat => $value) {
            echo "Billet catégorie " . htmlspecialchars($idCat) . " = " . htmlspecialchars($value) . "<br>";

            // Requête SQL pour récupérer la capacité totale et le nombre de billets déjà vendus
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
                    trajet.idTrajet = $idTrajet;";

            // Exécution de la requête
            $res_Quantite = mysqli_query($cnt, $req);

            // Vérifie si des résultats ont été trouvés
            if ($res_Quantite && mysqli_num_rows($res_Quantite) > 0) {
                $tab = mysqli_fetch_assoc($res_Quantite); // Récupération de la première ligne du résultat
                $capacite = $tab['capacite']; // Capacité maximale pour cette catégorie
                $totalBillet = $tab['total_billets']; // Nombre total de billets vendus

                // Vérification pour éviter une valeur NULL
                if($totalBillet == null){
                    $totalBillet = 0;
                }

                // Calcul des places disponibles et restantes
                $dispo = $capacite - $totalBillet;
                $restant = $dispo - $value;

                echo("→ Capacité trajet : $capacite | Total billet vendu : $totalBillet<br>");
                echo("→ Billet dispo : $dispo<br>");
                echo("→ Billet restant (si pris) : $restant<br>");

                // Vérifie s'il reste assez de places pour la demande
                if($dispo >= $value){
                    echo("<span style='color: green;'>✅ Place disponible en catégorie $idCat pour ce trajet.</span><br><br>");
                } else{
                    $toutesCategoriesDisponibles = 'N'; // Une catégorie est indisponible
                    echo("<span style='color: red;'>❌ Plus de place disponible en catégorie $idCat pour ce trajet.</span><br><br>");

                    // Stockage du message d'erreur et redirection
                    $_SESSION['error_message'] = "Plus de place disponible en catégorie $idCat pour le trajet $idTrajet.<br>Vous avez demandé $value billet(s) mais il ne reste que $dispo billet(s).";
                    header('Location: ../booking-step3.php');
                    exit();
                }
            } else {
                // Cas où aucune capacité n'est trouvée
                $toutesCategoriesDisponibles = 'N';
                echo '<span style="color: orange;">⚠️ Aucune capacité trouvée.</span><br><br>';
                $_SESSION['error_message'] = "Aucun billet trouvé pour le trajet $idTrajet.";
                header('Location: ../booking-step3.php');
                exit();
            }
        }
    } else {
        echo '<span style="color: orange;">⚠️ Aucune catégorie à afficher.</span>';
    }

    // Si toutes les catégories sont disponibles, on stocke les valeurs en session
    if ($toutesCategoriesDisponibles != 'N') {
        echo "<span style='color: green;'>✅ Toutes les catégories sont disponibles pour ce trajet !</span><br>";

        // Requête SQL pour récupérer les informations du trajet
        $res = mysqli_query($cnt, "SELECT trajet.heureDepart, trajet.dateArrivee, trajet.heureArrivee, liaison.duree FROM trajet, liaison WHERE trajet.idTrajet=$idTrajet AND trajet.idLiaison=liaison.idLiai;");

        // Vérifie si des résultats existent
        if (mysqli_num_rows($res) > 0) {
            while ($tab = mysqli_fetch_row($res)) {
                $heureDepart = date("H\hi", strtotime($tab[0]));
                $dateArrivee = $tab[1];
                $heureArrivee = date("H\hi", strtotime($tab[2]));
                $dureeTrajet = date("H\hi", strtotime($tab[3]));

                // Stockage des informations en session
                $_SESSION['idTrajet'] = $idTrajet;
                $_SESSION['dureeTrajet'] = $dureeTrajet;
                $_SESSION['heureDepart'] = $heureDepart;
                $_SESSION['dateArrivee'] = $dateArrivee;
                $_SESSION['heureArrivee'] = $heureArrivee;

                echo "<span style='color: green;'><b>✅ Données sauvegardées en session.</b></span><br>"; // Message Log
                header('Location: ../booking-step4.php'); // Redirection vers l'étape 4 (suivante)
                exit();
            }
        } else {
            // Gestion du cas où les informations du trajet sont absentes
            $_SESSION['error_message'] = "Oups, certaines informations n'ont pas pu être récupérées."; // Stock en session le message d'erreur
            echo("<span style=\"color: red;\">❌ Oups, certaines informations n'ont pas pu être récupérées.</span><br>"); // Message Log
            header('Location: ../booking-step3.php'); // Redirection étape 3 réservation
            exit();
        }
    } else {
        echo "<span style='color: red;'>❌ Certaines catégories n'ont pas suffisamment de places disponibles pour ce trajet.</span><br>"; // Message Log
    }
} else {
    // Gestion du cas où le formulaire n'a pas été correctement rempli
    $_SESSION['error_message'] = "Le formulaire est incomplet ou vide."; // Stock en session le message d'erreur
    echo '<span style="color: red;">❌ Le formulaire est incomplet ou vide.</span>'; // Message Log
    header('Location: ../booking-step3.php'); // Redirection étape 3 réservation
    exit();
}
?>