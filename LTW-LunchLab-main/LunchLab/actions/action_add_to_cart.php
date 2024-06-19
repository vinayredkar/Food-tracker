<?php

include_once('../includes/session.php');
include_once('../includes/redirect.php');

include_once('../database/categoria.prato.enum.php');
include_once('../database/prato.class.php');
include_once('../database/restaurante.class.php');
include_once('../database/user.class.php');
include_once('../database/encomenda.class.php');



$username = $_SESSION['username'];

$rest_id = $_POST['rest_id'];
$plate_id = $_POST['plate_id'];
$restaurante = getRestaurantInfo($rest_id);

if ($username == null) {
    die(redirect_login('error', 'Please log in to add a plate.'));
}

if ($username == $restaurante['dono']) {
    die(redirect_login('error', 'You cannot order from your own restaurant'));
}

$order = get_user_current_order($username);
if ($order == []) {
    add_order($rest_id, $username);
    $new_order = get_user_current_order($username);
    $first = $new_order[0];
    add_order_plate($plate_id, $first['order_id'], 1);
} else {
    $first = $order[0];
    if ($first['order_restaurant'] == $rest_id) {
        if (get_order_plate($first['order_id'], $plate_id) == NULL) {
            add_order_plate($plate_id, $first['order_id'], 1);
        }
    }
}


die(redirect('success', 'Plate added to cart!'));
