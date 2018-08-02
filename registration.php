<?php include 'header.php';?>
<?php include 'nav_bar.php';?>

<?php 
include 'db_auth.php';

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
       //TODo Take registrer Id from Session
      $registrarid = 1;

      $fname = mysqli_real_escape_string($db,$_POST['fname']);
      $mname = mysqli_real_escape_string($db,$_POST['mname']); 
      $lname = mysqli_real_escape_string($db,$_POST['lname']);

	  $full_names = $fname. " " . $mname. " " . $lname; 
      $dob = mysqli_real_escape_string($db,$_POST['dob']); 
      $gender = mysqli_real_escape_string($db,$_POST['gender']);
      $bloodgroup = mysqli_real_escape_string($db,$_POST['bloodgroup']); 

      $phone = mysqli_real_escape_string($db,$_POST['phone']);

       $sql = "INSERT INTO `patient` (`id`, `name`, `DOB`, `gender`, `blood_group`, `phone`, `registrarid`, `timestamp`) 
        VALUES (NULL, '$full_names', '$dob', '$gender', '$bloodgroup', '$phone', '$registrarid', CURRENT_TIMESTAMP);";
      $result = mysqli_query($db,$sql);     
      
      // If result matched $myusername and $mypassword, table row must be 1 row


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

?>

<div class="panel panel-primary">
	<div class="panel-heading">	Register New Patient </div>
	<div class="panel-body">
		
<form method="post">
	<hr />
	<div class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">FirstName</span>
			<input type="text" required="required" name="fname" class="form-control" placeholder="First Name" aria-describedby="basic-addon1">
		</div>
	</div>


	<div class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Middle Name</span>
			<input type="text" name="mname" required="required" class="form-control" placeholder="Middle Name" aria-describedby="basic-addon1">
		</div>
	</div>


	<div class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Last Name</span>
			<input type="text" name="lname" required="required" class="form-control" placeholder="Last Name" aria-describedby="basic-addon1">
		</div>
	</div>

	<div class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Date Of Birth</span>
			<input type="date" name="dob" required="required" class="form-control" placeholder="Date Of Birth" aria-describedby="basic-addon1">
		</div>
	</div>

	<div class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Gender</span>
			<select required="required" class="form-control" name="gender">
				<option>Select Gender</option>
				<option>Female</option>
				<option>Male</option>
				<option>Other</option>
			</select> 
		</div>
	</div>

	<div class="col-md-4">
		<div class="input-group">
			<span required="required" class="input-group-addon" id="basic-addon1">Blood Group</span>
				<select class="form-control" name="bloodgroup">
					<option>Select Blood Group</option>
					<option>A+</option>
					<option>A-</option>
					<option>B+</option>
					<option>B-</option>

					<option>AB+</option>
					<option>AB-</option>

					<option>O+</option>
					<option>O-</option>

				</select> 
			</div>
	</div>

	<div class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Phone</span>
			<input required="required" type="number" name="phone" class="form-control" placeholder="Phone" aria-describedby="basic-addon1">
		</div>
	</div>

	<div class="col-md-12">
		<div class="input-group">
		  <button type="submit" class="btn btn-sm btn-primary">Save</button> 
		</div>
	</div>
</form>

	</div>
</div>
<?php include 'footer.php';?>
