<!DOCTYPE html>
<html lang="fr">

<head>
  <?php include "component/head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
  <title>Destination - Marie Team</title> <!-- Titre de la page -->
  <link rel="stylesheet" href="css/destinations-detail.css"> <!-- CSS spécifique -->
</head>

<body>
  <?php
  include "component/navbar.php"; // Inclure la barre de navigation
  include "php/bdd.php"; // Fichier de connexion DB
  ?>

  <!-- ##### SECTION BANNIERE INFO  ##### -->
  <section id="sec-1">
    <?php
    // Vérifie si l'ID dans l'URL est valide (3 caractères)
    if (isset($_GET['id']) && strlen($_GET['id']) == 3) {
      $id = $_GET['id']; // Variable recuperation id port
    } else {
      echo ("<p class='messageErreur'>ID invalide ou absent. Veuillez vérifier l'URL.</p>"); // Message d'erreur de l'id port
      exit;
    }

    $id = mysqli_real_escape_string($cnt, $id); // Verification que l'ID est correctement échappé pour éviter les injections SQL
    $res_dest_detail = mysqli_query($cnt, "SELECT * FROM port WHERE idVille='$id'"); // Requête récupération informations sur la destination

    if ($res_dest_detail) { // Verification que la requete n'est pass vide
      while ($tab = mysqli_fetch_row($res_dest_detail)) { // Récuperation info destination/port
        $id = $tab[0]; // Variable id port
        $ville = $tab[1]; // Variable nom ville
        $pays = $tab[2];  // Variable localisation port
        $photo = $tab[3]; // Variable photo ville
        $desc = $tab[4];  // Variable description ville

        if ($id != NULL) { // Si l'id destination n'est pas vide, alors ...
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
          </div>"); // Affichage info destination
        } else {
          echo ("<p class='messageErreur'><b>Oups, il semblerait qu'une erreur est survenue !</b><br>Nous nous excusons pour la gêne occasionnée, Veuillez actualiser la page ou retenter plus tard.</p>"); // Message d'erreur récupération infos
          break;
        }
      }
    } else {
      echo ("<p class='messageErreur'><b>Erreur de base de données</b><br>Veuillez réessayer plus tard.</p>"); // Message d'erreur DB
    }
    ?>
  </section>



  </section>

  <!-- ##### SECTION TARIFS DEPART  ##### -->
  <section id="sec-3" class="flex flex-col">
    <div class='sec-2_info_title'>Nos tarifs divers</div>
    <div id="accordion-flush" data-accordion="collapse" class="w-full">
      <?php
      $n = 1;
      $res_depart = mysqli_query($cnt, "SELECT liaison.idvilleDepart, port.ville FROM port,liaison WHERE port.idVille=liaison.idvilleDepart AND liaison.idvilleArrivee='$id';");
      while ($tab = mysqli_fetch_row($res_depart)) {
        $idDepart = $tab[0];
        $villeDepart = $tab[1];

        // Détermine si c'est le premier accordéon
        $isFirst = $n === 1;
        $expanded = $isFirst ? "true" : "false";
        $hidden = $isFirst ? "" : "hidden";

        echo ("
          <h2 id=\"accordion-flush-heading-$n\">
            <button type=\"button\" class=\"flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800\" data-accordion-target=\"#accordion-flush-body-$n\" aria-expanded=\"$expanded\" aria-controls=\"accordion-flush-body-$n\">
              <span class=\"flex items-center\">
                <svg class=\"w-5 h-5 mr-2\" fill=\"currentColor\" viewBox=\"0 0 20 20\" xmlns=\"http://www.w3.org/2000/svg\">
                  <path fill-rule=\"evenodd\" d=\"M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z\" clip-rule=\"evenodd\"></path>
                </svg>
                $villeDepart
              </span>
              <svg data-accordion-icon class=\"w-3 h-3 rotate-180 shrink-0\" aria-hidden=\"true\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 10 6\">
                <path stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 5 5 1 1 5\"/>
              </svg>
            </button>
          </h2>
          <div id=\"accordion-flush-body-$n\" class=\"$hidden\" aria-labelledby=\"accordion-flush-heading-$n\">
            <div class=\"p-5 border-b border-gray-200 dark:border-gray-700\">
              <div id='sec-2'> 
                <div class='sec-2_info'>
                  <div class='sec-2_info_desc'>Depart $villeDepart, à partir de</div>
                </div>

                <div class='sec-2_box1'>
                  <div class='sec-2_box1_head'>
                    <div class='sec-2_box1_head_title'>A PIED</div>
                  </div>
                  
                  <div class='sec-2_box1_body'>");
        $res_departT = mysqli_query($cnt, "SELECT type.libelleType,MIN(tarif.tarif) FROM tarif,type WHERE tarif.idLiaison='$idDepart-$id' AND tarif.idType=type.idType AND type.idCategorie='A' GROUP BY tarif.idType;");
        if (mysqli_num_rows($res_departT) > 0) {
          while ($tab = mysqli_fetch_row($res_departT)) {
            $libelleT = $tab[0];
            $tarif = $tab[1];

            echo ("
                    <div class='sec-2_box1_body_info1'>
                      <div class=\"sec-2_box1_body_info1_cnt\">
                        <div class=\"sec-2_box1_body_info1_age\"><br>$libelleT</div>
                        <div class=\"sec-2_box1_body_info1_prix\">$tarif €</div>
                      </div>
                    </div>
                    <div class=\"sec-2_box1_barre\"></div>");
          };
        } else {
          echo ("
                  <div class='sec-2_box1_body_info1'>
                    <p>Aucun billet n'est disponible pour ce départ.</p>
                  </div>");
        }
        echo ("
                  </div>
                </div>

                <div class='sec-2_box2'>
                  <div class='sec-2_box2_head'>
                    <div class='sec-2_box2_head_title'>VEHICULE</div>
                  </div>
                  
                  <div class='sec-2_box2_body'>");
        $res_departT = mysqli_query($cnt, "SELECT type.libelleType,MIN(tarif.tarif) FROM tarif,type WHERE tarif.idLiaison='$idDepart-$id' AND tarif.idType=type.idType AND type.idCategorie!='A' GROUP BY tarif.idType;");
        if (mysqli_num_rows($res_departT) > 0) {
          while ($tab = mysqli_fetch_row($res_departT)) {
            $libelleT = $tab[0];
            $tarif = $tab[1];

            echo ("
                    <div class='sec-2_box2_body_info1'>
                      <div class='sec-2_box2_body_info1_cnt'>
                        <div class='sec-2_box2_body_info1_vehicule'>$libelleT</div>
                        <div class='sec-2_box2_body_info1_prix'>$tarif €</div>
                      </div>
                    </div>
                    <div class=\"sec-2_box2_barre\"></div>");
          };
        } else {
          echo ("
                  <div class='sec-2_box2_body_info1'>
                    <p>Aucun billet n'est disponible pour ce départ.</p>
                  </div>");
        }
        echo ("
                  </div>
                </div>
              </div>
            </div>
          </div>");
        $n++;
      }
      ?>
    </div>
  </section>

  <?php include "component/footer.php" ?> <!-- Inclure le footer -->
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> <!-- Modules Flowbite (pour composant) -->
  <script src="js/destination-detail.js"></script> <!-- Scripts pour la page de détail -->
</body>

</html>