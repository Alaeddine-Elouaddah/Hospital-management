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
            <th scope="col"><div align="right">Numéro de la facture &nbsp; </div></th>
            <td> <?php echo '#HMS_'.$rsbilling_records[billingid]; ?></td>
        </tr>
        <tr>
            <th width="124" scope="col"><div align="right">Numéro du rendez-vous &nbsp; </div></th>
            <td width="413"> <?php echo $rsbilling_records[appointmentid]; ?>
            </td>
        </tr>

        <tr>
            <th scope="col"><div align="right">Date de facturation &nbsp; </div></th>
            <td>&nbsp;<?php echo $rsbilling_records[billingdate]; ?></td>
        </tr>

        <tr>
            <th scope="col"><div align="right">Heure de facturation&nbsp; </div></th>
            <td>&nbsp;<?php echo $rsbilling_records[billingtime] ; ?></td>
        </tr>
        </tbody>
    </table>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th width="97" scope="col">Date</th>
            <th width="245" scope="col">Description</th>
            <th width="86" scope="col">Montant de la facture</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql ="SELECT * FROM billing_records where billingid='$rsbilling_records[billingid]'";
        $qsql = mysqli_query($con,$sql);
        $billamt= 0;
        while($rs = mysqli_fetch_array($qsql))
        {
            echo "<tr>
            <td>&nbsp;$rs[bill_date]</td>
            <td>&nbsp; $rs[bill_type]";

            if($rs[bill_type] == "Frais de service")
            {
                $sqlservice_type1 = "SELECT * FROM service_type WHERE service_type_id='$rs[bill_type_id]'";
                $qsqlservice_type1 = mysqli_query($con,$sqlservice_type1);
                $rsservice_type1 = mysqli_fetch_array($qsqlservice_type1);
                echo " - " . $rsservice_type1[service_type];
            }


            if($rs[bill_type]== "Location de chambre")
            {
                $sqlroomtariff = "SELECT * FROM room WHERE roomid='$rs[bill_type_id]'";
                $qsqlroomtariff = mysqli_query($con,$sqlroomtariff);
                $rsroomtariff = mysqli_fetch_array($qsqlroomtariff);
                echo " : ". $rsroomtariff[roomtype] .  "- Chambre No." . $rsroomtariff[roomno];
            }

            if($rs[bill_type] == "Frais de consultation")
            {
                //Frais de consultation
                $sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rs[bill_type_id]'";
                $qsqldoctor = mysqli_query($con,$sqldoctor);
                $rsdoctor = mysqli_fetch_array($qsqldoctor);
                echo " - M.".$rsdoctor[doctorname];
            }

            if($rs[bill_type] =="Coût de traitement")
            {
                //Coût de traitement
                $sqltreatment = "SELECT * FROM treatment WHERE treatmentid='$rs[bill_type_id]'";
                $qsqltreatment = mysqli_query($con,$sqltreatment);
                $rstreatment = mysqli_fetch_array($qsqltreatment);
                echo " - ".$rstreatment[treatmenttype];
            }

            if($rs[bill_type]  == "Frais d'ordonnance")
            {
                $sqltreatment = "SELECT * FROM prescription WHERE treatmentid='$rs[bill_type_id]'";
                $qsqltreatment = mysqli_query($con,$sqltreatment);
                $rstreatment = mysqli_fetch_array($qsqltreatment);

                $sqltreatment1 = "SELECT * FROM treatment_records WHERE treatmentid='$rstreatment[treatment_records_id]'";
                $qsqltreatment1 = mysqli_query($con,$sqltreatment1);
                $rstreatment1 = mysqli_fetch_array($qsqltreatment1);

                $sqltreatment2 = "SELECT * FROM treatment WHERE treatmentid='$rstreatment1[treatmentid]'";
                $qsqltreatment2 = mysqli_query($con,$sqltreatment2);
                $rstreatment2 = mysqli_fetch_array($qsqltreatment2);
                echo  " - " . $rstreatment2[treatmenttype];
            }

            echo " </td><td>&nbsp;$ $rs[bill_amount]</td></tr>";
            $billamt = $billamt +  $rs[bill_amount];
        }
        ?>
        </tbody>
    </table>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th scope="col"><div align="right">Montant de la facture &nbsp; </div></th>
            <td>&nbsp;$ <?php echo $billamt; ?></td>
        </tr>
        <tr>
            <th width="442" scope="col"><div align="right">Montant de la taxe (5%) &nbsp; </div></th>
            <td width="95">&nbsp;$ <?php echo $taxamt = 5 * ($billamt / 100); ?>
            </td>
        </tr>

        <tr>
            <th scope="col"><div align="right">Réduction &nbsp; </div></th>
            <td>&nbsp;$ <?php echo $rsbilling_records[discount]; ?></td>
        </tr>

        <tr>
            <th scope="col"><div align="right">Total général &nbsp; </div></th>
            <td>&nbsp;$ <?php echo ($billamt + $taxamt)  - $rsbilling_records[discount] ; ?></td>
        </tr>
        </tbody>
    </table>

</section>
