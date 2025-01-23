<?php
include "../bdd.php"; 
                        
// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($mabase){
        $res_log = mysqli_query($cnt,"SELECT * FROM personnel WHERE `role`='admin' AND `identifiant`='$username'");
        if (mysqli_num_rows($res_log) > 0) {
            $tab = mysqli_fetch_row($res_log);
            $admin_nom = $tab[2];
            $admin_prenom = $tab[3];
            $admin_username = $tab[4];
            $admin_password = $tab[5];
        } else {
            $admin_username = 'none';
        }
    }
    
    // Vérifiez les informations d'identification
    if ($username === $admin_username && $password === $admin_password) {
        // Si les informations d'identification sont correctes, définissez une session
        $_SESSION['loggedin'] = true;
        $_SESSION['userid'] = $username;
        $_SESSION['usernom'] = $admin_nom;
        $_SESSION['userprenom'] = $admin_prenom;
        // Redirigez vers la page admin
        header("Location: ../admin.php");
        echo "Vous êtes connecté en tant qu'administrateur !";
        exit();
    } else {
        // Si les informations d'identification sont incorrectes, affichez un message d'erreur
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

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

function supprimerLoggedIn()
{
    // Vérifier si la variable existe
    if (isset($_SESSION['loggedin'])) {
        unset($_SESSION['loggedin']); // Supprimer la variable
        header("Location: ../admin-login.php");
        return "La variable 'loggedin' a été supprimée.";
    }
    return "La variable 'loggedin' n'existe pas.";
}