<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include "component/head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Marie Team</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="css/index.css"> <!-- CSS spécifique -->
</head>

<body>
    <?php 
        include "component/navbar.php"; // Inclure la barre de navigation
        include "php/bdd.php"; // Fichier de connexion DB
    ?>

    <!-- ##### SECTION BANNIER  ##### -->
    <section id="sec-1">
        <div class="sec1-content">
            <div class="banner">
                <img src="img/illustration/bateau3.jpg" alt="">
                <div class="banner-info">
                    <h1 class="banner-info-titre">Réserver dès maintenant<br>votre traversée!</h1>
                    <?php
                    while ($tab = mysqli_fetch_row($res4)) { // Boucle pour afficher le nombre de destination (requête : res4 [bdd.php])
                        $countDest = $tab[0]; // Variable nb destinations
                        echo ("<p class=\"banner-info-p\">Dans plus de $countDest destinations</p>"); // Affichage nb destinations
                    }
                    ?>
                    <div class="banner-info-button">
                        <button class="banner-info-button-reserve" onclick="window.location='booking-step1.php';">Je réserve</button>
                        <button class="banner-info-button-destination" onclick="window.location='destinations.php';">Voir les destinations</button>
                    </div>
                </div>
            </div>
            <!-- +++ BARRE DE RESERVATION +++ -->
            <div class="searchbar">
                <form class="searchbar-form" method="POST" action="php/step1.php">
                    <div class="searchbar-composent">
                        <label for="">Port de départ</label>
                        <select id="villeDepart" name="villeD" onchange="updateVilleArrivee()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Selectionner un port</option>
                            <?php
                                while ($tab = mysqli_fetch_row($res1)) { // Boucle pour afficher les ports dispo (requête : res1 [bdd.php])
                                    $id = $tab[0]; // Variable id port
                                    $ville = $tab[1]; // Variable nom ville
                        
                                    echo("<option value=\"$id\">$ville</option>");
                                }
                            ?>
                        </select>
                    </div>
                    <div class="searchbar-composent">
                        <label for="">Port d'arrivée</label>
                        <select id="VilleArrivee" name="villeA" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Selectionner un port</option>
                            <?php
                                while ($tab = mysqli_fetch_row($res2)) { // Boucle pour afficher les ports dispo (requête : res2 [bdd.php])
                                    $id = $tab[0]; // Variable id port
                                    $ville = $tab[1]; // Variable nom ville
                        
                                    echo("<option value=\"$id\">$ville</option>");
                                }  
                            ?>
                        </select>
                    </div>
                    <div class="searchbar-composent">
                        <label for="">Date de traversé</label>
                        <div class="relative max-w-sm"> <!-- [ ! COMPOSANT FLOWBITE : CHOIX DATE]  +++ -->
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input name="dateDepart" id="datepicker-actions" datepicker datepicker-min-date="2024-12-01" datepicker-buttons datepicker-autoselect-today datepicker-format="yyyy-mm-dd" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selectionner une date" required> <!-- Input pour indiquer la date -->
                            <script>
                                // Permet de mettre la date minimum du input à aujourd'hui
                                const today = new Date(); // Variable date du jour
                                const minDate = today.toISOString().split('T')[0]; // Extraire uniquement la partie date
                                document.getElementById('datepicker-format').setAttribute('datepicker-min-date', minDate); // Met la date du jour sur l'attribut datapicker-min-date
                            </script>
                        </div>
                    </div>
                    <div class="searchbar-composent">
                        <button class="searchbar-composent-button" type="submit">Chercher</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- ##### SECTION DESTINATIONS PHARE  ##### -->
    <section id="sec-2">
        <div class="sec2-content">
            <div class="sec2-titre">
                <h1 class="sec2-titre-h1">Des dizaines de départs et destinations</h1>
                <button class="sec2-titre-bt" onclick="window.location='destinations.php';">Toutes nos destinations</a></button>
            </div>
            <div class="sec2-list">
                <?php
                while ($tab = mysqli_fetch_row($res3)) { // Boucle pour afficher les ports dispo (requête : res3 [bdd.php])
                    $id = $tab[0]; // Varaible id port
                    $ville = $tab[1]; // Variable nom ville
                    $photo = $tab[3];   // Variable photo ville

                    $res_count = mysqli_query($cnt, "SELECT COUNT(liaison.idvilleDepart) FROM liaison WHERE liaison.idvilleArrivee='$id';"); // Requête : Nombre ville de départ
                    while ($tab = mysqli_fetch_row($res_count)) { // Boucle nb ville depart pour la destination
                        $countDepart = $tab[0]; // Variable nb depart

                        $res_prixmin = mysqli_query($cnt, "SELECT MIN(tarif.tarif),liaison.idvilleArrivee,port.ville FROM tarif,liaison,port WHERE tarif.idLiaison=liaison.idLiai AND liaison.idvilleArrivee='$id' AND tarif.idType<>'B1'"); // Requête : Prix minimum pour la destination
                        while ($tab = mysqli_fetch_row($res_prixmin)) { // Boucle
                            $prixMin = $tab[0]; // Variable prix minimum

                            if ($id != NULL) { // Si l'id port n'est pas vide, alors ...
                                echo ("<a href=\"destinations-detail.php?id=$id\"><div class=\"sec2-list-cadre\">
                                    <div class=\"sec2-list-cadre-img\">
                                        <img src=\"$photo\" alt=\"\">
                                    </div>
                                    <div class=\"sec2-list-cadre-text\">
                                        <div class=\"sec2-list-cadre-text-titre\">
                                            <h3>$ville</h3>
                                            <p>A partir de $prixMin €</p>
                                        </div>
                                        <div class=\"sec2-list-cadre-text-depart\">
                                            <p>$countDepart départ</p>
                                        </div>
                                    </div>
                                </div></a>");
                            } else {
                                echo ("<p class=\"messageErreur\"><b>Oups, il semblerais qu'une erreur est survenue !</b><br>Nous nous exusons pour la gène occasionée, Veuillez actualiser la page ou retenter plustard.</p>"); // Message d'erreur, pas de destination
                                break;
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- ##### SECTION TYPE VOYAGE  ##### -->
    <section id="sec-3">
        <div class="sec3-content">
            <div class="sec3-titre">
                <h2>Nos differentes catégories de voyage</h2>
            </div>
            <div class="sec3-list">
                <div class="sec3-list-shema">
                    <div class="sec3-list-shema-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="66" height="65" viewBox="0 0 66 65" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.9298 14.2822H18.083C18.083 14.3616 18.0936 14.4409 18.1147 14.5203L19.379 19.3286C19.7387 20.7039 20.3523 21.9999 21.2727 22.915C22.1138 23.7561 23.1929 24.2798 24.5417 24.2798H29.5987V26.9828C29.5987 27.4113 29.9478 27.7604 30.371 27.7604H36.2426C36.671 27.7604 37.0149 27.4113 37.0149 26.9881V24.2798H42.3152C43.6799 24.2798 44.796 23.7455 45.6583 22.8833C46.5787 21.9629 47.187 20.6669 47.4832 19.281L48.4936 14.5308C48.5147 14.4515 48.5253 14.3669 48.5253 14.2822H49.0701C51.8419 14.2822 54.1112 16.5515 54.1112 19.3233V55.8329C54.1112 58.5889 51.8684 60.8476 49.123 60.874V62.8682C49.123 64.0426 48.1656 65 46.9913 65C45.817 65 44.8595 64.0426 44.8595 62.8682V60.874H21.1404V62.8682C21.1404 64.0426 20.183 65 19.0087 65C17.8344 65 16.8769 64.0426 16.8769 62.8682V60.874C14.1263 60.8476 11.8887 58.5889 11.8887 55.8329V19.3233C11.8887 16.5515 14.158 14.2822 16.9298 14.2822ZM20.6538 53.114C20.1407 53.114 19.7228 52.6961 19.7228 52.183C19.7228 51.6699 20.1407 51.252 20.6538 51.252H45.4837C45.9968 51.252 46.4147 51.6699 46.4147 52.183C46.4147 52.6961 45.9968 53.114 45.4837 53.114H20.6538ZM20.6538 44.1003C20.1407 44.1003 19.7228 43.6825 19.7228 43.1694C19.7228 42.6563 20.1407 42.2384 20.6538 42.2384H45.4837C45.9968 42.2384 46.4147 42.6563 46.4147 43.1694C46.4147 43.6825 45.9968 44.1003 45.4837 44.1003H20.6538ZM20.6538 35.0867C20.1407 35.0867 19.7228 34.6688 19.7228 34.1557C19.7228 33.6426 20.1407 33.2247 20.6538 33.2247H45.4837C45.9968 33.2247 46.4147 33.6426 46.4147 34.1557C46.4147 34.6688 45.9968 35.0867 45.4837 35.0867H20.6538ZM46.4411 15.2185H20.22L21.1775 18.8525C21.4631 19.9316 21.918 20.9261 22.5898 21.5926C23.0923 22.0951 23.7377 22.4125 24.5364 22.4125H42.3152C43.1404 22.4125 43.8174 22.0846 44.3411 21.5609C44.9971 20.9049 45.4414 19.9422 45.6636 18.8949L46.4411 15.2185ZM20.2835 0H45.9069C46.2031 0 46.4464 0.243327 46.4464 0.539551V4.0096C46.4464 4.30583 46.2031 4.54915 45.9069 4.54915H42.056V13.2666H39.792V4.54386H26.6417V13.2613H24.3777V4.54386H20.2835C19.9873 4.54386 19.744 4.30054 19.744 4.00431V0.539551C19.744 0.243327 19.9873 0 20.2835 0Z" fill="#3A2AFA" />
                        </svg>
                    </div>
                    <div class="sec3-list-shema-text">
                        <p>Voyages</p>
                    </div>
                </div>

                <div class="sec3-list-shema">
                    <hr class="sec3-list-shema-separ">
                </div>

                <div class="sec3-list-shema">
                    <div class="sec3-list-shema-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="66" height="66" viewBox="0 0 66 66" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.92233 33.7464C12.8519 36.4423 20.1647 38.0237 27.589 38.4318V43.8485H38.4223V38.4318C45.8287 37.968 53.1278 36.426 60.089 33.8547V54.6818H5.92233V33.7464ZM41.1307 8.64014L43.839 11.3485V16.7651H60.089V30.8756C51.7848 33.9761 43.0067 35.6162 34.1432 35.7235H32.1932C23.2107 35.6264 14.3164 33.9392 5.92233 30.7401V16.7651H22.1723V11.3485L24.8807 8.64014H41.1307ZM38.4223 14.0568H27.589V16.7651H38.4223V14.0568Z" fill="#3A2AFA" />
                        </svg>
                    </div>
                    <div class="sec3-list-shema-text">
                        <p>Travail</p>
                    </div>
                </div>

                <div class="sec3-list-shema">
                    <hr class="sec3-list-shema-separ">
                </div>

                <div class="sec3-list-shema">
                    <div class="sec3-list-shema-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="66" height="66" viewBox="0 0 66 66" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M33.0114 5.69678C22.7976 5.69678 17.6907 5.69678 14.5177 8.86978C11.6385 11.749 11.3719 16.2205 11.3472 24.6551H8.63636C7.1406 24.6551 5.92802 25.8677 5.92802 27.3634V30.0718C5.92802 30.9244 6.32937 31.7268 7.01136 32.2384L11.3447 35.4884C11.3694 43.923 11.6385 48.3945 14.5177 51.2737C15.1736 51.9296 15.9122 52.4499 16.7614 52.8627V57.1548C16.7614 58.6507 17.9739 59.8632 19.4697 59.8632H23.5322C25.0279 59.8632 26.2405 58.6507 26.2405 57.1548V54.3967C28.2098 54.4468 30.4498 54.4468 33.0114 54.4468C35.5729 54.4468 37.813 54.4468 39.7822 54.3967V57.1548C39.7822 58.6507 40.9947 59.8632 42.4905 59.8632H46.553C48.0488 59.8632 49.2614 58.6507 49.2614 57.1548V52.8627C50.1107 52.4499 50.849 51.9296 51.5049 51.2737C54.3842 48.3945 54.6534 43.923 54.678 35.4884L59.0114 32.2384C59.6933 31.7268 60.0947 30.9244 60.0947 30.0718V27.3634C60.0947 25.8677 58.8822 24.6551 57.3864 24.6551H54.6756C54.6509 16.2205 54.3842 11.749 51.5049 8.86978C48.3321 5.69678 43.225 5.69678 33.0114 5.69678ZM15.4072 26.0093C15.4072 29.8394 15.4072 31.7545 16.5971 32.9445C17.7869 34.1343 19.702 34.1343 23.5322 34.1343H33.0114H42.4905C46.3206 34.1343 48.2357 34.1343 49.4257 32.9445C50.6155 31.7545 50.6155 29.8394 50.6155 26.0093V19.2384C50.6155 15.4083 50.6155 13.4932 49.4257 12.3033C48.2357 11.1134 46.3206 11.1134 42.4905 11.1134H33.0114H23.5322C19.702 11.1134 17.7869 11.1134 16.5971 12.3033C15.4072 13.4932 15.4072 15.4083 15.4072 19.2384V26.0093ZM17.4384 43.6134C17.4384 42.4916 18.3479 41.5822 19.4697 41.5822H23.5322C24.654 41.5822 25.5634 42.4916 25.5634 43.6134C25.5634 44.7352 24.654 45.6447 23.5322 45.6447H19.4697C18.3479 45.6447 17.4384 44.7352 17.4384 43.6134ZM48.5843 43.6134C48.5843 42.4916 47.6748 41.5822 46.553 41.5822H42.4905C41.3687 41.5822 40.4593 42.4916 40.4593 43.6134C40.4593 44.7352 41.3687 45.6447 42.4905 45.6447H46.553C47.6748 45.6447 48.5843 44.7352 48.5843 43.6134Z" fill="#3A2AFA" />
                        </svg>
                    </div>
                    <div class="sec3-list-shema-text">
                        <p>Scolaire</p>
                    </div>
                </div>

                <div class="sec3-list-shema">
                    <hr class="sec3-list-shema-separ">
                </div>

                <div class="sec3-list-shema">
                    <div class="sec3-list-shema-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="66" height="66" viewBox="0 0 66 66" fill="none">
                            <g clip-path="url(#clip0_156_190)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M45.2216 8.18506H0.534058V52.8726H8.65906C8.65906 57.36 12.2967 60.9976 16.7841 60.9976C21.2714 60.9976 24.9091 57.36 24.9091 52.8726H41.1591C41.1591 57.36 44.7966 60.9976 49.2841 60.9976C53.7715 60.9976 57.4091 57.36 57.4091 52.8726H65.5341V32.5601C65.5341 25.8291 60.0777 20.3726 53.3466 20.3726H45.2216V8.18506ZM45.2216 28.4976V36.6226H57.4091V28.4976H45.2216Z" fill="#3A2AFA" />
                            </g>
                            <defs>
                                <clipPath id="clip0_156_190">
                                    <rect width="65" height="65" fill="white" transform="translate(0.534058 0.0600586)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="sec3-list-shema-text">
                        <p>Marchandise</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "component/footer.php" ?> <!-- Inclure le footer -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> <!-- Modules Flowbite (pour composant) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateVilleArrivee() {
            var villeDepart = $('#villeDepart').val();

            // Vérification que villeDepart n'est pas vide
            if (!villeDepart || villeDepart === "Selectionner un port") {
                $('#VilleArrivee').html('<option selected>Selectionner un port</option>');
                return;
            }

            $.ajax({
                url: 'php/get_villes_arrivee.php',
                type: 'POST',
                data: {
                    villeDepart: villeDepart
                },
                success: function(response) {
                    $('#VilleArrivee').html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Erreur AJAX:", status, error);
                    console.log("Réponse serveur:", xhr.responseText);
                    alert('Erreur lors de la mise à jour des villes d\'arrivée: ' + error);
                }
            });
        }

        // Ajout d'un événement au chargement de la page
        $(document).ready(function() {
            // Initialisation au chargement si une ville est déjà sélectionnée
            if ($('#villeDepart').val() !== "Selectionner un port") {
                updateVilleArrivee();
            }
        });
    </script>
</body>

</html>