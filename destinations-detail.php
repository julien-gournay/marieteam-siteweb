<!DOCTYPE html>
<html lang="fr">

<head>
  <?php include "head.php" ?>
  <title>Admin - Marie Team</title>
  <link rel="stylesheet" href="css/destinations-detail.css">
</head>

<body>
  <?php
  include "navbar.php";
  include "bdd.php";
  ?>

  <section id="sec-1">
    <?php

    // Vérifie si l'ID est dans l'URL et est valide (3 caractères)
    if (isset($_GET['id']) && strlen($_GET['id']) == 3) {
      $id = $_GET['id'];
    } else {
      echo "<p class='messageErreur'>ID invalide ou absent. Veuillez vérifier l'URL.</p>";
      exit;
    }

    // Assure-toi que l'ID est correctement échappé pour éviter les injections SQL
    $id = mysqli_real_escape_string($cnt, $id);

    // Exécution de la requête pour récupérer les informations de la destination
    $res_dest_detail = mysqli_query($cnt, "SELECT * FROM port WHERE idVille='$id'");

    if ($res_dest_detail) {
      while ($tab = mysqli_fetch_row($res_dest_detail)) {
        $id = $tab[0];
        $ville = $tab[1];
        $pays = $tab[2];
        $photo = $tab[3];
        $desc = $tab[4];

        if ($id != NULL) {
          echo ("
          <div class='cadre'>
            <img class='cadre-img' src='$photo'></img>
            <div class='cadre2'>
              <div class='cadre2-content'>
                <div class='cadre2-content-txt'>
                  <h3 class='cadre2-sous-titre'>Destination $pays</h3>
                  <h1 class='cadre2-titre'>$ville</h1><br>
                  <p class='cadre2-sous-description'>$desc</p>
                </div>
              </div>
            </div>
          </div>");
        } else {
          echo ("<p class='messageErreur'><b>Oups, il semblerait qu'une erreur est survenue !</b><br>Nous nous excusons pour la gêne occasionnée, Veuillez actualiser la page ou retenter plus tard.</p>");
          break;
        }
      }
    } else {
      echo ("<p class='messageErreur'><b>Erreur de base de données</b><br>Veuillez réessayer plus tard.</p>");
    }
    ?>
  </section>
</body>

</html>