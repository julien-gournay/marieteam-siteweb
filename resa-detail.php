<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include "component/head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Ma réservation - Marie Team</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="css/resa-detail.css"> <!-- CSS spécifique -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body >

    <nav class="no-print">
        <!-- Navbar -->
        <?php include "component/navbar.php"; ?>
    </nav>

    <?php
    include "php/bdd.php"; // Fichier de connexion DB

    if (isset($_GET["reference"])) { // Verification si la reférence dans l'URL n'est pas vide
        $reference = $_GET["reference"]; // Variable référence réservation
    }

    if ($mabase) {
        $res_resa = mysqli_query($cnt, "SELECT reservation.reference,reservation.idTrajet,client.nom,client.prenom,client.telephone,client.email,trajet.dateDepart,trajet.heureDepart,trajet.dateArrivee,trajet.heureArrivee,liaison.duree,port.ville,port.pays,port.photo FROM reservation,client,trajet,liaison,port WHERE reservation.reference='$reference' AND reservation.etat='Validé' AND reservation.idClient=client.idClient AND reservation.idTrajet=trajet.idTrajet AND trajet.idLiaison=liaison.idLiai AND liaison.idvilleArrivee=port.idVille;"); // Requête : Récupere toute les informations d'une réservation
        $res_resa2 = mysqli_query($cnt, "SELECT port.ville,port.pays,port.photo FROM reservation,client,trajet,liaison,port WHERE reservation.reference='$reference' AND reservation.etat='Validé' AND reservation.idClient=client.idClient AND reservation.idTrajet=trajet.idTrajet AND trajet.idLiaison=liaison.idLiai AND liaison.idvilleDepart=port.idVille;"); // Requête : Récupere toute les informations d'une réservation
    }

    while ($tab = mysqli_fetch_row($res_resa)) { // Récupération des infos
        $reference = $tab[0]; // Variable référence réservation
        $idTraversé = $tab[1]; // Variable id Trajet
        $nom = $tab[2]; // Variable nom client
        $prenom = $tab[3]; // Variable prenom client
        $tel = $tab[4]; // Variable tel client
        $mail = $tab[5]; // Variable mail client
        $dateDepart = $tab[6]; // Variable date départ
        $heureDepart = $tab[7]; // Variable heure départ
        $dateRetour = $tab[8]; // Variable date arrivée
        $heureRetour = $tab[9]; // Variable heure arrivée
        $duree = $tab[10]; // Variable durée trajet
        $villeRetour = $tab[11]; // Variable ville arrivée
        $paysRetour = $tab[12]; // Variable pays arrivée
        $photo = $tab[13]; // Variable photo destination
        break;
    }
    while ($tab = mysqli_fetch_row($res_resa2)) { // Récupération des infos
        $villeDepart = $tab[0]; // Variable référence réservation
        $paysDepart = $tab[1]; // Variable id Trajet
        $photoDepart = $tab[2]; // Variable nom client
        break;
    }

    $heureDepart = date("H\hi", strtotime($heureDepart));  // H:i correspond à l'heure et minutes uniquement
    $heureRetour = date("H\hi", strtotime($heureRetour));  // H:i correspond à l'heure et minutes uniquement
    $duree = date("H\hi", strtotime($duree));  // H:i correspond à l'heure et minutes uniquement

    ?>
    <div class="container-fluid mx-auto px-8 py-8 mt-20 print-container">
        <div class="h-16"></div>
        <!-- Carte principale unique -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden print-content">
            <!-- En-tête avec image de fond -->
            <div class="relative h-48 print:h-32">
                <img src="<?php echo ("$photo"); ?>" class="w-full h-full object-cover" alt="Destination">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/60 print:to-black/40">
                    <div class="absolute bottom-0 w-full p-6">
                        <div class="flex justify-between items-center">
                            <h1 class="text-2xl font-bold text-white print:text-black">Réservation #<?php echo ("$reference"); ?></h1>
                            <!-- Bouton caché à l'impression -->
                            <button data-modal-target="confirmationModal" data-modal-toggle="confirmationModal"
                                class="no-print text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5 print:hidden">
                                Annuler ma réservation
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="p-6">
                <!-- Section voyage -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-6">Détail du voyage</h2>
                    <div class="flex items-center justify-between space-x-4 bg-gray-50 p-6 rounded-lg print:bg-white print:border print:border-gray-200">
                        <!-- Départ -->
                        <div class="flex-1">
                            <div class="text-gray-600">Départ</div>
                            <div class="text-xl font-bold"><?php echo ("$heureDepart"); ?></div>
                            <div class="text-sm"><?php echo ("$dateDepart"); ?></div>
                            <div class="text-gray-700"><?php echo ("$villeDepart, $paysDepart"); ?></div>
                        </div>

                        <!-- Durée -->
                        <div class="flex flex-col items-center px-4">
                            <div class="text-sm text-gray-500"><?php echo ("$duree"); ?></div>
                            <div class="w-32 h-0.5 bg-gray-300 my-2"></div>
                            <div class="text-sm text-gray-500">Direct</div>
                        </div>

                        <!-- Arrivée -->
                        <div class="flex-1 text-right">
                            <div class="text-gray-600">Arrivée</div>
                            <div class="text-xl font-bold"><?php echo ("$heureRetour"); ?></div>
                            <div class="text-sm"><?php echo ("$dateRetour"); ?></div>
                            <div class="text-gray-700"><?php echo ("$villeRetour, $paysRetour"); ?></div>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-600">
                        Traversée numéro <?php echo ("$idTraversé"); ?>
                    </div>
                </div>

                <hr class="my-6 border-gray-200">

                <!-- Section information -->
                <div class="mb-8">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-6 h-6 text-orange-500 print:text-black" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9 9a1 1 0 112 0v4a1 1 0 11-2 0V9z"></path>
                        </svg>
                        <h2 class="text-lg font-semibold">Information importante</h2>
                    </div>
                    <div class="bg-orange-50 border-l-4 border-orange-500 p-4 rounded print:bg-white print:border print:border-gray-200">
                        <p class="text-gray-700">Lors de votre enregistrement au port, un passeport vous sera demandé pour passer les contrôles à la frontière.</p>
                    </div>
                </div>

                <hr class="my-6 border-gray-200">

                <!-- Section client -->
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Informations client -->
                    <div>
                        <h2 class="text-lg font-semibold mb-4">Informations client</h2>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <p class="text-gray-700"><?php echo ("$nom $prenom"); ?></p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <p class="text-gray-700"><?php echo ("$tel"); ?></p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-700"><?php echo ("$mail"); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="no-print flex flex-col justify-end print:hidden">
                        <button onClick="window.print()" class="inline-flex items-center justify-center px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 ease-in-out shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Imprimer la réservation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation -->
    <div id="confirmationModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full print:hidden">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Confirmer l'annulation
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="confirmationModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Fermer</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                        Êtes-vous sûr de vouloir annuler cette réservation ? Cette action est irréversible.
                    </h3>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-center gap-4">
                        <button onclick="supprimerReservation()" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Oui, annuler la réservation
                        </button>
                        <button data-modal-hide="confirmationModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                            Non, retour
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="no-print">
        <?php include "component/footer.php" ?>
    </footer>

    <!-- Scripts - certains peuvent être cachés à l'impression si nécessaire -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="js/resa-detail.js"></script>
</body>

</html>