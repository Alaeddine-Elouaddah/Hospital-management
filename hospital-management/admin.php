<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
    if(isset($_GET[editid]))
    {
        $sql ="UPDATE admin SET adminname='$_POST[adminname]',loginid='$_POST[loginid]',password='$_POST[password]',status='$_POST[select]' WHERE adminid='$_GET[editid]'";
        if($qsql = mysqli_query($con,$sql))
        {
            echo "<div class='alert alert-success'>
			Le profil de l'administrateur a été mis à jour avec succès.
			</div>";
        }
        else
        {
            echo mysqli_error($con);
        }
    }
    else
    {
        $sql ="INSERT INTO admin(adminname,loginid,password,status) values('$_POST[adminname]','$_POST[loginid]','$_POST[password]','$_POST[select]')";
        if($qsql = mysqli_query($con,$sql))
        {
            echo "<div class='alert alert-success'>
			Le profil de l'administrateur a été inséré avec succès.
			</div>";
        }
        else
        {
            echo mysqli_error($con);
        }
    }
}
if(isset($_GET[editid]))
{
    $sql="SELECT * FROM admin WHERE adminid='$_GET[editid]' ";
    $qsql = mysqli_query($con,$sql);
    $rsedit = mysqli_fetch_array($qsql);

}
?>

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center"> Ajouter un nouvel administrateur </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">

                <form method="post" action="" name="frmadminprofile" onSubmit="return validateform()">


                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label> Nom de l'administrateur</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control"  name="adminname" id="adminname" value="<?php echo $rsedit[adminname]; ?>"/>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Identifiant de connexion</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="loginid" id="loginid" value="<?php echo $rsedit[loginid]; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label> Mot de passe de l'administrateur</label>
                                    <div class="form-line">
                                        <input type="password" class="form-control"  name="password" id="password" value="<?php echo $rsedit[password]; ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Confirmer le mot de passe</label>
                                    <div class="form-line">
                                        <input type="password" class="form-control"  name="cnfirmpassword" id="cnfirmpassword" value="<?php echo $rsedit[confirmpassword]; ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group drop-custum">
                                    <label>Statut</label>

                                    <select class="form-control show-tick" name="select">
                                        <option value="" selected>Choisir un statut</option>
                                        <?php
                                        $arr = array("Actif","Inactif");
                                        foreach($arr as $val)
                                        {
                                            if($val == $rsedit[status])
                                            {
                                                echo "<option value='$val' selected>$val</option>";
                                            }
                                            else
                                            {
                                                echo "<option value='$val'>$val</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit" value="Soumettre" />

                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<?php
include("adfooter.php");
?>
<script type="application/javascript">
    var alphaExp = /^[a-zA-Z]+$/; //Variable pour valider uniquement les alphabets
    var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable pour valider uniquement les alphabets et les espaces
    var numericExpression = /^[0-9]+$/; //Variable pour valider uniquement les nombres
    var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable pour valider les chiffres et les alphabets
    var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable pour valider l'e-mail

    function validateform()
    {
        if(document.frmadmin.adminname.value == "")
        {
            alert("Le nom de l'administrateur ne doit pas être vide.");
            document.frmadmin.adminname.focus();
            return false;
        }
        else if(!document.frmadmin.adminname.value.match(alphaspaceExp))
        {
            alert("Nom de l'administrateur invalide.");
            document.frmadmin.adminname.focus();
            return false;
        }
        else if(document.frmadmin.loginid.value == "")
        {
            alert("L'identifiant de connexion ne doit pas être vide.");
            document.frmadmin.loginid.focus();
            return false;
        }
        else if(!document.frmadmin.loginid.value.match(alphanumericExp))
        {
            alert("Identifiant de connexion invalide.");
            document.frmadmin.loginid.focus();
            return false;
        }
        else if(document.frmadmin.password.value == "")
        {
            alert("Le mot de passe ne doit pas être vide.");
            document.frmadmin.password.focus();
            return false;
        }
        else if(document.frmadmin.password.value.length < 8)
        {
            alert("Le mot de passe doit comporter au moins 8 caractères.");
            document.frmadmin.password.focus();
            return false;
        }
        else if(document.frmadmin.password.value != document.frmadmin.cnfirmpassword.value )
        {
            alert("Le mot de passe et la confirmation doivent correspondre.");
            document.frmadmin.password.focus();
            return false;
        }
        else if(document.frmadmin.select.value == "" )
        {
            alert("Veuillez sélectionner un statut.");
            document.frmadmin.select.focus();
            return false;
        }
        else
        {
            return true;
        }
    }
</script>
