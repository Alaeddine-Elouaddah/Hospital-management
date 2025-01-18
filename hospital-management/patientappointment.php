<?php

include("header.php");
include("dbconnection.php");

if(isset($_POST['submit']))
{
    if(isset($_SESSION['patientid']))
    {
        $lastinsid = $_SESSION['patientid'];
    }
    else
    {
        $dt = date("Y-m-d");
        $tim = date("H:i:s");
        $sql = "INSERT INTO patient(patientname, admissiondate, admissiontime, address, city, mobileno, loginid, password, gender, dob, status) 
                VALUES ('$_POST[patiente]', '$dt', '$tim', '$_POST[textarea]', '$_POST[city]', '$_POST[mobileno]', '$_POST[loginid]', '$_POST[password]', '$_POST[select6]', '$_POST[dob]', 'Active')";
        if($qsql = mysqli_query($con, $sql))
        {
            /* echo "<script>alert('Enregistrement du patient ajouté avec succès...');</script>"; */
        }
        else
        {
            echo mysqli_error($con);
        }
        $lastinsid = mysqli_insert_id($con);
    }

    $sqlappointment = "SELECT * FROM appointment WHERE appointmentdate='$_POST[appointmentdate]' AND appointmenttime='$_POST[appointmenttime]' AND doctorid='$_POST[doct]' AND status='Approved'";
    $qsqlappointment = mysqli_query($con, $sqlappointment);
    if(mysqli_num_rows($qsqlappointment) >= 1)
    {
        echo "<script>alert('Un rendez-vous est déjà programmé pour cette heure..');</script>";
    }
    else
    {
        $sql = "INSERT INTO appointment(appointmenttype, patientid, appointmentdate, appointmenttime, app_reason, status, departmentid, doctorid) 
                VALUES ('ONLINE', '$lastinsid', '$_POST[appointmentdate]', '$_POST[appointmenttime]', '$_POST[app_reason]', 'Pending', '$_POST[department]', '$_POST[doct]')";
        if($qsql = mysqli_query($con, $sql))
        {
            echo "<script>alert('Rendez-vous ajouté avec succès...');</script>";
        }
        else
        {
            echo mysqli_error($con);
        }
    }
}

if(isset($_GET['editid']))
{
    $sql = "SELECT * FROM appointment WHERE appointmentid='$_GET[editid]'";
    $qsql = mysqli_query($con, $sql);
    $rsedit = mysqli_fetch_array($qsql);
}

