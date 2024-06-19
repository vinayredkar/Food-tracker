<?php

include_once('../includes/session.php');
include_once('../includes/redirect.php');

include_once('../database/categoria.prato.enum.php');
include_once('../database/prato.class.php');
include_once('../database/restaurante.class.php');
include_once('../database/user.class.php');
include_once('../database/encomenda.class.php');



$username = $_SESSION['username'];

$prato_id = $_POST['prato_id'];
$encomenda_id = $_POST['encomenda_id'];

if ($username == null) {
    die(redirect_login('error', 'Please log in to edit cart.'));
}

$pratoEncomenda = get_order_plate($encomenda_id, $prato_id);
$quantidade = $pratoEncomenda['quantidade'] + 1;
//echo $quantidade;
update_order_plate($prato_id, $encomenda_id, $quantidade);



die(redirect('success', 'Plate added to cart!'));
