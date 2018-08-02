<?php
/**
 * Created by PhpStorm.
 * User: starkogi
 * Date: 2018-07-21
 * Time: 5:31 PM
 */
include 'db_auth.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST) == 'notes' && isset($_POST) == 'drugs' && isset($_POST) == 'opd'){

    $test = mysqli_real_escape_string($db,$_POST['test']);

    $sql = "SELECT * FROM `services`";
    $result = mysqli_query($db,$sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $serviceid = $row['id'];

        }
    }

    $opd = mysqli_real_escape_string($db,$_POST['opd']);
    $drugs = mysqli_real_escape_string($db,$_POST['drugs']);
    $notes = mysqli_real_escape_string($db,$_POST['notes']);
    ;
    $sql = "INSERT INTO `treatment` (`id`, `opd_no`, `notes`, `drugs`, `timestamp`)
 VALUES (NULL, '$opd', '$notes', '$drugs', CURRENT_TIMESTAMP)";

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
