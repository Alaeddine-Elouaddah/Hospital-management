<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
    $sql ="DELETE FROM department WHERE departmentid='$_GET[delid]'";
    $qsql=mysqli_query($con,$sql);
    if(mysqli_affected_rows($con) == 1)
    {
        echo "<script>
    Swal.fire({
      title: 'Fait !',
      text: 'Département supprimé avec succès',
      type: 'success',
    })</script>";
    }
}
?>


<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Voir l'enregistrement du département</h2>
    </div>
    <div class="card">

        <section class="container">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                <tr>
                    <td><strong>Nom</strong></td>
                    <td><strong>Description du département</strong></td>
                    <td><strong>Statut</strong></td>
                    <?php
                    if(isset($_SESSION[adminid]))
                    {
                        ?>
                        <td><strong>Action</strong></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
                $sql ="SELECT * FROM department";
                $qsql = mysqli_query($con,$sql);
                while($rs = mysqli_fetch_array($qsql))
                {
                    echo "<tr>
          <td>$rs[departmentname]</td>
          <td> $rs[description]</td>
          <td>&nbsp;$rs[status]</td>";
                    if(isset($_SESSION[adminid]))
                    {
                        echo "<td>&nbsp;
            <a href='department.php?editid=$rs[departmentid]'>Modifier</a> | <a href='viewdepartment.php?delid=$rs[departmentid]'>Supprimer</a> </td>";
                    }
                    echo "</tr>";
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
