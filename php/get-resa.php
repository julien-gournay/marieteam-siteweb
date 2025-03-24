<?php
require '../bdd.php'; // Fichier de connexion à la DB

if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];

    $query = "
        SELECT 
            r.reference, r.dateResa, r.etat, 
            c.nom AS client_nom, c.prenom AS client_prenom, c.telephone AS client_tel, c.email AS client_email, 
            t.idTrajet, t.dateDepart, t.heureDepart, t.dateArrivee, t.heureArrivee, 
            l.idLiai, l.idvilleDepart, l.idvilleArrivee,
            b.nomBateau
        FROM reservation r
        JOIN client c ON r.idClient = c.idClient
        JOIN trajet t ON r.idTrajet = t.idTrajet
        JOIN liaison l ON t.idLiaison = l.idLiai
        JOIN bateau b ON t.idBateau = b.idBateau
        WHERE r.reference = ?";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':reference', $reference, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($data); // Retourne les données en JSON
    } else {
        header('Content-Type: application/json');
        echo json_encode(["error" => "Réservation non trouvée"]);
    }
}
?>