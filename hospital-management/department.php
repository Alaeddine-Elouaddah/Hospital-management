<?php
include("adheader.php");
include("dbconnection.php");

if(isset($_POST['submit']))
{
    if(isset($_GET['editid']))
    {
        $sql ="UPDATE department SET departmentname='$_POST[departmentname]',description='$_POST[textarea]',status='$_POST[select]' WHERE departmentid='$_GET[editid]'";
        if($qsql = mysqli_query($con,$sql))
        {
            echo "<script>alert('L\'enregistrement du département a été mis à jour avec succès...');</script>";
        }
        else
        {
            echo mysqli_error($con);
        }
    }
    else
    {
        $sql ="INSERT INTO department(departmentname,description,status) values('$_POST[departmentname]','$_POST[textarea]','$_POST[select]')";
        if($qsql = mysqli_query($con,$sql))
        {
            echo "<script>alert('L\'enregistrement du département a été inséré avec succès...');</script>";
        }
        else
        {
            echo mysqli_error($con);
        }
    }
}

if(isset($_GET['editid']))
{
    $sql="SELECT * FROM department WHERE departmentid='$_GET[editid]' ";
    $qsql = mysqli_query($con,$sql);
    $rsedit = mysqli_fetch_array($qsql);

}
?>

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Ajouter un nouveau département</h2>
    </div>
    <div class="card">
        <form method="post" action="" name="frmdept" onSubmit="return validateform()">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <td width="34%">Nom du département</td>
                    <td width="66%"><input placeholder=" Entrez ici " class="form-control" type="text" name="departmentname" id="departmentname" value="<?php echo $rsedit['departmentname']; ?>" /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea placeholder=" Entrez ici " class="form-control no-resize" name="textarea" id="textarea" cols="45" rows="5"><?php echo $rsedit['description']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="select" id="select" class="form-control show-tick">
                            <option value="">Sélectionner</option>
                            <?php
                            $arr = array("Actif", "Inactif");
                            foreach($arr as $val)
                            {
                                if($val == $rsedit['status'])
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
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input class="btn btn-default" type="submit" name="submit" id="submit" value="Soumettre" /></td>
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
include("adfooter.php");
?>

<script type="application/javascript">
    var alphaExp = /^[a-zA-Z]+$/; //Variable pour valider uniquement les lettres
    var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable pour valider uniquement les lettres et les espaces
    var numericExpression = /^[0-9]+$/; //Variable pour valider uniquement les numéros
    var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable pour valider les numéros et les lettres
    var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable pour valider l'ID de l'email

    function validateform()
    {
        if(document.frmdept.departmentname.value == "")
        {
            alert("Le nom du département ne doit pas être vide..");
            document.frmdept.departmentname.focus();
            return false;
        }
        else if(!document.frmdept.departmentname.value.match(alphaspaceExp))
        {
            alert("Le nom du département n'est pas valide..");
            document.frmdept.departmentname.focus();
            return false;
        }
        else if(document.frmdept.select.value == "" )
        {
            alert("Veuillez sélectionner le statut..");
            document.frmdept.select.focus();
            return false;
        }

        else
        {
            return true;
        }
    }
</script>
