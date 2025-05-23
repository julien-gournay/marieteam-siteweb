<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include "component/head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Marie Team</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="css/booking.css"> <!-- CSS spécifique -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#villeDepart').on('change', function() {
                var villeDepart = $(this).val();

                $.ajax({
                    url: 'php/get_villes_arrivee2.php',
                    type: 'POST',
                    data: {
                        villeDepart: villeDepart
                    },
                    success: function(response) {
                        var villes = JSON.parse(response);
                        var villeArriveeSelect = $('#villeArrivee');
                        villeArriveeSelect.empty();
                        villeArriveeSelect.append('<option value="">Sélectionnez une ville d\'arrivée</option>');

                        villes.forEach(function(ville) {
                            villeArriveeSelect.append(
                                $('<option></option>').val(ville.id).text(ville.nom)
                            );
                        });
                    }
                });
            });
        });
    </script>
</head>

<body>
<?php
include "component/navbar.php"; // Inclure la barre de navigation
include "php/bdd.php"; // Fichier de connexion BDD

session_start(); // Ouverture d'une session pour stocker les données
?>

<!-- ##### SECTION ETAPE 1 : DESTINATION  ##### -->
<section id="sec-1">
    <!-- Bouton récapitulatif mobile -->
    <button type="button" class="recap-toggle-button" onclick="toggleRecap()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
        </svg>
        Récapitulatif
    </button>

    <form class="cadre" method="POST" action="php/step1.php"> <!-- Formulaire de l'etape 1 -->
        <!-- +++ CADRES PARTIE DE GAUCHE  +++ -->
        <div class="cadre-ct">
            <!-- +++ CADRE DES DIVERSE ETAPES  +++ -->
            <div class="cadre-menu">
                <ol class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse"> <!-- [ ! COMPOSANT FLOWBITE]  +++ -->
                    <li class="flex items-center text-blue-600 dark:text-blue-500"> <!-- Icon Etape 1 -->
                        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                1
                            </span>
                        <a href="booking-step1.php">Destination</a>
                        <div class="arrow"> <!-- Fleches animé -->
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </li>
                    <li class="flex items-center"> <!-- Icon Etape 2 -->
                        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                2
                            </span>
                        Billets
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                        </svg>
                    </li>
                    <li class="flex items-center"> <!-- Icon Etape 2 -->
                        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                3
                            </span>
                        Horaire
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                        </svg>
                    </li>
                    <li class="flex items-center"> <!-- Icon Etape 4 -->
                        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                4
                            </span>
                        Informations
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4" />
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

            <!-- +++ SELECTION VILLE DEPART  +++ -->
            <div class="cadre-ville">
                <p>Selectionner la ville de départ</p>
                <div class="cadre-list">
                    <?php
                    while ($tab = mysqli_fetch_row($res1)) {
                        $id = $tab[0];
                        $ville = $tab[1];
                        $photo = $tab[3];

                        echo ("<div class=\"cadre-list-ville\">
                                    <input class=\"radio-ville\" type=\"radio\" name=\"villeD\" value=\"$id\" onchange=\"updateVillesArrivee(this.value)\" required>
                                    <img src=\"$photo\" alt=\"\">
                                    <p class=\"cadre-list-ville-v\">$ville</p></div>
                                ");
                    }
                    ?>
                </div>
            </div>

            <!-- +++ SELECTION VILLE D'ARRIVEE  +++ -->
            <div class="cadre-ville">
                <p>Selectionner la ville d'arrivée</p>
                <div class="cadre-list" id="villes-arrivee">
                    <?php
                    // Le contenu sera mis à jour dynamiquement via AJAX
                    ?>
                </div>
            </div>

            <!-- +++ SELECTION DATE DEPART  +++ -->
            <div class="cadre-ville">
                <p>Selectionner la date de départ</p>
                <div class="relative max-w-sm"> <!-- [ ! COMPOSANT FLOWBITE : CHOIX DATE]  +++ -->
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input name="dateDepart" id="datepicker-actions" datepicker datepicker-min-date="date()" datepicker-buttons datepicker-autoselect-today datepicker-format="yyyy-mm-dd" datepicker-orientation="top" autocomplete="off" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selectionner une date" required> <!-- Input pour indiquer la date -->
                    <script>
                        // Permet de mettre la date minimum du input à aujourd'hui
                        const today = new Date(); // Variable date du jour
                        const minDate = today.toISOString().split('T')[0]; // Extraire uniquement la partie date
                        document.getElementById('datepicker-format').setAttribute('datepicker-min-date', minDate); // Met la date du jour sur l'attribut datapicker-min-date
                    </script>
                </div>
            </div>
        </div>

        <!-- +++ CADRES PARTIE DE DROITE  +++ -->
        <div class="cadre-recap">
            <!-- +++ RECAPITULATIF RESERVATION  +++ -->
            <div class="cadre-recap-ct">
                <h2>Votre réservation</h2>
                <hr>
                <div class="cadre-recap-ct-select">
                    <p>Continuer la réservation pour voir apparaitre votre récapitulatif.</p>
                </div>

                <?php
                if (isset($_SESSION['error_message'])) { // Vérifiez si un message d'erreur est défini dans la session
                    echo "<div class='error-message'>" . $_SESSION['error_message'] . "</div>"; // Affiche le message d'erreur
                    unset($_SESSION['error_message']); // Supprimez le message après l'affichage
                }
                ?>
            </div>
        </div>
    </form>

    <!-- Boutons de navigation mobile -->
    <div class="mobile-nav-buttons">
        <button type="button" class="prev-button" onclick="window.location='index.php'">Retour</button>
        <button type="button" class="next-button" onclick="document.querySelector('form').submit()">Suivant</button>
    </div>
</section>

<?php include "component/footer.php" ?> <!-- Inclure le footer -->

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> <!-- Modules Flowbite (pour composant) -->
<script src="js/recap-slider.js"></script>
<script>
    function updateVillesArrivee(villeDepart) {
        $.ajax({
            url: 'php/get_villes_arrivee2.php',
            type: 'POST',
            data: {
                villeDepart: villeDepart
            },
            success: function(response) {
                $('#villes-arrivee').html(response);
            }
        });
    }

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