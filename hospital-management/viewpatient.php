<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
    $sql ="DELETE FROM patient WHERE patientid='$_GET[delid]'";
    $qsql=mysqli_query($con,$sql);
    if(mysqli_affected_rows($con) == 1)
    {
        echo "<script>alert('Enregistrement du patient supprimé avec succès..');</script>";
    }
}
?>
<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Voir les dossiers des patients</h2>

    </div>

    <div class="card">

        <section class="container">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

                <thead>
                <tr>
                    <th width="15%" height="36"><div align="center">Nom</div></th>
                    <th width="20%"><div align="center">Admission</div></th>
                    <th width="28%"><div align="center">Adresse, Contact</div></th>
                    <th width="20%"><div align="center">Profil du patient</div></th>
                    <th width="17%"><div align="center">Action</div></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql ="SELECT * FROM patient";
                $qsql = mysqli_query($con,$sql);
                while($rs = mysqli_fetch_array($qsql))
                {
                    echo "<tr>
        <td>$rs[patientname]<br>
        <strong>ID de connexion :</strong> $rs[loginid] </td>
        <td>
        <strong>Date</strong>: &nbsp;$rs[admissiondate]<br>
        <strong>Heure</strong>: &nbsp;$rs[admissiontime]</td>
        <td>$rs[address]<br>$rs[city] -  &nbsp;$rs[pincode]<br>
        No. Mob. - $rs[mobileno]</td>
        <td><strong>Groupe sanguin</strong> - $rs[bloodgroup]<br>
        <strong>Genre</strong> - &nbsp;$rs[gender]<br>
        <strong>Date de naissance</strong> - &nbsp;$rs[dob]</td>
        <td align='center'>Statut - $rs[status] <br>";
                    if(isset($_SESSION[adminid]))
                    {
                        echo "<a href='patient.php?editid=$rs[patientid]' class='btn btn-sm btn-raised bg-green'>Modifier</a><a href='viewpatient.php?delid=$rs[patientid]' class='btn btn-sm btn-raised bg-blush'>Supprimer</a> <hr>
          <a href='patientreport.php?patientid=$rs[patientid]' class='btn btn-sm btn-raised bg-cyan'>Voir le rapport</a>";
                    }
                    echo "</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </section>

    </div>
</div>
<?php
include("adformfooter.php");
?>
