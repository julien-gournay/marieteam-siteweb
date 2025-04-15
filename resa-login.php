<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "component/head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Gérer ma réservation - Marie Team</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="css/mareservation.css"> <!-- CSS spécifique -->
</head>
<body>
    <?php
        // navbar.php : Composant de la barre de navigation
        include "component/navbar.php";

        // bdd.php : Connexion à la base de données
        include "php/bdd.php";
    ?>

    <section id="sec-1">
        <div class="cadre">
            <img class="cadre-img" src="img/illustration/bateau3.jpg" alt="">
            <div class="cadre2">
                <div class="cadre2-content">
                    <h2 class="cadre2-titre">Accéder à votre espace personnel “ Ma réservation”</h2>
                    <p class="cadre2-p">Pour accéder à votre réservation, renseignez votre nom de famille et votre référence de réservation</p>
                    <form class="cadre2-form" action="php/login-resa.php" method="POST">
                        <div class="relative">
                            <input type="text" name="reference" id="floating_outlined" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label for="floating_outlined" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">N° de réservation</label>
                        </div>
                        <div class="relative">
                            <input type="text" name="nom" id="floating_outlined" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label for="floating_outlined" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Votre nom</label>
                        </div>
                        <!-- Bouton d'envoi -->
                        <button class="cadre2-form-button" type="submit">Rechercher</button> <!-- onclick="window.location='resa-detail.php';" -->
                    </form>
                    <?php
                        include "php/login-resa.php";
                    ?>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>