<?php
include("header.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE room SET roomtype='$_POST[select2]',roomno='$_POST[roomnumber]',noofbeds='$_POST[numberofbeds]',room_tariff='$_POST[roomtariff]',status='$_POST[select]' WHERE roomid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('room record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO room(roomtype,roomno,noofbeds,room_tariff,status) values('$_POST[select2]','$_POST[roomnumber]','$_POST[numberofbeds]','$_POST[roomtariff]','$_POST[select]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('room record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM room WHERE roomid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>


<div class="wrapper col2">
    <div id="breadcrumb">
        <ul>
            <li class="first">Ajouter une nouvelle chambre</li>
        </ul>
    </div>
</div>
<div class="wrapper col4">
    <div id="container">
        <h1>Ajouter un nouvel enregistrement de chambre</h1>
        <form method="post" action="" name="frmroom" onSubmit="return validateform()">

            <table width="200" border="3">
                <tbody>
                <tr>
                    <td width="34%">Type de chambre</td>
                    <td width="66%">
                        <select name="select2" id="select2">
                            <option value="">Sélectionner</option>
                            <?php
                            $arr = array("GENERAL WARD", "SPECIAL WARD");
                            foreach ($arr as $val) {
                                if ($val == $rsedit['roomtype']) {
                                    echo "<option value='$val' selected>$val</option>";
                                } else {
                                    echo "<option value='$val'>$val</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Numéro de chambre</td>
                    <td><input type="text" name="roomnumber" id="roomnumber" value="<?php echo $rsedit['roomno']; ?>" /></td>
                </tr>
                <tr>
                    <td>Nombre de lits</td>
                    <td><input type="text" name="numberofbeds" id="numberofbeds" value="<?php echo $rsedit['noofbeds']; ?>" /></td>
                </tr>
                <tr>
                    <td>Tarif de la chambre</td>
                    <td><input type="text" name="roomtariff" id="roomtariff" value="<?php echo $rsedit['room_tariff']; ?>" /></td>
                </tr>
                <tr>
                    <td>Statut</td>
                    <td>
                        <select name="select" id="select">
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
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" id="submit" value="Soumettre" />
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
        <p>&nbsp;</p>
    </div>
</div>
<div class="clear"></div>
</div>
</div>




<?php
include("footer.php");
?>

<script type="application/javascript">
    var alphaExp = /^[a-zA-Z]+$/; // Variable pour valider uniquement les alphabets
    var alphaspaceExp = /^[a-zA-Z\s]+$/; // Variable pour valider uniquement les alphabets et espaces
    var numericExpression = /^[0-9]+$/; // Variable pour valider uniquement les chiffres
    var alphanumericExp = /^[0-9a-zA-Z]+$/; // Variable pour valider les chiffres et alphabets
    var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; // Variable pour valider l'adresse e-mail

    function validateform()
    {
        if(document.frmroom.select2.value == "")
        {
            alert("Le type de chambre ne doit pas être vide.");
            document.frmroom.select2.focus();
            return false;
        }
        else if(document.frmroom.roomnumber.value == "")
        {
            alert("Le numéro de chambre ne doit pas être vide.");
            document.frmroom.roomnumber.focus();
            return false;
        }
        else if(!document.frmroom.roomnumber.value.match(numericExpression))
        {
            alert("Le numéro de chambre n'est pas valide.");
            document.frmroom.roomnumber.focus();
            return false;
        }
        else if(document.frmroom.numberofbeds.value == "")
        {
            alert("Le nombre de lits ne doit pas être vide.");
            document.frmroom.numberofbeds.focus();
            return false;
        }
        else if(!document.frmroom.numberofbeds.value.match(numericExpression))
        {
            alert("Le nombre de lits n'est pas valide.");
            document.frmroom.numberofbeds.focus();
            return false;
        }
        else if(document.frmroom.select.value == "" )
        {
            alert("Veuillez sélectionner le statut.");
            document.frmroom.select.focus();
            return false;
        }
        else
        {
            return true;
        }
    }
</script>
