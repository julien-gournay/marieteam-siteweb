<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Admin | Port</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php 
      include "bdd.php"; // Fichier de connexion DB
      
      // Récupérer les ports depuis la bdd
      $query = $pdo->query("SELECT * FROM port");
      $ports = $query->fetchAll();
   ?>

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
                    <th scope="col" class="px-6 py-3">Ville</th>
                    <th scope="col" class="px-6 py-3">Pays</th>
                    <th scope="col" class="px-6 py-3">Photo</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                foreach ($ports as $port) {
                    echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-300 transition duration-200'>";
                    echo "<td class='px-6 py-4'>{$port['idVille']}</td>";
                    echo "<td class='px-6 py-4'>{$port['ville']}</td>";
                    echo "<td class='px-6 py-4'>{$port['pays']}</td>";
                    echo "<td class='px-6 py-4'><img src=\"{$port['photo']}\"></td>";
                    echo "<td class='px-6 py-4'>{$port['description']}</td>";
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