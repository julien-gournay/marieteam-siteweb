<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "head.php"; ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Admin - Marie Team</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="css/admin-login.css"> <!-- CSS spécifique -->
</head>
<body>
    <?php 
        session_start();
        include "navbar.php";
    ?>

    <!-- ### SECTION CONNEXION DASHBAORD ADMIN ### -->
    <section id="sec-1">
        <div class="cadre">
            <img class="cadre-img" src="img/illustration/bateau2.jpg" alt=""> <!-- Image background -->
            <div class="cadre2">
                <div class="cadre2-content">
                    <div class="cadre2-content-txt">
                        <h2 class="cadre2-titre">Dashboard Admin</h2>
                    <p class="cadre2-p">Content de vous revoir.</p>
                    </div>
                    <form class="cadre2-form" action="php/login-admin.php" method="post"> <!-- Formulaire de connexion -->
                        <div class="relative">
                            <input name="username" type="text" id="floating_outlined" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " /> <!-- Input pour le nom d'utilisateur -->
                            <label for="floating_outlined" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Nom d'utilisateur</label>
                        </div>
                        <div class="relative">
                            <input name="password" type="password" id="floating_outlined" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " /> <!-- Input pour le mdp -->
                            <label for="floating_outlined" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Mot de passe</label>
                        </div>
                        <button class="cadre2-form-button" type="submit">Se connecter</button> <!-- Bouton de connexion -->
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> <!-- Modules Flowbite (pour composant) -->
</body>
</html>