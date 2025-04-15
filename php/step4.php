<?php
    include "bdd.php"; // Connexion DB
    include "mail.php";
    session_start(); // Ouverture d'une session pour stocker les données
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nomClient = $_POST['nom'];
        $prenomClient = $_POST['prenom'];
        $telClient = $_POST['tel'];
        $emailClient = $_POST['email'];

        $_SESSION['nomClient'] = $nomClient;
        $_SESSION['prenomClient'] = $prenomClient;
        $_SESSION['telClient'] = $telClient;
        $_SESSION['emailClient'] = $emailClient;

        echo "<span style='color: green; '><b>✅ Données sauvegardé en session.</b></span><br>";
        //header('Location: ../booking-step4.php'); // Redirection étape 4 réservation

        // Paramètres de connexion à la base de données
        $host = 'localhost';
        $dbname = 'marieteam';
        $username = 'root';
        $password = '';

        try {
            // Connexion à la base de données
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Début de la transaction
            $pdo->beginTransaction();

            // Vérification si le client existe déjà
            $checkClientQuery = "SELECT idClient FROM client WHERE nom = :nom AND prenom = :prenom AND telephone = :telephone AND email = :email";
            $stmtCheckClient = $pdo->prepare($checkClientQuery);
            $stmtCheckClient->execute([
                ':nom' => $_SESSION['nomClient'],
                ':prenom' => $_SESSION['prenomClient'],
                ':telephone' => $_SESSION['telClient'],
                ':email' => $_SESSION['emailClient']
            ]);
            $existingClient = $stmtCheckClient->fetch(PDO::FETCH_ASSOC);

            if ($existingClient) {
                // Le client existe, récupérer son ID
                $idClient = $existingClient['idClient'];
                echo "<span style='color: blue; '><b>❗ Le client existe déja sous l'id $idClient.</b></span><br>";

            } else {
                    // Étape 1 : Insérer un nouveau client
            $clientQuery = "INSERT INTO client (nom, prenom, telephone, email) 
                            VALUES (:nom, :prenom, :telephone, :email)";
            $stmtClient = $pdo->prepare($clientQuery);
            $stmtClient->execute([
                ':nom' => $_SESSION['nomClient'],
                ':prenom' => $_SESSION['prenomClient'],
                ':telephone' => $_SESSION['telClient'],
                ':email' => $_SESSION['emailClient']
            ]);
            

            // Récupérer l'ID du client inséré
            $idClient = $pdo->lastInsertId();
            echo "<span style='color: green; '><b>✅ Client inséré avec succés sous l'id $idClient.</b></span><br>";
            }

            // Étape 2 : Insérer une réservation associée
            $reservationQuery = "INSERT INTO reservation (reference, idClient, idTrajet, etat) 
                                VALUES (:reference, :idClient, :idTrajet, :etat)";
            $stmtReservation = $pdo->prepare($reservationQuery);
            $stmtReservation->execute([
                ':reference' => '',
                ':idClient' => $idClient,
                ':idTrajet' => $_SESSION['idTrajet'], // Remplacez par un ID valide de trajet
                ':etat' => 'Validé'
            ]);

            // Récupérer l'ID de la réservation la plus récente, triée par dateCreation décroissante
            $reservationIdQuery = "SELECT reference FROM reservation 
                                   WHERE idClient = :idClient 
                                   ORDER BY dateResa DESC LIMIT 1";
            $stmtReservationId = $pdo->prepare($reservationIdQuery);
            $stmtReservationId->execute([
                ':idClient' => $idClient
            ]);
            $idReservation = $stmtReservationId->fetch(PDO::FETCH_ASSOC)['reference'];
            echo "<span style='color: green; '><b>✅ Réservation insérée avec succès sous l'id $idReservation</b></span><br>";


            // Étape 3 : Insérer les billets dans la table billets
            if (isset($_SESSION['billet']) && is_array($_SESSION['billet'])) {
                // Boucle pour insérer chaque billet
                foreach ($_SESSION['billet'] as $idType => $quantite) {
                    // Vérification que la quantité est un nombre positif
                    if (is_numeric($quantite) && $quantite > 0) {
                        $billetQuery = "INSERT INTO billet (reference, idType, quantite) 
                                        VALUES (:reference, :idType, :quantite)";
                        $stmtBillet = $pdo->prepare($billetQuery);
                        $stmtBillet->execute([
                            ':reference' => $idReservation,  // Si tu as un mécanisme pour générer une référence, mets-le ici.
                            ':idType' => $idType,
                            ':quantite' => $quantite,
                        ]);
                        echo "<span style='color: green; '><b>✅ Billet inséré pour le type $idType avec quantité $quantite.</b></span><br>";
                    }
                }
            }

            // Valider la transaction
            $pdo->commit();
            session_destroy(); // 
            session_start(); // Ouverture d'une session pour stocker les données
            $_SESSION['idReservation'] = $idReservation;
            echo "<span style='color: green; '><b>✅ Transaction validée avec succés</b></span><br>";
            echo extension_loaded('intl') ? 'L\'extension intl est activée.' : 'L\'extension intl n\'est PAS activée.';



            if($mabase){
                $res_resa = mysqli_query($cnt,"SELECT trajet.dateDepart,trajet.heureDepart,trajet.dateArrivee,trajet.heureArrivee,port.ville,port.pays,port.photo FROM reservation,trajet,liaison,port WHERE reservation.reference='$idReservation' AND reservation.idTrajet=trajet.idTrajet AND trajet.idLiaison=liaison.idLiai AND liaison.idvilleArrivee=port.idVille;"); // Requête : Récupere toute les informations d'une réservation
                $res_resa2 = mysqli_query($cnt,"SELECT port.ville,port.pays FROM reservation,trajet,liaison,port WHERE reservation.reference='$idReservation' AND reservation.idTrajet=trajet.idTrajet AND trajet.idLiaison=liaison.idLiai AND liaison.idvilleDepart=port.idVille;"); // Requête : Récupere toute les informations d'une réservation
            }
            while ($tab = mysqli_fetch_row($res_resa)) { // Récupération des infos
                $dateDepart = $tab[0]; // Variable Date depart selectionnée
                $heureDepart = $tab[1]; // Variable Date depart selectionnée
                $dateArrivee = $tab[2]; // Variable Date depart selectionnée*
                $heureArrivee = $tab[3]; // Variable Date depart selectionnée
                $villeRetour = $tab[4]; // Variable ville arrivée
                $paysRetour = $tab[5]; // Variable pays arrivée
                $photo = $tab[6]; // Variable photo destination
                break;
            }
            while ($tab = mysqli_fetch_row($res_resa2)) { // Récupération des infos
                $villeDepart = $tab[0]; // Variable référence réservation
                $paysDepart = $tab[1]; // Variable id Trajet
                break;
            }

            $sent = confirmationMail($idReservation, $emailClient, $telClient, $prenomClient, $nomClient, $dateDepart, $heureDepart, $dateArrivee, $heureArrivee, $villeDepart, $paysDepart, $villeRetour, $paysRetour, $photo);
            if ($sent) {
                echo "<span style='color: green;'><b>✅ Confirmation mail envoyé avec succès.</b></span><br>";
            } else {
                echo "<span style='color: red;'><b>❌ Échec de l'envoi du mail de confirmation.</b></span><br>";
            }

            header('Location: ../booking-confirm.php'); // Redirection
        } catch (Exception $e) {
            // Annuler la transaction en cas d'erreur
            $pdo->beginTransaction();
            $pdo->rollBack();
            echo "Erreur : " . $e->getMessage();
        }


    } else{
        $_SESSION['error_message'] = "Le formulaire est incomplet ou vide."; // Stock le message d'erreur à return
        echo '<span style="color: red;">❌ Le formulaire est incomplet ou vide.</span>';
        header('Location: ../booking-step4.php'); // Redirection étape 4 réservation
        exit();
    }
?>