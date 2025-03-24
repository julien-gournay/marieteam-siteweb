<?php
include "../bdd.php"; // Connexion à la BBD
session_start();  // Ouverture d'une session pour stocker les données
                        
// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Si le formulaire est saisi
    $username = $_POST['username']; // Récuperation nom d'utilisateur
    $password = $_POST['password']; // Récuperation mot de passe

    if($mabase){ // Vérification connexion DB
        $res_log = mysqli_query($cnt,"SELECT * FROM personnel WHERE `role`='admin' AND `nomUtilisateur`='$username'"); // Requete : Vérification user dans la DB
        if (mysqli_num_rows($res_log) > 0) { // Si la requete récupere 1 user
            $tab = mysqli_fetch_row($res_log);
            $admin_nom = $tab[2]; // Récuperation Nom
            $admin_prenom = $tab[3]; // Récuperation Prenom
            $admin_username = $tab[4]; // Récuperation Nom d'utilisateur
            $admin_password = $tab[5]; // Récuperation Mot de passe
        } else {
            $admin_username = 'none'; // Si pas de user trouvé, initialise username
        }
    }
    
    // Vérification des informations d'identification
    if ($username === $admin_username && $password === $admin_password) {
        // Si les informations d'identification sont correctes, définir une session
        $_SESSION['loggedin'] = true; // La session de loggin passe en état "true"
        $_SESSION['userid'] = $username; // Initialise en session le nom d'utilisateur
        $_SESSION['usernom'] = $admin_nom; // Initialise en session le nom de famille
        $_SESSION['userprenom'] = $admin_prenom; // Initialise en session le prenom
        header("Location: ../admin.php"); // Redirection vers la page admin
        echo "Vous êtes connecté en tant qu'administrateur !"; // Message successs
        exit();
    } else {
        // Si les informations d'identification sont incorrectes, affichez un message d'erreur Log
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

// Vérification si la session n'est pas ouverte ou vide
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Si l'administrateur n'est pas connecté, affiche le formulaire
    if (isset($error_message)) {
        echo "<br><p>$error_message</p>";
    }
} else {
    // Si l'administrateur est déjà connecté, affiche un message
    echo "<p>Vous êtes déjà connecté en tant qu'administrateur.<br><a href='admin.php'>Accéder à votre espace</a></p>";
    echo "<form action=\"deconnexion.php\" method=\"post\"><button type=\"submit\" class=\"btn-deconnexion bouton\">Se déconnecter</button></form>";
}