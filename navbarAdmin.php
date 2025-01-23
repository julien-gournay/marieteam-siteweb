<?php
// Récupérer le nom de la page PHP en cours
$currentPage = basename($_SERVER['PHP_SELF']);

// Fonction pour ajouter la classe active à l'element de la page ouverte
function addActiveClass($page, $current) {
    return ($page == $current) ? 'active' : '';
}
?>

<div class="h-full px-3 py-4 overflow-y-auto navbarAdmin">
    <a href="admin.php" class="flex items-center ps-2.5 mb-5">
        <img src="img/logosvg_bleu.svg" class="h-6 me-3 sm:h-7" alt="MarieTeam Logo" />
    </a>
    <div id="dropdown-cta" class="p-4 mt-6 rounded-lg bg-blue-50 dark:bg-blue-900" role="alert">
        <div class="flex items-center mb-3">
        <span class="bg-blue-500 text-blue-100 text-sm font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">Dev</span>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 inline-flex justify-center items-center w-6 h-6 text-blue-900 rounded-lg focus:ring-2 focus:ring-blue-400 p-1 hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-400 dark:hover:bg-blue-800" data-dismiss-target="#dropdown-cta" aria-label="Close">
            <span class="sr-only">Fermer</span>
            <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
        </div>
        <p class="mb-3 text-sm text-blue-800 dark:text-blue-400">Cette espace administrateur est encore en developpement, seule la visualisation est disponible.</p>
        <!--<a class="text-sm text-blue-800 underline font-medium hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" href="#">Turn new navigation off</a>-->
    </div>
    <ul class="space-y-2 font-medium">
        <li class="<?php addActiveClass('admin.php', $currentPage); ?>">
            <a href="admin" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                    <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                    <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ms-3">Dashboard</span>
            </a>
        </li>
        <li class="<?php addActiveClass('admin-liaison.php', $currentPage); ?>">
            <a href="admin-liaison.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="img/icon/arrow-left-arrow-right-svgrepo-com.svg" alt="Liaison" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                <span class="flex-1 ms-3 whitespace-nowrap">Liaison</span>
            </a>
        </li>
        <li class="<?php addActiveClass('admin-trajet.php', $currentPage); ?>">
        <a href="admin-trajet.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="img/icon/route-svgrepo-com.svg" alt="Trajet" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                <span class="flex-1 ms-3 whitespace-nowrap">Trajet</span>
            </a>
            </li>
        <li class="<?php addActiveClass('admin-reservation.php', $currentPage); ?>">
        <a href="admin-reservation.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
        <img src="img/icon/ticket-svgrepo-com.svg" alt="Reservation" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
            <span class="flex-1 ms-3 whitespace-nowrap">Réservation</span>
        </a>
        </li>
        <li>
            <a href="admin-boat.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="img/icon/boat-svgrepo-com.svg" alt="Bateau" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                <span class="flex-1 ms-3 whitespace-nowrap">Bateau</span>
            </a>
        </li>
        <li>
            <a href="admin-incident.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="img/icon/incident-svgrepo-com.svg" alt="Incident" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                <span class="flex-1 ms-3 whitespace-nowrap">Incident</span>
            </a>
        </li>
        <li>
            <a href="admin-tarif.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="img/icon/price-ui-svgrepo-com.svg" alt="Tarif" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                <span class="flex-1 ms-3 whitespace-nowrap">Tarif</span>
            </a>
        </li>
        <li>
            <a href="admin-client.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="img/icon/user-svgrepo-com.svg" alt="Client" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                <span class="flex-1 ms-3 whitespace-nowrap">Client</span>
            </a>
        </li>
        <li>
            <a href="admin-type.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="img/icon/vehicle-car-svgrepo-com.svg" alt="Type" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                <span class="flex-1 ms-3 whitespace-nowrap">Type</span>
            </a>
        </li>
        <li class="<?php addActiveClass('admin-port.php', $currentPage); ?>">
            <a href="admin-port.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="img/icon/city-svgrepo-com.svg" alt="Ville" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                <span class="flex-1 ms-3 whitespace-nowrap">Ville</span>
            </a>
        </li>
    </ul>
    <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
        <li>
            <a href="index.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="img/icon/phpmyadmin-svgrepo-com.svg" alt="Ville" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                <span class="flex-1 ms-3 whitespace-nowrap">Accéder au site</span>
            </a>
        </li>
        <li>
            <a href="http://localhost/phpmyadmin" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="img/icon/phpmyadmin-svgrepo-com.svg" alt="Ville" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                <span class="flex-1 ms-3 whitespace-nowrap">phpmyadmin</span>
            </a>
        </li>
        <li>
            <a href="http://localhost/phpmyadmin" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <img src="img/icon/exit-svgrepo-com.svg" alt="Ville" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                <form method="post"><button type="submit" name="supprimer">Supprimer 'loggedin'</button></form>
                <?php
                // Vérifier si le bouton a été cliqué
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
                    // Appeler la fonction et afficher le message
                    echo "<p>" . supprimerLoggedIn() . "</p>";
                }
                ?>
            </a>
        </li>
    </ul>
</div>