<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "component/head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Admin | Tarif</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php 
        include "php/bdd.php"; // Fichier de connexion DB

        // Récupérer les tarifs depuis la bdd
        $query = $pdo->query("SELECT * FROM tarif");
        $tarifs = $query->fetchAll(); 
    ?>
   
<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <?php include "component/navbarAdmin.php"; ?>
</aside>

<div class="p-4 sm:ml-64 pl-8 pt-5 pr-8 pb-5">
    <div class="relative overflow-x-auto">
        <div class="mb-4">
            <input type="text" id="searchInput" placeholder="Rechercher un tarif..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <table id="sorting-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Id
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </th>
                    <th scope="col" class="px-6 py-3">Liaion #
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </th>
                    <th scope="col" class="px-6 py-3">Periode #
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </th>
                    <th scope="col" class="px-6 py-3">Type #
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </th>
                    <th scope="col" class="px-6 py-3">Tarif
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                foreach ($tarifs as $tarif) {
                    echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-300 transition duration-200'>";
                    echo "<td class='px-6 py-4'>{$tarif['idTarif']}</td>";
                    echo "<td class='px-6 py-4'>{$tarif['idLiaison']}</td>";
                    echo "<td class='px-6 py-4'>{$tarif['idPeriode']}</td>";
                    echo "<td class='px-6 py-4'>{$tarif['idType']}</td>";
                    echo "<td class='px-6 py-4'>{$tarif['tarif']} €</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById("searchInput");
            const tableBody = document.getElementById("tableBody");
            const rows = tableBody.getElementsByTagName("tr");

            searchInput.addEventListener("input", function() {
                const searchTerm = this.value.toLowerCase();
                
                Array.from(rows).forEach(row => {
                    const cells = row.getElementsByTagName("td");
                    let found = false;
                    
                    Array.from(cells).forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(searchTerm)) {
                            found = true;
                        }
                    });
                    
                    row.style.display = found ? "" : "none";
                });
            });
        });
    </script>
<div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById("sorting-table") && typeof simpleDatatables.DataTable !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#sorting-table", {
                searchable: true,
                perPageSelect: false,
                sortable: true,
                paging: false,
                labels: {
                    placeholder: "Rechercher un tarif...",
                    searchTitle: "Rechercher dans le tableau",
                    perPage: "entrées par page",
                    noRows: "Aucune entrée trouvée",
                    info: "Affichage de {start} à {end} sur {rows} entrées"
                }
            });
        }
    });
</script>
</body>
</html>