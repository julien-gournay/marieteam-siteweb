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
        $heureDepart = $_SESSION['heureDepart']; // Variable Date depart selectionnée
        $dateArrivee = $_SESSION['dateArrivee']; // Variable Date depart selectionnée
        $heureArrivee = $_SESSION['heureArrivee']; // Variable Date depart selectionnée
        $idTrajet = $_SESSION['idTrajet']; // V
        $dureeTrajet = $_SESSION['dureeTrajet'];
        $idPeriode = $_SESSION['periode']; // Variable Date depart selectionnée


        if ($mabase) { // Verification que la DB sois bien connecté
            $res_villeD = mysqli_query($cnt, "SELECT port.ville FROM liaison,port WHERE liaison.idVilleDepart='$idVilleDepart' AND liaison.idvilleDepart=port.idVille GROUP BY port.ville;"); // Requête : affichage nom ville depart selon id
            $res_villeA = mysqli_query($cnt, "SELECT port.ville FROM liaison,port WHERE liaison.idVilleArrivee='$idVilleArrivee' AND liaison.idvilleArrivee=port.idVille GROUP BY port.ville;"); // Requête : affichage nom ville arrivée selon id
            $res_horaire = mysqli_query($cnt, "SELECT * FROM liaison,trajet WHERE liaison.idvilleDepart='$idVilleDepart' AND liaison.idvilleArrivee='$idVilleArrivee' AND liaison.idLiai=trajet.idLiaison AND trajet.dateDepart='$dateDepart';"); // Requête : Récupération de tout les trajets selon la liaisons
        }
    ?>

    <!-- ##### SECTION ETAPE 3 : TRAJETS  ##### -->
    <section id="sec-1">
        <!-- Bouton récapitulatif mobile -->
        <button type="button" class="recap-toggle-button" onclick="toggleRecap()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
            </svg>
            Récapitulatif
        </button>

        <form class="cadre" method="POST" action="php/step4.php" autocomplete="on"> <!-- Formulaire de l'etape 3 -->
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
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                            </svg>
                        </li>
                        <li class="flex items-center text-blue-600 dark:text-blue-500"> <!-- Icon Etape 4 -->
                            <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                4
                            </span>
                            <a href="booking-step4.php">Informations</a>
                            <div class="arrow"> <!-- Fleches animé -->
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
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
                if (mysqli_num_rows($res_horaire) <= 0) { // Si aucun trajets ne sont existant alors ...
                    echo("<div id=\"alert-additional-content-2\" class=\"p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800\" role=\"alert\">
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
                ?>

                <div class="cadre-ville">
                    <p>Renseigner vos informations personnelles</p>
                    <div class="form-info1">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                </svg>
                            </div>
                            <input type="text"
                                   name="nom"
                                   id="nom-input"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Nom"
                                   autocomplete="family-name">
                        </div>
                        
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                </svg>
                            </div>
                            <input type="text"
                                   name="prenom"
                                   id="prenom-input"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Prénom"
                                   autocomplete="given-name">
                        </div>

                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                            </div>
                            <input type="text" 
                                   id="phone-input" 
                                   name="tel"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                   placeholder="Numéro de téléphone"
                                   autocomplete="tel"
                                   required />
                        </div>
                    </div>

                    <div class="relative mt-4">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                            </svg>
                        </div>
                        <input type="email"
                               name="email"
                               id="email-input"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Adresse mail"
                               autocomplete="email"
                               required>
                    </div>

                    <!-- Case à cocher pour les conditions -->
                    <div class="mt-4">
                        <div class="flex items-center gap-1">
                            <input id="link-checkbox" type="checkbox" value="true" class="w-4 h-4 text-blue-600 bg-gray-100 border-2 border-black rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700" required oninvalid="this.setCustomValidity('Veuillez lire puis accepter les conditions.')" oninput="this.setCustomValidity('')">
                            <label for="link-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">En cochant cette case, vous acceptez les <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">conditions d'achat et de confidentitalité</a>.</label>
                        </div>
                    </div>

                </div>


                <div class="cadre-ville">
                    <p>Renseigner vos informations de paiement</p>

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
                            <p><?php echo("$dateDepart | $heureDepart"); // Affichage date départ ?></p>
                        </div>
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Date arrivé</p>
                            <p><?php echo("$dateArrivee | $heureArrivee"); // Affichage date départ ?></p>
                        </div>
                    </div>
                    
                    <div class="cadre-recap-ct-gp">
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Traversé numéro</p>
                            <p><?php echo("$idTrajet");?></p>
                        </div>
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Durée</p>
                            <p><?php echo("$dureeTrajet"); // Affichage date départ ?></p>
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
                </div>
            </div>
        </form>

        <!-- Boutons de navigation mobile -->
        <div class="mobile-nav-buttons">
            <button type="button" class="prev-button" onclick="window.location='booking-step3.php'">Retour</button>
            <button type="button" class="next-button" onclick="document.querySelector('form').submit()">Procéder au paiement</button>
        </div>
    </section>

    <?php include "component/footer.php" ?> <!-- Inclure le footer -->

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> <!-- Modules Flowbite (pour composant) -->
    <script src="js/recap-slider.js"></script>
    <script>
        function toggleRecap() {
            const recap = document.querySelector('.cadre-recap');
            recap.classList.toggle('active');
        }

        // Fermer le récapitulatif en cliquant en dehors
        document.querySelector('.cadre-recap').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });
    </script>
</body>
</html>