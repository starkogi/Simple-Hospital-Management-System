<?php
include 'db_auth.php';

function calculateAge($birthDate){
# procedural
echo date_diff(date_create($birthDate), date_create('today'))->y;
  }
