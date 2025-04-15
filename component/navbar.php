<?php
// Récupérer le nom de la page PHP en cours
$currentPage = basename($_SERVER['PHP_SELF']);

// Fonction pour ajouter la classe active à l'element de la page ouverte
function addActiveClass($page, $current) {
    return ($page == $current) ? 'active' : '';
}
?>

<nav class="navbar">
    <a href="index.php"><img src="img/logosvg_bleu.svg" id="logoName"></a> <!-- Logo -->
    <i class='bx bx-menu' id="menuIcon"></i>
    <div class="nav-links">
        <i class='bx bx-x' id="closeMenu"></i>
        <ul> <!-- Menu redirection -->
            <li class="<?php echo addActiveClass('index.php', $currentPage); ?>">
                <a href="index.php"><i class='bx bx-home-alt-2'></i>Home</a>
            </li>
            <li class="<?php echo addActiveClass('destinations.php', $currentPage);addActiveClass('destinations-detail.php', $currentPage) ?>">
                <a href="destinations.php"><i class='bx bx-map-alt'></i>Nos destinations</a>
            </li>
            <li class="<?php echo addActiveClass('resa-login.php', $currentPage);addActiveClass('resa-detail.php', $currentPage) ?>">
                <a href="resa-login.php"><i class='bx bx-calendar-check'></i>Ma reservation</a>
            </li>
            <li class="<?php echo addActiveClass('booking-step1.php', $currentPage); ?>">
                <a href="booking-step1.php"><i class='bx bx-calendar-plus'></i>Réserver</a>
            </li>
        </ul>
    </div>
</nav>
<script src="js/navbar.js"></script>