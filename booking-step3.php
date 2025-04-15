<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "component/head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Marie Team</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="css/booking.css"> <!-- CSS spécifique -->
</head>
<body>
    <?php 
        include "component/navbar.php"; // Inclure la barre de navigation
        include "php/bdd.php"; // Fichier de connexion DB

        // ### OPTION 1: RECUPERATION PARAMETRES VIA SESSION ### 
        session_start(); // Ouverture d'une session pour stocker les données
        $idVilleDepart = $_SESSION['villeD']; // Variable Ville depart selectionnée
        $idVilleArrivee = $_SESSION['villeA']; // Variable Ville arrivée selectionnée
        $dateDepart = $_SESSION['dateDepart']; // Variable Date depart selectionnée
        $idPeriode = $_SESSION['periode']; // Variable Date depart selectionnée
        //$billet = $_SESSION['billet'];

        if ($mabase) { // Verification que la DB sois bien connecté
            $res_villeD = mysqli_query($cnt, "SELECT port.ville FROM liaison,port WHERE liaison.idVilleDepart='$idVilleDepart' AND liaison.idvilleDepart=port.idVille GROUP BY port.ville;"); // Requête : affichage nom ville depart selon id
            $res_villeA = mysqli_query($cnt, "SELECT port.ville FROM liaison,port WHERE liaison.idVilleArrivee='$idVilleArrivee' AND liaison.idvilleArrivee=port.idVille GROUP BY port.ville;"); // Requête : affichage nom ville arrivée selon id
            $res_horaire = mysqli_query($cnt, "SELECT * FROM liaison,trajet WHERE liaison.idvilleDepart='$idVilleDepart' AND liaison.idvilleArrivee='$idVilleArrivee' AND liaison.idLiai=trajet.idLiaison AND trajet.dateDepart='$dateDepart' ORDER BY trajet.heureDepart ASC;"); // Requête : Récupération de tout les trajets selon la liaisons
        }
    ?>

    <!-- ##### SECTION ETAPE 3 : TRAJETS  ##### -->
    <section id="sec-1">
        <form class="cadre" method="POST" action="php/step3.php"> <!-- Formulaire de l'etape 3 -->
            <!-- +++ CADRES PARTIE DE GAUCHE  +++ -->
            <div class="cadre-ct">
                <!-- +++ CADRE DES DIVERSE ETAPES  +++ -->
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
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                            </svg>
                        </li>
                        <li class="flex items-center text-blue-600 dark:text-blue-500"> <!-- Icon Etape 3 -->
                            <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                3
                            </span>
                            <a href="booking-step3.php">Horaire</a>
                            <div class="arrow"> <!-- Fleches animé -->
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
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

                if (mysqli_num_rows($res_horaire) <= 0) { // Si aucun trajets ne sont existant alors ...
                    echo("<div id=\"alert-additional-content-2\" class=\"p-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800\" role=\"alert\">
                    <div class=\"flex items-center\">
                        <svg class=\"flex-shrink-0 w-4 h-4 me-2\" aria-hidden=\"true\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"currentColor\" viewBox=\"0 0 20 20\">
                        <path d=\"M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z\"/>
                        </svg>
                        <span class=\"sr-only\">Info</span>
                        <h3 class=\"text-lg font-medium\">Aucun trajet trouvé !</h3>
                    </div>
                    <div class=\"mt-2 mb-4 text-sm\">
                        Oups, nous avions cherché des horaires mais il semblerais qu'il n'y est pas de traversé pour le $dateDepart.
                    </div>
                    <div class=\"flex\">
                        <button type=\"button\" onclick=\"window.location='booking-step1.php';\" class=\"text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800\">
                            <svg class=\"me-2 h-3 w-3\" aria-hidden=\"true\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"currentColor\" viewBox=\"0 0 20 14\">
                                <path d=\"M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z\"/>
                            </svg>
                            Choisir une nouvelle date
                        </button>
                    </div>
                    </div>"); // Message d'erreur (aucun trajet disponible selon les conditions)
                }

                if (mysqli_num_rows($res_horaire) > 0) { // Si des trajets sont existant alors ...
                echo("<div class=\"cadre-ville\">");
                    echo("<p>Selectionner votre trajet</p>");
                    echo("<div class=\"cadre-listh\">");
                        while ($tab = mysqli_fetch_row($res_horaire)) { // Boucle pour afficher chaque trajet
                            $idLiaison = $tab[0]; // Variable id Liaison
                            $duree = $tab[3]; // Variable durée trajet
                            $idtrajet = $tab[4]; // Variable id trajet
                            $dDepart = $tab[7]; // Variable date départ
                            $hDepart = $tab[8]; // Variable heure départ
                            $dArrive = $tab[9]; // Variable date arrivée
                            $hArrive = $tab[10]; // Variable heure arrivée

                            $hDepart = date("H\hi", strtotime($hDepart));  // H:i correspond à l'heure et minutes uniquement
                            $hArrive = date("H\hi", strtotime($hArrive));  // H:i correspond à l'heure et minutes uniquement
                            $duree = date("H\hi", strtotime($duree));  // H:i correspond à l'heure et minutes uniquement

                            
                            echo("<div class=\"cadre-list-boxh\">
                                <input class=\"radio-trajet\" type=\"radio\" name=\"idtrajet\" value=\"$idtrajet\" required>
                                <div class=\"cadre-list-boxh-heure\">
                                    <p class=\"cadre-list-boxh-txt-ty\">$hDepart</p>
                                    <p class=\"cadre-list-boxh-txt-ta\">$hArrive</p>
                                </div>
                                <div class=\"cadre-list-boxh-txt\">
                                    <p>$idLiaison ($idtrajet) ");
                            
                            // +++ INCIDENT TRAJET +++
                            $res_incident = mysqli_query($cnt, "SELECT * FROM incident WHERE incident.idTrajet=$idtrajet;"); // Requête : Recupére la liste d'indicent du trajet de la boucle
                            if (mysqli_num_rows($res_incident) > 0) { // Vérification si un incident existe
                                while ($tab = mysqli_fetch_row($res_incident)) { // Boucle récuperation incident
                                    $typeIncident = $tab[3]; // Variable type d'incident
                                    $retard = $tab[4]; // Variable durée retard
                                    $raison = $tab[5]; // Variable raison incident
                                }
                                // Conversion de retard au format convivial (durée + unité)
                                list($hours, $minutes, $seconds) = explode(':', $retard);
                                if ((int)$hours > 0) {
                                    $retard_convivial = (int)$hours . " heure" . ((int)$hours > 1 ? "s" : "");
                                } else {
                                    $retard_convivial = (int)$minutes . " minute" . ((int)$minutes > 1 ? "s" : "");
                                }

                                switch($typeIncident){ // Switch selon le type d'incident
                                    case "Retard": // Pour le type retard
                                        echo("<span class=\"inline-flex items-center bg-orange-100 text-orange-500 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300\">
                                        <span class=\"w-2 h-2 me-1 bg-orange-500 rounded-full\">
                                        </span>Retardé de $retard_convivial</span>"); // Affichage de la durée de retard [! COMPOSANT FLOWBITE]
                                        break;
                                    case "Annulé": // Pour le type annulé
                                        echo("<span class=\"inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300\">
                                        <span class=\"w-2 h-2 me-1 bg-red-500 rounded-full\">
                                        </span>Annulé pour $raison</span>"); //Affichage du motif annulation [! COMPOSANT FLOWBITE]
                                        break;
                                    case "Méteo": // Pour le type méteo
                                        echo("<span class=\"inline-flex items-center bg-blue-100 text-blue-500 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300\">
                                        <span class=\"w-2 h-2 me-1 bg-blue-500 rounded-full\">
                                        </span>Condition méteo : $raison</span>"); // Affichage des informations méteo [! COMPOSANT FLOWBITE]
                                        break;
                                }
                            } echo("<div class=\"cadre-list-boxh-txt-dur\"><img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAABM0lEQVR4nN2UTU7DMBCFrSC4QvxecgAUwSqsEHeg4vdKQDlGFe7CBSgUWCKVHYW90UhGRHQSOyarjjSSF5P3Zd6MbcxGR1VVOyQvSTYA5iS/JP25IXkhNUni1tpTki8kXV8CeLbWngzR3gJwGxLmOmhqjMmC6ini/M3rGFv6BA4BHAU6majiMizxs+9j4yPwE6/q4P22uBEAriiKc837u7EAJGca4GksAIC5ZtFqAGAZqF0lAay1B1Kb5/leALIOAPAY4e17WZb7vn4XwFtH3YPWQRN5mZbSQauTj6ghy8MVCXBtCMl7ZU3Pki4a//isiQNY1HW9bbSQV3EAwHWs6LEq3hr29B+AKxMRGYCbxJc0iwH8dDIRPyMsWQRt6QoZljxcsnay2yQ/fcp5JtvSOdCNiW/DpYV/SqBrIQAAAABJRU5ErkJggg==\" alt=\"clock\"></p>$duree</div></div></div>");
                        }
                    echo("</div>");
                echo("</div>");
            }?>
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
                    <hr>
                    
                    <!-- +++ DETAIL PRIX  +++ -->
                    <h3>Détail prix</h3>
                    <div class="cadre-recap-ct-gp">
                        <!--<div class="cadre-recap-ct-gp-txt">
                            <p>Billet piéton</p>
                            <p>0</p>
                        </div>-->
                        <?php
                            $prixTotalP = 0;
                            foreach ($_SESSION['billet'] as $key => $value) {
                                $res_typeP = mysqli_query($cnt, "SELECT type.libelleType, type.idCategorie, tarif.tarif 
                                                                  FROM tarif, type 
                                                                  WHERE type.idType='$key' 
                                                                  AND type.idType=tarif.idType 
                                                                  AND type.idCategorie='A'
                                                                  AND tarif.idPeriode='$idPeriode'
                                                                  AND tarif.idLiaison='$idVilleDepart-$idVilleArrivee';"); // Requête pour récupérer les informations
                            
                                if ((mysqli_num_rows($res_typeP) > 0) && ($value > 0)) {
                                    while ($tab = mysqli_fetch_row($res_typeP)) {
                                        // Récupérer les informations
                                        $nomTypeP = $tab[0];
                                        $prixBaseP = $tab[2];
                            
                                        // Calcul du prix total pour ce type
                                        $prixTypeP = $prixBaseP * $value;
                                        $prixTotalP = isset($prixTotalP) ? $prixTotalP + $prixTypeP : $prixTypeP; // Initialisation du prix total si nécessaire
                            
                                        // Affichage des détails pour chaque type
                                        echo("
                                        <div class=\"cadre-recap-ct-gp-txt\">
                                            <p>$nomTypeP [$value x $prixBaseP €]</p>
                                            <p>$prixTypeP €</p>
                                        </div>");
                                    }
                                }
                            }
                            
                            if ($prixTotalP > 0) {
                                echo("    
                                <div class=\"cadre-recap-ct-gp-txt\">
                                    <p><b>Total piéton</b></p>
                                    <p><b>$prixTotalP €</b></p>
                                </div>");
                            }
                        ?>
                    </div>
                    <div class="cadre-recap-ct-gp">
                        <!--<div class="cadre-recap-ct-gp-txt">
                            <p>Nombre véhicule</p>
                            <p>0</p>
                        </div>-->
                        <?php
                            $prixTotalV = 0;
                            foreach ($_SESSION['billet'] as $key => $value) {
                                $res_typeV = mysqli_query($cnt, "SELECT type.libelleType, type.idCategorie, tarif.tarif 
                                                                  FROM tarif, type 
                                                                  WHERE type.idType='$key' 
                                                                  AND type.idType=tarif.idType 
                                                                  AND type.idCategorie!='A'
                                                                  AND tarif.idPeriode='$idPeriode'
                                                                  AND tarif.idLiaison='$idVilleDepart-$idVilleArrivee';"); // Requête pour récupérer les informations
                            
                                if ((mysqli_num_rows($res_typeV) > 0) && ($value > 0)) {
                                    while ($tab = mysqli_fetch_row($res_typeV)) {
                                        // Récupérer les informations
                                        $nomTypeV = $tab[0];
                                        $prixBaseV = $tab[2];
                            
                                        // Calcul du prix total pour ce type
                                        $prixTypeV = $prixBaseV * $value;
                                        $prixTotalV = isset($prixTotalV) ? $prixTotalV + $prixTypeV : $prixTypeV; // Initialisation du prix total si nécessaire
                            
                                        // Affichage des détails pour chaque type
                                        echo("
                                        <div class=\"cadre-recap-ct-gp-txt\">
                                            <p>$nomTypeV [$value x $prixBaseV €]</p>
                                            <p>$prixTypeV €</p>
                                        </div>");
                                    }
                                }
                            }
                            if ($prixTotalV > 0) {
                                echo("    
                                <div class=\"cadre-recap-ct-gp-txt\">
                                    <p><b>Total véhicule</b></p>
                                    <p><b>$prixTotalV €</b></p>
                                </div>");
                            }
                        ?>
                    </div>
                    <hr>
                    
                    <!-- +++ TOTAL DEPENSE  +++ -->
                    <div class="cadre-recap-ct-gp">
                        <div class="cadre-recap-ct-gp-txt">
                            <?php
                                $prixTotal = $prixTotalP + $prixTotalV;

                                echo("
                                    <p class=\"cadre-recap-ct-gp-txt-total\">TOTAL</p>
                                    <p class=\"cadre-recap-ct-gp-txt-total\">$prixTotal €</p>
                                ");
                            ?>
                        </div>
                    </div>

                    <!-- +++ BOUTONS RECAP  +++ -->
                    <div class="cadre-recap-ct-bt">
                        <button class="cadre-recap-ct-bt-ann"><a href="booking-step2.php">Précedemment</a></button> <!-- Bouton retour etape -->
                        <button class="cadre-recap-ct-bt-sui" type="submit">Suivant</button> <!-- Bouton etape suivante -->
                    </div>
                </div>
            </div>
        </form>
    </section>

    <?php include "component/footer.php" ?> <!-- Inclure le footer -->

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> <!-- Modules Flowbite (pour composant) -->
    <script src="js/recap-slider.js"></script>
</body>
</html>