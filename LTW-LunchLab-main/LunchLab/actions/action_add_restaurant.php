<?php

include_once('../includes/session.php');
include_once('../includes/redirect.php');
include_once('../includes/input_validation.php');

include_once('../database/user.class.php');
include_once('../database/restaurante.class.php');

include_once('../database/categoria.enum.php');


$rest_name = $_POST['rest_name'];
$rest_address = $_POST['rest_address'];
$category = $_POST['category'];
$dono = $_SESSION['username'];

//verify if user is logged in
if (!isset($_SESSION['username'])) {
    die(redirect_login('error', 'Please log in to list your restaurant.'));
}


if (!check_input($rest_name)) {
    die(redirect('error', 'Restaurant Name: invalid characters'));
}

if (!check_input_address($rest_address)) {
    die(redirect('error', 'Address: invalid characters'));
}

addRestaurant($rest_name, $rest_address, Categoria::matchCatValue($category), $dono);

$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Restaurant added successfuly!');
header("Location: ../pages/edit_profile_owner.php");
