<?php

include_once('../includes/session.php');
include_once('../includes/redirect.php');
include_once('../includes/input_validation.php');

include_once('../database/prato.class.php');
include_once('../database/user.class.php');

include_once('../database/categoria.prato.enum.php');


$username = $_SESSION['username'];
if ($username == null) {
    die(redirect_login('error', 'Please log in to edit your dish'));
}

$prato_id = $_POST['prato_id'];
$prato = get_plate($prato_id);
$restaurante = $prato['restaurante'];

$new_name = $_POST['new_name'];
$new_price = $_POST['new_price'];
$new_category = $_POST['new_category'];

if (!check_input_names($new_name)) {
    die(redirect('error', 'Title: invalid characters'));
}

if ($new_price <= 0) {
    die(redirect('error', 'Price must be greater than 0'));
}

updateDish($prato_id, $new_name, $new_price, CategoriaPrato::matchCatValue($new_category), $restaurante);

die(redirect('success', 'Dish updated!'));
