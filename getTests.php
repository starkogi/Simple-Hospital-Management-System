<?php
/**
 * Created by PhpStorm.
 * User: starkogi
 * Date: 2018-07-21
 * Time: 3:49 PM
 */

include_once 'db_auth.php';
// Get search term
$searchTerm = $_GET['term'];
$depId = $_GET['depId'];

// Get matched data from skills table
$query = $db->query("SELECT * FROM services WHERE service_name LIKE '%".$searchTerm."%' AND deptid=$depId" );

// Generate skills data array
$skillData = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){

        array_push($skillData,  $row['service_name']);
    }
}

// Return results as json encoded array
echo json_encode($skillData);

?>
