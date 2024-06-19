<?php

include_once('../includes/session.php');

if ($_SESSION['username'] == NULL) {
    header("Location: ../pages/login.php");
}

include_once('../database/user.class.php');

$username = $_SESSION['username'];

$rest_id = $_GET['q'];

try{
    removeFavRest($username,$rest_id);
}
catch(PDOException $e){}



?>
