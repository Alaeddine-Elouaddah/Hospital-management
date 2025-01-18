<?php
include("header.php");
if(isset($_POST['submit']))
{
    $message = "<strong>Cher(e) $_POST[name],</strong><br />
                <strong>Votre ID Email est :</strong> $_POST[email]<br />
                <strong>Message :-</strong> $_POST[comment]
                ";

    sendmail("yashikachinz1997@gmail.com", "Mail de l'application Appoint My Doctor", $message);

}
?>
<div class="wrapper col2">
    <div id="breadcrumb">
        <ul>
            <li class="first">Contactez-nous</li>
        </ul>
    </div>
</div>
<div class="wrapper col4">
    <div id="container">
        <h6>Notre adresse</h6>
        <p>
            Système de gestion hospitalière en ligne, Bangalore<br />
            <strong>Téléphone</strong>: 080 65110488<br />
            <strong>Email</strong>: ohms@gmail.com
        </p>

        <h6>Contactez-nous en entrant les informations suivantes</h6>
        <form action="" method="post">
            <p>
                <input type="text" name="name" id="name" value="" size="22" />
                <label for="name"><small>Nom (obligatoire)</small></label>
            </p>
            <p>
                <input type="text" name="email" id="email" value="" size="22" />
                <label for="email"><small>Email (obligatoire)</small></label>
            </p>
            <p>
                <textarea name="comment" id="comment" cols="100%" rows="10"></textarea>
                <label for="comment" style="display:none;"><small>Commentaire (obligatoire)</small></label>
            </p>
            <p>
                <input name="submit" type="submit" id="submit" value="Soumettre le formulaire"  />
                &nbsp;
                <input name="reset" type="reset" id="reset" tabindex="5" value="Réinitialiser le formulaire" />
            </p>
        </form>

    </div>

</div>

<div class="clear"></div>
</div>
</div>
<?php
include("footer.php");

function sendmail($toaddress, $subject, $message)
{
    require 'PHPMailer-master/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Activer la sortie de débogage détaillée

    $mail->isSMTP();                                      // Définir le serveur SMTP
    $mail->Host = 'mail.dentaldiary.in';  // Spécifier les serveurs SMTP principaux et de secours
    $mail->SMTPAuth = true;                               // Activer l'authentification SMTP
    $mail->Username = 'sendmail@dentaldiary.in';                 // Nom d'utilisateur SMTP
    $mail->Password = 'q1w2e3r4/';                           // Mot de passe SMTP
    $mail->SMTPSecure = 'tls';                            // Activer le chiffrement TLS, `ssl` également accepté
    $mail->Port = 587;                                    // Port TCP pour se connecter

    $mail->From = 'sendmail@dentaldiary.in';
    $mail->FromName = 'Web Mall';
    $mail->addAddress($toaddress, 'Joe User');     // Ajouter un destinataire
    $mail->addAddress($toaddress);               // Le nom est optionnel
    $mail->addReplyTo('aravinda@technopulse.in', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    $mail->addAttachment('/var/tmp/file.tar.gz');         // Ajouter des pièces jointes
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Nom optionnel
    $mail->isHTML(true);                                  // Définir le format de l'email en HTML

    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = $subject;

    if(!$mail->send()) {
        echo 'Le message n\'a pas pu être envoyé.';
        echo 'Erreur du Mailer: ' . $mail->ErrorInfo;
    } else {
        echo '<center><strong><font color=green>Email envoyé.</font></strong></center>';
    }
}
?>
