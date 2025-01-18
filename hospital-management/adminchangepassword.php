<?php

include("adheader.php");
include("dbconnection.php");
session_start();
if(isset($_POST[submit]))
{
    $sql = "UPDATE admin SET password='$_POST[newpassword]' WHERE password='$_POST[oldpassword]' AND adminid='$_SESSION[adminid]'";
    $qsql= mysqli_query($con,$sql);
    if(mysqli_affected_rows($con) == 1)
    {
        echo "<div class='alert alert-success'>
            Mot de passe mis à jour avec succès
        </div>";
    }
    else
    {
        echo "<div class='alert alert-warning'>
            Échec de la mise à jour du mot de passe
        </div>";
    }
}
?>
<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Mot de Passe de l'Administrateur</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <form method="post" action="" name="frmadminprofile" onSubmit="return validateform()">


                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="password" name="oldpassword" id="oldpassword" placeholder="Ancien mot de passe" />
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="password" name="newpassword" id="newpassword" placeholder="Nouveau mot de passe" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="password" name="password" id="password" placeholder="Confirmer le mot de passe" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit" value="Soumettre" />

                        </div>
                    </div>
            </div>

            </form>


            <div class="clear"></div>
        </div>
    </div>
    <?php
    include("adfooter.php");
    ?>
    <script type="application/javascript">
        function validateform1()
        {
            if(document.frmadminchange.oldpassword.value == "")
            {
                alert("L'ancien mot de passe ne doit pas être vide.");
                document.frmadminchange.oldpassword.focus();
                return false;
            }
            else if(document.frmadminchange.newpassword.value == "")
            {
                alert("Le nouveau mot de passe ne doit pas être vide.");
                document.frmadminchange.newpassword.focus();
                return false;
            }
            else if(document.frmadminchange.newpassword.value.length < 8)
            {
                alert("La longueur du nouveau mot de passe doit être supérieure à 8 caractères.");
                document.frmadminchange.newpassword.focus();
                return false;
            }
            else if(document.frmadminchange.newpassword.value != document.frmadminchange.password.value )
            {
                alert("Le nouveau mot de passe et la confirmation du mot de passe doivent être identiques.");
                document.frmadminchange.password.focus();
                return false;
            }
            else
            {
                return true;
            }
        }
    </script>
