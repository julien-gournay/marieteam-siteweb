<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Admin | Port</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php include "bdd.php"; // Fichier de connexion BDD ?>

   <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
      <?php include "navbarAdmin.php"; ?>
   </aside>

<div class="p-4 sm:ml-64">
   <table id="search-table">
      <thead>
         <tr>
            <th>
               <span class="flex items-center">id Ville</span>
               <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
               </svg>
            </th>
            <th>
               <span class="flex items-center">ville</span>
            </th>
            <th>
               <span class="flex items-center">pays</span>
            </th>
            <th>
               <span class="flex items-center">photo</span>
            </th>
            <th>
               <span class="flex items-center">descritpion</span>
            </th>
         </tr>
      </thead>
      <tbody>
      <?php
         $res_port = mysqli_query($cnt, "SELECT * FROM port;"); // Requête :
         while ($tab = mysqli_fetch_row($res_port)) { // Boucle pour afficher les ports dispo (requête : res3 [bdd.php])
            $idVille = $tab[0]; // Variable de l'id port
            $ville = $tab[1]; // Variable nom port
            $pays = $tab[2]; // Variable photo port
            $photo = $tab[3];
            $description = $tab[4];

            echo("<tr>
                  <td class=\"font-medium text-gray-900 whitespace-nowrap dark:text-white\">$idVille</td>
                  <td>$ville</td>
                  <td>$pays</td>
                  <td>$photo</td>
                  <td>$description</td>
            </tr>"); // Affichage des ports sous forme de cadre/bouton
         }
         ?>
      </tbody>
   </table>
</div>

<script>
   if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
      const dataTable = new simpleDatatables.DataTable("#search-table", {
         searchable: true,
         sortable: false
      });
   }
</script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
</body>
</html>