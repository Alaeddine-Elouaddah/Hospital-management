<?php
include("header.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
    $sql ="DELETE FROM service_type WHERE service_type_id='$_GET[delid]'";
    $qsql=mysqli_query($con,$sql);
    if(mysqli_affected_rows($con) == 1)
    {
        echo "<script>alert('Type de service supprimé avec succès..');</script>";
    }
}
?>
<div class="wrapper col2">
    <div id="breadcrumb">
        <ul>
            <li class="first">Voir le type de service</li>
        </ul>
    </div>
</div>

<div class="wrapper col4">
    <div id="container">
        <h1>Consulter l'enregistrement des types de service</h1>
        <table width="200" border="3">
            <tbody>
            <tr>
                <td>Type de service</td>
                <td>Frais de service</td>
                <td>Description</td>
                <td>Statut</td>
                <td>Action</td>
            </tr>
            <?php
            $sql = "SELECT * FROM service_type";
            $qsql = mysqli_query($con, $sql);
            while ($rs = mysqli_fetch_array($qsql)) {
                echo "<tr>
            <td>&nbsp;$rs[service_type]</td>
            <td>&nbsp;$rs[servicecharge]</td>
            <td>&nbsp;$rs[description]</td>
            <td>&nbsp;$rs[status]</td>
            <td>&nbsp; 
              <a href='servicetype.php?editid=$rs[service_type_id]'>Modifier</a> | 
              <a href='viewservicetype.php?delid=$rs[service_type_id]'>Supprimer</a>
            </td>
          </tr>";
            }
            ?>
            </tbody>
        </table>
        <p>&nbsp;</p>
    </div>
</div>
<div class="clear"></div>

<?php
include("footer.php");
?>
