<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "head.php" ?>
    <title>Marie Team</title>
    <link rel="stylesheet" href="css/booking.css">
</head>
<body>
    <?php 
        include "navbar.php";
        include "bdd.php"; 

        session_start();
        $idVilleDepart = $_SESSION['villeD'];
        $idVilleArrivee = $_SESSION['villeA'];
        $dateDepart = $_SESSION['dateDepart'];

        //if((isset($_GET["villed"]))OR(isset($_GET["villea"]))){
        //  $idvilled = $_GET["villed"];
        //    $idvillea = $_GET["villea"];
        //}


        if ($mabase) {
            $res_villeD = mysqli_query($cnt, "SELECT port.ville FROM liaison,port WHERE liaison.idVilleDepart='$idVilleDepart' AND liaison.idvilleDepart=port.idVille GROUP BY port.ville;");
            //$res_villeD = mysqli_query($cnt, "SELECT port.ville FROM liaison,port WHERE liaison.idVilleDepart='$idvilled' AND liaison.idvilleDepart=port.idVille GROUP BY port.ville;");
            $res_villeA = mysqli_query($cnt, "SELECT port.ville FROM liaison,port WHERE liaison.idVilleArrivee='$idVilleArrivee' AND liaison.idvilleArrivee=port.idVille GROUP BY port.ville;");
            //$res_villeA = mysqli_query($cnt, "SELECT port.ville FROM liaison,port WHERE liaison.idVilleArrivee='$idvillea' AND liaison.idvilleArrivee=port.idVille GROUP BY port.ville;");
        }
    ?>

    <section id="sec-1">
        <form class="cadre" method="POST" action="">
            <div class="cadre-ct">
                <div class="cadre-menu">
                    <ol class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                        <li class="flex items-center text-blue-600 dark:text-blue-500">
                            <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                1
                            </span>
                            Destination<!--<span class="hidden sm:inline-flex sm:ms-2">Info</span>-->
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                            </svg>
                        </li>
                        <li class="flex items-center text-blue-600 dark:text-blue-500">
                            <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                2
                            </span>
                            Billets<!--<span class="hidden sm:inline-flex sm:ms-2">Info</span>-->
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                            </svg>
                        </li>
                        <li class="flex items-center text-blue-600 dark:text-blue-500">
                            <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                3
                            </span>
                            Horaire<!--<span class="hidden sm:inline-flex sm:ms-2">Info</span>-->
                            <div class="arrow">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </li>
                        <li class="flex items-center">
                            <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                4
                            </span>
                            Informations<!--<span class="hidden sm:inline-flex sm:ms-2">Info</span>-->
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                            </svg>
                        </li>
                        <li class="flex items-center">
                            <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                5
                            </span>
                            Validation
                        </li>
                    </ol>
                </div>
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
  <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
  </svg>
  <span class="sr-only">Info</span>
  <div>
    <span class="font-medium">Danger alert!</span> Change a few things up and try submitting again.
  </div>
</div>
                <div class="cadre-ville">
                    <p>Selectionner la ville de départ</p>
                    <div class="cadre-list">
                        <?php
                            //rechercheH($idVilleDepart,$idVilleArrivee,$dateDepart);
                            $res_horaire = mysqli_query($cnt, "SELECT * FROM liaison,trajet WHERE liaison.idvilleDepart='$idVilleDepart' AND liaison.idvilleArrivee='$idVilleArrivee' AND liaison.idLiai=trajet.idLiaison AND trajet.dateDepart='$dateDepart';");

                            if (mysqli_num_rows($res_horaire) > 0) {
                                while ($tab = mysqli_fetch_row($res_horaire)) {
                                    $idLiaison = $tab[0];
                                    $duree = $tab[3];
                                    $idtrajet = $tab[4];
                                    $dateDepart = $tab[7];
                                    $heureDepart = $tab[8];
                                    $dateArrive = $tab[9];
                                    $heureArrive = $tab[10];
                                }
                                echo("<p>$dateDepart - $heureDepart | $dateArrive - $heureArrive</p>");
                            } else{
                                echo("<p class=\"error-message\">Aucun trajet trouvé</p>");
                            }
                            
                        ?>
                    </div>
                </div>
            </div>
            <div class="cadre-recap">
                <div class="cadre-recap-ct">
                    <h2>Votre réservation</h2>
                    <hr>
                    <div class="cadre-recap-ct-gp">
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Ville de départ</p>
                            <p><?php while ($tab = mysqli_fetch_row($res_villeD)) {
                                    $villeDepart = $tab[0];
                                }
                                echo("$villeDepart");?></p>
                        </div>
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Ville d'arrivée</p>
                            <p><?php while ($tab = mysqli_fetch_row($res_villeA)) {
                                    $villeArrivee = $tab[0];
                                }
                                echo("$villeArrivee"); ?></p>
                        </div>
                    </div>
                    
                    <div class="cadre-recap-ct-gp">
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Date départ</p>
                            <p><?php echo("$dateDepart"); ?></p>
                        </div>
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Date arrivé</p>
                            <p>[A l'étape 3]</p>
                        </div>
                    </div>
                    <hr>
                    
                    <h3>Détail prix</h3>
                    <div class="cadre-recap-ct-gp">
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Billet piéton</p>
                            <p>0</p>
                        </div>
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Prix piéton</p>
                            <p>0€</p>
                        </div>
                    </div>
                    <div class="cadre-recap-ct-gp">
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Nombre véhicule</p>
                            <p>0</p>
                        </div>
                        <div class="cadre-recap-ct-gp-txt">
                            <p>Prix véhicule</p>
                            <p>0€</p>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="cadre-recap-ct-gp">
                        <div class="cadre-recap-ct-gp-txt">
                            <p class="cadre-recap-ct-gp-txt-total">TOTAL</p>
                            <p class="cadre-recap-ct-gp-txt-total">0€</p>
                        </div>
                    </div>
                    <div class="cadre-recap-ct-bt">
                        <button class="cadre-recap-ct-bt-ann"><a href="booking-step2.php">Précedement</a></button>
                        <button class="cadre-recap-ct-bt-sui" type="submit">Suivant</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>