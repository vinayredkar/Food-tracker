<?php

include_once('../includes/session.php');
include_once('../includes/redirect.php');

include_once('../database/categoria.prato.enum.php');
include_once('../database/prato.class.php');
include_once('../database/restaurante.class.php');
include_once('../database/user.class.php');
include_once('../database/encomenda.class.php');



$username = $_SESSION['username'];

$order_id = $_POST['order_id'];
$state = $_POST['state'];

if ($username == null) {
    die(redirect_login('error', 'Please log in to edit cart.'));
}

update_order($order_id, $state);

die(redirect('success', 'Plate added to cart!'));
