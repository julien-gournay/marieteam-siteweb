<?php
include "php/bdd.php"; // Fichier de connexion DB


// 🚨 Graphique 1 : Ligne (incidents categories)
$incidentsCat = "SELECT incident.typeIncident, COUNT(*) AS total FROM incident GROUP BY incident.typeIncident";
$incidentsCat = $conn->query($incidentsCat);
// Formatage des données pour JS
$labelsIncidents = [];
$dataIncidents = [];
while ($row = $incidentsCat->fetch_assoc()) {
    $labelsIncidents[] = $row['typeIncident'];
    $dataIncidents[] = $row['total'];
}


// 🎯 Graphique 2 : Ligne (traversées de la semaine)
$traversesSemaine = "SELECT DAYNAME(dateDepart) AS jour, COUNT(*) AS nb FROM trajet WHERE dateDepart BETWEEN DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY) AND DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL 6 DAY) GROUP BY DATE(dateDepart) ORDER BY dateDepart;";
$traversesSemaine = $conn->query($traversesSemaine);
// Formatage des données pour JS
$labelsSemaine = [];
$dataSemaine = [];
while ($row = $traversesSemaine->fetch_assoc()) {
    $labelsSemaine[] = $row['jour'];
    $dataSemaine[] = $row['nb'];
}


// 🌍 Graphique 3 : Ligne (top destinations)
$sqlTop5 = "SELECT port.ville AS destination, COUNT(*) AS nb_resa FROM reservation JOIN trajet ON reservation.idTrajet = trajet.idTrajet JOIN liaison ON trajet.idLiaison = liaison.idLiai JOIN port ON liaison.idVilleArrivee = port.idVille GROUP BY port.ville ORDER BY nb_resa DESC LIMIT 5;";
$sqlTop5 = $conn->query($sqlTop5);
// Formatage des données pour JS
$labelsDest = [];
$dataDest = [];
$topDestination = "Non définie";
$index = 0;
while ($row = $sqlTop5->fetch_assoc()) {
    $labelsDest[] = $row['destination'];
    $dataDest[] = $row['nb_resa'];

    // Stocker la top 1 pour l'affichage texte
    if ($index === 0) {
        $topDestination = $row['destination'] ;
    }
    $index++;
}


// 🧁 Graphique 4 : Camembert (passagers par type)
$passagersCat = "SELECT type.libelleType, SUM(quantite) AS total_passagers FROM billet, type where (billet.idType = 'A1' OR billet.idType = 'A2' OR billet.idType = 'A3') AND type.idType=billet.idType GROUP BY billet.idType;";
$passagersCat = $conn->query($passagersCat);
// Formatage des données pour JS
$labelsType = [];
$dataPassagers = [];
while ($row = $passagersCat->fetch_assoc()) {
    $labelsType[] = $row['libelleType'];
    $dataPassagers[] = $row['total_passagers'];
}

$conn->close();
