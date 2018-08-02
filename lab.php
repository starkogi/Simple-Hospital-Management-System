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
?>


<div class="panel panel-primary">
    <div class="panel-heading"> Lab Queue</div>
    <div class="panel-body">
        <table class="table table-bordered table-condensed ">
            <thead class="panel-heading">
            <tr>
                <th>#</th>
                <th>Test/Profile Name</th>
                <th>Patient Name</th>
                <th>Results</th>
                <th>Bill Paid</th>
                <th>Request Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody >
            <?php
            $sql = "SELECT lab_test.id,lab_test.paid, patient.name, opd_reg.patient_id, lab_test.results, lab_test.timestamp, services.service_name FROM `lab_test` JOIN services ON lab_test.serviceid = services.id
JOIN opd_reg ON lab_test.pid = opd_reg.id JOIN patient ON patient.id = opd_reg.patient_id ORDER BY id DESC ";
            $result = mysqli_query($db,$sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $row_color = "white";
                    $text_color = "black";
                    if($row['paid'] == 0){
                        $row_color = "red";
                        $text_color = "white";
                    }
                    echo "<tr>";
                    echo "<td style='background: $row_color; color: $text_color;'>" . $row['id'] ."</td>";
                    echo "<td>" . $row['name'] ."</td>";
                    echo "<td>" . $row['service_name'] ."</td>";
                    echo "<td>" . $row['results'] . "</td>";
                    echo "<td>" . $row['paid'] . "</td>";
                    echo "<td>" . $row['timestamp'] . "</td>";
                    if($row['paid'] == 0){
                        echo "<td> <button  disabled class='btn btn-xs btn-primary' onclick='selectPatient($row[id])'>Select</button></td>";
                    }else{
                        echo "<td> <button  class='btn btn-xs btn-primary' onclick='selectPatient($row[id])'>Select</button></td>";
                    }
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function selectPatient(id){
        window.location.href = "add_lab_results.php?id=" + id;
    }
</script>