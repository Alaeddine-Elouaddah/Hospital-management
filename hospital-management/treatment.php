<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE treatment SET treatmenttype='$_POST[treatmenttype]',treatment_cost='$_POST[treatmentcost]',note='$_POST[textarea]',status='$_POST[select]' WHERE treatmentid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Enregistrement du traitement mis à jour avec succès...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		$sql ="INSERT INTO treatment(treatmenttype,treatment_cost,note,status) values('$_POST[treatmenttype]','$_POST[treatmentcost]', '$_POST[textarea]','$_POST[select]')";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Enregistrement du traitement ajouté avec succès...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM treatment WHERE treatmentid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>



<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Ajouter un nouveau traitement</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">

                <form method="post" action="" name="frmtreat" onSubmit="return validateform()">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label for="type">Type de traitement</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="treatmenttype" id="treatmenttype"
                                           value="<?php echo $rsedit['treatmenttype']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label for="type">Coût du traitement</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="treatmentcost" id="treatmentcost"
                                           value="<?php echo $rsedit['treatment_cost']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Statut</label>
                                <div class="form-line">
                                    <select name="select" id="select" class="form-control show-tick">
                                        <option value="">Sélectionner</option>
                                        <?php
                                        $arr = array("Actif", "Inactif");
                                        foreach ($arr as $val) {
                                            if ($val == $rsedit['status']) {
                                                echo "<option value='$val' selected>$val</option>";
                                            } else {
                                                echo "<option value='$val'>$val</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Note</label>
                            <div class="form-line">
								<textarea name="textarea" class="form-control no-resize" id="textarea" cols="45"
                                          rows="5"><?php echo $rsedit['note']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <input type="submit" name="submit" id="submit" value="Soumettre" class="btn btn-raised" />
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
    var alphaExp = /^[a-zA-Z]+$/; // Variable pour valider uniquement les alphabets
    var alphaspaceExp = /^[a-zA-Z\s]+$/; // Variable pour valider uniquement les alphabets et espaces
    var numericExpression = /^[0-9]+$/; // Variable pour valider uniquement les chiffres
    var alphanumericExp = /^[0-9a-zA-Z]+$/; // Variable pour valider les chiffres et alphabets
    var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; // Variable pour valider une adresse e-mail
    function validateform() {
        if (document.frmtreat.treatmenttype.value == "") {
            alert("Le type de traitement ne doit pas être vide.");
            document.frmtreat.treatmenttype.focus();
            return false;
        } else if (!document.frmtreat.treatmenttype.value.match(alphaspaceExp)) {
            alert("Le type de traitement n'est pas valide.");
            document.frmtreat.treatmenttype.focus();
            return false;
        } else if (document.frmtreat.select.value == "") {
            alert("Veuillez sélectionner un statut.");
            document.frmtreat.select.focus();
            return false;
        } else {
            return true;
        }
    }
</script>