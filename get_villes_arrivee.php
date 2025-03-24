<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marieteam";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['villeDepart'])) {
  $villeDepart = $_POST['villeDepart'];

  // Requête avec les bons noms de colonnes de la table port
  $query = "SELECT DISTINCT p.idVille, p.ville, p.photo 
              FROM port p 
              INNER JOIN liaison l ON p.idVille = l.idvilleArrivee 
              WHERE l.idvilleDepart = ?";

  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "s", $villeDepart);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class=\"cadre-list-ville\">
                <input class=\"radio-ville\" type=\"radio\" name=\"villeA\" value=\"{$row['idVille']}\" required>
                <img src=\"{$row['photo']}\" alt=\"\">
                <p class=\"cadre-list-ville-v\">{$row['ville']}</p>
              </div>";
  }

  mysqli_stmt_close($stmt);
}

// Fermer la connexion
$conn->close();
