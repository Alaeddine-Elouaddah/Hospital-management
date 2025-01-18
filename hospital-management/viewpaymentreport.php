<?php
session_start();
include("dbconnection.php");
if(isset($_GET[delid]))
{
    $sql ="DELETE FROM billing_records WHERE billingid='$_GET[delid]'";
    $qsql=mysqli_query($con,$sql);
    if(mysqli_affected_rows($con) == 1)
    {
        echo "<script>alert('Enregistrement de facturation supprimé avec succès..');</script>";
    }
}

?>
<section class="container">
    <?php
    $sqlbilling_records ="SELECT * FROM billing WHERE appointmentid='$billappointmentid'";
    $qsqlbilling_records = mysqli_query($con,$sqlbilling_records);
    $rsbilling_records = mysqli_fetch_array($qsqlbilling_records);
    ?>
    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th scope="col"><div align="right">Numéro de facture &nbsp; </div></th>
            <td><?php echo $rsbilling_records[billingid]; ?></td>
            <td>Numéro de rendez-vous &nbsp;</td>
            <td><?php echo $rsbilling_records[appointmentid]; ?></td>
        </tr>
        <tr>
            <th width="442" scope="col"><div align="right">Date de facturation &nbsp; </div></th>
            <td width="413"><?php echo $rsbilling_records[billingdate]; ?></td>
            <td width="413">Heure de facturation&nbsp; </td>
            <td width="413"><?php echo $rsbilling_records[billingtime] ; ?></td>
        </tr>

        <tr>
            <th scope="col"><div align="right"></div></th>
            <td></td>
            <th scope="col"><div align="right">Montant de la facture &nbsp; </div></th>
            <td><?php
                $sql ="SELECT * FROM billing_records where billingid='$rsbilling_records[billingid]'";
                $qsql = mysqli_query($con,$sql);
                $billamt= 0;
                while($rs = mysqli_fetch_array($qsql))
                {
                    $billamt = $billamt +  $rs[bill_amount];
                }
                ?>
                &nbsp;$ <?php echo $billamt; ?></td>
        </tr>
        <tr>
            <th width="442" scope="col"><div align="right"></div></th>
            <td width="413">&nbsp;</td>
            <th width="442" scope="col"><div align="right">Montant de la taxe (5%) &nbsp; </div></th>
            <td width="413">&nbsp;$ <?php echo $taxamt = 5 * ($billamt / 100); ?></td>
        </tr>

        <tr>
            <th scope="col"><div align="right">Raison de la remise</div></th>
            <td rowspan="4" valign="top"><?php echo $rsbilling_records[discountreason]; ?></td>
            <th scope="col"><div align="right">Remise &nbsp; </div></th>
            <td>&nbsp;$ <?php echo $rsbilling_records[discount]; ?></td>
        </tr>

        <tr>
            <th rowspan="3" scope="col">&nbsp;</th>
            <th scope="col"><div align="right">Total global &nbsp; </div></th>
            <td>&nbsp;$ <?php echo $grandtotal = ($billamt + $taxamt)  - $rsbilling_records[discount] ; ?></td>
        </tr>
        <tr>
            <th scope="col"><div align="right">Montant payé </div></th>
            <td>$ <?php
                $sqlpayment ="SELECT sum(paidamount) FROM payment where appointmentid='$billappointmentid'";
                $qsqlpayment = mysqli_query($con,$sqlpayment);
                $rspayment = mysqli_fetch_array($qsqlpayment);
                echo $rspayment[0];
                ?></td>
        </tr>
        <tr>
            <th scope="col"><div align="right">Montant restant</div></th>
            <td>$ <?php echo $balanceamt = $grandtotal - $rspayment[0]  ; ?></td>
        </tr>
        </tbody>
    </table>
    <p><strong>Rapport de paiement :</strong></p>
    <?php
    $sqlpayment = "SELECT * FROM payment where appointmentid='$billappointmentid'";
    $qsqlpayment = mysqli_query($con,$sqlpayment);
    if(mysqli_num_rows($qsqlpayment) == 0)
    {
        echo "<strong>Aucun détail de transaction trouvé..</strong>";
    }
    else
    {
        ?>
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <th scope="col">Date de paiement</th>
                <th scope="col">Heure de paiement</th>
                <th scope="col">Montant payé</th>
            </tr>
            <?php
            while($rspayment = mysqli_fetch_array($qsqlpayment))
            {
                ?>
                <tr>
                    <td>&nbsp;<?php echo $rspayment[paiddate]; ?></td>
                    <td>&nbsp;<?php echo $rspayment[paidtime]; ?></td>
                    <td>&nbsp;$ <?php echo $rspayment[paidamount]; ?></td>
                </tr>
                <?php
            }
            ?>

            </tbody>
        </table>
        <?php
    }
    ?>
    <p><strong></strong></p>
</section>
