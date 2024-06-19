<?php

include_once('../includes/session.php');
include_once('../includes/redirect.php');
include_once('../includes/input_validation.php');

include_once('../database/restaurante.class.php');
include_once('../database/user.class.php');

include_once('../database/categoria.enum.php');


$username = $_SESSION['username'];
if ($username == null) {
    die(redirect_login('error', 'Please log in to edit your restaurant'));
}

$rest_id = $_POST['rest_id'];

// validate the new first name
$new_rest_name = $_POST['new_rest_name'];
$new_rest_address = $_POST['new_rest_address'];
$new_category = $_POST['new_category'];

if (!check_input_names($new_rest_name)) {
    die(redirect('error', 'Title: invalid characters'));
}

if (!check_input_address($new_rest_address)) {
    die(redirect('error', 'Address: invalid characters'));
}

updateRestaurant($rest_id, $new_rest_name, $new_rest_address, Categoria::matchCatValue($new_category), $username);

die(redirect('success', 'Restaurany updated!'));
