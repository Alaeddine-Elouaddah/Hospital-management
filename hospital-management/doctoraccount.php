<?php
include("adheader.php");
include 'dbconnection.php';

if(!isset($_SESSION['doctorid'])) {
    echo "<script>window.location='doctorlogin.php';</script>";
}

// Récupérer les informations du médecin
$sql = "SELECT * FROM `doctor` WHERE doctorid = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['doctorid']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$doc = mysqli_fetch_array($result);
?>

<div class="container-fluid">
    <div class="block-header">
        <h2>Welcome <?php echo 'Dr. ' . $doc['doctorname']; ?></h2>
    </div>
</div>

<div class="card">
    <section class="container">
        <div class="row clearfix" style="margin-top: 10px">
            <!-- Nouveau rendez-vous -->
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <i class="zmdi zmdi-file-plus col-blue"></i> </div>
                    <div class="content">
                        <div class="text">New Appointment</div>
                        <div class="number">
                            <?php
                            $sql = "SELECT * FROM appointment WHERE doctorid = ? AND appointmentdate = ?";
                            $stmt = mysqli_prepare($con, $sql);
                            $date = date("Y-m-d");
                            mysqli_stmt_bind_param($stmt, 'is', $_SESSION['doctorid'], $date);
                            mysqli_stmt_execute($stmt);
                            $qsql = mysqli_stmt_get_result($stmt);
                            echo mysqli_num_rows($qsql);
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nombre de patients -->
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <i class="zmdi zmdi-account col-cyan"></i> </div>
                    <div class="content">
                        <div class="text">Number of Patients</div>
                        <div class="number">
                            <?php
                            $sql = "SELECT * FROM patient WHERE status = 'Active'";
                            $qsql = mysqli_query($con, $sql);
                            echo mysqli_num_rows($qsql);
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rendez-vous approuvés aujourd'hui -->
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <i class="zmdi zmdi-account-circle col-blush"></i> </div>
                    <div class="content">
                        <div class="text">Today's Appointment</div>
                        <div class="number">
                            <?php
                            $sql = "SELECT * FROM appointment WHERE status = 'Approved' AND doctorid = ? AND appointmentdate = ?";
                            $stmt = mysqli_prepare($con, $sql);
                            mysqli_stmt_bind_param($stmt, 'is', $_SESSION['doctorid'], $date);
                            mysqli_stmt_execute($stmt);
                            $qsql = mysqli_stmt_get_result($stmt);
                            echo mysqli_num_rows($qsql);
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total des gains -->
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <i class="zmdi zmdi-money col-green"></i> </div>
                    <div class="content">
                        <div class="text">Total Earnings</div>
                        <div class="number">
                            <?php
                            $sql = "SELECT sum(bill_amount) as total FROM billing_records WHERE bill_type = 'Consultancy Charge'";
                            $qsql = mysqli_query($con, $sql);
                            $row = mysqli_fetch_assoc($qsql);
                            echo ($row['total'] > 0) ? '$' . $row['total'] : '$0';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include("adfooter.php");
?>
