<?php
    include "bdd.php";
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['villeD']) && isset($_POST['villeA']) && !empty($_POST['villeD']) && !empty($_POST['villeA'])) {
            $villeDepart = $_POST['villeD'];
            $villeArrivee = $_POST['villeA'];
            $dateDepart = $_POST['dateDepart'];
    
            echo("$villeDepart + $villeArrivee");

            if($mabase){
                $req = "SELECT * FROM `liaison` WHERE idVilleDepart='$villeDepart' AND idVilleArrivee='$villeArrivee'";
                $res = mysqli_query($cnt,$req);
                if (mysqli_num_rows($res) > 0) {
                    $_SESSION['villeD'] = $villeDepart;
                    $_SESSION['villeA'] = $villeArrivee;
                    $_SESSION['dateDepart'] = $dateDepart;
                    echo("Réussi");
                    header('Location: booking-step2.php');
                    exit();
                } else {
                    $_SESSION['error_message'] = "Oups, il semblerait que ce trajet n'existe pas.";
                    echo("Oups, il s'emblerais que ce trajet n'existe pas");
                    header('Location: booking-step1.php');
                    exit();                     
                }
            }
        }
    }
?>