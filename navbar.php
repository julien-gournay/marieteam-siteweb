<?php
// Récupérer le nom du fichier PHP en cours
$currentPage = basename($_SERVER['PHP_SELF']);

// Fonction pour ajouter la classe active à un élément de menu
function addActiveClass($page, $current) {
    return ($page == $current) ? 'active' : '';
}
?>

<nav class="navbar">
    <a href="index.php"><img src="img/logosvg_bleu.svg" id="logoName"></a>
    <div class="nav-links">
        <ul>
            <li class="<?php echo addActiveClass('index.php', $currentPage); ?>"><a href="index.php">Home</a></li>
            <li class="<?php echo addActiveClass('destinations.php', $currentPage);addActiveClass('destinations-detail.php', $currentPage) ?>"><a href="destinations.php">Nos destinations</a></li>
            <li class="<?php echo addActiveClass('resa-login.php', $currentPage);addActiveClass('resa-detail.php', $currentPage) ?>"><a href="resa-login.php">Ma reservation</a></li>
            <li class="<?php echo addActiveClass('booking-step1.php', $currentPage); ?>"><a href="booking-step1.php">Réserver</a></li>
        </ul>
    </div>
</nav>