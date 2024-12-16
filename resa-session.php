<?php
    session_start();
    var_dump($_SESSION);
    // Fonction pour supprimer la session
    if (isset($_POST['supprimer_session'])) {
        session_unset();
        session_destroy();
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
?>

<!-- Formulaire pour supprimer la session -->
<form action="" method="post">
    <input type="submit" name="supprimer_session" value="Supprimer la session">
    <button type="button"><a href="booking-step1.php">Nouvelle Réservation</a></button>
    <button type="button"><a href="#" onclick="history.back()">Retour</a></button>
</form>