if(isset($_SESSION['patientid']))
{
    $sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]'";
    $qsqlpatient = mysqli_query($con, $sqlpatient);
    $rspatient = mysqli_fetch_array($qsqlpatient);
    $readonly = " readonly";
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="wrapper col4">
    <div id="container">

        <?php
        if(isset($_POST['submit']))
        {
            if(mysqli_num_rows($qsqlappointment) >= 1)
            {
                echo "<h2>Un rendez-vous est déjà programmé pour le ". date("d-M-Y", strtotime($_POST['appointmentdate'])) . " à " . date("H:i A", strtotime($_POST['appointmenttime'])) . " .. </h2>";
            }
            else
            {
                if(isset($_SESSION['patientid']))
                {
                    echo "<h2 class='text-center'>Rendez-vous pris avec succès.. </h2>";
                    echo "<p class='text-center'>L'enregistrement du rendez-vous est en attente. Veuillez vérifier l'état du rendez-vous.</p>";
                    echo "<p class='text-center'> <a href='viewappointment.php'>Voir l'enregistrement du rendez-vous</a>.</p>";
                }
                else
                {
                    echo "<h2 class='text-center'>Rendez-vous pris avec succès.. </h2>";
                    echo "<p class='text-center'>L'enregistrement du rendez-vous est en attente. Veuillez attendre un message de confirmation.. </p>";
                    echo "<p class='text-center'> <a href='patientlogin.php'>Cliquez ici pour vous connecter</a>.</p>";
                }
            }
        }
        else
        {
            ?>
            <!-- Contenu -->
            <div id="content">


                <!-- Prendre un rendez-vous -->
                <section class="main-oppoiment ">
                    <div class="container">
                        <div class="row">

                            <!-- Prendre un rendez-vous -->
                            <div class="col-lg-7">
                                <div class="appointment">

                                    <!-- Titre -->
                                    <div class="heading-block head-left margin-bottom-50">
                                        <h4>Prendre un rendez-vous</h4>
                                    </div>
                                    <form method="post" action="" name="frmpatapp" onSubmit="return validateform()" class="appointment-form">
                                        <ul class="row">
                                            <li class="col-sm-6">
                                                <label>
                                                    <input placeholder="Nom du patient" type="text" class="form-control" name="patiente" id="patiente" value="<?php echo $rspatient['patientname']; ?>" <?php echo $readonly; ?>>
                                                    <i class="icon-user"></i>
                                                </label>
                                            </li>

                                            <li class="col-sm-6">
                                                <label><input placeholder="Adresse" type="text" class="form-control" name="textarea" id="textarea" value="<?php echo $rspatient['address']; ?>" <?php echo $readonly; ?>><i class="icon-compass"></i>
                                                </label>
                                            </li>
                                            <li class="col-sm-6">
                                                <label><input placeholder="Ville" type="text" class="form-control" name="city" id="city" value="<?php echo $rspatient['city']; ?>" <?php echo $readonly; ?>><i class="icon-pin"></i>
                                                </label>
                                            </li>
                                            <li class="col-sm-6">
                                                <label>
                                                    <input placeholder="Numéro de contact" type="text" class="form-control" name="mobileno" id="mobileno" value="<?php echo $rspatient['mobileno']; ?>" <?php echo $readonly; ?>><i class="icon-phone"></i>
                                                </label>
                                            </li>
                                            <?php
                                            if(!isset($_SESSION['patientid']))
                                            {
                                                ?>
                                                <li class="col-sm-6">
                                                    <label>
                                                        <input placeholder="Identifiant de connexion" type="text" class="form-control" name="loginid" id="loginid" value="<?php echo $rspatient['loginid']; ?>" <?php echo $readonly; ?>><i class="icon-login"></i>
                                                    </label>
                                                </li>
                                                <li class="col-sm-6">
                                                    <label>

                                                        <input placeholder="Mot de passe" type="password" class="form-control" name="password" id="password" value="<?php echo $rspatient['password']; ?>" <?php echo $readonly; ?>><i class="icon-lock"></i>
                                                    </label>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                            <li class="col-sm-6">
                                                <label>

                                                    <?php
                                                    if(isset($_SESSION['patientid']))
                                                    {
                                                        echo $rspatient['gender'];
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        <select name="select6" id="select6" class="selectpicker">
                                                            <option value="" selected="" hidden="">Sélectionner le genre</option>
                                                            <?php
                                                            $arr = array("Homme", "Femme");
                                                            foreach($arr as $val)
                                                            {
                                                                echo "<option value='$val'>$val</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        <?php
                                                    }
                                                    ?>
                                                    <i class="ion-transgender"></i>
                                                </label>

                                            </li>
                                            <li class="col-sm-6">
                                                <label>
                                                    <input placeholder="Date de naissance" type="text" class="form-control" name="dob" id="dob" onfocus="(this.type='date')" value="<?php echo $rspatient['dob']; ?>" <?php echo $readonly; ?>><i
                                                            class="ion-calendar"></i>
                                                </label>

                                            </li>
                                            <li class="col-sm-6">
                                                <label>
                                                    <input placeholder="Date de rendez-vous" type="text" class="form-control" min="<?php echo date("Y-m-d"); ?>" name="appointmentdate" onfocus="(this.type='date')" id="appointmentdate"><i
                                                            class="ion-calendar"></i>
                                                </label>

                                            </li>
                                            <li class="col-sm-6">
                                                <label>
                                                    <input placeholder="Heure de rendez-vous" type="text" onfocus="(this.type='time')" class="form-control" name="appointmenttime" id="appointmenttime"><i
                                                            class="ion-ios-clock"></i>
                                                </label>

                                            </li>
                                            <li class="col-sm-6">
                                                <label>

                                                    <select name="department" class="selectpicker" id="department">
                                                        <option value="">Sélectionner le département</option>
                                                        <?php
                                                        $sqldept = "SELECT * FROM department WHERE status='Active'";
                                                        $qsqldept = mysqli_query($con,$sqldept);
                                                        while($rsdept = mysqli_fetch_array($qsqldept))
                                                        {
                                                            echo "<option value='$rsdept[departmentid]'>$rsdept[departmentname]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </label>
                                            </li>
                                            <li class="col-sm-6">
                                                <label>

                                                    <select name="doct" class="selectpicker" id="doct">
                                                        <option value="">Sélectionner un docteur</option>
                                                        <?php
                                                        $sqldoctor = "SELECT * FROM doctor WHERE status='Active'";
                                                        $qsqldoctor = mysqli_query($con,$sqldoctor);
                                                        while($rsdoctor = mysqli_fetch_array($qsqldoctor))
                                                        {
                                                            echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorname]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </label>
                                            </li>
                                            <li class="col-sm-6">
                                                <label>
                                                    <input placeholder="Raison du rendez-vous" type="text" class="form-control" name="app_reason" id="app_reason">
                                                </label>
                                            </li>

                                            <li class="col-sm-12">
                                                <button type="submit" name="submit" class="btn btn-primary">Prendre un rendez-vous</button>
                                            </li>
                                        </ul>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php
include("footer.php");
?>
<script language="javascript">
    function validateform()
    {
        if(document.frmpatapp.patiente.value == "")
        {
            alert("Veuillez entrer le nom du patient.");
            document.frmpatapp.patiente.focus();
            return false;
        }
        if(document.frmpatapp.textarea.value == "")
        {
            alert("Veuillez entrer l'adresse.");
            document.frmpatapp.textarea.focus();
            return false;
        }
        if(document.frmpatapp.city.value == "")
        {
            alert("Veuillez entrer la ville.");
            document.frmpatapp.city.focus();
            return false;
        }
        if(document.frmpatapp.mobileno.value == "")
        {
            alert("Veuillez entrer le numéro de contact.");
            document.frmpatapp.mobileno.focus();
            return false;
        }
        if(document.frmpatapp.loginid.value == "")
        {
            alert("Veuillez entrer un identifiant de connexion.");
            document.frmpatapp.loginid.focus();
            return false;
        }
        if(document.frmpatapp.password.value == "")
        {
            alert("Veuillez entrer un mot de passe.");
            document.frmpatapp.password.focus();
            return false;
        }
        if(document.frmpatapp.select6.value == "")
        {
            alert("Veuillez sélectionner le genre.");
            document.frmpatapp.select6.focus();
            return false;
        }
        if(document.frmpatapp.dob.value == "")
        {
            alert("Veuillez entrer la date de naissance.");
            document.frmpatapp.dob.focus();
            return false;
        }
        if(document.frmpatapp.appointmentdate.value == "")
        {
            alert("Veuillez sélectionner une date de rendez-vous.");
            document.frmpatapp.appointmentdate.focus();
            return false;
        }
        if(document.frmpatapp.appointmenttime.value == "")
        {
            alert("Veuillez sélectionner une heure de rendez-vous.");
            document.frmpatapp.appointmenttime.focus();
            return false;
        }
        if(document.frmpatapp.department.value == "")
        {
            alert("Veuillez sélectionner un département.");
            document.frmpatapp.department.focus();
            return false;
        }
        if(document.frmpatapp.doct.value == "")
        {
            alert("Veuillez sélectionner un docteur.");
            document.frmpatapp.doct.focus();
            return false;
        }
        if(document.frmpatapp.app_reason.value == "")
        {
            alert("Veuillez entrer une raison pour le rendez-vous.");
            document.frmpatapp.app_reason.focus();
            return false;
        }
        return true;
    }
</script>
