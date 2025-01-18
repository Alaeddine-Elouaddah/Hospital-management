<?php
include("header.php");
include("dbconnection.php");
if (isset($_POST['submit'])) {
    if (isset($_GET['editid'])) {
        $sql = "UPDATE service_type SET service_type='$_POST[servicetype]',servicecharge='$_POST[servicecharge]',description='$_POST[textarea]',status= '$_POST[select]' WHERE service_type_id='$_GET[editid]'";
        if ($qsql = mysqli_query($con, $sql)) {
            echo "<script>alert('Enregistrement du type de service mis à jour avec succès...');</script>";
        } else {
            echo mysqli_error($con);
        }
    } else {
        $sql = "INSERT INTO service_type(service_type,servicecharge,description,status) values('$_POST[servicetype]','$_POST[servicecharge]','$_POST[textarea]','$_POST[select]')";
        if ($qsql = mysqli_query($con, $sql)) {
            echo "<script>alert('Enregistrement du type de service ajouté avec succès...');</script>";
        } else {
            echo mysqli_error($con);
        }
    }
}
if (isset($_GET['editid'])) {
    $sql = "SELECT * FROM service_type WHERE service_type_id='$_GET[editid]' ";
    $qsql = mysqli_query($con, $sql);
    $rsedit = mysqli_fetch_array($qsql);
}
?>

<div class="wrapper col2">
    <div id="breadcrumb">
        <ul>
            <li class="first">Ajouter un nouveau type de service</li>
        </ul>
    </div>
</div>
<div class="wrapper col4">
    <div id="container">
        <h1>Ajouter un nouvel enregistrement de type de service</h1>
        <form method="post" action="" name="frmserv" onSubmit="return validateform()">
            <table width="200" border="3">
                <tbody>
                <tr>
                    <td width="34%">Type de service</td>
                    <td width="66%"><input type="text" name="servicetype" id="servicetype" value="<?php echo $rsedit['service_type']; ?>" /></td>
                </tr>
                <tr>
                    <td>Frais de service</td>
                    <td><input type="text" name="servicecharge" id="servicecharge" value="<?php echo $rsedit['servicecharge']; ?>" /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="textarea" id="textarea" cols="45" rows="5"><?php echo $rsedit['description']; ?></textarea></td>
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
<?php
include("footer.php");
?>
<script type="application/javascript">
    var alphaExp = /^[a-zA-Z]+$/; // Variable pour valider uniquement les lettres
    var alphaspaceExp = /^[a-zA-Z\s]+$/; // Variable pour valider les lettres et espaces
    var numericExpression = /^[0-9]+$/; // Variable pour valider uniquement les nombres

    function validateform() {
        if (document.frmserv.servicetype.value == "") {
            alert("Le type de service ne doit pas être vide.");
            document.frmserv.servicetype.focus();
            return false;
        } else if (!document.frmserv.se
