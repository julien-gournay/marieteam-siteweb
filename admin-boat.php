<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Admin | Bateau</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php include "bdd.php"; // Fichier de connexion BDD ?>
   
<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <?php include "navbarAdmin.php"; ?>
</aside>

<div class="p-4 sm:ml-64">
   
<table id="search-table">
    <thead>
        <tr>
            <th>
                <span class="flex items-center">
                    id Bateau
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    nom Bateau
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Marque
                </span>
            </th>
        </tr>
    </thead>
    <tbody>
    <?php
    $res_boat = mysqli_query($cnt, "SELECT * FROM bateau;"); // Requête :
    while ($tab = mysqli_fetch_row($res_boat)) { // Boucle pour afficher les ports dispo (requête : res3 [bdd.php])
        $idBateau = $tab[0]; // Variable de l'id port
        $nomBateau = $tab[2]; // Variable nom port
        $marque = $tab[3]; // Variable photo port

        echo("<tr>
            <td class=\"font-medium text-gray-900 whitespace-nowrap dark:text-white\">$idBateau</td>
            <td>$nomBateau</td>
            <td>$marque</td>
        </tr>
        "); // Affichage des ports sous forme de cadre/bouton
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