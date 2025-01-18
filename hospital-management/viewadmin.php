<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM admin WHERE adminid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Enregistrement de l\'administrateur supprimé avec succès..');</script>";
	}
}
?>


    <div class="container-fluid">
        <div class="block-header">
            <h2 class="text-center"> Voir l'Administrateur </h2>
        </div>
    </div>
    <div class="card">
        <section class="container">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                <tr>
                    <td width="12%" height="40">Nom de l'administrateur</td>
                    <td width="11%">ID de connexion</td>
                    <td width="12%">Statut</td>
                    <td width="10%">Action</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM admin";
                $qsql = mysqli_query($con, $sql);
                while ($rs = mysqli_fetch_array($qsql)) {
                    echo "<tr>
            <td>$rs[adminname]</td>
            <td>$rs[loginid]</td>
            <td>$rs[status]</td>
            <td>
            <a href='admin.php?editid=$rs[adminid]' class='btn btn-raised g-bg-cyan'>Modifier</a> <a href='viewadmin.php?delid=$rs[adminid]' class='btn btn-raised g-bg-blush2'>Supprimer</a> </td>
            </tr>";
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