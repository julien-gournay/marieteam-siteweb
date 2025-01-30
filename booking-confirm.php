<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Marie Team</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="css/confirm.css"> <!-- CSS spécifique -->
</head>
<body>
    <?php 
        include "navbar.php"; // Inclure la barre de navigation
        include "bdd.php"; // Fichier de connexion BDD

        session_start(); // Ouverture d'une session pour stocker les données
        if(isset($_SESSION['idReservation'])){ // Verification si la reférence n'est pas vide
            $reference = $_SESSION['idReservation']; // Variable Ville depart selectionnée
        } else{
            $_SESSION['error_message'] = "Une erreur est survenue, nous n'arrivons pas à recupérer votre réservation. Veillez vérifier vos mails, pour être sur que celle ci à bien été effectué."; // Stock le message d'erreur à return
            echo '<span style="color: red;">❌ Récupération de la réservation impossible.</span>';
            header('Location: ../booking-step4.php'); // Redirection étape 4 réservation
        }
        
        if($mabase){
            $res_resa = mysqli_query($cnt,"SELECT reservation.reference,reservation.idTrajet,client.nom,client.prenom,client.telephone,client.email,trajet.dateDepart,trajet.heureDepart,trajet.dateArrive,trajet.heureArrive,liaison.duree,port.ville,port.pays,port.photo FROM reservation,client,trajet,liaison,port WHERE reservation.reference='$reference' AND reservation.etat='Validé' AND reservation.idClient=client.idClient AND reservation.idTrajet=trajet.idTrajet AND trajet.idLiaison=liaison.idLiai AND liaison.idvilleArrivee=port.idVille;"); // Requête : Récupere toute les informations d'une réservation
            $res_resa2 = mysqli_query($cnt,"SELECT port.ville,port.pays,port.photo FROM reservation,client,trajet,liaison,port WHERE reservation.reference='$reference' AND reservation.etat='Validé' AND reservation.idClient=client.idClient AND reservation.idTrajet=trajet.idTrajet AND trajet.idLiaison=liaison.idLiai AND liaison.idvilleDepart=port.idVille;"); // Requête : Récupere toute les informations d'une réservation
        }

        while ($tab = mysqli_fetch_row($res_resa)) { // Récupération des infos
            $reference = $tab[0]; // Variable référence réservation
            $idTraversé = $tab[1]; // Variable id Trajet
            $nom = $tab[2]; // Variable nom client
            $prenom = $tab[3]; // Variable prenom client
            $tel = $tab[4]; // Variable tel client
            $mail = $tab[5]; // Variable mail client
            $dateDepart = $tab[6]; // Variable date départ
            $heureDepart = $tab[7]; // Variable heure départ
            $dateRetour = $tab[8]; // Variable date arrivée
            $heureRetour = $tab[9]; // Variable heure arrivée
            $duree = $tab[10]; // Variable durée trajet
            $villeRetour = $tab[11]; // Variable ville arrivée
            $paysRetour = $tab[12]; // Variable pays arrivée
            $photo = $tab[13]; // Variable photo destination
            break;
        }
        while ($tab = mysqli_fetch_row($res_resa2)) { // Récupération des infos
            $villeDepart = $tab[0]; // Variable référence réservation
            $paysDepart = $tab[1]; // Variable id Trajet
            $photoDepart = $tab[2]; // Variable nom client
            break;
        }

        $heureDepart = date("H\hi", strtotime($heureDepart));  // H:i correspond à l'heure et minutes uniquement
        $heureRetour = date("H\hi", strtotime($heureRetour));  // H:i correspond à l'heure et minutes uniquement
        $duree = date("H\hi", strtotime($duree));  // H:i correspond à l'heure et minutes uniquement

        $date = new DateTimeImmutable($dateDepart);
    ?>

    <!-- ##### SECTION ETAPE 3 : TRAJETS  ##### -->
    <section id="sec-1">
        <div class="sec1-content">
            <div class="cadre">
                <div class="cadre-ctn">
                    <div class="cadre-ctn-entete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M55 30C55 43.807 43.807 55 30 55C16.1929 55 5 43.807 5 30C5 16.1929 16.1929 5 30 5C43.807 5 55 16.1929 55 30ZM40.0758 22.4242C40.808 23.1564 40.808 24.3436 40.0758 25.0758L27.5758 37.5758C26.8435 38.308 25.6565 38.308 24.9242 37.5758L19.9242 32.5758C19.1919 31.8435 19.1919 30.6565 19.9242 29.9242C20.6564 29.192 21.8436 29.192 22.5758 29.9242L26.25 33.5982L31.837 28.0112L37.4242 22.4242C38.1565 21.6919 39.3435 21.6919 40.0758 22.4242Z" fill="#008767"/>
                        </svg>
                        <div class="cadre-ctn-entete-txt">
                            <p class="p_titre">Votre réservation a bien été effectuée !</p>
                            <p class="p_ref">#<?php echo("$reference"); ?></p>
                        </div>
                    </div>
                    <div class="cadre-ctn-info">
                        <p>Vous recevrez un mail contenant les informations de votre réservation à l’adresse mail : <?php echo("$mail"); ?></p>
                        <p>Veillez ne pas perdre votre référence de réservation.</p>
                        <p>La montée sur le bateau s’effectue jusqu'à 5 minutes avant le départ.</p>
                    </div>
                    <div class="cadre-ctn-recap">
                        <p class="p_stitre">Recapitalisation de votre réservation</p>
                        <div class="cadre-ctn-recap-cd">
                            <div class="cadre-ctn-recap-cd-info">
                                <p><?php echo $date->format('l \t\h\e jS'); ?></p>
                                <div class="cadre-ctn-recap-cd-info_txt">
                                    <div class="cadre-ctn-recap-cd-info-txt-hr">
                                        <p class="p_heure"><?php echo("$heureDepart"); ?></p>
                                        <hr>
                                        <p class="p_heure"><?php echo("$heureRetour"); ?></p>
                                    </div>
                                    <div class="cadre-ctn-recap-cd-info-txt-lieu">
                                        <p class="p_lieu"><?php echo("$villeDepart, $paysDepart"); ?></p>
                                        <div class="cadre-ctn-recap-cd-info-txt-lieu-bat">
                                            <p class="p_bat"><?php echo("$duree"); ?></p>
                                            <p class="p_bat">Traversé n° <?php echo("$idTraversé"); ?></p>
                                        </div>
                                        <p class="p_lieu"><?php echo("$villeRetour, $paysRetour"); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="cadre-ctn-recap-cd-qrcode">
                                <?php
                                    $data = 'localhost/marieteam/resa-detail.php?reference='.$reference; // Contenu du QR code
                                    $encodedData = urlencode($data);
                                    $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=$encodedData";

                                    echo '<img src="' . $qrCodeUrl . '" alt="QR Code">';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="cadre-ctn-bt">
                    <button onclick="window.location='resa-detail.php?reference=<?php echo htmlspecialchars($reference, ENT_QUOTES, 'UTF-8'); ?>';">Gérer ma réservation</button>
                        <button onClick="window.print()">Imprimer la page</button>
                    </div>
                </div>
            </div>
            <div class="cadre-img">
                <img src="<?php echo("$photo"); ?>" alt="">
            </div>
        </div>
    </section>

    <?php include "footer.php" ?> <!-- Inclure le footer -->

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> <!-- Modules Flowbite (pour composant) -->
</body>
</html>