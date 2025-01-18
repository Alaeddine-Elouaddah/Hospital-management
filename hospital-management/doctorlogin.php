<?php
session_start();
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");

include("dbconnection.php");

if(isset($_SESSION['doctorid']))
{
    echo "<script>window.location='doctoraccount.php';</script>";
}

$err = '';
if(isset($_POST['submit']))
{
    $sql = "SELECT * FROM doctor WHERE loginid='$_POST[loginid]' AND password='$_POST[password]' AND status='Active'";
    $qsql = mysqli_query($con,$sql);
    if(mysqli_num_rows($qsql) == 1)
    {
        $rslogin = mysqli_fetch_array($qsql);
        $_SESSION['doctorid'] = $rslogin['doctorid'];
        echo "<script>window.location='doctoraccount.php';</script>";
    }
    else
    {
        $err = "<div class='alert alert-danger'>
        <strong>Oh !</strong> Modifiez quelques éléments et essayez de soumettre à nouveau.
        </div>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - Gestion Hospitalière</title>
    <link href="assets/css/login-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="glass-container" style="height: 68%;">
    <div class="login-box">
        <h2>Gestion Hospitalière</h2>
        <p class="subtitle">Connectez-vous pour commencer votre session <b style="color: green">Médecin</b></p>

        <?php if(!empty($err)): ?>
            <div class="error-message"><?php echo $err; ?></div>
        <?php endif; ?>

        <form method="post" action="" name="frmadminlogin" id="sign_in" onSubmit="return validateform()">
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
                <a href="doctorchangepassword.php">Change Mot passe</a><!--Forgotpassword.php-->
            </div>

            <button type="submit" name="submit" id="submit">Connexion</button>

            <p>Merci de vous connecter. <a href="index.php" id="register">Accueil</a></p>
        </form>
    </div>
</div>

</body>
</html>





<!--
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>HMS - Administration</title>
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/login.css" rel="stylesheet">


    <link href="assets/css/themes/all-themes.css" rel="stylesheet" />
</head>
<body class="theme-cyan login-page authentication">

<div class="container">
    <div id="err"><?php echo $err; ?></div>
    <div class="card-top"></div>
    <div class="card">
        <h1 class="title"><span>Système de gestion hospitalière</span>Connexion <span class="msg">Bonjour, Docteur !</span></h1>
        <div class="col-md-12">

            <form method="post" action="" name="frmadminlogin" id="sign_in" onSubmit="return validateform()">
                <div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-account"></i> </span>
                    <div class="form-line">
                        <input type="text" name="loginid" id="loginid" class="form-control" placeholder="Nom d'utilisateur" /></div>
                </div>
                <div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-lock"></i> </span>
                    <div class="form-line">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" /> </div>
                </div>
                <div>
                    <div class="">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Se souvenir de moi</label>
                    </div>
                    <div class="text-center">
                        <input type="submit" name="submit" id="submit" value="Se connecter" class="btn btn-raised waves-effect g-bg-cyan" /></div>
                    <div class="text-center"> <a href="index.php">Accueil</a></div> Forgotpassword.php
                </div>
            </form>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="theme-bg"></div>



<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/bundles/mainscripts.bundle.js"></script>
</body>
</html>--->

<script type="application/javascript">
    var alphaExp = /^[a-zA-Z]+$/; // Variable pour valider uniquement les lettres
    var alphaspaceExp = /^[a-zA-Z\s]+$/; // Variable pour valider uniquement les lettres et les espaces
    var numericExpression = /^[0-9]+$/; // Variable pour valider uniquement les chiffres
    var alphanumericExp = /^[0-9a-zA-Z]+$/; // Variable pour valider les chiffres et les lettres
    var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; // Variable pour valider l'ID Email

    function validateform()
    {
        if(document.frmdoctlogin.loginid.value == "")
        {
            alert("L'ID de connexion ne doit pas être vide.");
            document.frmdoctlogin.loginid.focus();
            return false;
        }
        else if(!document.frmdoctlogin.loginid.value.match(alphanumericExp))
        {
            alert("L'ID de connexion n'est pas valide.");
            document.frmdoctlogin.loginid.focus();
            return false;
        }
        else if(document.frmdoctlogin.password.value == "")
        {
            alert("Le mot de passe ne doit pas être vide.");
            document.frmdoctlogin.password.focus();
            return false;
        }
        else if(document.frmdoctlogin.password.value.length < 8)
        {
            alert("La longueur du mot de passe doit être supérieure à 8 caractères.");
            document.frmdoctlogin.password.focus();
            return false;
        }
    }
</script>
