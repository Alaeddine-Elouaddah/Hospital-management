<?php

include("adheader.php");
session_start();
include("dbconnection.php");

if(isset($_POST['submit']))
{
    if(isset($_GET['editid']))
    {
        $sql = "UPDATE appointment SET patientid='$_POST[select4]',departmentid='$_POST[select5]',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]',doctorid='$_POST[select6]',status='$_POST[select]' WHERE appointmentid='$_GET[editid]'";
        if($qsql = mysqli_query($con, $sql))
        {
            echo "<script>alert('Le dossier de rendez-vous a été mis à jour avec succès...');</script>";
        }
        else
        {
            echo mysqli_error($con);
        }
    }
    else
    {
        $sql = "INSERT INTO appointment(patientid, departmentid, appointmentdate, appointmenttime, doctorid, status) VALUES('$_POST[select4]', '$_POST[select5]', '$_POST[appointmentdate]', '$_POST[time]', '$_POST[select6]', '$_POST[select]')";
        if($qsql = mysqli_query($con, $sql))
        {
            echo "<script>alert('Le dossier de rendez-vous a été inséré avec succès...');</script>";
        }
        else
        {
            echo mysqli_error($con);
        }
    }
}

if(isset($_GET['editid']))
{
    $sql = "SELECT * FROM appointment WHERE appointmentid='$_GET[editid]'";
    $qsql = mysqli_query($con, $sql);
    $rsedit = mysqli_fetch_array($qsql);
}

?>

<div class="wrapper col2">
    <div id="breadcrumb">
        <h1></h1>
    </div>
</div>

<div class="container-fluid">
    <div class="block-header">
        <h2>Panel de rapports des patients</h2>
    </div>
    <div class="card">
        <p>

            <!-- jQuery Library -->
            <script src="js/jquery.min.js"></script>
            <script type="text/javascript">
                jQuery(document).ready(function($) {

                    // Trouver les éléments à basculer et masquer leur contenu
                    $('.toggle').each(function(){
                        $(this).find('.toggle-content').hide();
                    });

                    // Lorsque un élément de bascule est cliqué, afficher son contenu
                    $('.toggle a.toggle-trigger').click(function(){
                        var el = $(this), parent = el.closest('.toggle');

                        if( el.hasClass('active') )
                        {
                            parent.find('.toggle-content').slideToggle();
                            el.removeClass('active');
                        }
                        else
                        {
                            parent.find('.toggle-content').slideToggle();
                            el.addClass('active');
                        }
                        return false;
                    });

                });  //Fin
            </script>

            <!-- CSS de la bascule -->
            <style type="text/css">
                /* Bascule principale */
                .toggle {
                    font-size: 13px;
                    line-height:20px;
                    font-family: "HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif;
                    background: #ffffff;
                    margin-bottom: 10px;
                    border: 1px solid #e5e5e5;
                    border-radius: 5px;
                }

                /* Texte du lien de la bascule */
                .toggle a.toggle-trigger {
                    display:block;
                    padding: 10px 20px 15px 20px;
                    position:relative;
                    text-decoration: none;
                    color: #666;
                }

                /* État du lien de la bascule au survol */
                .toggle a.toggle-trigger:hover {
                    opacity: .8;
                    text-decoration: none;
                }

                /* Lien de la bascule lorsqu'il est cliqué */
                .toggle a.active {
                    text-decoration: none;
                    border-bottom: 1px solid #e5e5e5;
                    box-shadow: 0 8px 6px -6px #ccc;
                    color: #000;
                }

                /* Ajouter un "-" avant le lien de la bascule */
                .toggle a.toggle-trigger:before {
                    content: "-";
                    margin-right: 10px;
                    font-size: 1.3em;
                }

                /* Lorsque la bascule est active, changer le "-" en "+" */
                .toggle a.active.toggle-trigger:before {
                    content: "+";
                }

                /* Contenu de la bascule */
                .toggle .toggle-content {
                    padding: 10px 20px 15px 20px;
                    color:#666;
                }
            </style>

            <!-- Bascule #1 -->
        <div class="toggle">
            <a href="#" title="Titre de la bascule" class="toggle-trigger">Profil du patient</a>
            <div class="toggle-content">
                <p><?php include("patientdetail.php"); ?></p>
            </div>
        </div>

        <!-- Bascule #2 -->
        <div class="toggle">
            <a href="#" title="Titre de la bascule" class="toggle-trigger">Dossier de rendez-vous</a>
            <div class="toggle-content">
                <p><?php include("appointmentdetail.php"); ?></p>
            </div>
        </div>

        <!-- Bascule #3 -->
        <div class="toggle">
            <a href="#" title="Titre de la bascule" class="toggle-trigger">Dossier de traitement</a>
            <div class="toggle-content">
                <p><?php include("treatmentdetail.php"); ?></p>
            </div>
        </div>

        <!-- Bascule #4 -->
        <div class="toggle">
            <a href="#" title="Titre de la bascule" class="toggle-trigger">Dossier de prescription</a>
            <div class="toggle-content">
                <p><?php include("prescriptiondetail.php"); ?></p>
            </div>
        </div>

        <!-- Bascule #5 -->
        <div class="toggle">
            <a href="#" title="Titre de la bascule" class="toggle-trigger">Rapport de facturation</a>
            <div class="toggle-content">
                <p><?php
                    $billappointmentid = $rsappointment[0];
                    include("viewbilling.php"); ?>
                </p>
            </div>
        </div>

        <?php
        if(isset($_SESSION['adminid']))
        {
            ?>
            <!-- Bascule #6 -->
            <div class="toggle">
                <a href="#" title="Titre de la bascule" class="toggle-trigger">Rapport de paiement</a>
                <div class="toggle-content">
                    <p><?php
                        $billappointmentid = $rsappointment[0];
                        include("viewpaymentreport.php"); ?>
                        <?php
                        if(!isset($_SESSION['patientid']))
                        {
                            $sqlbilling_records = "SELECT * FROM billing WHERE appointmentid='$billappointmentid'";
                            $qsqlbilling_records = mysqli_query($con, $sqlbilling_records);
                            $rsbilling_records = mysqli_fetch_array($qsqlbilling_records);
                            ?>
                            <a class="btn btn-raised" href="paymentdischarge.php?appointmentid=<?php echo $rsappointment[0]; ?>&patientid=<?php echo $_GET['patientid']; ?>">Effectuer le paiement</a>
                            <?php
                        }
                        ?>
                    </p>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</div>

<?php
include("adfooter.php");
?>
