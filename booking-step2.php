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
            $res_tarif = mysqli_query($cnt, "SELECT tarif.idType,type.libelleType,tarif.tarif FROM tarif,type WHERE tarif.idLiaison='$idVilleDepart-$idVilleArrivee' AND tarif.idType=type.idType;");
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
                            <div class="arrow">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </li>
                        <li class="flex items-center">
                            <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                3
                            </span>
                            Horaire<!--<span class="hidden sm:inline-flex sm:ms-2">Info</span>-->
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                            </svg>
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

                <div class="cadre-ville">
                    <p>Selectionner la ville de départ</p>
                    <div class="cadre-list">
                        <?php 
                            if (mysqli_num_rows($res_tarif) > 0) {
                                while ($tab = mysqli_fetch_row($res_tarif)) {
                                    $idtype = $tab[0];
                                    $libelleType = $tab[1];
                                    $tarif = $tab[2];

                                    echo("<div class=\"cadre-list-boxt\">
                                        <div class=\"cadre-list-boxt-txt\">
                                            <p class=\"cadre-list-boxt-txt-ty\">$libelleType</p>
                                            <p class=\"cadre-list-boxt-txt-ta\">$tarif</p>
                                        </div>
                                        <div class=\"cadre-list-boxt-qua\">
                                            <button class=\"moins\">-</button>
                                            <span class=\"quantite-value\">1</span>
                                            <button class=\"plus\">+</button>
                                            <input type=\"hidden\" name=\"quantite_voiture\" id=\"quantite_voiture\">
                                        </div>
                                    </div>");
                            }
                            } else{
                                echo("<p class=\"error-message\">Il n'y a pas de billets disponibles pour se trajet</p>");
                            }
                        ?>
                        <script>
                           const moinsBtn = document.querySelector('.moins');
                            const plusBtn = document.querySelector('.plus');
                            const quantiteValue = document.querySelector('.quantite-value');

                            let quantite = 1; // Initialisation de la variable en dehors de la fonction

                            moinsBtn.addEventListener('click', () => {
                            if (quantite > 1) {
                                quantite--;
                                quantiteValue.textContent = quantite;
                            }
                            });

                            plusBtn.addEventListener('click', () => {
                            quantite++;
                            quantiteValue.textContent = quantite;
                            });
                        </script>
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
                    
                    <div class="cadre-recap-ct-bt">
                        <button class="cadre-recap-ct-bt-ann"><a href="booking-step1.php">Précedement</a></button>
                        <button class="cadre-recap-ct-bt-sui" type="submit">Suivant</button>
                    </div>
                </div>
            </div>
        </form>
        <!--<div id="confirmationDiv">
            <div class="confirmationDiv-ct">
                <div class="confirmationDiv-titre">
                    <svg width="2rem" fill="#ffffff" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>warning</title> <path d="M30.555 25.219l-12.519-21.436c-1.044-1.044-2.738-1.044-3.782 0l-12.52 21.436c-1.044 1.043-1.044 2.736 0 3.781h28.82c1.046-1.045 1.046-2.738 0.001-3.781zM14.992 11.478c0-0.829 0.672-1.5 1.5-1.5s1.5 0.671 1.5 1.5v7c0 0.828-0.672 1.5-1.5 1.5s-1.5-0.672-1.5-1.5v-7zM16.501 24.986c-0.828 0-1.5-0.67-1.5-1.5 0-0.828 0.672-1.5 1.5-1.5s1.5 0.672 1.5 1.5c0 0.83-0.672 1.5-1.5 1.5z"></path></g></svg>
                    <h2>ANNULATION DE VOTRE RESERVATION</h2>
                </div>
                <div class="confirmationDiv-texte">
                    <p><b>Êtes-vous sûr de vouloir supprimer cette réservation ?</b></p>
                    <p>En confirmant la suppression de cette réservation, vous accepter annuler votre commande et ne pourrait revenir en arrière.</p>
                </div>
                <div class="confirmationDiv-bt">
                    <button class="confirmationDiv-bt-Fer" onclick="fermerReservation()">Fermer</button>
                </div>
            </div>
        </div>
        <script>
            function confirmerSuppression() {
                document.getElementById("confirmationDiv").style.display = "block";
                return false; // Empêche le rechargement de la page
            }

            function fermerConfirmation() {
                document.getElementById("confirmationDiv").style.display = "none";
            }
        </script>-->
    </section>

    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>