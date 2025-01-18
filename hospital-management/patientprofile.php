<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
    $sql ="UPDATE patient SET patientname='$_POST[patientname]',admissiondate='$_POST[admissiondate]',admissiontime='$_POST[admissiontme]',address='$_POST[address]',mobileno='$_POST[mobilenumber]',city='$_POST[city]',pincode='$_POST[pincode]',loginid='$_POST[loginid]',bloodgroup='$_POST[select2]',gender='$_POST[select3]',dob='$_POST[dateofbirth]' WHERE patientid='$_SESSION[patientid]'";
    if($qsql = mysqli_query($con,$sql))
    {
        echo "<script>alert('L\'enregistrement du patient a été mis à jour avec succès...');</script>";
    }
    else
    {
        echo mysqli_error($con);
    }
}
if(isset($_SESSION['patientid']))
{
    $sql="SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
    $qsql = mysqli_query($con,$sql);
    $rsedit = mysqli_fetch_array($qsql);
}
?>

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Profil du patient</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <form method="post" action="" name="frmpatprfl" onSubmit="return validateform()">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="">Nom du patient</label>
                                    <div class="form-line">
                                        <input class="form-control" type="text" name="patientname" id="patientname" value="<?php echo $rsedit['patientname']; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="">Date d'admission</label>
                                    <div class="form-line">
                                        <input class="form-control" type="date" name="admissiondate" id="admissiondate" value="<?php echo $rsedit['admissiondate']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="admissiontme">Heure d'admission</label>
                                    <div class="form-line">
                                        <input class="form-control" type="time" name="admissiontme" id="admissiontme" value="<?php echo $rsedit['admissiontime']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group ">
                                    <label for="">Adresse</label>
                                    <div class="form-line">
                                        <input class="form-control" name="address" id="address" value="<?php echo $rsedit['address']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="">Numéro de téléphone</label>
                                    <div class="form-line">
                                        <input class="form-control" type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit['mobileno']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="">Ville</label>
                                    <div class="form-line">
                                        <input class="form-control" type="text" name="city" id="city" value="<?php echo $rsedit['city']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Code postal</label>
                                    <div class="form-line">
                                        <input class="form-control" type="text" name="pincode" id="pincode" value="<?php echo $rsedit['pincode']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Identifiant de connexion</label>
                                    <div class="form-line">
                                        <input class="form-control" type="text" name="loginid" id="loginid" value="<?php echo $rsedit['loginid']; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="blood group">Groupe sanguin</label>
                                    <div class="form-line">
                                        <select name="select2" id="select2" class="form-control show-tick">
                                            <option value="" selected hidden="">Sélectionner</option>
                                            <?php
                                            $arr = array("A+","A-","B+","B-","O+","O-","AB+","AB-");
                                            foreach($arr as $val)
                                            {
                                                if($val == $rsedit['bloodgroup'])
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Genre</label>
                                    <div class="form-line">
                                        <select name="select3" id="select3" class="form-control show-tick">
                                            <option value="" selected="" hidden="">Sélectionner</option>
                                            <?php
                                            $arr = array("HOMME","FEMME");
                                            foreach($arr as $val)
                                            {
                                                if($val == $rsedit['gender'])
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
                                <div class="form-group">
                                    <label for="">Date de naissance</label>
                                    <div class="form-line">
                                        <input class="form-control" type="date" name="dateofbirth" id="dateofbirth" value="<?php echo $rsedit['dob']; ?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit" value="Envoyer" />
                            </div>
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
<script>
var alphaExp = /^[a-zA-Z]+$/; // Variable pour valider uniquement les lettres
var alphaspaceExp = /^[a-zA-Z\s]+$/; // Variable pour valider uniquement les lettres et les espaces
var numericExpression = /^[0-9]+$/; // Variable pour valider uniquement les chiffres
var alphanumericExp = /^[0-9a-zA-Z]+$/; // Variable pour valider les chiffres et les lettres
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; // Variable pour valider un identifiant de connexion (email)

function validateform()
{
if(document.frmpatprfl.patientname.value == "")
{
alert("Le nom du patient ne doit pas être vide.");
document.frmpatprfl.patientname.focus();
return false;
}
else if(!document.frmpatprfl.patientname.value.match(alphaspaceExp))
{
alert("Nom du patient non valide.");
document.frmpatprfl.patientname.focus();
return false;
}
else if(document.frmpatprfl.admissiondate.value == "")
{
alert("La date d'admission ne doit pas être vide.");
document.frmpatprfl.admissiondate.focus();
return false;
}
else if(document.frmpatprfl.admissiontme.value == "")
{
alert("L'heure d'admission ne doit pas être vide.");
document.frmpatprfl.admissiontme.focus();
return false;
}
else if(document.frmpatprfl.address.value == "")
{
alert("L'adresse ne doit pas être vide.");
document.frmpatprfl.address.focus();
return false;
}
else if(!document.frmpatprfl.address.value.match(alphaspaceExp))
{
alert("L'adresse est invalide.");
document.frmpatprfl.address.focus();
return false;
}
else if(document.frmpatprfl.mobilenumber.value == "")
{
alert("Le numéro de téléphone ne doit pas être vide.");
document.frmpatprfl.mobilenumber.focus();
return false;
}
else if(!document.frmpatprfl.mobilenumber.value.match(numericExpression))
{
alert("Numéro de téléphone invalide.");
document.frmpatprfl.mobilenumber.focus();
return false;
}
else if(document.frmpatprfl.city.value == "")
{
alert("La ville ne doit pas être vide.");
document.frmpatprfl.city.focus();
return false;
}
else if(!document.frmpatprfl.city.value.match(alphaspaceExp))
{
alert("Ville invalide.");
document.frmpatprfl.city.focus();
return false;
}
else if(document.frmpatprfl.pincode.value == "")
{
alert("Le code postal ne doit pas être vide.");
document.frmpatprfl.pincode.focus();
return false;
}
else if(!document.frmpatprfl.pincode.value.match(numericExpression))
{
alert("Code postal invalide.");
document.frmpatprfl.pincode.focus();
return false;
}
else if(document.frmpatprfl.loginid.value == "")
{
alert("L'identifiant de connexion ne doit pas être vide.");
document.frmpatprfl.loginid.focus();
return false;
}
///else if(!document.frmpatprfl.loginid.value.match(emailExp))
else if(!document.frmpatprfl.loginid.value.match(alphanumericExp))
{
alert("Identifiant de connexion invalide.");
document.frmpatprfl.loginid.focus();
return false;
}
else if(document.frmpatprfl.select2.value == "")
{
alert("Veuillez sélectionner un groupe sanguin.");
document.frmpatprfl.select2.focus();
return false;
}
else if(document.frmpatprfl.select3.value == "")
{
alert("Veuillez sélectionner un genre.");
document.frmpatprfl.select3.focus();
return false;
}
else if(document.frmpatprfl.dateofbirth.value == "")
{
alert("La date de naissance ne doit pas être vide.");
document.frmpatprfl.dateofbirth.focus();
return false;
}
return true;
}
</script>