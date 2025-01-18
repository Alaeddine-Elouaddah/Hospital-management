<?php
session_start();
error_reporting(0);
include("dbconnection.php");

// Initialisation des variables de date et d'heure
$dt = date("Y-m-d");
$tim = date("H:i:s");

// Vérification de la session existante
if (isset($_SESSION['adminid'])) {
    echo "<script>window.location='adminaccount.php';</script>";
}

$err = ''; // Variable pour afficher les erreurs

// Vérification de la soumission du formulaire
if (isset($_POST['submit'])) {

    // Préparation de la requête SQL pour éviter les injections SQL
    $sql = "SELECT * FROM admin WHERE loginid=? AND password=? AND (status='Active' OR status='' OR status IS NULL)";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $_POST['loginid'], $_POST['password']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérification de l'existence de l'utilisateur
    if ($result->num_rows == 1) {
        $rslogin = $result->fetch_array();
        $_SESSION['adminid'] = $rslogin['adminid']; // Initialisation de la session
        echo "<script>window.location='adminaccount.php';</script>";
    } else {
        $err = "<div class='alert alert-danger'>
            <strong>Oh non !</strong> Veuillez corriger quelques éléments et réessayer.
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
<div class="glass-container" style="height: 67%;">
    <div class="login-box">
        <h2>Gestion Hospitalière</h2>
        <p class="subtitle">Connectez-vous pour commencer votre session <b style="color: greenyellow">Admin</b></p>

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
                <a href="adminchangepassword.php">Change Mot passe ?</a>
            </div>

            <button type="submit" name="submit" id="submit">Connexion</button>

            <p>Merci de vous connecter. <a href="index.php" id="register">Accueil</a></p>
        </form>
    </div>
</div>

<script>
    function validateform() {
        const loginid = document.getElementById('loginid');
        const password = document.getElementById('password');

        // Expressions régulières pour validation
        const alphanumericExp = /^[0-9a-zA-Z]+$/;

        if (loginid.value === "") {
            alert("Veuillez entrer un nom d'utilisateur");
            loginid.focus();
            return false;
        }

        if (!loginid.value.match(alphanumericExp)) {
            alert("Nom d'utilisateur invalide");
            loginid.focus();
            return false;
        }

        if (password.value === "") {
            alert("Le mot de passe ne doit pas être vide");
            password.focus();
            return false;
        }

        if (password.value.length < 8) {
            alert("Le mot de passe doit contenir au moins 8 caractères");
            password.focus();
            return false;
        }

        return true;
    }
</script>
</body>
</html>
