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
$estado = $_POST['estado'];

if ($username == null) {
    die(redirect_login('error', 'Please log in to edit cart.'));
}

$orders = orders_of_restaurant($rest_id, $estado);

drawOrder($orders, 'client');

die(redirect('success', 'Plate added to cart!'));
