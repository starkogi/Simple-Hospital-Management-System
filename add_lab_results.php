<?php
include 'header.php';
include 'nav_bar.php';
include 'functions.php';
/**
 * Created by PhpStorm.
 * User: starkogi
 * Date: 2018-07-21
 * Time: 5:41 PM
 */


$id = mysqli_real_escape_string($db, $_GET['id']);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $results = ((mysqli_real_escape_string($db, $_POST['results'])));

    $sql = "UPDATE `lab_test` SET `results` = '$results' WHERE `lab_test`.`id` = " .$id . ";";

    $result = mysqli_query($db, $sql);
if ($result === TRUE) {
           echo "<div class=\"alert alert-success alert-dismissible\">
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
  <strong>Success!</strong> New record created successfully
</div>";
       } else {
           echo "<div class=\"alert alert-danger alert-dismissible\">
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
  <strong>Failed!</strong> An Error Occured
</div>";
       }
}
$sql = "SELECT opd_reg.id FROM opd_reg JOIN lab_test ON lab_test.pid = opd_reg.id WHERE lab_test.id=" . "$id";

$result = mysqli_query($db, $sql);
$pid;
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $pid = $row;
    }
}

$sql = "SELECT opd_reg.id, opd_reg.patient_id, opd_reg.timestamp, patient.name, patient.DOB, patient.gender, 
patient.blood_group, patient.phone FROM `opd_reg` JOIN patient ON opd_reg.patient_id = patient.id WHERE opd_reg.id=" . "$pid[id]";

$result = mysqli_query($db, $sql);

$data;

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $data = $row;
    }
}


$sql = "SELECT lab_test.id, patient.name, opd_reg.patient_id, lab_test.results, lab_test.timestamp, services.service_name FROM `lab_test` JOIN services ON lab_test.serviceid = services.id
JOIN opd_reg ON lab_test.pid = opd_reg.id JOIN patient ON patient.id = opd_reg.patient_id WHERE lab_test.id = " .$id. " ORDER BY id DESC ";
$result = mysqli_query($db,$sql);


?>


<div class="panel">
    <table style="width:100%;" class="table">
        <th>
        <th>OPD No</th>
        <td>: <?php echo $data['id']; ?></td>
        <th>Reg No</th>
        <td>: <?php echo $data['patient_id']; ?></td>
        <th>Name</th>
        <td>: <?php echo $data['name']; ?></td>
        <th>Age</th>
        <td>: <?php calculateAge($data['DOB']) ?></td>
        <th>Gender</th>
        <td>: <?php echo $data['gender']; ?></td>
        <th>Blood Group</th>
        <td>: <?php echo $data['blood_group']; ?></td>
        </th>
    </table>
</div>




<div class="panel panel-primary">
    <div class="panel-heading"> Add Lab Results</div>
    <div class="panel-body">
        <form method="post">
            <div class="form-group col-md-4">
                <label for="email">Test:</label>
                <div name="" style="height: 200px; overflow: auto;" disabled="disabled"
                     type="chief_complains" class="form-control" id="chief_complains">


                    <?php


                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {

                            echo "<p> <b>Name : </b>". $row['name'] . "</p>";
                            echo "<p><b>Test : </b>". $row['service_name'] . "</p>";
                            echo "<p><b>Results : </b>". $row['results'] . "</p>";
                            echo "<p><b>Time : </b>". $row['timestamp'] . "</p>";

                        }
                    }

                    ?>

                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="chief_complains">Results:</label>
                <textarea name="results" style="height: 200px;" type="results"
                          class="form-control" id="chief_complains"></textarea>
            </div>

            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </form>

    </div>
</div>
