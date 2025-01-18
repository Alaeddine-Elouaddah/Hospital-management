<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
    $sql ="DELETE FROM medicine WHERE medicineid='$_GET[delid]'";
    $qsql=mysqli_query($con,$sql);
    if(mysqli_affected_rows($con) == 1)
    {
        echo "<script>alert('Enregistrement du médicament supprimé avec succès..');</script>";
    }
}
?>
<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Voir la liste des médicaments</h2>

    </div>
</div>
<div class="card">

    <section class="container">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

            <thead>
            <tr>
                <th>Nom</th>
                <th>Coût</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $sql ="SELECT * FROM medicine";
            $qsql = mysqli_query($con,$sql);
            while($rs = mysqli_fetch_array($qsql))
            {
                echo "<tr>
              <td>&nbsp;$rs[medicinename]</td>
              <td>&nbsp;$$rs[medicinecost]</td>
              <td>&nbsp;$rs[description]</td>
              <td>&nbsp;$rs[status]</td>
              <td>&nbsp;
              <a href='medicine.php?editid=$rs[medicineid]' class='btn btn-raised bg-green'>Modifier</a> 
              <a href='viewmedicine.php?delid=$rs[medicineid]' class='btn btn-raised bg-blush'>Supprimer</a></td>
              </tr>";
            }
            ?>
            </tbody>
        </table>
    </section>

</div>
</div>
</div>

</div>
</div>
<?php
include("adformfooter.php");
?>
