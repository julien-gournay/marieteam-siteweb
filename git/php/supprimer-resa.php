<?php
    // Connexion à la base de données
    $bdd = new PDO('mysql:host=localhost;dbname=marieteam;charset=utf8', 'root', '');

    // Récupération de l'ID à supprimer et vérification de son existence
    if (isset($_GET['reference'])) {
        $id_a_supprimer = $_GET['reference'];

        // Requête SQL avec le marqueur de paramètre correctement placé
        $req = $bdd->prepare('UPDATE reservation SET etat="Annulé" WHERE reference = ?');
        $req->execute([$id_a_supprimer]);

        // Redirection
        header('Location: ../resa-login.php');
        exit;
    } else {
        // Gestion de l'erreur : l'ID n'a pas été fourni
        echo "L'ID de la réservation à supprimer n'a pas été spécifié.";
    }
?>