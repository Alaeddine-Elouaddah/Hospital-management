<?php
session_start();
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>HMS</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<!-- JQuery DataTable Css -->
<link href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="assets/css/main.css" rel="stylesheet">
<!-- Custom Css -->

<!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="assets/css/themes/all-themes.css" rel="stylesheet" />
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body  style="background-color:white" class="theme-cyan">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-cyan">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Veuillez patienter...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->

<!-- Morphing Search  -->

<!-- Top Bar --><nav class="navbar clearHeader" style="background-color:white; text-align: center;">
    <div class="col-12">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="bars" style="color:red;"></a>
            <a style="color: darkblue; font-weight: bold" class="navbar-brand" href="#">Système de Gestion Hospitalière</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <!-- Notifications -->
            <li>
                <a data-placement="bottom" title="Plein Écran" href="logout.php">
                    <i class="zmdi zmdi-sign-in" style="color: red"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar" style="background-color: white ; color: black;"   >
        <?php
        if(isset($_SESSION[adminid]))
        {
            ?>
            <!-- Menu Admin -->
            <div class="menu"    style="background-color: white; color: black; " >
                <ul class="list" style="overflow: hidden; width: auto; height: calc(-184px + 100vh);">
                    <li class="header" style="background-color: #00adef ;  color: white ">NAVIGATION PRINCIPALE</li>
                    <li class="active open"><a href="adminaccount.php"><i class="zmdi zmdi-home"></i><span >Tableau de bord</span></a></li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span ">Profil</span> </a>
                        <ul class="ml-menu">
                            <li style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'"><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="adminprofile.php">Profil Admin</a></li>
                            <li style="color: black"><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="adminchangepassword.php">Changer le Mot de Passe</a></li>
                            <li style="color: black"><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="admin.php">Ajouter un Admin</a></li>
                            <li style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'"><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewadmin.php">Voir les Admins</a></li>
                        </ul>
                    </li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Rendez-vous</span> </a>
                        <ul class="ml-menu">
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="appointment.php">Nouveau Rendez-vous</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewappointmentpending.php">Voir les Rendez-vous en Attente</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewappointmentapproved.php">Voir les Rendez-vous Approuvés</a></li>
                        </ul>
                    </li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-add"></i><span>Médecins</span> </a>
                        <ul class="ml-menu">
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="doctor.php">Ajouter un Médecin</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewdoctor.php">Voir les Médecins</a></li>
                        </ul>
                    </li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-o"></i><span>Patients</span> </a>
                        <ul class="ml-menu">
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="patient.php">Ajouter un Patient</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewpatient.php">Voir les Dossiers des Patients</a></li>
                        </ul>
                    </li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle toggled waves-effect waves-block"><i class="zmdi zmdi-copy"></i><span>Service</span> </a>
                        <ul class="ml-menu" style="display: block;">
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="department.php" class="waves-effect waves-block">Ajouter un Département</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewdepartment.php" class="waves-effect waves-block">Voir les Départements</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="treatment.php" class="waves-effect waves-block">Ajouter un Type de Traitement</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewtreatment.php" class="waves-effect waves-block">Voir les Types de Traitements</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="medicine.php" class="waves-effect waves-block">Ajouter un Médicament</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewmedicine.php" class="waves-effect waves-block">Voir les Médicaments</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Admin Menu -->
        <?php }?>


        <!-- doctor Menu -->
        <?php
        if(isset($_SESSION[doctorid]))
        {
            ?>
            <div class="menu" style="background-color: white ; color: black">
                <ul class="list">
                    <li class="header" style="background-color: #00adef ;  color: white ">NAVIGATION PRINCIPALE</li>
                    <li class="active open"><a href="doctoraccount.php"><i class="zmdi zmdi-home"></i><span>Tableau de bord</span></a></li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check" ></i><span>Profil</span> </a>
                        <ul class="ml-menu">
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="doctorprofile.php">Profil</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="doctorchangepassword.php">Changer le Mot de Passe</a></li>
                        </ul>
                    </li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Rendez-vous</span> </a>
                        <ul class="ml-menu">
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewappointmentpending.php" style="width:250px;">Voir les Rendez-vous en Attente</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewappointmentapproved.php" style="width:250px;">Voir les Rendez-vous Approuvés</a></li>
                        </ul>
                    </li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-add"></i><span>Médecins</span> </a>
                        <ul class="ml-menu">
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="doctortimings.php">Ajouter les Heures de Visite</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewdoctortimings.php">Voir les Heures de Visite</a></li>
                        </ul>
                    </li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-o"></i><span>Patients</span> </a>
                        <ul class="ml-menu">
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewpatient.php">Voir les Patients</a></li>
                        </ul>
                    </li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewdoctorconsultancycharge.php"><i class="zmdi zmdi-copy"></i><span>Rapport de Revenus</span> </a></li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-copy"></i><span>Service</span> </a>
                        <ul class="ml-menu">
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewtreatmentrecord.php">Voir les Dossiers de Traitement</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewtreatment.php">Voir les Traitements</a></li>
                        </ul>
                    </li>
                </ul>
            </div>


        <?php }; ?>
        <!-- doctor Menu -->




        <!-- patient Menu -->
        <?php
        if(isset($_SESSION[patientid]))
        {
            ?>
            <div class="menu" style="background-color: white ; color: black">
                <ul class="list">
                    <li class="header" style="background-color: #00adef ;  color: white ">NAVIGATION PRINCIPALE</li>
                    <li class="active open"><a href="patientaccount.php"><i class="zmdi zmdi-home"></i><span>Tableau de bord</span></a></li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Profil</span> </a>
                        <ul class="ml-menu">
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="patientprofile.php">Voir le Profil</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="patientchangepassword.php">Changer le Mot de Passe</a></li>
                        </ul>
                    </li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Rendez-vous</span> </a>
                        <ul class="ml-menu">
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="patientappointment.php">Ajouter un Rendez-vous</a></li>
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewappointment.php">Voir les Rendez-vous</a></li>
                        </ul>
                    </li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-add"></i><span>Ordonnance</span> </a>
                        <ul class="ml-menu">
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="patviewprescription.php">Voir les Dossiers d'Ordonnance</a></li>
                        </ul>
                    </li>

                    <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-o"></i><span>Traitement</span> </a>
                        <ul class="ml-menu">
                            <li><a style="color: black;transition: color 0.3s;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="viewtreatmentrecord.php">Voir les Dossiers de Traitement</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        <?php }; ?>
        <!-- patient Menu -->
    </aside>
    <!-- #END# Left Sidebar -->

    </section>
     <section class="content home">
