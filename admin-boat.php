<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Admin | Bateau</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php 
        include "bdd.php"; // Fichier de connexion DB
    
        // Récupérer les bateaux depuis la bdd
        $query = $pdo->query("SELECT * FROM bateau");
        $bateaux = $query->fetchAll();
    ?>
   
<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <?php include "navbarAdmin.php"; ?>
</aside>

<div class="p-4 sm:ml-64 pl-8 pt-5 pr-8 pb-5">
    <div class="relative overflow-x-auto">
        <input type="text" id="searchInput" placeholder="Rechercher..." class="mb-4 p-2 border rounded w-full">
        
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Id</th>
                    <th scope="col" class="px-6 py-3">Nom bateau</th>
                    <th scope="col" class="px-6 py-3">Marque</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                foreach ($bateaux as $bateau) {
                    echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-300 transition duration-200'>";
                    echo "<td class='px-6 py-4'>{$bateau['idBateau']}</td>";
                    echo "<td class='px-6 py-4'>{$bateau['nomBateau']}</td>";
                    echo "<td class='px-6 py-4'>{$bateau['marque']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById("searchInput").addEventListener("keyup", function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#tableBody tr");

            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });
    </script>
<div>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
</body>
</html>