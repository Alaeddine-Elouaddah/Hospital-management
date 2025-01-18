<?php
session_start();
include("header.php");
include("dbconnection.php");
if(isset($_SESSION['patientid']))
{
    echo "<script>window.location='patientaccount.php';</script>";
}
if(isset($_POST['submit']))
{
    $sql = "SELECT * FROM patient WHERE loginid='$_POST[loginid]' AND status='Active'";
    $qsql = mysqli_query($con,$sql);
    if(mysqli_num_rows($qsql) >= 1)
    {
        $rslogin = mysqli_fetch_array($qsql);

        $msg = "Veuillez entrer votre identifiant de connexion : $rslogin[loginid] et le mot de passe : $rslogin[password] pour vous connecter à l'HMS..";
        ?>
        <iframe style="visibility:hidden" src="http://login.smsgatewayhub.com/api/mt/SendSMS?APIKey=qyQgcDu3EEiw1VfItgv1tA&senderid=WEBSMS&channel=1&DCS=0&flashsms=0&number=<?php echo $rslogin['mobileno']; ?>&text=<?php echo $msg; ?>&route=1"></iframe>
        <?php
        echo "<script>alert('Détails de connexion envoyés à votre numéro de téléphone enregistré...'); </script>";
        echo "<script>window.location='patientlogin.php';</script>";
    }
    else
    {
        echo "<script>alert('Identifiant de connexion invalide...'); </script>";
    }
}
?>
<div class="wrapper col2">
    <div id="breadcrumb">
        <ul>
            <li class="first">Récupérer le mot de passe</li>
        </ul>
    </div>
</div>
<div class="wrapper col4">
    <div id="container">
        <h1>Veuillez entrer l'identifiant de connexion pour récupérer le mot de passe..</h1>
        <form method="post" action="" name="frmpatlogin" onSubmit="return validateform()">
            <table width="200" border="3">
                <tbody>
                <tr>
                    <td width="34%">Identifiant de connexion</td>
                    <td width="66%"><input type="text" name="loginid" id="loginid" /></td>
                </tr>
                <tr>
                    <td height="36" colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Récupérer le mot de passe" /></td>
                </tr>
                </tbody>
            </table>
        </form>
        <p>&nbsp;</p>
    </div>
</div>
</div>
<div class="clear"></div>
</div>
</div>
<?php
include("footer.php");
?>
<script type="application/javascript">
    var alphaExp = /^[a-zA-Z]+$/; // Variable pour valider uniquement les lettres
    var alphaspaceExp = /^[a-zA-Z\s]+$/; // Variable pour valider uniquement les lettres et les espaces
    var numericExpression = /^[0-9]+$/; // Variable pour valider uniquement les numéros
    var alphanumericExp = /^[0-9a-zA-Z]+$/; // Variable pour valider les lettres et les numéros
    var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; // Variable pour valider un email

    function validateform()
    {
        if(document.frmpatlogin.loginid.value == "")
        {
            alert("L'identifiant de connexion ne doit pas être vide.");
            document.frmpatlogin.loginid.focus();
            return false;
        }
        else if(!document.frmpatlogin.loginid.value.match(alphanumericExp))
        {
            alert("L'identifiant de connexion n'est pas valide.");
            document.frmpatlogin.loginid.focus();
            return false;
        }
    }
</script>
