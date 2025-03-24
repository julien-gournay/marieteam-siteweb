<?php
// Création de la connexion
$server = "localhost";
$database = "marieteam";
//   $user = "d.mercier_m"; // ! USER PHPmyAdmin
//   $password = '$Dans;mkw/974'; // ! MOT DE PASSE PHPmyAdmin
$user = "root"; // ! USER PHPmyAdmin
$password = ''; // ! MOT DE PASSE PHPmyAdmin

    $cnt = mysqli_connect($server, $user, $password); // Connexion Serveur DB (serveur,user,mdp)
    $mabase = mysqli_select_db($cnt, $database); // Choix de la DB : marieteam (defaut)

// REQUETES SQL :
if ($cnt) {
    $res1 = mysqli_query($cnt, "SELECT * FROM port"); // Requête pour afficher tout les ports
    $res2 = mysqli_query($cnt, "SELECT * FROM port"); // Requête pour afficher tout les ports
    $res3 = mysqli_query($cnt, "SELECT * FROM port"); // Requête pour afficher tout les ports
    $res4 = mysqli_query($cnt, "SELECT COUNT(port.ville) FROM port;"); // Requête pour compter le nombre de ports
}


try {
    $pdo = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// TEST FUNCTION
/*function rechercheH($villed,$villea,$dated){
        $cnt = mysqli_connect('localhost', 'root', '');
        $mabase = mysqli_select_db($cnt, "marieteam");
        $res_horaire = mysqli_query($cnt, "SELECT * FROM liaison,trajet WHERE liaison.idvilleDepart='$villed' AND liaison.idvilleArrivee='$villea' AND liaison.idLiai=trajet.idLiai AND trajet.dateDepart='$dated';");

        return $res_horaire;
    }*/
