<?php

include("adheader.php");
include("dbconnection.php");
if (isset($_POST['submit'])) {
    if (isset($_GET['editid'])) {
        $sql = "UPDATE appointment SET patientid='$_POST[select4]',departmentid='$_POST[select5]',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]',doctorid='$_POST[select6]',status='$_POST[select]' WHERE appointmentid='$_GET[editid]'";
        if ($qsql = mysqli_query($con, $sql)) {
            echo "<script>alert('Le rendez-vous a été mis à jour avec succès...');</script>";
        } else {
            echo mysqli_error($con);
        }
    } else {
        $sql = "UPDATE patient SET status='Active' WHERE patientid='$_POST[select4]'";
        $qsql = mysqli_query($con, $sql);

        $sql = "INSERT INTO appointment(patientid, departmentid, appointmentdate, appointmenttime, doctorid, status, app_reason) VALUES ('$_POST[select4]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]','$_POST[appreason]')";
        if ($qsql = mysqli_query($con, $sql)) {
            include("insertbillingrecord.php");
            echo "<script>alert('Le rendez-vous a été enregistré avec succès...');</script>";
            echo "<script>window.location='patientreport.php?patientid=$_POST[select4]';</script>";
        } else {
            echo mysqli_error($con);
        }
    }
}
if (isset($_GET['editid'])) {
    $sql = "SELECT * FROM appointment WHERE appointmentid='$_GET[editid]'";
    $qsql = mysqli_query($con, $sql);
    $rsedit = mysqli_fetch_array($qsql);
}
?>

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Prendre un rendez-vous</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Informations sur le rendez-vous</h2>
                </div>
                <form method="post" action="" name="frmappnt" onSubmit="return validateform()">
                    <input type="hidden" name="select2" value="Offline">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php
                                        if (isset($_GET['patid'])) {
                                            $sqlpatient = "SELECT * FROM patient WHERE patientid='$_GET[patid]'";
                                            $qsqlpatient = mysqli_query($con, $sqlpatient);
                                            $rspatient = mysqli_fetch_array($qsqlpatient);
                                            echo $rspatient['patientname'] . " (ID Patient - $rspatient[patientid])";
                                            echo "<input type='hidden' name='select4' value='$rspatient[patientid]'>";
                                        } else {
                                            ?>
                                            <select name="select4" id="select4" class=" form-control show-tick">
                                                <option value="">Sélectionner un patient</option>
                                                <?php
                                                $sqlpatient = "SELECT * FROM patient WHERE status='Active'";
                                                $qsqlpatient = mysqli_query($con, $sqlpatient);
                                                while ($rspatient = mysqli_fetch_array($qsqlpatient)) {
                                                    if ($rspatient['patientid'] == $rsedit['patientid']) {
                                                        echo "<option value='$rspatient[patientid]' selected>$rspatient[patientid] - $rspatient[patientname]</option>";
                                                    } else {
                                                        echo "<option value='$rspatient[patientid]'>$rspatient[patientid] - $rspatient[patientname]</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="select5" id="select5" class="form-control show-tick">
                                            <option value="">Sélectionner un département</option>
                                            <?php
                                            $sqldepartment = "SELECT * FROM department WHERE status='Active'";
                                            $qsqldepartment = mysqli_query($con, $sqldepartment);
                                            while ($rsdepartment = mysqli_fetch_array($qsqldepartment)) {
                                                if ($rsdepartment['departmentid'] == $rsedit['departmentid']) {
                                                    echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
                                                } else {
                                                    echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="date" name="appointmentdate" id="appointmentdate" value="<?php echo $rsedit['appointmentdate']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="time" name="time" id="time" value="<?php echo $rsedit['appointmenttime']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="select6" id="select6" class="form-control show-tick">
                                            <option value="">Sélectionner un médecin</option>
                                            <?php
                                            $sqldoctor = "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
                                            $qsqldoctor = mysqli_query($con, $sqldoctor);
                                            while ($rsdoctor = mysqli_fetch_array($qsqldoctor)) {
                                                if ($rsdoctor['doctorid'] == $rsedit['doctorid']) {
                                                    echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorname] ( $rsdoctor[departmentname] )</option>";
                                                } else {
                                                    echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorname] ( $rsdoctor[departmentname] )</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" class="form-control no-resize" name="appreason" id="appreason"><?php echo $rsedit['app_reason']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group drop-custum">
                                    <select name="select" id="select" class="form-control show-tick">
                                        <option value="">Sélectionner un statut</option>
                                        <?php
                                        $arr = array("Active", "Inactive");
                                        foreach ($arr as $val) {
                                            if ($val == $rsedit['status']) {
                                                echo "<option value='$val' selected>$val</option>";
                                            } else {
                                                echo "<option value='$val'>$val</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit" value="Soumettre" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'adfooter.php'; ?>
<script type="application/javascript">
    function validateform() {
        if (document.frmappnt.select4.value == "") {
            alert("Le nom du patient ne doit pas être vide.");
            document.frmappnt.select4.focus();
            return false;
        } else if (document.frmappnt.select3.value == "") {
            alert("Le type de chambre ne doit pas être vide.");
            document.frmappnt.select3.focus();
            return false;
        } else if (document.frmappnt.select5.value == "") {
            alert("Le département ne doit pas être vide.");
            document.frmappnt.select5.focus();
            return false;
        } else if (document.frmappnt.appointmentdate.value == "") {
            alert("La date du rendez-vous ne doit pas être vide.");
            document.frmappnt.appointmentdate.focus();
            return false;
        } else if (document.frmappnt.time.value == "") {
            alert("L'heure du rendez-vous ne doit pas être vide.");
            document.frmappnt.time.focus();
            return false;
        } else if (document.frmappnt.select6.value == "") {
            alert("Le nom du médecin ne doit pas être vide.");
            document.frmappnt.select6.focus();
            return false;
        } else if (document.frmappnt.select.value == "") {
            alert("Veuillez sélectionner un statut.");
            document.frmappnt.select.focus();
            return false;
        } else {
            return true;
        }
    }
</script>
