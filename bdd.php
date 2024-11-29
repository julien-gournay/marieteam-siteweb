<?php
    $cnt = mysqli_connect('localhost', 'root', ''); // Connexion Serveur BDD
    $mabase = mysqli_select_db($cnt, "marieteam"); // Choix de la BDD

    // REQUETES SQL :
    if ($mabase) {
        $res1 = mysqli_query($cnt, "SELECT * FROM port");
        $res3 = mysqli_query($cnt, "SELECT * FROM port");
    }

    /*function rechercheH($villed,$villea,$dated){
        $cnt = mysqli_connect('localhost', 'root', '');
        $mabase = mysqli_select_db($cnt, "marieteam");
        $res_horaire = mysqli_query($cnt, "SELECT * FROM liaison,trajet WHERE liaison.idvilleDepart='$villed' AND liaison.idvilleArrivee='$villea' AND liaison.idLiai=trajet.idLiai AND trajet.dateDepart='$dated';");

        return $res_horaire;
    }*/
?>