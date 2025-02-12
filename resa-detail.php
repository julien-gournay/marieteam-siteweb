<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include "head.php" ?> <!-- Fichiers qui inclu les paramètres du site (meta, link) -->
    <title>Destination - Marie Team</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="css/resa-detail.css"> <!-- CSS spécifique -->
</head>

<body>
    <?php
    include "navbar.php"; // Inclure la barre de navigation
    include "bdd.php"; // Fichier de connexion BDD

    if (isset($_GET["reference"])) { // Verification si la reférence dans l'URL n'est pas vide
        $reference = $_GET["reference"]; // Variable référence réservation
    }

    if ($mabase) {
        $res_resa = mysqli_query($cnt, "SELECT reservation.reference,reservation.idTrajet,client.nom,client.prenom,client.telephone,client.email,trajet.dateDepart,trajet.heureDepart,trajet.dateArrive,trajet.heureArrive,liaison.duree,port.ville,port.pays,port.photo FROM reservation,client,trajet,liaison,port WHERE reservation.reference='$reference' AND reservation.etat='Validé' AND reservation.idClient=client.idClient AND reservation.idTrajet=trajet.idTrajet AND trajet.idLiaison=liaison.idLiai AND liaison.idvilleArrivee=port.idVille;"); // Requête : Récupere toute les informations d'une réservation
        $res_resa2 = mysqli_query($cnt, "SELECT port.ville,port.pays,port.photo FROM reservation,client,trajet,liaison,port WHERE reservation.reference='$reference' AND reservation.etat='Validé' AND reservation.idClient=client.idClient AND reservation.idTrajet=trajet.idTrajet AND trajet.idLiaison=liaison.idLiai AND liaison.idvilleDepart=port.idVille;"); // Requête : Récupere toute les informations d'une réservation
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

    if ($mabase) {
        $res_resa = mysqli_query($cnt, "SELECT reservation.reference,reservation.idTrajet,client.nom,client.prenom,client.telephone,client.email,trajet.dateDepart,trajet.heureDepart,trajet.dateArrive,trajet.heureArrive,liaison.duree,port.ville,port.pays,port.photo FROM reservation,client,trajet,liaison,port WHERE reservation.reference='$reference' AND reservation.etat='Validé' AND reservation.idClient=client.idClient AND reservation.idTrajet=trajet.idTrajet AND trajet.idLiaison=liaison.idLiai AND liaison.idvilleArrivee=port.idVille;"); // Requête : Récupere toute les informations d'une réservation
        $res_resa2 = mysqli_query($cnt, "SELECT port.ville,port.pays,port.photo FROM reservation,client,trajet,liaison,port WHERE reservation.reference='$reference' AND reservation.etat='Validé' AND reservation.idClient=client.idClient AND reservation.idTrajet=trajet.idTrajet AND trajet.idLiaison=liaison.idLiai AND liaison.idvilleDepart=port.idVille;"); // Requête : Récupere toute les informations d'une réservation
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

    ?>
    <section id="sec-1">
        <div class="cadre">
            <div id="main-content">
                <!-- Contenu de votre page -->
                <div class="cadre-head">
                    <h1>Réservation #<?php echo ("$reference"); ?></h1>
                    <button onclick="return confirmerSuppression()">Annuler ma réservation</button>
                </div>
            </div>
            <div id="overlay"></div>
            <div id="confirmationDiv">
                <div class="confirmationDiv-ct">
                    <div class="confirmationDiv-titre">
                        <svg width="2rem" fill="#ffffff" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>warning</title>
                                <path d="M30.555 25.219l-12.519-21.436c-1.044-1.044-2.738-1.044-3.782 0l-12.52 21.436c-1.044 1.043-1.044 2.736 0 3.781h28.82c1.046-1.045 1.046-2.738 0.001-3.781zM14.992 11.478c0-0.829 0.672-1.5 1.5-1.5s1.5 0.671 1.5 1.5v7c0 0.828-0.672 1.5-1.5 1.5s-1.5-0.672-1.5-1.5v-7zM16.501 24.986c-0.828 0-1.5-0.67-1.5-1.5 0-0.828 0.672-1.5 1.5-1.5s1.5 0.672 1.5 1.5c0 0.83-0.672 1.5-1.5 1.5z"></path>
                            </g>
                        </svg>
                        <h2>ANNULATION DE VOTRE RESERVATION</h2>
                    </div>
                    <div class="confirmationDiv-texte">
                        <p><b>Êtes-vous sûr de vouloir supprimer cette réservation ?</b></p>
                        <p>En confirmant la suppression de cette réservation, vous acceptez d'annuler votre commande et ne pourrez revenir en arrière.</p>
                    </div>
                    <div class="confirmationDiv-bt">
                        <button class="confirmationDiv-bt-Sup" onclick="supprimerReservation()">Oui, supprimer</button>
                        <button class="confirmationDiv-bt-Ann" onclick="fermerConfirmation()">Fermer</button>
                    </div>
                </div>
            </div>


            <div class="cadre-content">
                <div class="cadre-content-recap">
                    <div class="cadre-content-recap-banniere">
                        <img src="<?php echo ("$photo"); ?>" alt="">
                        <div></div>
                    </div>
                    <div class="cadre-content-recap-voyage">
                        <h2>Détail du voyage</h2>
                        <div class="cadre-content-recap-voyage-detail">
                            <div class="cadre-content-recap-voyage-detail-box">
                                <p class="titre">Départ</p>
                                <p class="heure"><?php echo ("$heureDepart"); ?></p>
                                <p class="date"><?php echo ("$dateDepart"); ?></p>
                                <p class="ville"><?php echo ("$villeDepart, $paysDepart"); ?></p>

                                <p class="heure"><?php echo ("$heureDepart"); ?></p>
                                <p class="date"><?php echo ("$dateDepart"); ?></p>
                                <p class="ville"><?php echo ("$villeDepart, $paysDepart"); ?></p>
                            </div>
                            <div class="cadre-content-recap-voyage-detail-sépa">
                                <p class="temps"><?php echo ("$duree"); ?></p>
                            </div>
                            <div class="cadre-content-recap-voyage-detail-box">
                                <p class="titre">Arrivée</p>
                                <p class="heure"><?php echo ("$heureRetour"); ?></p>
                                <p class="date"><?php echo ("$dateRetour"); ?></p>
                                <p class="ville"><?php echo ("$villeRetour, $paysRetour"); ?></p>
                            </div>
                        </div>
                        <p class="cadre-content-recap-voyage-num">Traversée numéro <?php echo ("$idTraversé"); ?></p>
                        <div class="cadre-content-recap-voyage-imp">
                            <button onClick="window.print()">Imprimer la page</button>
                        </div>
                    </div>
                </div>
                <div class="cadre-content2">
                    <div class="cadre-content2-information">
                        <div class="cadre-content2-information-titre">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                <path d="M15 1.875C18.481 1.875 21.8194 3.25781 24.2808 5.71922C26.7422 8.18064 28.125 11.519 28.125 15C28.125 18.481 26.7422 21.8194 24.2808 24.2808C21.8194 26.7422 18.481 28.125 15 28.125C11.519 28.125 8.18064 26.7422 5.71922 24.2808C3.25781 21.8194 1.875 18.481 1.875 15C1.875 11.519 3.25781 8.18064 5.71922 5.71922C8.18064 3.25781 11.519 1.875 15 1.875ZM15 7.5C14.7619 7.4998 14.5265 7.54924 14.3086 7.64518C14.0908 7.74112 13.8953 7.88145 13.7347 8.05719C13.5742 8.23293 13.452 8.44023 13.3761 8.66585C13.3001 8.89146 13.2721 9.13044 13.2938 9.3675L13.9781 16.8787C14.0047 17.1313 14.1238 17.365 14.3125 17.535C14.5012 17.7049 14.7461 17.7989 15 17.7989C15.2539 17.7989 15.4988 17.7049 15.6875 17.535C15.8762 17.365 15.9953 17.1313 16.0219 16.8787L16.7044 9.3675C16.726 9.13059 16.698 8.89178 16.6222 8.66629C16.5464 8.4408 16.4244 8.23359 16.264 8.05788C16.1037 7.88217 15.9084 7.74181 15.6908 7.64575C15.4732 7.5497 15.2379 7.50006 15 7.5ZM15 22.5C15.3978 22.5 15.7794 22.342 16.0607 22.0607C16.342 21.7794 16.5 21.3978 16.5 21C16.5 20.6022 16.342 20.2206 16.0607 19.9393C15.7794 19.658 15.3978 19.5 15 19.5C14.6022 19.5 14.2206 19.658 13.9393 19.9393C13.658 20.2206 13.5 20.6022 13.5 21C13.5 21.3978 13.658 21.7794 13.9393 22.0607C14.2206 22.342 14.6022 22.5 15 22.5Z" fill="#FF8C0A" />
                            </svg>
                            <h2>Information Voyage</h2>
                        </div>
                        <div class="cadre-content2-information-message">
                            <p>Lors de votre enregistrement au port, un passeport vous sera demandé pour passer les contrôles à la frontière.</p>
                        </div>
                    </div>
                    <div class="cadre-content2-transaction">
                        <h2>Detail de la transaction</h2>
                        <div class="cadre-content2-transaction-ct">
                            <div class="cadre-content2-transaction-ct-cadres">
                                <div class="cadre-content2-transaction-ct-cadre">
                                    <div class="cadre-content2-transaction-ct-cadre-head">
                                        <img src="" alt="">
                                        <p>Passager</p>
                                    </div>
                                    <div class="cadre-content2-transaction-ct-cadre-ct">
                                        <p class="">Type</p>
                                        <p>0x Prix</p>
                                        <hr class="sepa">
                                        <p>0,00€</p>
                                    </div>
                                    <hr>
                                    <div class="cadre-content2-transaction-ct-cadre-ct">
                                        <p>Total</p>
                                        <hr>
                                        <p>0,00€</p>
                                    </div>
                                </div>

                                <div class="cadre-content2-transaction-ct-cadre">
                                    <div class="cadre-content2-transaction-ct-cadre-head">
                                        <img src="" alt="">
                                        <p>Véhicule</p>
                                    </div>
                                    <div class="cadre-content2-transaction-ct-cadre-ct">
                                        <p class="">Type</p>
                                        <p>0x Prix</p>
                                        <hr class="sepa">
                                        <p>0,00€</p>
                                    </div>
                                    <hr>
                                    <div class="cadre-content2-transaction-ct-cadre-ct">
                                        <p>Total</p>
                                        <hr>
                                        <p>0,00€</p>
                                    </div>
                                </div>
                            </div>
                            <p>Total de la réservation: <b>000€</b></p>
                        </div>
                    </div>
                    <div class="cadre-content2-client">
                        <h2>Client</h2>
                        <div class="">
                            <p><u>Nom/prénom</u> : <?php echo ("$nom $prenom"); ?></p>
                            <p><u>Numero Tel</u> : <?php echo ("$tel"); ?></p>
                            <p><u>Adresse mail</u> : <?php echo ("$mail"); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "footer.php" ?> <!-- Inclure le footer -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> <!-- Modules Flowbite (pour composant) -->
    <script src="js/resa-detail.js"></script> <!-- Scripts pour la page de détail -->
</body>

</html>