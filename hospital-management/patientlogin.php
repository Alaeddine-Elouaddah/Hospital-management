<?php
session_start();
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");

include("dbconnection.php");
if(isset($_SESSION['patientid']))
{
    echo "<script>window.location='patientaccount.php';</script>";
}
$err = '';
if(isset($_POST['submit']))
{
    $sql = "SELECT * FROM patient WHERE loginid='$_POST[loginid]' AND password='$_POST[password]' AND status='Active'";
    $qsql = mysqli_query($con,$sql);
    if(mysqli_num_rows($qsql) >= 1)
    {
        $rslogin = mysqli_fetch_array($qsql);
        $_SESSION['patientid'] = $rslogin['patientid'];
        echo "<script>window.location='patientaccount.php';</script>";
    }
    else
    {
        $err = "<div class='alert alert-danger'>
        <strong>Oh !</strong> Changez quelques informations et essayez à nouveau.
    </div>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGH - Connexion</title>
    <link href="assets/css/login-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="glass-container" style="height: 68%;">
    <div class="login-box">
        <h2>Gestion Hospitalière</h2>
        <p class="subtitle">Connectez-vous pour commencer votre session <b style="color: green">Patient</b></p>

        <?php if(!empty($err)): ?>
            <div class="error-message"><?php echo $err; ?></div>
        <?php endif; ?>

        <form method="post" action="" name="frmadminlogin" id="sign_in" onsubmit="return validateform()">
            <div class="input-group">
                <i class="material-icons input-icon">person</i>
                <input type="text" id="loginid" name="loginid" required placeholder="Nom d'utilisateur">
            </div>

            <div class="input-group">
                <i class="material-icons input-icon">lock</i>
                <input type="password" id="password" name="password" required placeholder="Mot de passe">
            </div>

            <div class="options">
                <input type="checkbox" id="rememberme" name="rememberme">
                <label for="rememberme">Se souvenir de moi</label>
                <a href="patientchangepassword.php">Changer Mot de passe</a>
            </div>

            <button type="submit" name="submit" id="submit">Connexion</button>

            <p>Merci de vous connecter. <a href="index.php" id="register">Retour à l'accueil</a></p>
        </form>
    </div>
</div>

</body>
</html>

<script type="application/javascript">
    var alphaExp = /^[a-zA-Z]+$/; //Variable pour valider uniquement les lettres
    var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable pour valider uniquement les lettres et les espaces
    var numericExpression = /^[0-9]+$/; //Variable pour valider uniquement les numéros
    var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable pour valider les lettres et les numéros
    var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable pour valider un email

    function validateform()
    {
        if(document.frmpatlogin.loginid.value == "")
        {
            alert("L'identifiant de connexion ne doit pas être vide.");
            document.frmpatlogin.loginid.focus();
            return false;
        }
        else if(document.frmpatlogin.password.value == "")
        {
            alert("Le mot de passe ne doit pas être vide.");
            document.frmpatlogin.password.focus();
            return false;
        }
        else if(document.frmpatlogin.password.value.length < 8)
        {
            alert("Le mot de passe doit comporter plus de 8 caractères.");
            document.frmpatlogin.password.focus();
            return false;
        }
    }
</script>
