<?php
/**
 * Created by PhpStorm.
 * User: starkogi
 * Date: 2018-07-21
 * Time: 5:34 PM
 */
include 'db_auth.php';


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST) == 'test' && isset($_POST) == 'opd'){

    $test = mysqli_real_escape_string($db,$_POST['test']);

    $sql = "SELECT * FROM `services`";
    $result = mysqli_query($db,$sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $serviceid = $row['id'];

        }
    }

    $pid = mysqli_real_escape_string($db,$_POST['opd']);
    ;
    $sql = "INSERT INTO `lab_test` (`id`, `pid`, `serviceid`, `results`, `timestamp`) VALUES (NULL, '$pid', '$serviceid', '', CURRENT_TIMESTAMP);";

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
