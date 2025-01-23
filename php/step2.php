<?php
    include "../bdd.php";
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $verifCat = 'N';
        $types = []; // Stocker les types disponibles*
        $categories = []; // Tableau pour stocker les sommes par catégorie
        $billet = []; // Tableau pour stocker les clés et valeurs

        // Chargez tous les types dans un tableau
        $res = mysqli_query($cnt, "SELECT idType, idCategorie FROM type");
        while ($row = mysqli_fetch_assoc($res)) {
            $types[$row['idType']] = $row['idCategorie'];
        }

        foreach ($_POST as $key => $value) {
            if (!empty($value)) { // Si la valeur n'est pas vide
                if (isset($types[$key])) { // Si l'idType existe dans la liste des types récupérés
                    $idCat = $types[$key];

                    // Vérification de la catégorie (si elle appartient à la catégorie A)
                    if ($idCat == 'A') {
                        $verifCat = 'O'; // Une catégorie valide a été sélectionnée
                    }

                    // Calcul des sommes par catégorie
                    if (!isset($categories[$idCat])) {
                        $categories[$idCat] = 0; // Initialiser la catégorie si elle n'existe pas
                    }
                    $categories[$idCat] += (int)$value; // Ajouter la valeur à la somme de la catégorie

                    $billet[$key] = $value; // Ajouter la clé et la valeur dans le tableau billet

                    // Debug : afficher les informations pour chaque valeur
                    echo "La valeur de l'input avec l'id $key (catégorie $idCat) est : $value<br>";
                    echo "Verification eligibilité = $verifCat<br><br>";

                }
                //$_SESSION[$key] = $value; // Stocker dans la session
            } else {
                unset($_SESSION[$key]); // Supprimer les clés non définies
            }
        }

        // Stocker le tableau des catégories dans la session
        $_SESSION['categories'] = $categories;
        $_SESSION['billet'] = $billet; // Stocker le tableau billet dans la session


        // Afficher le tableau des catégories et leurs sommes
        echo "<pre>";
        print_r($_POST); // Données envoyées par le formulaire
        print_r($categories); // Sommes par catégorie
        print_r($billet); // Paires clé/valeur dans le tableau billet
        echo "</pre>";
        
        if ($verifCat === 'O') {
            echo '<span style="color: green;">✅ Réussi, les valeurs ont été mise en session.</span>';
            header('Location: ../booking-step3.php');
            exit();
        } else {
            $_SESSION['error_message'] = "Vous devez sélectionner au moins un billet Enfant, Jeune ou Adulte.";
            echo '<span style="color: red;">❌ Vous devez sélectionner au moins un billet Enfant, Jeune ou Adulte.</span>';
            header('Location: ../booking-step2.php');
            exit();
        }
    }
    else{
        $_SESSION['error_message'] = "Le formulaire est incomplet ou vide."; // Stock le message d'erreur à return
        echo '<span style="color: red;">❌ Le formulaire est incomplet ou vide.</span>';
        header('Location: ../booking-step2.php'); // Redirection étape 1 réservation
        exit();
    }
?>