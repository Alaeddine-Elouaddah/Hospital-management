<?php
include("adheader.php");
include("dbconnection.php");

if(isset($_POST[submit]))
{
    $sql = "UPDATE patient SET password='$_POST[newpassword]' WHERE password='$_POST[oldpassword]' AND patientid='$_SESSION[patientid]'";
    $qsql = mysqli_query($con, $sql);
    if(mysqli_affected_rows($con) == 1)
    {
        echo "<div class='alert alert-success'>
                        Le mot de passe a été mis à jour avec succès
                    </div>
                    <script>alert('..');</script>";
    }
    else
    {
        echo "<div class='alert alert-danger'>
                        Échec de la mise à jour
                    </div>";
    }
}
?>

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Mot de passe du patient</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <form method="post" action="" name="frmpatchange" onSubmit="return validateform()" style="padding: 10px">
                    <div class="form-group">
                        <label>Ancien mot de passe</label>
                        <div class="form-line">
                            <input class="form-control" type="password" name="oldpassword" id="oldpassword" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nouveau mot de passe</label>
                        <div class="form-line">
                            <input class="form-control" type="password" name="newpassword" id="newpassword" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Confirmer le mot de passe</label>
                        <div class="form-line">
                            <input class="form-control" type="password" name="password" id="password" />
                        </div>
                    </div>

                    <input class="btn btn-raised g-bg-cyan" type="submit" name="submit" id="submit" value="Soumettre" />
                </form>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<?php
include("adfooter.php");
?>

<script type="application/javascript">
    function validateform()
    {
        if(document.frmpatchange.oldpassword.value == "")
        {
            alert("L'ancien mot de passe ne doit pas être vide.");
            document.frmpatchange.oldpassword.focus();
            return false;
        }
        else if(document.frmpatchange.newpassword.value == "")
        {
            alert("Le nouveau mot de passe ne doit pas être vide.");
            document.frmpatchange.newpassword.focus();
            return false;
        }
        else if(document.frmpatchange.newpassword.value.length < 6)
        {
            alert("Le nouveau mot de passe doit comporter plus de 6 caractères.");
            document.frmpatchange.newpassword.focus();
            return false;
        }
        else if(document.frmpatchange.newpassword.value != document.frmpatchange.password.value )
        {
            alert("Le nouveau mot de passe et la confirmation du mot de passe doivent être égaux.");
            document.frmpatchange.password.focus();
            return false;
        }
        else
        {
            return true;
        }
    }
</script>
