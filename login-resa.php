<?php
// Inclure le fichier de connexion à la base de données
include "bdd.php";  // ou require "bdd.php"

// Vérifier que la connexion existe
if (!isset($conn)) {
  die("La connexion à la base de données a échoué");
}

// Ensuite votre code existant avec real_escape_string()
$variable = $conn->real_escape_string($_POST['variable']);
// ... reste du code ... 