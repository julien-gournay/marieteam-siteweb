<?php
    include ".bdd.php"; // Connexion DB

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        // Vérifier l'ID avant de procéder à la suppression
        echo "Tentative de suppression de l'ID : " . htmlspecialchars($id);  // Pour déboguer

        // Préparer la requête de suppression
        $query = $pdo->prepare("DELETE FROM liaison WHERE idLiai = ?");

        // Déboguer : afficher la requête SQL avant de l'exécuter
        $debugQuery = "DELETE FROM liaison WHERE idLiai = ". htmlspecialchars($id) ."";
        echo "<br>Requête SQL exécutée : " . $debugQuery;  // Affiche la requête avec l'ID

        $query->execute([$id]);

        // Vérifier si la suppression a bien eu lieu
        if ($query->rowCount() > 0) {
            echo "<br>Suppression réussie !";
        } else {
            echo "<br>Aucune ligne supprimée. L'ID existe-t-il ?";
        }

        // Redirection après suppression
        //header("Location: ../admin-liaison.php?deleted=success");
        exit();
    } else {
        echo "<br>ID invalide ou manquant.";
        //header("Location: ../admin-liaison.php?deleted=error");
        exit();
    }
?>
