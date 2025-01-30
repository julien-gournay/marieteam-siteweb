<?php
    echo("<a href=\"\" onclick=\"confirmationMail('00000','julien.grny@gmail.com')\">Envoyer test</a>");
    function confirmationMail($idResa,$mailDestinaire,$prenom){
        //if (filter_var($mailDestinaire, FILTER_VALIDATE_EMAIL) === false) {
        //    echo "L'email est invalide.";
        //    return;
        //}

        $sujet = '⛴️ Confirmation de réservation';
        $message = '<body style="margin: 0px;font-family: \'Product Sans\', sans-serif; display: flex; flex-direction: column; align-items: center;">
        <header>
            <img style="width: 15rem; padding: 2rem;" src="https://marieteam.juliengournay.fr/logosvg_bleu.svg" alt="">
        </header>
        <section style="width: 100vw; display: flex; flex-direction: column; align-items: center;">
            <div style="background-color: #3a2afa; color:white; height: 20vh; width: -webkit-fill-available; padding: 2rem; display: flex; flex-direction: column; align-items: center;">
                <h1>Confirmation de réservation</h1>
                <p>#'.$idResa.'</p>
            </div>
            <div style="background-color: #cbdaff; width: 70vw; padding: 2rem; border-radius: 15px; position: relative; top: -2rem;">
                <img src="" alt="">
                <p>Bonjour '.$prenom.'<br>
                    Votre réservation '.$idResa.' à bien été enregistré.<br>
                    Vous pouvez consulter les details de votre commande via le lien.
                </p>
            </div>
        </section>
    </body>';
        $destinataire = "$mailDestinaire";
        $header = "From:\"Marie Team\"<contact@juliengournay.fr>\n";
        $header .="Reply-To:marieteam@gmail.com\n";
        $header .= "Content-Type: text/html; charset=\"iso-8859-1\"";
        if (mail($destinataire, $sujet, $message, $header)){
            echo "L'email a été envoyé avec succès";
        } else{
            echo "L'email n'a pas été envoyé";
        }
    }
?>