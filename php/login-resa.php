<?php
include "bdd.php"; // Connexion à la BBD

// Vérification que le formulaire sois complet
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $reference = $cnt->real_escape_string($_POST['reference']);
    $nom = $cnt->real_escape_string($_POST['nom']);

    // Requête SQL
    $sql = "SELECT reservation.reference,client.nom,reservation.etat FROM reservation, client WHERE reservation.reference='$reference' AND client.nom='$nom' AND reservation.idClient=client.idClient";
    $result = $cnt->query($sql); // Execution requete

    // Vérifiez si une réservation existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Vérifiez si l'état est "validé"
        if ($row['etat'] === 'Validé') {
            header("Location: ../resa-detail.php?reference=$reference"); // Redirige vers la page "Gérer ma réservation"
            exit();
        } else {
            echo "<p class='error'>La réservation n'existe plus.</p>"; // Message d'erreur si la réservation est archivé
        }
    } else {
        echo "<p class='error'>Aucune réservation trouvée pour ces informations.</p>"; // Message d'erreur si la réservation n'exsite pas
    }
    $conn->close(); // Fermer la connexion
}
