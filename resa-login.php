<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "component/head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Gérer ma réservation - Marie Team</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="css/mareservation.css"> <!-- CSS spécifique -->
    <style>
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 1000;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 300px;
        }

        .alert.show {
            opacity: 1;
            transform: translateX(0);
        }

        .alert.error {
            background-color: #ff6b6b;
            border-left: 4px solid #ff4757;
        }

        .alert.warning {
            background-color: #ffa502;
            border-left: 4px solid #ff7f50;
        }

        .alert.info {
            background-color: #2ed573;
            border-left: 4px solid #7bed9f;
        }

        .alert i {
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <?php
        // navbar.php : Composant de la barre de navigation
        include "component/navbar.php";

        // bdd.php : Connexion à la base de données
        include "php/bdd.php";
    ?>

    <!-- Div pour les alertes -->
    <div id="alertContainer"></div>

    <section id="sec-1">
        <div class="cadre">
            <img class="cadre-img" src="img/illustration/bateau3.jpg" alt="">
            <div class="cadre2">
                <div class="cadre2-content">
                    <h2 class="cadre2-titre">Accéder à votre espace personnel " Ma réservation"</h2>
                    <p class="cadre2-p">Pour accéder à votre réservation, renseignez votre nom de famille et votre référence de réservation</p>
                    <form class="cadre2-form" action="php/login-resa.php" method="POST" onsubmit="return validateForm()">
                        <div class="relative">
                            <input type="text" name="reference" id="reference" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="reference" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">N° de réservation</label>
                        </div>
                        <div class="relative">
                            <input type="text" name="nom" id="nom" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="nom" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Votre nom</label>
                        </div>
                        <!-- Bouton d'envoi -->
                        <button class="cadre2-form-button" type="submit">Rechercher</button>
                    </form>
                    <?php
                        include "php/login-resa.php";
                    ?>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        function validateForm() {
            const reference = document.getElementById('reference').value.trim();
            const nom = document.getElementById('nom').value.trim();
            
            if (reference === '' || nom === '') {
                showAlert('❌ Veuillez remplir tous les champs avant de valider', 'error');
                return false;
            }
            return true;
        }

        function showAlert(message, type = 'error') {
            const alertContainer = document.getElementById('alertContainer');
            const alert = document.createElement('div');
            alert.className = `alert ${type}`;
            
            // Ajouter l'icône en fonction du message
            let icon = '';
            if (message.includes('⚠️')) {
                icon = '<i class="fas fa-exclamation-triangle"></i>';
                message = message.replace('⚠️', '');
                type = 'warning';
            } else if (message.includes('❌')) {
                icon = '<i class="fas fa-times-circle"></i>';
                message = message.replace('❌', '');
                type = 'error';
            } else if (message.includes('🔍')) {
                icon = '<i class="fas fa-search"></i>';
                message = message.replace('🔍', '');
                type = 'info';
            } else if (message.includes('✅')) {
                icon = '<i class="fas fa-check-circle"></i>';
                message = message.replace('✅', '');
                type = 'info';
            } else if (message.includes('📝')) {
                icon = '<i class="fas fa-edit"></i>';
                message = message.replace('📝', '');
                type = 'warning';
            }
            
            alert.innerHTML = `${icon}<span>${message}</span>`;
            alertContainer.appendChild(alert);

            // Afficher l'alerte
            setTimeout(() => {
                alert.classList.add('show');
            }, 100);

            // Supprimer l'alerte après 5 secondes
            setTimeout(() => {
                alert.classList.remove('show');
                setTimeout(() => {
                    alertContainer.removeChild(alert);
                }, 300);
            }, 5000);
        }

        // Vérifier s'il y a un message d'erreur dans l'URL
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get('error');
            if (error) {
                showAlert(decodeURIComponent(error));
                // Nettoyer l'URL sans recharger la page
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        }
    </script>
</body>
</html>