<?php include 'header.php';?>
<?php include 'nav_bar.php';?>

<?php 
include 'db_auth.php';

if ( $_SESSION['role'] != null && $_SESSION['role'] != 3) {
    header("location: index.php");
}
$sql = "SELECT opd_reg.id, opd_reg.patient_id, opd_reg.timestamp, patient.name, patient.DOB, patient.gender, 
      patient.blood_group, patient.phone FROM `opd_reg` JOIN patient ON opd_reg.patient_id = patient.id";
      $result = mysqli_query($db,$sql);
?>

<div class="panel panel-primary">
  <div class="panel-heading"> OPD Queue </div>
  <div class="panel-body">

    <table class="table table-condensed table-primary">
      <thead>
        <tr>
          <th>SELECT</th>
            <th>OPD NO</th>
            <th>REG NO</th>
          <th>NAME</th>
          <th>DOB</th>
          <th>GENDER</th>
        </tr>        
      </thead>
      <tbody>
       
          <?php 
  
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

    echo "<tr>";
    echo "<td> <button class='btn btn-sm btn-primary' onclick='selectPatient($row[id])'>Select</button></td>";
        echo "<td>" . $row['id'] ."</td>";
        echo "<td>" . $row['patient_id'] ."</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['DOB'] . "</td>";
    echo "<td>" . $row['gender'] . "</td>";
    echo "</tr>";
    }
} 
?>
      </tbody>
    </table>

  </div>
</div>
<?php include 'footer.php';?>

<script type="text/javascript">
  function selectPatient(id){
      window.location.href = "consultation.php?id=" + id;
  }
</script>