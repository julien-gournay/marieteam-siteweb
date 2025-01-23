<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Marie Team</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="css/booking.css"> <!-- CSS spécifique -->
</head>
<body>
    <?php 
        include "navbar.php"; // Inclure la barre de navigation
        include "bdd.php"; // Fichier de connexion BDD

        // ### OPTION 1: RECUPERATION PARAMETRES VIA SESSION ### 
        session_start();  // Ouverture d'une session pour stocker les données
        $idVilleDepart = $_SESSION['villeD']; // Variable Ville depart selectionnée
        $idVilleArrivee = $_SESSION['villeA']; // Variable Ville arrivée selectionnée
        $dateDepart = $_SESSION['dateDepart']; // Variable Date depart selectionnée
        $idPeriode = $_SESSION['periode']; // Variable Date depart selectionnée


        // ### OPTION 2 : RECUPERATION PARAMETRES VIA URL ### 
        // if((isset($_GET["villed"]))OR(isset($_GET["villea"]))){
        //   $idvilled = $_GET["villed"];
        //     $idvillea = $_GET["villea"];
        // }

        if ($mabase) { // Verification que la BDD sois bien connecté
            $res_villeD = mysqli_query($cnt, "SELECT port.ville FROM liaison,port WHERE liaison.idVilleDepart='$idVilleDepart' AND liaison.idvilleDepart=port.idVille GROUP BY port.ville;"); // Requête : affichage nom ville depart selon id
            //$res_villeD = mysqli_query($cnt, "SELECT port.ville FROM liaison,port WHERE liaison.idVilleDepart='$idvilled' AND liaison.idvilleDepart=port.idVille GROUP BY port.ville;"); // Requête : affichage nom ville depart selon id (option 2)
            $res_villeA = mysqli_query($cnt, "SELECT port.ville FROM liaison,port WHERE liaison.idVilleArrivee='$idVilleArrivee' AND liaison.idvilleArrivee=port.idVille GROUP BY port.ville;"); // Requête : affichage nom ville arrivée selon id
            //$res_villeA = mysqli_query($cnt, "SELECT port.ville FROM liaison,port WHERE liaison.idVilleArrivee='$idvillea' AND liaison.idvilleArrivee=port.idVille GROUP BY port.ville;"); // Requête : affichage nom ville arrivée selon id (option 2)
            $res_tarif = mysqli_query($cnt, "SELECT tarif.idType,type.libelleType,tarif.tarif FROM tarif,type WHERE tarif.idLiaison='$idVilleDepart-$idVilleArrivee' AND tarif.idType=type.idType AND tarif.idPeriode=$idPeriode;"); // Requête : récuperation des tarifs selon la liaison
        }
    ?>

    <!-- ##### SECTION ETAPE 2 : BILLETS  ##### -->
    <section id="sec-1">
        <form class="cadre" method="POST" action="php/step2.php"> <!-- Formulaire de l'etape 2 -->
            <!-- +++ CADRES PARTIE DE GAUCHE  +++ -->
            <div class="cadre-ct">
                <!-- +++ CADRE DES DIVERSE ETAPES +++ -->
                <div class="cadre-menu">
                    <ol class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                        <li class="flex items-center text-blue-600 dark:text-blue-500"> <!-- Icon Etape 1 -->
                            <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                1
                            </span>
                            <a href="booking-step1.php">Destination</a>
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                            </svg>
                        </li>
                        <li class="flex items-center text-blue-600 dark:text-blue-500"> <!-- Icon Etape 2 -->
                            <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                2
                            </span>
                            <a href="booking-step2.php">Billets</a>
                            <div class="arrow"> <!-- Fleches animé -->
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </li>
                        <li class="flex items-center"> <!-- Icon Etape 3 -->
                            <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                3
                            </span>
                            Horaire
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                            </svg>
                        </li>
                        <li class="flex items-center"> <!-- Icon Etape 4 -->
                            <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                4
                            </span>
                            Informations
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                            </svg>
                        </li>
                        <li class="flex items-center"> <!-- Icon Etape 5 -->
                            <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                5
                            </span>
                            Validation
                        </li>
                    </ol>
                </div>

                <?php
                    if (isset($_SESSION['error_message'])) { // Vérifiez si un message d'erreur est défini dans la session
                        echo("<div id=\"alert-additional-content-2\" class=\"p-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800\" role=\"alert\">
                            <div class=\"flex items-center\">
                                <svg class=\"flex-shrink-0 w-4 h-4 me-2\" aria-hidden=\"true\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"currentColor\" viewBox=\"0 0 20 20\">
                                <path d=\"M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z\"/>
                                </svg>
                                <span class=\"sr-only\">Warning</span>
                                <h3 class=\"text-lg font-medium\">Problème de billet</h3>
                            </div>
                            <div class=\"mt-2 mb-4 text-sm\">
                                ".$_SESSION['error_message']."
                            </div>
                        </div>"); // Message d'erreur (aucun trajet disponible selon les conditions)
                        unset($_SESSION['error_message']); // Supprimez le message après l'affichage
                    }
                ?>
                <!-- +++ SELECTION BILLETS  +++ -->
                <div class="cadre-ville">
                    <p>Selectionner vos billets</p>
                    <div>
                        <p>⚠️ Vous devez obligatoirement prendre au moins un billet enfant, jeune ou adulte.</p>
                        <p>Pour l'achat de billet de groupe (+10 personnes), merci de nous contacter.</p>
                    </div>
                    <div class="cadre-list">
                        <?php 
                            if (mysqli_num_rows($res_tarif) > 0) { // Vérification que des types/tarifs de billets existes
                                while ($tab = mysqli_fetch_row($res_tarif)) { // Boucle pour afficher les tarifs selon Type
                                    $idtype = $tab[0]; // Variable de l'id Type
                                    $libelleType = $tab[1]; // Variable nom Type
                                    $tarif = $tab[2]; // Variable tarif lié au Type

                                    echo("<div class=\"cadre-list-boxt\">
                                        <div class=\"cadre-list-boxt-txt\">
                                            <p class=\"cadre-list-boxt-txt-ty\">$libelleType</p>
                                            <p class=\"cadre-list-boxt-txt-ta\">$tarif €</p>
                                        </div>
                                        <div class=\"cadre-list-boxt-qua\">
                                            <div class=\"relative flex items-center max-w-[8rem]\">
                                                <button type=\"button\" id=\"decrement-button\" data-input-counter-decrement=\"qb-$idtype\" class=\"dark:bg-gray-700 dark:border-gray-600 hover:bg-gray-200 border rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none\">
                                                    <svg class=\"w-3 h-3 text-gray-900 dark:text-white\" aria-hidden=\"true\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 18 2\">
                                                        <path stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M1 1h16\"/>
                                                    </svg>
                                                </button>
                                                <input type=\"text\" id=\"qb-$idtype\" name=\"$idtype\" data-input-counter data-input-counter-min=\"0\" data-input-counter-max=\"10\" aria-describedby=\"helper-text-explanation\" class=\"border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500\" placeholder=\"0\" />
                                                <button type=\"button\" id=\"increment-button\" data-input-counter-increment=\"qb-$idtype\" class=\"dark:bg-gray-700 dark:border-gray-600 hover:bg-gray-200 border rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none\">
                                                    <svg class=\"w-3 h-3 text-gray-900 dark:text-white\" aria-hidden=\"true\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 18 18\">
                                                        <path stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 1v16M1 9h16\"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>");
                                }
                            } else{ // Si pas de type de billet existant alors ...
                                echo("<p class=\"error-message\">Il n'y a pas de billets disponibles pour se trajet</p>"); // Message d'erreur si pas de type/tarif existant
                            }
                        ?>
                    </div>
                </div>
            </div>

            <!-- +++ CADRES PARTIE DE DROITE  +++ -->                    
            <div class="cadre-recap">
                <!-- +++ RECAPITULATIF RESERVATION  +++ -->
                <div class="cadre-recap-ct">
                    <h2>Votre réservation</h2>
                    <hr>
                    <div class="cadre-recap-ct-gp">
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Ville de départ</p>
                            <p><?php while ($tab = mysqli_fetch_row($res_villeD)) {
                                    $villeDepart = $tab[0]; // Variable nom ville depart
                                }
                                echo("$villeDepart"); // Affichage nom ville depart ?></p> 
                        </div>
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Ville d'arrivée</p>
                            <p><?php while ($tab = mysqli_fetch_row($res_villeA)) {
                                    $villeArrivee = $tab[0]; // Variable nom ville arrivée
                                }
                                echo("$villeArrivee"); // Affichage nom ville depart ?></p>
                        </div>
                    </div>
                    
                    <div class="cadre-recap-ct-gp">
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Date départ</p>
                            <p><?php echo("$dateDepart"); // Affichage date départ ?></p>
                        </div>
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Date arrivé</p>
                            <p>[A l'étape 3]</p>
                        </div>
                    </div>

                    <!-- +++ BOUTONS RECAP  +++ -->
                    <div class="cadre-recap-ct-bt">
                        <button class="cadre-recap-ct-bt-ann"><a href="booking-step1.php">Précedemment</a></button> <!-- Bouton retour etape -->
                        <button class="cadre-recap-ct-bt-sui" type="submit">Suivant</button> <!-- Bouton etape suivante -->
                    </div>
                </div>
            </div>
        </form>
    </section>

    <?php include "footer.php" ?> <!-- Inclure le footer -->

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> <!-- Modules Flowbite (pour composant) -->
</body>
</html>