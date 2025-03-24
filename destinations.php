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

  <section id="sec-1" class="pt-32 sm:pt-40 lg:pt-24">
    <div class="relative overflow-hidden">
      <!-- Background pattern -->


      <!-- Content -->
      <div class="relative max-w-screen-xl mx-auto px-4 py-16 sm:px-7 lg:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
          <!-- Text content -->
          <div class="text-center lg:text-left">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white mb-6">
              Nos destinations
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 mb-8">
              Découvrez nos différentes destinations à travers l'Europe
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
              <a href="#sec-2" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Explorer les destinations
                <i class='bx bx-map text-xl ml-2 text-white'></i>
              </a>
            </div>
          </div>

          <!-- Image -->
          <div class="relative">
            <div class="relative z-10">
              <img src="img/destination_france.svg" alt="Nos Destination" class="w-full h-auto transform hover:scale-105 transition-transform duration-300">
            </div>
            <!-- Decorative elements -->
            <div class="absolute -top-4 -right-4 w-24 h-24 bg-blue-100 dark:bg-blue-900 rounded-full opacity-20"></div>
            <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-blue-100 dark:bg-blue-900 rounded-full opacity-20"></div>
          </div>
        </div>
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