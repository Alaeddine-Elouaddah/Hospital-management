<?php
include("dbconnection.php");

if(isset($_POST[submitpat]))
{
    $sql = "INSERT INTO patient(patientname,admissiondate,admissiontime,address,mobileno,gender,dob) 
            values('$_POST[patientname]','$_POST[admissiondate]','$_POST[admissiontime]','$_POST[address]','$_POST[mobilenumber]','$_POST[select]','$_POST[dateofbirth]')";
    if($qsql = mysqli_query($con,$sql))
    {
        echo "<script>alert('Enregistrement du patient effectué avec succès...');</script>";
    }
    else
    {
        echo mysqli_error($con);
    }
}

if(isset($_GET[editid]))
{
    $sql="SELECT * FROM patient WHERE patientid='$_GET[editid]' ";
    $qsql = mysqli_query($con,$sql);
    $rsedit = mysqli_fetch_array($qsql);
}
?>

<?php
if(!isset($_GET[patientid]))
{
    ?>
    <div class="container-fluid">
        <div class="block-header">
            <h2>Prendre un rendez-vous</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="patientname" id="patientname" placeholder="Nom du patient"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="patientid" id="patientid" placeholder="ID du patient" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="address" id="address" cols="45" rows="5" placeholder="Adresse"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group drop-custum">
                                    <select class="form-control show-tick" name="select">
                                        <option value="">-- Genre --</option>
                                        <option value="10">Homme</option>
                                        <option value="20">Femme</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="mobilenumber" id="mobilenumber" placeholder="Numéro de téléphone"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" name="dateofbirth" id="dateofbirth" placeholder="Date de naissance" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-raised" name="submitpat" id="submitpat" value="Soumettre" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="" name="frmpatdet" onSubmit="return validateform()">
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <td width="17%"><strong>Nom du patient </strong></td>
                <td width="41%"><input type="text" name="patientname" id="patientname" placeholder="Nom du patient"/></td>
                <td width="16%"><strong>ID du patient</strong></td>
                <td width="26%"><input type="text" name="patientid" id="patientid" placeholder="ID du patient" /></td>
            </tr>
            <tr>
                <td><strong>Adresse</strong></td>
                <td align="right"><textarea name="address" id="address" cols="45" rows="5" placeholder="Adresse"> </textarea></td>
                <td><strong>Genre</strong></td>
                <td>
                    <select name="select" id="select">
                        <option value="">Sélectionner</option>
                        <option value="Male">Homme</option>
                        <option value="Female">Femme</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><strong>Numéro de contact</strong></td>
                <td><input type="text" name="mobilenumber" id="mobilenumber" placeholder="Numéro de téléphone"/></td>
                <td><strong>Date de naissance</strong></td>
                <td><input type="date" name="dateofbirth" id="dateofbirth" placeholder="Date de naissance" /></td>
            </tr>
            <tr>
                <td colspan="4" align="center"><input type="submit" name="submitpat" id="submitpat" value="Soumettre" /></td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php
}
else
{
    $sqlpatient = "SELECT * FROM patient WHERE patientid='$_GET[patientid]'";
    $qsqlpatient = mysqli_query($con,$sqlpatient);
    $rspatient = mysqli_fetch_array($qsqlpatient);
    ?>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <td width="16%"><strong>Nom du patient</strong></td>
            <td width="34%">&nbsp;<?php echo $rspatient[patientname]; ?></td>
            <td width="16%"><strong>ID du patient</strong></td>
            <td width="34%">&nbsp;<?php echo $rspatient[patientid]; ?></td>
        </tr>
        <tr>
            <td><strong>Adresse</strong></td>
            <td>&nbsp;<?php echo $rspatient[address]; ?></td>
            <td><strong>Genre</strong></td>
            <td>&nbsp;<?php echo $rspatient[gender];?></td>
        </tr>
        <tr>
            <td><strong>Numéro de contact</strong></td>
            <td>&nbsp;<?php echo $rspatient[mobileno]; ?></td>
            <td><strong>Date de naissance</strong></td>
            <td>&nbsp;<?php echo $rspatient[dob]; ?></td>
        </tr>
        </tbody>
    </table>
    <?php
}
?>

<script type="application/javascript">
    function validateform()
    {
        if(document.frmpatdet.patientname.value == "")
        {
            alert("Le nom du patient ne doit pas être vide.");
            document.frmpatdet.patientname.focus();
            return false;
        }
        else if(document.frmpatdet.patientid.value == "")
        {
            alert("L'ID du patient ne doit pas être vide.");
            document.frmpatdet.patientid.focus();
            return false;
        }
        else if(document.frmpatdet.admissiondate.value == "")
        {
            alert("La date d'admission ne doit pas être vide.");
            document.frmpatdet.admissiondate.focus();
            return false;
        }
        else if(document.frmpatdet.admissiontime.value == "")
        {
            alert("L'heure d'admission ne doit pas être vide.");
            document.frmpatdet.admissiontime.focus();
            return false;
        }
        else if(document.frmpatdet.address.value == "")
        {
            alert("L'adresse ne doit pas être vide.");
            document.frmpatdet.address.focus();
            return false;
        }
        else if(document.frmpatdet.select.value == "")
        {
            alert("Le genre ne doit pas être vide.");
            document.frmpatdet.select.focus();
            return false;
        }
        else if(document.frmpatdet.mobilenumber.value == "")
        {
            alert("Le numéro de contact ne doit pas être vide.");
            document.frmpatdet.mobilenumber.focus();
            return false;
        }
        else if(document.frmpatdet.dateofbirth.value == "")
        {
            alert("La date de naissance ne doit pas être vide.");
            document.frmpatdet.dateofbirth.focus();
            return false;
        }
        else
        {
            return true;
        }
    }
</script>
