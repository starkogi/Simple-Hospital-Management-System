<?php
/**
 * Created by PhpStorm.
 * User: starkogi
 * Date: 2018-07-21
 * Time: 12:29 PM
 */
//
//if ($_SESSION['user'] == '' || $_SESSION['role'] == '') {
//    header("location: login.php");
//
//}

if(isset($_SESSION['user']) && !empty($_SESSION['role'])) {
    header("location: login.php");
}