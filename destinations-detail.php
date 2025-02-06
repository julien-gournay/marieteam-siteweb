<!DOCTYPE html>
<html lang="fr">

<head>
  <?php include "head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
  <title>Destination - Marie Team</title> <!-- Titre de la page -->
  <link rel="stylesheet" href="css/destinations-detail.css"> <!-- CSS spécifique -->
</head>

<body>
  <?php
  include "navbar.php"; // Inclure la barre de navigation
  include "bdd.php"; // Fichier de connexion BDD
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
      echo ("<p class='messageErreur'><b>Erreur de base de données</b><br>Veuillez réessayer plus tard.</p>"); // Message d'erreur BDD
    }
    ?>
  </section>



  </section>

  <!-- ##### SECTION TARIFS DEPART  ##### -->
  <section id="sec-3" class="flex flex-col">
    <div class='sec-2_info_title'>Nos tarifs divers</div>
    <div id="accordion-collapse" data-accordion="collapse" data-active-classes="bg-blue-100 dark:bg-gray-800 text-white dark:text-white" data-inactive-classes="bg-gray-300 dark:bg-gray-800 text-black-600 dark:text-white" class="flex flex-col gap-2">
      <?php
      $n = 1; // iniatialisation n
      $res_depart = mysqli_query($cnt, "SELECT liaison.idvilleDepart, port.ville FROM port,liaison WHERE port.idVille=liaison.idvilleDepart AND liaison.idvilleArrivee='$id';"); // Requête : Récuperation des départs possible selon le port d'arrivée
      while ($tab = mysqli_fetch_row($res_depart)) { // Boucle des départs possible
        $idDepart = $tab[0]; // Variable id port départ
        $villeDepart = $tab[1]; // Variable nom ville départ


        echo (" 
            <h2 id=\"accordion-collapse-heading-$n\">
              <button type=\"button\" class=\"flex items-center justify-between w-full p-5 font-medium rtl:text-right text-black border-b border-black dark:border-black gap-3 bg-blue-500 rtl:text-black\" data-accordion-target=\"#accordion-collapse-body-$n\" aria-expanded=\"true\" aria-controls=\"accordion-collapse-body-$n\">
                <span>$villeDepart</span>
                <svg data-accordion-icon class=\"w-3 h-3 rotate-180 shrink-0\" aria-hidden=\"true\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 10 6\">
                  <path stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 5 5 1 1 5\"/>
                </svg>
              </button>
            </h2>
          ");
        $res_departT = mysqli_query($cnt, "SELECT type.libelleType,tarif.tarif FROM tarif,liaison,type WHERE tarif.idLiaison=liaison.idLiai AND liaison.idvilleDepart='$idDepart' AND tarif.idType=type.idType"); // Requête : Liste tarifs selon le port de depart
        while ($tab = mysqli_fetch_row($res_departT)) { // Boucle des tarifs/type
          $libelleT = $tab[0]; // Variable type tari
          $tarif = $tab[1]; // Variable prix tarif
        }
        echo ("
              <div id=\"accordion-collapse-body-$n\" class=\"hidden\" aria-labelledby=\"accordion-collapse-heading-$n\">
                <div id='sec-2'> 
                  <div class='sec-2_info'>
                    <div class='sec-2_info_desc'>Depart $villeDepart, à partir de</div>
                  </div>

                  <div class='sec-2_box1'>
                    <div class='sec-2_box1_head'>
                      <div class='sec-2_box1_head_title'>A PIED</div>
                    </div>
                    
                    <div class='sec-2_box1_body'>");
        $res_departT = mysqli_query($cnt, "SELECT type.libelleType,MIN(tarif.tarif) FROM tarif,type WHERE tarif.idLiaison='$idDepart-$id' AND tarif.idType=type.idType AND type.idCategorie='A' GROUP BY tarif.idType;"); // Requête : Liste tarifs selon le port de depart
        if (mysqli_num_rows($res_departT) > 0) {
          while ($tab = mysqli_fetch_row($res_departT)) { // Boucle des tarifs/type
            $libelleT = $tab[0]; // Variable type tari
            $tarif = $tab[1]; // Variable prix tarif

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
        $res_departT = mysqli_query($cnt, "SELECT type.libelleType,MIN(tarif.tarif) FROM tarif,type WHERE tarif.idLiaison='$idDepart-$id' AND tarif.idType=type.idType AND type.idCategorie!='A' GROUP BY tarif.idType;"); // Requête : Liste tarifs selon le port de depart
        if (mysqli_num_rows($res_departT) > 0) {
          while ($tab = mysqli_fetch_row($res_departT)) { // Boucle des tarifs/type
            $libelleT = $tab[0]; // Variable type tari
            $tarif = $tab[1]; // Variable prix tarif

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
          "); // Affichage liste accordéon ville
        //<div id=\"accordion-open-body-$n\" class=\"hidden\" aria-labelledby=\"accordion-open-heading-$n\">
        //    <div class=\"p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900\">"
        $n++;
      }
      ?>
      <!--<h2 id="accordion-open-heading-2">
        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-open-body-2" aria-expanded="false" aria-controls="accordion-open-body-2">
          <span class="flex items-center"><svg class="w-5 h-5 me-2 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>Is there a Figma file available?</span>
          <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
          </svg>
        </button>
      </h2>
      <div id="accordion-open-body-2" class="hidden" aria-labelledby="accordion-open-heading-2">
        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
          <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is first conceptualized and designed using the Figma software so everything you see in the library has a design equivalent in our Figma file.</p>
          <p class="text-gray-500 dark:text-gray-400">Check out the <a href="https://flowbite.com/figma/" class="text-blue-600 dark:text-blue-500 hover:underline">Figma design system</a> based on the utility classes from Tailwind CSS and components from Flowbite.</p>
        </div>
      </div>-->
    </div>
  </section>

  <?php include "footer.php" ?> <!-- Inclure le footer -->
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> <!-- Modules Flowbite (pour composant) -->
  <script src="js/destination-detail.js"></script> <!-- Scripts pour la page de détail -->
</body>

</html>