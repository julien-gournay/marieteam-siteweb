<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Admin | Réservation</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php 
        include "bdd.php"; // Fichier de connexion BDD 

        // Récupérer les réservations depuis la bdd
        $query = $pdo->query("SELECT * FROM reservation");
        $reservations = $query->fetchAll();

        // Fonction pour définir les couleurs des statuts
        function getStatusBadge($etat) {
            $badges = [
                "Validé" => "bg-green-100 text-green-800",
                "Archivé" => "bg-gray-100 text-gray-800",
                "Annulé" => "bg-red-100 text-red-800",
                "En attente" => "bg-yellow-100 text-yellow-800",
            ];
            $classe = $badges[$etat] ?? "bg-gray-100 text-gray-800"; // Si statut inconnu
            return "<span class='px-2 py-1 rounded text-xs font-semibold $classe'>$etat</span>";
        }
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
                    <th scope="col" class="px-6 py-3">etat</th>
                    <th scope="col" class="px-6 py-3">Référence</th>
                    <th scope="col" class="px-6 py-3">Client #</th>
                    <th scope="col" class="px-6 py-3">Trajet #</th>
                    <th scope="col" class="px-6 py-3">Date réservation</th>
                    <th scope="col" class="px-6 py-3">ACTIONS</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                foreach ($reservations as $reservation) {
                    echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-300 transition duration-200'>";
                    echo "<td class='px-6 py-4'>".getStatusBadge($reservation['etat'])."</td>";
                    echo "<td class='px-6 py-4'>{$reservation['reference']}</td>";
                    echo "<td class='px-6 py-4'>{$reservation['idClient']}</td>";
                    echo "<td class='px-6 py-4'>{$reservation['idTrajet']}</td>";
                    echo "<td class='px-6 py-4'>{$reservation['dateResa']}</td>";
                    echo "<td class='px-6 py-3'>";
                        echo "<button onclick='fetchReservationDetails('{$reservation['reference']}')' class=\"px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700\">";
                        echo   "Voir Détails";
                        echo "</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modale -->
    <div id="reservationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <h2 class="text-xl font-semibold mb-4">Détails de la Réservation</h2>

            <p><strong>Référence :</strong> <span id="modal-reference"></span></p>
            <p><strong>Date Réservation :</strong> <span id="modal-date"></span></p>
            <p><strong>État :</strong> <span id="modal-etat"></span></p>

            <h3 class="text-lg font-semibold mt-4">Client</h3>
            <p><strong>Nom :</strong> <span id="modal-client-nom"></span></p>
            <p><strong>Prénom :</strong> <span id="modal-client-prenom"></span></p>
            <p><strong>Téléphone :</strong> <span id="modal-client-tel"></span></p>
            <p><strong>Email :</strong> <span id="modal-client-email"></span></p>

            <h3 class="text-lg font-semibold mt-4">Trajet</h3>
            <p><strong>ID Trajet :</strong> <span id="modal-trajet"></span></p>
            <p><strong>Date Départ :</strong> <span id="modal-date-depart"></span></p>
            <p><strong>Heure Départ :</strong> <span id="modal-heure-depart"></span></p>
            <p><strong>Date Arrivée :</strong> <span id="modal-date-arrivee"></span></p>
            <p><strong>Heure Arrivée :</strong> <span id="modal-heure-arrivee"></span></p>

            <h3 class="text-lg font-semibold mt-4">Liaison</h3>
            <p><strong>ID Liaison :</strong> <span id="modal-liaison"></span></p>
            <p><strong>Ville Départ :</strong> <span id="modal-ville-depart"></span></p>
            <p><strong>Ville Arrivée :</strong> <span id="modal-ville-arrivee"></span></p>

            <h3 class="text-lg font-semibold mt-4">Bateau</h3>
            <p><strong>Nom :</strong> <span id="modal-bateau"></span></p>

            <div class="mt-4 flex justify-end">
                <button onclick="closeModal()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700">
                    Fermer
                </button>
            </div>
        </div>
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

    <script>
        function fetchReservationDetails(reference) {
            fetch('php/get_resa.php?reference=' + reference)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert("Erreur : " + data.error);
                        return;
                    }

                    document.getElementById("modal-reference").textContent = data.reference;
                    document.getElementById("modal-date").textContent = data.dateResa;
                    document.getElementById("modal-etat").textContent = data.etat;

                    document.getElementById("modal-client-nom").textContent = data.client_nom;
                    document.getElementById("modal-client-prenom").textContent = data.client_prenom;
                    document.getElementById("modal-client-tel").textContent = data.client_tel;
                    document.getElementById("modal-client-email").textContent = data.client_email;

                    document.getElementById("modal-trajet").textContent = data.idTrajet;
                    document.getElementById("modal-date-depart").textContent = data.dateDepart;
                    document.getElementById("modal-heure-depart").textContent = data.heureDepart;
                    document.getElementById("modal-date-arrivee").textContent = data.dateArrivee;
                    document.getElementById("modal-heure-arrivee").textContent = data.heureArrivee;

                    document.getElementById("modal-liaison").textContent = data.idLiai;
                    document.getElementById("modal-ville-depart").textContent = data.idvilleDepart;
                    document.getElementById("modal-ville-arrivee").textContent = data.idvilleArrivee;

                    document.getElementById("modal-bateau").textContent = data.nomBateau;

                    document.getElementById("reservationModal").classList.remove("hidden");
                })
                .catch(error => console.error('Erreur lors du chargement des données :', error));
        }


        function closeModal() {
            document.getElementById("reservationModal").classList.add("hidden");
        }
    </script>
<div>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
</body>
</html>