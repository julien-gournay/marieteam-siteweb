<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "component/head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Admin | Trajet</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php 
        include "php/bdd.php"; // Fichier de connexion DB
        
        // Récupérer les trajets depuis la bdd
        $query = $pdo->query("SELECT * FROM trajet LIMIT 100");
        $trajets = $query->fetchAll(); 
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
            <input type="text" id="searchInput" placeholder="Rechercher un trajet..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <table id="trajetsTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Id</th>
                    <th scope="col" class="px-6 py-3">Liaison #</th>
                    <th scope="col" class="px-6 py-3">Bateau #</th>
                    <th scope="col" class="px-6 py-3">Date départ</th>
                    <th scope="col" class="px-6 py-3">Heure départ</th>
                    <th scope="col" class="px-6 py-3">Date Arrivée</th>
                    <th scope="col" class="px-6 py-3">Heure Arrivée</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                foreach ($trajets as $trajet) {
                    echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-300 transition duration-200'>";
                    echo "<td class='px-6 py-4'>{$trajet['idTrajet']}</td>";
                    echo "<td class='px-6 py-4'>{$trajet['idLiaison']}</td>";
                    echo "<td class='px-6 py-4'>{$trajet['idBateau']}</td>";
                    echo "<td class='px-6 py-4'>{$trajet['dateDepart']}</td>";
                    echo "<td class='px-6 py-4'>{$trajet['heureDepart']}</td>";
                    echo "<td class='px-6 py-4'>{$trajet['dateArrivee']}</td>";
                    echo "<td class='px-6 py-4'>{$trajet['heureArrivee']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <div id="pagination" class="flex justify-center items-center mt-4"></div>
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

</body>
</html>