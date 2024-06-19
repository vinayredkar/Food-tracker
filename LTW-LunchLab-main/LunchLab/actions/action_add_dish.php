<?php

include_once('../includes/session.php');
include_once('../includes/redirect.php');

include_once('../database/categoria.prato.enum.php');
include_once('../database/prato.class.php');
include_once('../database/restaurante.class.php');
include_once('../database/user.class.php');



$username = $_SESSION['username'];

$rest_id = $_POST['rest_id'];
$prato_nome = $_POST['prato_nome'];
$preco = $_POST['preco'];
$categoria = $_POST['categoria'];

if ($username == null) {
    die(redirect_login('error', 'Please log in to add a plate.'));
}

if ($preco <= 0) {
    die(redirect('error', 'Preço tem de ser superior a 0'));
}


$restaurant_info = getRestaurantInfo($rest_id);
/*if ($restaurant_info['owner'] != $username) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Não podes editar um restaurante que não é teu.');
    die(header('Location: ../index.php'));
}*/

add_plate($rest_id, $prato_nome, $preco, CategoriaPrato::matchCatValue($categoria));

die(redirect('success', 'Plate Created!'));
