<?php include 'header.php'; ?>
<?php include 'nav_bar.php'; ?>
<?php include 'functions.php'; ?>

<?php

$id = mysqli_real_escape_string($db, $_GET['id']);
$sql = "SELECT opd_reg.id, opd_reg.patient_id, opd_reg.timestamp, patient.name, patient.DOB, patient.gender, 
patient.blood_group, patient.phone FROM `opd_reg` JOIN patient ON opd_reg.patient_id = patient.id WHERE opd_reg.id=" . "3";

$result = mysqli_query($db, $sql);

$data;

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $data = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $pid = $_GET['id'];

    //TODo Take registrer Id from Session
    $doctorId = "1";

    $chief_complains = mysqli_real_escape_string($db, $_POST['chief_complains']);
    $complain_date = mysqli_real_escape_string($db, $_POST['complain_date']);
    $treatment_taken = mysqli_real_escape_string($db, $_POST['treatment_taken']);

    $sql = "INSERT INTO `diagnosis` (`id`, `pid`, `diagnosis`, `doctorId`, `complain_date`, `timestamp`) 
VALUES (NULL, '$pid', '$chief_complains', '$doctorId', '$complain_date', CURRENT_TIMESTAMP);";

    $result = mysqli_query($db, $sql);

    if ($result === TRUE) {
        echo "<div class=\"alert alert-success alert-dismissible\">
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
  <strong>Success!</strong> New record created successfully
</div>";
    } else {
        echo "<div class=\"alert alert-danger alert-dismissible\">
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
  <strong>Success!</strong> An Error Occured
</div>";
    }
}
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
    <div class="panel-heading"> Diagnosis</div>
    <div class="panel-body">

        <h2>Recent Diagnostics</h2>
        <?php
            $res_diag = "SELECT * FROM diagnosis WHERE pid = '".$_GET['id'] ."' ORDER BY id DESC LIMIT 1";
            $result2 = mysqli_query($db, $res_diag);
            while($row = $result2->fetch_assoc()) {

                echo "<b><h4 class='text-primary'>". $row['complain_date'] ."</h4></b>";
                echo "<p>". $row['diagnosis'] . "</p>";

            }
        ?>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home"> Chief Complaints</a></li>
            <li><a data-toggle="pill" href="#menu1">Investigation</a></li>
            <li><a data-toggle="pill" href="#menu4">Treatment</a></li>
        </ul>

        <p id="ErrorBay"></p>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="panel panel-primary">
                    <div class="panel-heading"> Chief Complaints Details</div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group col-md-4">
                                <label for="chief_complains">Chief Complaints:</label>
                                <textarea name="chief_complains" style="height: 200px;" type="chief_complains"
                                          class="form-control" id="chief_complains"></textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pwd">Complaint Date:</label>
                                <input type="date" name="complain_date" required="required" class="form-control"
                                       placeholder="Complaints Date" aria-describedby="basic-addon1">

                                <label for="pwd">Treatment Taken:</label>
                                <textarea placeholder="Treatment Taken" name="treatment_taken" style="height: 140px;"
                                          type="chief_complains"
                                          class="form-control" id="chief_complains"></textarea>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">History of Present Patient :</label>
                                <div name="chief_complains" style="height: 200px; overflow: auto;" disabled="disabled"
                                          type="chief_complains" class="form-control" id="chief_complains">

                                    <?php
                                    $res_all_diag = "SELECT * FROM diagnosis WHERE pid = '".$_GET['id'] ."' ORDER BY id DESC ";
                                    $result3 = mysqli_query($db, $res_all_diag);
                                    while($row = $result3->fetch_assoc()) {

                                        echo "<b><h4 class='text-primary'>". $row['complain_date'] ."</h4></b>";
                                        echo "<p>". $row['diagnosis'] . "</p>";

                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade in">
                <div class="panel panel-primary">
                    <div class="panel-heading"> Test Registration</div>
                    <div class="panel-body">
                        <form id="tests">
                            <div class="form-group col-md-4 col-md-offset-8">
                                <form autocomplete="off">
                                    <div class="autocomplete" style="width:300px;">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">Test</span>
                                            <input id="test" name="test" class="form-control"
                                                   placeholder="Test">
                                            <?php echo '<input hidden id="opd" name="opd" value="' . $_GET['id'] . '">' ?>
                                            <span class="btn btn-primary input-group-addon"
                                                  id="basic-addon1" onclick="saveTests();">Add Test</span>

                                            <script type="text/javascript">
                                                function saveTests()
                                                {
                                                    var data = $('#tests').serialize();

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "add_lab_test.php",
                                                        data: data,
                                                        dataType: "text",
                                                        success: function(resultData){
                                                            $('#ErrorBay').html(resultData);

                                                            $('#test_list').append(
                                                                "<tr>\n" +
                                                                "                                    <td>\n" +
                                                                "                                        <button class=\"btn btn-xs btn-primary\" id=\"\">Delete</button>\n" +
                                                                "                                    </td>\n" +
                                                                "                                    <td>" + $('#test').val()+ "</td>\n" +
                                                                "                                    <td></td>\n" +
                                                                "                                    <td>Sent</td>\n" +
                                                                "                                    <td>Dev</td>\n" +
                                                                "                                </tr>");

                                                            $('#test').val('');

                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <table class="table table-bordered table-condensed ">
                                <thead class="panel-heading">
                                <tr>
                                    <th></th>
                                    <th>Test/Profile Name</th>
                                    <th>Payable Amount</th>
                                    <th>Status</th>
                                    <th>Doctor</th>
                                </tr>
                                </thead>
                                <tbody id="test_list">

                                </tbody>
                            </table>
                            <div class="checkbox  col-md-4">
                                <button type="submit" class="btn  btn-sm btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="menu4" class="tab-pane fade in">
                <div class="panel panel-primary">
                    <div class="panel-heading"> Treatment</div>
                    <div class="panel-body">

                        <form id="treatments">
                            <div class="form-group col-md-6">
                                <label for="notes">Doctor Notes:</label>
                                <textarea name="notes" style="height: 200px;" type="text" class="form-control" id="notes">

                                </textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="drugs">drugs:</label>
                                <textarea name="drugs"  style="height: 200px;"type="text" class="form-control" id="drugs"></textarea>
                            </div>
                            <?php echo '<input hidden id="opd" name="opd" value="' . $_GET['id'] . '">' ?>
                            <div class="form-group col-md-12">
                                <button type="button" onclick="saveTreatments();" class="btn btn-primary">Submit</button>
                                <script type="text/javascript">
                                    function saveTreatments()
                                    {
                                        var data = $('#treatments').serialize();

                                        $.ajax({
                                            type: "POST",
                                            url: "save_treatments.php",
                                            data: data,
                                            dataType: "text",
                                            success: function(resultData){
                                                $('#ErrorBay').html(resultData);


                                                $('#notes').val('');
                                                $('#drugs').val('');

                                            }
                                        });
                                    }
                                </script>
                            </div>

                        </form>

                        <table class="table table-bordered table-condensed ">
                            <thead class="panel-heading">
                            <tr>
                                <th>#</th>
                                <th>Test/Profile Name</th>
                                <th>Results</th>
                                <th>Request Date</th>
                            </tr>
                            </thead>
                            <tbody >
                            <?php
                            $sql = "SELECT lab_test.id, lab_test.results, lab_test.timestamp, services.service_name FROM `lab_test` JOIN 
services ON lab_test.serviceid = services.id WHERE lab_test.pid=" . $_GET['id'] . "";
                            $result = mysqli_query($db,$sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {

                                    echo "<td>" . $row['id'] ."</td>";
                                    echo "<td>" . $row['service_name'] ."</td>";
                                    echo "<td>" . $row['results'] . "</td>";
                                    echo "<td>" . $row['timestamp'] . "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>


        <script type="text/javascript">
            $("#test").autocomplete({
                source: "getTests.php?depId=" + 1 + "&term=" + $('#test').val(),
            });

        </script>