<!DOCTYPE html>
<html lang="fr">

<head>
  <?php include "head.php" ?>
  <link rel="stylesheet" href="css/destinations.css">
  <title>Marie Team</title>
</head>

<body>
  <?php
  include "navbar.php";
  include "bdd.php";
  ?>

  <section id="sec-1">
    <div class="sec1-content">
      <div class="banner-sec-1">
        <div class="banner-sec-1-info">
          <h1 class="banner-sec-1-info-titre">Nos destinations</h1>
        </div>
      </div>
      <div class="svg_destination">
        <img src="img/destination_france.svg" alt="Nos Destination">
      </div>
    </div>
  </section>

  <section id="sec-2">
    <!-- BOX FRANCE -->
    <div class="sec-2-box">
      <div class="sec-2-box-head">
        <div class="sec-2-box-head-img"><img src="img/drapeau/france.png">
          <div class="sec-2-box-head-text">FRANCE</div>
        </div>
      </div>
      <div class="sec-2-box-liste">
        <?php
        $resFR = mysqli_query($cnt, "SELECT * FROM port WHERE pays=\"France\"");
        while ($tab = mysqli_fetch_row($resFR)) {
          $id = $tab[0];
          $ville = $tab[1];
          $photo = $tab[3];

          if ($id != NULL) {
            echo ("
            <a href='destinations-detail.php?id=$id'><div class='sec-2-box-liste-card'>
          <img src='$photo'>
          <div class='sec-2-box-liste-card-text'>$ville</div>
        </div>
        </a>
        ");
          } else {
            echo ("<p class=\"messageErreur\"><b>Oups, il semblerais qu'une erreur est survenue !</b><br>Nous nous exusons pour la gène occasionée, Veuillez actualiser la page ou retenter plustard.</p>");
            break;
          }
        }
        ?>
      </div>
    </div>

    <!-- BOX ROYAUME UNI -->
    <div class="sec-2-box">
      <div class="sec-2-box-head">
        <div class="sec-2-box-head-img"><img src="img/drapeau/royaume_uni.png">
          <div class="sec-2-box-head-text">ROYAUME-UNI</div>
        </div>
      </div>
      <div class="sec-2-box-liste">
        <?php
        $resRU = mysqli_query($cnt, "SELECT * FROM port WHERE pays=\"Royaume Uni\"");
        while ($tab = mysqli_fetch_row($resRU)) {
          $id = $tab[0];
          $ville = $tab[1];
          $photo = $tab[3];

          if ($id != NULL) {
            echo ("
            <a href='destinations-detail.php?id=$id'><div class='sec-2-box-liste-card'>
          <img src='$photo'>
          <div class='sec-2-box-liste-card-text'>$ville</div>
        </div>
        </a>
        ");
          } else {
            echo ("<p class=\"messageErreur\"><b>Oups, il semblerais qu'une erreur est survenue !</b><br>Nous nous exusons pour la gène occasionée, Veuillez actualiser la page ou retenter plustard.</p>");
            break;
          }
        }
        ?>
      </div>
    </div>
    </div>

    <!-- BOX ESPAGNE -->
    <div class="sec-2-box">
      <div class="sec-2-box-head">
        <div class="sec-2-box-head-img"><img src="img/drapeau/espagne.png">
          <div class="sec-2-box-head-text">ESPAGNE</div>
        </div>
      </div>
      <div class="sec-2-box-liste">
        <?php
        $resES = mysqli_query($cnt, "SELECT * FROM port WHERE pays=\"Espagne\"");
        while ($tab = mysqli_fetch_row($resES)) {
          $id = $tab[0];
          $ville = $tab[1];
          $photo = $tab[3];

          if ($id != NULL) {
            echo ("
            <a href='destinations-detail.php?id=$id'><div class='sec-2-box-liste-card'>
          <img src='$photo'>
          <div class='sec-2-box-liste-card-text'>$ville</div>
        </div>
        </a>
        ");
          } else {
            echo ("<p class=\"messageErreur\"><b>Oups, il semblerais qu'une erreur est survenue !</b><br>Nous nous exusons pour la gène occasionée, Veuillez actualiser la page ou retenter plustard.</p>");
            break;
          }
        }
        ?>
      </div>
    </div>

    <!-- BOX IRLANDE -->
    <div class="sec-2-box">
      <div class="sec-2-box-head">
        <div class="sec-2-box-head-img"><img src="img/drapeau/irlande.png">
          <div class="sec-2-box-head-text">Irlande</div>
        </div>
      </div>
      <div class="sec-2-box-liste">
        <?php
        $resIR = mysqli_query($cnt, "SELECT * FROM port WHERE pays=\"Irlande\"");
        while ($tab = mysqli_fetch_row($resIR)) {
          $id = $tab[0];
          $ville = $tab[1];
          $photo = $tab[3];

          if ($id != NULL) {
            echo ("
            <a href='destinations-detail.php?id=$id'><div class='sec-2-box-liste-card'>
          <img src='$photo'>
          <div class='sec-2-box-liste-card-text'>$ville</div>
        </div>
        </a>
        ");
          } else {
            echo ("<p class=\"messageErreur\"><b>Oups, il semblerais qu'une erreur est survenue !</b><br>Nous nous exusons pour la gène occasionée, Veuillez actualiser la page ou retenter plustard.</p>");
            break;
          }
        }
        ?>
      </div>
    </div>
  </section>
  <?php include "footer.php" ?>
  <script src="js/navbar.js"></script>
</body>

</html>