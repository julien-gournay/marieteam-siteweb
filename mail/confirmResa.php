<body style="margin: 0px;font-family: 'Product Sans', sans-serif; display: flex; flex-direction: column; align-items: center;">
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
                Votre réservation '.$idResa.' à destination de '.$VilleArrivee.' à bien été enregistré.<br>
                Vous pouvez consulter les details de votre commande via le lien.
            </p>
        </div>
    </section>
</body>