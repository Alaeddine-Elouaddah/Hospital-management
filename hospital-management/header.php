<?php
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");
?>
<!doctype html>
<html class="no-js" lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="M_toumi" />
    <!-- Titre du document -->
    <title>HMS</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <!-- Paramètres CSS SLIDER REVOLUTION 4.x -->
    <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />

    <!-- Feuilles de style -->
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Polices en ligne -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900|Raleway:200,300,400,500,600,700,800,900" rel="stylesheet">

    <!-- JavaScripts -->
    <script src="js/vendors/modernizr.js"></script>
    <!-- Support HTML5 Shim et Respond.js pour IE8 -->
    <!-- ATTENTION : Respond.js ne fonctionne pas si vous visualisez la page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
</head>
<body>

<!-- Chargeur de page -->
<div id="loader">
    <div class="position-center-center">
        <div class="cssload-thecube">
            <div class="cssload-cube cssload-c1"></div>
            <div class="cssload-cube cssload-c2"></div>
            <div class="cssload-cube cssload-c4"></div>
            <div class="cssload-cube cssload-c3"></div>
        </div>
    </div>
</div>

<!-- En-tête -->
<header class="header-style-2" style="background-color:; color: white;">
    <div class="container">
        <div class="logo"> <a href="index.php"><img src="images/hmslogo.png" alt="" style="height: 51px;"></a> </div>
        <div class="head-info" style="color: white;">
            <ul>
                <li> <i class="fa fa-phone"></i>
                    <p>06 81 02 21 00 <br>
                        9-269-690-HMS</p>
                </li>
                <li> <i class="fa fa-envelope-o"></i>
                    <p>toumi@gmail.com<br>
                        info@gmail.com</p>
                </li>
                <li> <i class="fa fa-map-marker"></i>
                    <p>EST - HSM<br>
                        Sidi Bennour</p>
                </li>
            </ul>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar ownmenu" style="background-color: darkblue">
        <div class="container" >
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-open-btn" aria-expanded="false"> <span><i class="fa fa-navicon"></i></span> </button>
            </div>

            <!-- NAV -->
            <div class="collapse navbar-collapse navbar-right" id="nav-open-btn" >
                <ul class="nav">
                    <li> <a href="index.php">Accueil </a></li>
                    <li><a href="about.php">À propos</a></li>
                    <li><a href="patientappointment.php">Rendez-vous </a></li>
                    <li><a href="contact.php">Contact </a></li>
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Connexion </a>
                        <ul class="dropdown-menu multi-level" style="display: none;">
                            <li><a href="adminlogin.php">Administrateur</a></li>
                            <li><a href="doctorlogin.php">Médecin</a></li>
                            <li><a href="patientlogin.php">Patient </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
