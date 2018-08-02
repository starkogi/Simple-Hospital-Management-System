
<?php
include 'header.php';
include 'auth.php';



?>
<br>
<br>
<div class="">
  <div class="row Jumbotron">

<h3 class="text-center" style="font-weight: bold; color: 0071f2"> MURANG'A HOSPITAL</h3>
    <nav aria-label="...">
      <ul class="pager">

        <li class="next"><a href="login.php">Logout <span aria-hidden="true">&rarr;</span></a></li>       
         <li class="next"><a href="#">Ian Harris</a></li>

      </ul>
    </nav>
    <div class=" col-xs-6 col-md-3">
      <a href="registration.php" class="thumbnail dashboard_options">
        <img src="http://localhost:200/Content/icons/dashboard/pathology-lab.png" alt="Lab">
                  Registration

      </a>
    </div>

    <div class="col-xs-6 col-md-3 ">
      <a href="opd_queue.php" class="thumbnail dashboard_options">
        <img src="http://localhost:200/Content/icons/dashboard/pathology-lab.png" alt="Lab">
              Consultation

      </a>
    </div>
    

    <div class="col-xs-6 col-md-3 ">
      <a href="lab.php" class="thumbnail dashboard_options">
        <img src="http://localhost:200/Content/icons/dashboard/pathology-lab.png" alt="Lab">
              Lab

      </a>
    </div>
    

    <div class="col-xs-6 col-md-3">
      <a href="billing.php" class="thumbnail dashboard_options">
        <img src="http://localhost:200/Content/icons/dashboard/pathology-lab.png" alt="Lab">
              Billing

      </a>
    </div>

    <div class="col-xs-6 col-md-3">
      <a href="phamarcy.php" class="thumbnail dashboard_options">
        <img src="http://localhost:200/Content/icons/dashboard/pathology-lab.png" alt="Lab">
              Phamarcy
      </a>
    </div>
    
</div>

<?php include 'footer.php';?>
