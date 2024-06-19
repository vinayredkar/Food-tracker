<?php

include_once('../includes/session.php');
include_once('../includes/redirect.php');
include_once('../includes/input_validation.php');

include_once('../database/restaurante.class.php');


$username = $_SESSION['username'];

if ($username == null) {
    die(redirect_login('error', 'Please login to continue.'));
}


$rest_id = $_GET['rest_id'];
$info =  getRestaurantInfo($rest_id);

if ($info['dono'] != $username) {
    die(redirect('error', 'You cannot delete other user property'));
}
deleteRestaurant($rest_id);

die(redirect('success', 'Property deleted!'));
