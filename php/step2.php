<?php
    include "bdd.php"; // Connexion DB
    session_start(); // Ouverture d'une session pour stocker les données

    // Vérification que le formulaire est bien rempli
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $verifCat = 'N'; // Initialise la verification de la Cat à "Non"
        $types = []; // Initialise le tableau les types disponibles 
        $categories = []; // Initialise le tableau des catégories disponibles
        $billet = []; // Initialise le tableau des billets et quantités

        // Chargez tous les types dans un tableau
        $res = mysqli_query($cnt, "SELECT idType, idCategorie FROM type"); // Requete : Liste des types
        while ($row = mysqli_fetch_assoc($res)) {
            $types[$row['idType']] = $row['idCategorie'];
        }

        // Chargez toutes les catégories dans un tableau
        foreach ($_POST as $key => $value) {
            if (!empty($value)) { // Si la valeur n'est pas vide
                if (isset($types[$key])) { // Si l'idType existe dans la liste des types récupérés
                    $idCat = $types[$key]; // Initialise l'Id Categorie

                    // Vérification de la catégorie (si elle appartient à la catégorie A)
                    // Un billet de Cat A doit obligatoirement être selectionné
                    if ($idCat == 'A') {
                        $verifCat = 'O'; // Initialise la validité des catégories sélectionnées
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

        $_SESSION['categories'] = $categories; // Stocker le tableau des catégories dans la session
        $_SESSION['billet'] = $billet; // Stocker le tableau billet dans la session


        // Message Log : Afficher le tableau des catégories et leurs sommes
        echo "<pre>";
        print_r($_POST); // Données envoyées par le formulaire
        print_r($categories); // Sommes par catégorie
        print_r($billet); // Paires clé/valeur dans le tableau billet
        echo "</pre>";
        
        // Si la vérification des catégories est OK
        if ($verifCat === 'O') {
            echo '<span style="color: green;">✅ Réussi, les valeurs ont été mise en session.</span>'; // Message Log
            header('Location: ../booking-step3.php'); // Redirection étape 3 réservation
            exit();
        } else {
            $_SESSION['error_message'] = "Vous devez sélectionner au moins un billet Enfant, Jeune ou Adulte."; // Stock en session le message d'erreur
            echo '<span style="color: red;">❌ Vous devez sélectionner au moins un billet Enfant, Jeune ou Adulte.</span>'; // Message Log
            header('Location: ../booking-step2.php'); // Redirection étape 2 réservation
            exit();
        }
    }
    // Si le formulaire est vide
    else{
        $_SESSION['error_message'] = "Le formulaire est incomplet ou vide."; // Stock le message d'erreur à return
        echo '<span style="color: red;">❌ Le formulaire est incomplet ou vide.</span>'; // Message Log
        header('Location: ../booking-step2.php'); // Redirection étape 1 réservation
        exit();
    }
?>