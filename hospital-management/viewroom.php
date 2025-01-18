<?php
include("header.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
    $sql ="DELETE FROM room WHERE roomid='$_GET[delid]'";
    $qsql=mysqli_query($con,$sql);
    if(mysqli_affected_rows($con) == 1)
    {
        echo "<script>alert('Chambre supprimée avec succès..');</script>";
    }
}
?>
<div class="wrapper col2">
    <div id="breadcrumb">
        <ul>
            <li class="first">Voir la chambre</li>
        </ul>
    </div>
</div>
<div class="wrapper col4">
    <div id="container">
        <h1>Consulter les détails des chambres</h1>
        <table width="200" border="3">
            <tbody>
            <tr>
                <td width="21%">Type de chambre</td>
                <td width="21%">Numéro de chambre</td>
                <td width="30%">Nombre de lits</td>
                <td width="30%">Tarif de la chambre</td>
                <td width="14%">Statut</td>
                <td width="14%">Action</td>
            </tr>
            <?php
            $sql = "SELECT * FROM room";
            $qsql = mysqli_query($con, $sql);
            while ($rs = mysqli_fetch_array($qsql)) {
                echo "<tr>
            <td>&nbsp;$rs[roomtype]</td>
            <td>&nbsp;$rs[roomno]</td>
            <td>&nbsp;$rs[noofbeds]</td>
            <td>&nbsp;$rs[room_tariff]</td>
            <td>&nbsp;$rs[status]</td>
            <td>&nbsp;<a href='room.php?editid=$rs[roomid]'>Modifier</a> | <a href='viewroom.php?delid=$rs[roomid]'>Supprimer</a></td>
          </tr>";
            }
            ?>
            </tbody>
        </table>
        <p>&nbsp;</p>
    </div>
</div>
<div class="clear"></div>

</div>


<?php
include("footer.php");
?>
