<?php
include "bdd.php"; // Connexion à la BBD

// Vérification que le formulaire sois complet
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $reference = isset($_POST['reference']) ? trim($_POST['reference']) : '';
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';

    // Vérification que les champs ne sont pas vides
    if (empty($reference) || empty($nom)) {
        header("Location: ../resa-login.php?error=" . urlencode("📝 Veuillez remplir tous les champs avant de valider"));
        exit();
    }

    // Requête SQL
    $sql = "SELECT reservation.reference, client.nom, reservation.etat FROM reservation, client WHERE reservation.reference='$reference' AND client.nom='$nom' AND reservation.idClient=client.idClient";
    $result = $cnt->query($sql); // Execution requete

    // Vérifiez si une réservation existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Vérifiez l'état de la réservation
        switch($row['etat']) {
            case 'Validé':
                header("Location: ../resa-detail.php?reference=$reference");
                exit();
                break;
            case 'Archivé':
                header("Location: ../resa-login.php?error=" . urlencode("📦 Cette réservation est archivée. Elle n'est plus accessible."));
                exit();
                break;
            case 'Annulé':
                header("Location: ../resa-login.php?error=" . urlencode("❌ Cette réservation a été annulée."));
                exit();
                break;
            default:
                header("Location: ../resa-login.php?error=" . urlencode("⚠️ Cette réservation n'est pas dans un état valide."));
                exit();
                break;
        }
    } else {
        header("Location: ../resa-login.php?error=" . urlencode("🔍 Aucune réservation trouvée pour ces informations."));
        exit();
    }
    $conn->close(); // Fermer la connexion
}
