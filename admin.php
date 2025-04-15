<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "component/head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Espace admin</title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php 
        include "php/bdd.php"; // Fichier de connexion DB

        // Récupérer les données cadres
        $chiffreAffaire = $pdo->query("SELECT SUM(ta.tarif) AS chiffre_affaire FROM reservation r 
            JOIN trajet t ON r.idTrajet = t.idTrajet
            JOIN tarif ta ON t.idLiaison = ta.idLiaison
            WHERE YEAR(r.dateResa) = YEAR(CURDATE())")->fetchColumn();

        $totalReservations = $pdo->query("SELECT COUNT(*) FROM reservation")->fetchColumn();
        $totalClients = $pdo->query("SELECT COUNT(*) FROM client")->fetchColumn();
        $totalBillets = $pdo->query("SELECT SUM(b.quantite) FROM billet b")->fetchColumn();

        $indicentsSemestre = $pdo->query("SELECT COUNT(*) FROM incident JOIN trajet ON incident.idTrajet = trajet.idTrajet WHERE trajet.dateDepart >= CURDATE() - INTERVAL 6 MONTH;")->fetchColumn();
        $incidentsTotal = $pdo->query("SELECT COUNT(*) FROM incident")->fetchColumn();

        $traversesAujourdhui = $pdo->query("SELECT COUNT(*) FROM trajet WHERE dateDepart = CURDATE()")->fetchColumn();
        $traversesAnnuel = $pdo->query("SELECT COUNT(*) FROM trajet  WHERE YEAR(dateDepart) = YEAR(CURDATE());")->fetchColumn();

        $passagersAujourdhui = $pdo->query("SELECT SUM(b.quantite) FROM billet b, reservation r, trajet t where b.reference=r.reference AND r.idTrajet=t.idTrajet AND dateDepart = CURDATE() AND (idType = 'A1' OR idType = 'A2' OR idType = 'A3');")->fetchColumn();
        $passagersAnnuel = $pdo->query("SELECT SUM(b.quantite) FROM billet b, reservation r, trajet t where b.reference=r.reference AND r.idTrajet=t.idTrajet AND YEAR(dateDepart) = YEAR(CURDATE()) AND (idType = 'A1' OR idType = 'A2' OR idType = 'A3');")->fetchColumn();
        $passagersTotal = $pdo->query("SELECT SUM(b.quantite) FROM billet b where idType = 'A1' OR idType = 'A2' OR idType = 'A3'")->fetchColumn();

        include "php/admin_req.php"; // Requetes pour les graphiques
    ?>
   
    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
    </button>

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <?php 
        include "component/navbarAdmin.php"; 
        $prenom = $_SESSION['userprenom'];
    ?>
    </aside>

    <div class="p-4 sm:ml-64 pl-8 pt-5 p-8 pb-5">        
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Bienvenue <span class="text-blue-600 dark:text-blue-500"><?php echo("$prenom"); ?></span> sur l'espace administrateur.</h1>
        <!--<p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>-->

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Chiffre d'affaires -->
            <div class="bg-white p-5 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">💰 Chiffre d'affaires annuel</h3>
                <p class="text-2xl font-bold text-green-500"><?= number_format($chiffreAffaire, 2, ',', ' ') ?> €</p>
            </div>

            <!-- Nombre de réservations -->
            <div class="bg-white p-5 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">📅 Nombre de réservations</h3>
                <p class="text-2xl font-bold text-blue-500"><?= $totalReservations ?></p>
            </div>

            <!-- Nombre total de billets -->
            <div class="bg-white p-5 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">🎟️ Billets vendus</h3>
                <p class="text-2xl font-bold text-yellow-500"><?= $totalBillets ?></p>
            </div>

            <!-- Nombre toral de passagers -->
            <div class="bg-white p-5 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">👨 Nombre de clients</h3>
                <p class="text-2xl font-bold text-red-500"><?= $totalClients ?></p>
            </div>

            <!-- Nombre toral de passagers -->
            <div class="bg-white p-5 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">🚨 Incident</h3>
                <div class="flex flex-row">
                    <div class="flex flex-col w-1/2">
                        <h4 class="text-l font-semibold text-gray-700">6 derniers mois</h4>
                        <p class="text-2xl font-bold text-red-500"><?= $indicentsSemestre ?></p>
                    </div>
                    <div class="flex flex-col">
                        <h4 class="text-l font-semibold text-gray-700">Total</h4>
                        <p class="text-2xl font-bold text-red-500"><?= $incidentsTotal ?></p>
                    </div>
                </div>
                <canvas id="incidentChart"></canvas>
            </div>

            <!-- Nombre de traversées aujourd'hui -->
            <div class="bg-white p-5 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">🚢 Traversées </h3>
                <div class="flex flex-row">
                    <div class="flex flex-col w-1/2">
                        <h4 class="text-l font-semibold text-gray-700">Aujourd’hui</h4>
                        <p class="text-2xl font-bold text-red-500"><?= $traversesAujourdhui ?></p>
                    </div>
                    <div class="flex flex-col">
                        <h4 class="text-l font-semibold text-gray-700">Annuel</h4>
                        <p class="text-2xl font-bold text-red-500"><?= $traversesAnnuel ?></p>
                    </div>
                </div>
                <br>
                <canvas id="weeklyLineChart"></canvas>
            </div>


            <!-- Nombre total de client -->
            <div class="bg-white p-5 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">🌍 Classement des destinations</h3>
                <p class="text-2xl font-bold text-yellow-500">Top destination : <?= $topDestination ?></p><br>
                <canvas id="topDestChart"></canvas>
            </div>

            <div class="bg-white p-5 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">👥​ Passagers transportés</h3>
                <div class="flex flex-row gap-x-16">
                    <div class="flex flex-col w-1/3">
                        <h4 class="text-l font-semibold text-gray-700">Aujourd’hui</h4>
                        <p class="text-2xl font-bold text-red-500"><?= $passagersAujourdhui ?></p>
                    </div>
                    <div class="flex flex-col w-1/3">
                        <h4 class="text-l font-semibold text-gray-700">Annuel</h4>
                        <p class="text-2xl font-bold text-red-500"><?= $passagersAnnuel ?></p>
                    </div>
                    <div class="flex flex-col w-1/3">
                        <h4 class="text-l font-semibold text-gray-700">Total</h4>
                        <p class="text-2xl font-bold text-red-500"><?= $passagersTotal ?></p>
                    </div>
                </div>
                <canvas id="passengerPieChart"></canvas>
            </div>

            <?php include "js/graph.php"; ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
</body>
</html>