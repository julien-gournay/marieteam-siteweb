<?php
    echo("<a href=\"\" onclick=\"confirmationMail('00000','julien.grny@gmail.com')\">Envoyer test</a>");
    function confirmationMail($idResa,$mailDestinaire,$prenom){
        //if (filter_var($mailDestinaire, FILTER_VALIDATE_EMAIL) === false) {
        //    echo "L'email est invalide.";
        //    return;
        //}

        $sujet = '⛴️ Confirmation de réservation';
        /*$message = '<body style="margin: 0px;font-family: \'Product Sans\', sans-serif; display: flex; flex-direction: column; align-items: center;">
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
    </body>';*/


        $message = "<html dir=\"ltr\" xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" lang=\"fr\">
 <head>
  <meta charset=\"UTF-8\">
  <meta content=\"width=device-width, initial-scale=1\" name=\"viewport\">
  <meta name=\"x-apple-disable-message-reformatting\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta content=\"telephone=no\" name=\"format-detection\">
  <title>Nouveau message</title>
  <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700,700i\"><!--<![endif]-->
  <style type=\"text/css\">
.rollover:hover .rollover-first {
  max-height:0px!important;
  display:none!important;
}
.rollover:hover .rollover-second {
  max-height:none!important;
  display:block!important;
}
.rollover span {
  font-size:0px;
}
u + .body img ~ div div {
  display:none;
}
#outlook a {
  padding:0;
}
span.MsoHyperlink,
span.MsoHyperlinkFollowed {
  color:inherit;
  mso-style-priority:99;
}
a.es-button {
  mso-style-priority:100!important;
  text-decoration:none!important;
}
a[x-apple-data-detectors],
#MessageViewBody a {
  color:inherit!important;
  text-decoration:none!important;
  font-size:inherit!important;
  font-family:inherit!important;
  font-weight:inherit!important;
  line-height:inherit!important;
}
.es-desk-hidden {
  display:none;
  float:left;
  overflow:hidden;
  width:0;
  max-height:0;
  line-height:0;
  mso-hide:all;
}
@media only screen and (max-width:600px) {.es-m-p0r { padding-right:0px!important } .es-m-p20b { padding-bottom:20px!important } .es-p-default { } *[class=\"gmail-fix\"] { display:none!important } p, a { line-height:150%!important } h1, h1 a { line-height:120%!important } h2, h2 a { line-height:120%!important } h3, h3 a { line-height:120%!important } h4, h4 a { line-height:120%!important } h5, h5 a { line-height:120%!important } h6, h6 a { line-height:120%!important } .es-header-body p { } .es-content-body p { } .es-footer-body p { } .es-infoblock p { } h1 { font-size:36px!important; text-aligne-items:left } h2 { font-size:26px!important; text-aligne-items:left } h3 { font-size:20px!important; text-aligne-items:left } h4 { font-size:24px!important; text-aligne-items:left } h5 { font-size:20px!important; text-aligne-items:left } h6 { font-size:16px!important; text-aligne-items:left } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:36px!important } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:26px!important } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important } .es-header-body h4 a, .es-content-body h4 a, .es-footer-body h4 a { font-size:24px!important } .es-header-body h5 a, .es-content-body h5 a, .es-footer-body h5 a { font-size:20px!important } .es-header-body h6 a, .es-content-body h6 a, .es-footer-body h6 a { font-size:16px!important } .es-menu td a { font-size:12px!important } .es-header-body p, .es-header-body a { font-size:14px!important } .es-content-body p, .es-content-body a { font-size:14px!important } .es-footer-body p, .es-footer-body a { font-size:14px!important } .es-infoblock p, .es-infoblock a { font-size:12px!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3, .es-m-txt-c h4, .es-m-txt-c h5, .es-m-txt-c h6 { text-aligne-items:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3, .es-m-txt-r h4, .es-m-txt-r h5, .es-m-txt-r h6 { text-aligne-items:right!important } .es-m-txt-j, .es-m-txt-j h1, .es-m-txt-j h2, .es-m-txt-j h3, .es-m-txt-j h4, .es-m-txt-j h5, .es-m-txt-j h6 { text-aligne-items:justify!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3, .es-m-txt-l h4, .es-m-txt-l h5, .es-m-txt-l h6 { text-aligne-items:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-m-txt-r .rollover:hover .rollover-second, .es-m-txt-c .rollover:hover .rollover-second, .es-m-txt-l .rollover:hover .rollover-second { display:inline!important } .es-m-txt-r .rollover span, .es-m-txt-c .rollover span, .es-m-txt-l .rollover span { line-height:0!important; font-size:0!important; display:block } .es-spacer { display:inline-table } a.es-button, button.es-button { font-size:20px!important; padding:10px 20px 10px 20px!important; line-height:120%!important } a.es-button, button.es-button, .es-button-border { display:inline-block!important } .es-m-fw, .es-m-fw.es-fw, .es-m-fw .es-button { display:block!important } .es-m-il, .es-m-il .es-button, .es-social, .es-social td, .es-menu { display:inline-block!important } .es-adaptive table, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .adapt-img { width:100%!important; height:auto!important } .es-mobile-hidden, .es-hidden { display:none!important } .es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } .h-auto { height:auto!important } }
@media screen and (max-width:384px) {.mail-message-content { width:414px!important } }
</style>
 </head>
 <body class=\"body\" style=\"width:100%;height:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0\">
  <div dir=\"ltr\" class=\"es-wrapper-color\" lang=\"fr\" style=\"background-color:#FAFAFA\"><!--[if gte mso 9]>
			<v:background xmlns:v=\"urn:schemas-microsoft-com:vml\" fill=\"t\">
				<v:fill type=\"tile\" color=\"#fafafa\"></v:fill>
			</v:background>
		<![endif]-->
   <table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" class=\"es-wrapper\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FAFAFA\">
     <tr>
      <td valigne-items=\"top\" style=\"padding:0;Margin:0\">
       <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"center\" class=\"es-content\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important\">
         <tr>
          <td aligne-items=\"center\" class=\"es-info-area\" style=\"padding:0;Margin:0\">
           <table aligne-items=\"center\" cellpadding=\"0\" cellspacing=\"0\" background-color=\"#00000000\" class=\"es-content-body\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px\" role=\"none\">
             <tr>
              <td aligne-items=\"left\" style=\"padding:20px;Margin:0\">
               <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                 <tr>
                  <td aligne-items=\"center\" valigne-items=\"top\" style=\"padding:0;Margin:0;width:560px\">
                   <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                     <tr>
                      <td aligne-items=\"center\" class=\"es-infoblock\" style=\"padding:0;Margin:0\"><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:18px;letter-spacing:0;color:#CCCCCC;font-size:12px\"><a target=\"_blank\" href=\"\" style=\"mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px\">View online version</a></p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"center\" class=\"es-header\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important;background-color:transparent;background-repeat:repeat;background-position:center top\">
         <tr>
          <td aligne-items=\"center\" style=\"padding:0;Margin:0\">
           <table background-color=\"#ffffff\" aligne-items=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"es-header-body\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px\">
             <tr>
              <td aligne-items=\"left\" style=\"padding:20px;Margin:0\">
               <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                 <tr>
                  <td valigne-items=\"top\" aligne-items=\"center\" class=\"es-m-p0r\" style=\"padding:0;Margin:0;width:560px\">
                   <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                     <tr>
                      <td aligne-items=\"center\" style=\"padding:0;Margin:0;padding-bottom:10px;font-size:0px\"><img src=\"https://ftemyoe.stripocdn.email/content/guids/CABINET_36e28c7c15934a4369adee2b04eff6fb5670824634ac7c41d0562cfac833a2ab/images/logo_marieteam.png\" alt=\"Logo\" width=\"200\" title=\"Logo\" class=\"adapt-img\" style=\"display:block;font-size:12px;border:0;outline:none;text-decoration:none\"></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"center\" class=\"es-content\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important\">
         <tr>
          <td aligne-items=\"center\" background-color=\"#3a2afa\" style=\"padding:0;Margin:0;background-color:#3a2afa\">
           <table background-color=\"#3A2AFA\" aligne-items=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"es-content-body\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#3A2AFA;width:600px\" role=\"none\">
             <tr>
              <td aligne-items=\"left\" style=\"Margin:0;padding-top:30px;padding-right:20px;padding-bottom:30px;padding-left:20px\">
               <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                 <tr>
                  <td aligne-items=\"center\" valigne-items=\"top\" style=\"padding:0;Margin:0;width:560px\">
                   <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                     <tr>
                      <td aligne-items=\"center\" style=\"padding:0;Margin:0;padding-bottom:10px\"><h1 class=\"es-m-txt-c\" style=\"Margin:0;font-family:arial, 'helvetica neue', helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:46px;font-style:normal;font-weight:bold;line-height:46px;color:#ffffff\">Confirmation réservation</h1></td>
                     </tr>
                   </table></td>
                 </tr>
                 <tr>
                  <td aligne-items=\"center\" valigne-items=\"top\" style=\"padding:0;Margin:0;width:560px\">
                   <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                     <tr>
                      <td aligne-items=\"center\" style=\"padding:0;Margin:0\"><h2 class=\"es-m-txt-c\" style=\"Margin:0;font-family:arial, 'helvetica neue', helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:26px;font-style:normal;font-weight:bold;line-height:31.2px;color:#CBDAFF\">Réservation <a target=\"_blank\" style=\"mso-line-height-rule:exactly;text-decoration:underline;color:#CBDAFF;font-size:26px\" href=\"\">#$idResa</a></h2></td>
                     </tr>
                     <tr>
                      <td aligne-items=\"center\" height=\"59\" style=\"padding:0;Margin:0;font-size:0\"></td>
                     </tr>
                     <tr>
                      <td aligne-items=\"center\" style=\"padding:0;Margin:0\"><span class=\"es-button-border\" style=\"border-style:solid;border-color:#5c68e2;background:#CBDAFF;border-width:0;display:inline-block;border-radius:24px;width:auto\"><a href=\"marieteam.donovanmercier.fr/resa-detail.php?reference=$idResa\" target=\"_blank\" class=\"es-button\" style=\"mso-style-priority:100 !important;text-decoration:none !important;mso-line-height-rule:exactly;color:#333333;font-size:20px;padding:10px 30px;display:inline-block;background:#CBDAFF;border-radius:24px;font-family:'source sans pro', 'helvetica neue', helvetica, arial, sans-serif;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-aligne-items:center;letter-spacing:0;mso-padding-alt:0;mso-border-alt:10px solid #CBDAFF;border-left-width:30px;border-right-width:30px\">Gérer ma réservation</a></span></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"center\" class=\"es-content\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important\">
         <tr>
          <td aligne-items=\"center\" style=\"padding:0;Margin:0\">
           <table background-color=\"#ffffff\" aligne-items=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"es-content-body\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px\">
             <tr>
              <td aligne-items=\"left\" style=\"padding:0;Margin:0;padding-right:20px;padding-left:20px;padding-top:35px\"><!--[if mso]><table style=\"width:560px\" cellpadding=\"0\" cellspacing=\"0\"><tr><td style=\"width:193px\" valigne-items=\"top\"><![endif]-->
               <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"left\" class=\"es-left\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left\">
                 <tr>
                  <td aligne-items=\"left\" class=\"es-m-p20b\" style=\"padding:0;Margin:0;width:173px\">
                   <table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                     <tr>
                      <td aligne-items=\"left\" background-color=\"#cbdaff\" style=\"padding:10px;Margin:0\"><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">VILLE DEPART, FR</p><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">DATE</p><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">Heure</p></td>
                     </tr>
                   </table></td>
                  <td class=\"es-hidden\" style=\"padding:0;Margin:0;width:20px\"></td>
                 </tr>
               </table><!--[if mso]></td><td style=\"width:173px\" valigne-items=\"top\"><![endif]-->
               <table cellspacing=\"0\" aligne-items=\"left\" cellpadding=\"0\" class=\"es-left\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left\">
                 <tr>
                  <td aligne-items=\"left\" class=\"es-m-p20b\" style=\"padding:0;Margin:0;width:173px\">
                   <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                     <tr>
                      <td aligne-items=\"center\" style=\"padding:0;Margin:0;font-size:0\"><img src=\"https://ftemyoe.stripocdn.email/content/guids/CABINET_36e28c7c15934a4369adee2b04eff6fb5670824634ac7c41d0562cfac833a2ab/images/transportation_transport_ferry_boat_train_ferry_boat_ship256.png\" alt=\"\" width=\"83\" style=\"display:block;font-size:14px;border:0;outline:none;text-decoration:none\"></td>
                     </tr>
                   </table></td>
                 </tr>
               </table><!--[if mso]></td><td style=\"width:20px\"</td><td style=\"width:174px\" valigne-items=\"top\"><![endif]-->
               <table cellspacing=\"0\" aligne-items=\"right\" cellpadding=\"0\" class=\"es-right\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right\">
                 <tr>
                  <td aligne-items=\"left\" style=\"padding:0;Margin:0;width:174px\">
                   <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                     <tr>
                      <td aligne-items=\"left\" background-color=\"#cbdaff\" style=\"padding:10px;Margin:0\"><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">VILLE ARRIVEE, FR</p><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">DATE</p><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">Heure</p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table><!--[if mso]></td></tr></table><![endif]--></td>
             </tr>
             <tr>
              <td aligne-items=\"left\" style=\"padding:20px;Margin:0\">
               <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                 <tr>
                  <td aligne-items=\"left\" style=\"padding:0;Margin:0;width:560px\">
                   <table width=\"100%\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                     <tr>
                      <td aligne-items=\"left\" style=\"padding:0;Margin:0\"><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">Votre réservation XXXX vers XXXX à bien été pris en compte.</p><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">Veillez conserver votre référence de réservation.</p></td>
                     </tr>
                     <tr>
                      <td aligne-items=\"center\" height=\"40\" style=\"padding:0;Margin:0;font-size:0\"></td>
                     </tr>
                     <tr>
                      <td aligne-items=\"center\" style=\"padding:0;Margin:0;font-size:0\"><img src=\"https://ftemyoe.stripocdn.email/content/guids/CABINET_36e28c7c15934a4369adee2b04eff6fb5670824634ac7c41d0562cfac833a2ab/images/gc7e62150d438783f8ae639824ae0fbdd0c614039520c8eff01edc004278cf017c959ac3ea5fd5ae01fbaaf0d79111ef6_640.jpeg\" alt=\"\" width=\"560\" class=\"adapt-img\" style=\"display:block;font-size:14px;border:0;outline:none;text-decoration:none;border-radius:19px\"></td>
                     </tr>
                     <tr>
                      <td aligne-items=\"center\" style=\"padding:20px;Margin:0;font-size:0\">
                       <table height=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\" class=\"es-spacer\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                         <tr>
                          <td style=\"padding:0;Margin:0;background:none;height:0px;width:100%;margin:0px;border-bottom:1px solid #cccccc\"></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
             <tr>
              <td aligne-items=\"left\" class=\"esdev-adapt-off\" style=\"Margin:0;padding-bottom:10px;padding-right:20px;padding-left:20px;padding-top:10px\">
               <table cellpadding=\"0\" cellspacing=\"0\" class=\"esdev-mso-table\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:560px\">
                 <tr>
                  <td class=\"es-m-w0\" style=\"padding:0;Margin:0;width:20px\"></td>
                  <td valigne-items=\"top\" class=\"esdev-mso-td\" style=\"padding:0;Margin:0\">
                   <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"left\" class=\"es-left\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left\">
                     <tr>
                      <td aligne-items=\"center\" style=\"padding:0;Margin:0;width:355px\">
                       <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                         <tr>
                          <td aligne-items=\"left\" style=\"padding:0;Margin:0\"><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\"><strong>Billet Adulte</strong></p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                  <td class=\"es-m-w0\" style=\"padding:0;Margin:0;width:20px\"></td>
                  <td valigne-items=\"top\" class=\"esdev-mso-td\" style=\"padding:0;Margin:0\">
                   <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"left\" class=\"es-left\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left\">
                     <tr>
                      <td aligne-items=\"left\" style=\"padding:0;Margin:0;width:80px\">
                       <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                         <tr>
                          <td aligne-items=\"center\" style=\"padding:0;Margin:0\"><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">2 billets</p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                  <td class=\"es-m-w0\" style=\"padding:0;Margin:0;width:20px\"></td>
                  <td valigne-items=\"top\" class=\"esdev-mso-td\" style=\"padding:0;Margin:0\">
                   <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"right\" class=\"es-right\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right\">
                     <tr>
                      <td aligne-items=\"left\" style=\"padding:0;Margin:0;width:85px\">
                       <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                         <tr>
                          <td aligne-items=\"right\" style=\"padding:0;Margin:0\"><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">10 €</p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
             <tr>
              <td aligne-items=\"left\" class=\"esdev-adapt-off\" style=\"Margin:0;padding-bottom:10px;padding-right:20px;padding-left:20px;padding-top:10px\">
               <table cellpadding=\"0\" cellspacing=\"0\" class=\"esdev-mso-table\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:560px\">
                 <tr>
                  <td class=\"es-m-w0\" style=\"padding:0;Margin:0;width:20px\"></td>
                  <td valigne-items=\"top\" class=\"esdev-mso-td\" style=\"padding:0;Margin:0\">
                   <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"left\" class=\"es-left\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left\">
                     <tr>
                      <td aligne-items=\"center\" style=\"padding:0;Margin:0;width:355px\">
                       <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                         <tr>
                          <td aligne-items=\"left\" style=\"padding:0;Margin:0\"><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\"><strong>Enfant</strong></p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                  <td class=\"es-m-w0\" style=\"padding:0;Margin:0;width:20px\"></td>
                  <td valigne-items=\"top\" class=\"esdev-mso-td\" style=\"padding:0;Margin:0\">
                   <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"left\" class=\"es-left\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left\">
                     <tr>
                      <td aligne-items=\"left\" style=\"padding:0;Margin:0;width:80px\">
                       <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                         <tr>
                          <td aligne-items=\"center\" style=\"padding:0;Margin:0\"><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">1 billets</p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                  <td class=\"es-m-w0\" style=\"padding:0;Margin:0;width:20px\"></td>
                  <td valigne-items=\"top\" class=\"esdev-mso-td\" style=\"padding:0;Margin:0\">
                   <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"right\" class=\"es-right\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right\">
                     <tr>
                      <td aligne-items=\"left\" style=\"padding:0;Margin:0;width:85px\">
                       <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                         <tr>
                          <td aligne-items=\"right\" style=\"padding:0;Margin:0\"><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">10 €</p></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
             <tr>
              <td aligne-items=\"left\" style=\"padding:0;Margin:0;padding-right:20px;padding-left:20px;padding-top:10px\">
               <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                 <tr>
                  <td aligne-items=\"center\" class=\"es-m-p0r\" style=\"padding:0;Margin:0;width:560px\">
                   <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-top:2px solid #efefef;border-bottom:2px solid #efefef\" role=\"presentation\">
                     <tr>
                      <td aligne-items=\"right\" style=\"padding:0;Margin:0;padding-top:10px;padding-bottom:20px\"><p class=\"es-m-txt-r\" style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">Total : <strong>00,00 €</strong></p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
             <tr>
              <td aligne-items=\"left\" style=\"Margin:0;padding-bottom:10px;padding-right:20px;padding-left:20px;padding-top:20px\">
               <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"left\" class=\"es-left\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left\">
                 <tr>
                  <td aligne-items=\"center\" class=\"es-m-p0r es-m-p20b\" style=\"padding:0;Margin:0;width:560px\">
                   <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                     <tr>
                      <td aligne-items=\"left\" style=\"padding:0;Margin:0\"><h4 style=\"Margin:0;font-family:arial, 'helvetica neue', helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:24px;font-style:normal;font-weight:normal;line-height:28.8px;color:#3A2AFA\"><strong>Information clients</strong></h4></td>
                     </tr>
                     <tr>
                      <td aligne-items=\"left\" style=\"padding:0;Margin:0\"><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">Nom et prénom: <strong>sarah_powell@domain.com</strong></p><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">Adresse mail: <strong> $mailDestinaire</strong></p><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px\">Tel: <strong>00000000</strong></p></td>
                     </tr>
                     <tr>
                      <td aligne-items=\"center\" height=\"40\" style=\"padding:0;Margin:0;font-size:0\"></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"center\" class=\"es-footer\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important;background-color:transparent;background-repeat:repeat;background-position:center top\">
         <tr>
          <td aligne-items=\"center\" background-color=\"#3a2afa\" style=\"padding:0;Margin:0;background-color:#3a2afa\">
           <table aligne-items=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"es-footer-body\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:640px\" role=\"none\">
             <tr>
              <td aligne-items=\"left\" style=\"Margin:0;padding-right:20px;padding-left:20px;padding-bottom:20px;padding-top:20px\">
               <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                 <tr>
                  <td aligne-items=\"left\" style=\"padding:0;Margin:0;width:600px\">
                   <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                     <tr>
                      <td aligne-items=\"left\" style=\"padding:0;Margin:0;font-size:0\"><img src=\"https://ftemyoe.stripocdn.email/content/guids/CABINET_36e28c7c15934a4369adee2b04eff6fb5670824634ac7c41d0562cfac833a2ab/images/group_36.png\" alt=\"\" width=\"300\" class=\"adapt-img\" style=\"display:block;font-size:14px;border:0;outline:none;text-decoration:none\"></td>
                     </tr>
                     <tr>
                      <td aligne-items=\"center\" style=\"padding:0;Margin:0;padding-bottom:35px\"><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:18px;letter-spacing:0;color:#ffffff;font-size:12px\">Marie Team est la compagnie numéro 1 dans le transport maritime par ferry. Elle vous accompagne au quotidien.</p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table cellpadding=\"0\" cellspacing=\"0\" aligne-items=\"center\" class=\"es-content\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important\">
         <tr>
          <td aligne-items=\"center\" class=\"es-info-area\" style=\"padding:0;Margin:0\">
           <table aligne-items=\"center\" cellpadding=\"0\" cellspacing=\"0\" background-color=\"#00000000\" class=\"es-content-body\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px\" role=\"none\">
             <tr>
              <td aligne-items=\"left\" style=\"padding:20px;Margin:0\">
               <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"none\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                 <tr>
                  <td aligne-items=\"center\" valigne-items=\"top\" style=\"padding:0;Margin:0;width:560px\">
                   <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">
                     <tr>
                      <td aligne-items=\"center\" class=\"es-infoblock\" style=\"padding:0;Margin:0\"><p style=\"Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:18px;letter-spacing:0;color:#CCCCCC;font-size:12px\"><a target=\"_blank\" href=\"\" style=\"mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px\"></a>No longer want to receive these emails?&nbsp;<a href=\"\" target=\"_blank\" style=\"mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px\">Unsubscribe</a>.<a target=\"_blank\" href=\"\" style=\"mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px\"></a></p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table></td>
     </tr>
   </table>
  </div>
 </body>
</html>";





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