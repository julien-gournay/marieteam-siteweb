<?php
    include "bdd.php";
    // GESTION DES VILLES D'ARRIVÉE POUR LE FORMULAIRE DE RESERVATION (INDEX)

// Activation des messages d'erreur PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log pour vérifier si le script est appelé
file_put_contents('debug.txt', "Script appelé\n", FILE_APPEND);

if (isset($_POST['villeDepart'])) {
  $villeDepart = $_POST['villeDepart'];

  // Log de la ville de départ reçue
  file_put_contents('debug.txt', "Ville départ reçue: " . $villeDepart . "\n", FILE_APPEND);

  try {
    // Requête pour obtenir les villes d'arrivée possibles avec leurs noms
    $req = "SELECT DISTINCT l.idvilleArrivee, p.ville 
                FROM liaison l 
                JOIN port p ON l.idvilleArrivee = p.idVille 
                WHERE l.idvilleDepart = '$villeDepart'";

    $result = mysqli_query($cnt, $req);

    if (!$result) {
      throw new Exception(mysqli_error($cnt));
    }

    $options = '<option selected>Selectionner un port</option>';
    while ($row = mysqli_fetch_assoc($result)) {
      $options .= sprintf(
        '<option value="%s">%s</option>',
        $row['idvilleArrivee'],
        $row['ville']
      );
    }

    echo $options;
  } catch (Exception $e) {
    file_put_contents('debug.txt', "Erreur: " . $e->getMessage() . "\n", FILE_APPEND);
    http_response_code(500);
    echo "Erreur: " . $e->getMessage();
  }
} else {
  file_put_contents('debug.txt', "Pas de ville de départ reçue\n", FILE_APPEND);
  http_response_code(400);
  echo "Erreur: Pas de ville de départ spécifiée";
}
