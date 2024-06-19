<?php
include_once('../includes/session.php');
include_once('../includes/redirect.php');

include_once('../database/categoria.prato.enum.php');
include_once('../database/prato.class.php');
include_once('../database/restaurante.class.php');
include_once('../database/user.class.php');


$rest_id = $_POST['rest_id'];
$location = "../images/restaurant/".$rest_id;
$filename = $_FILES['file']['name'];
unlink($location);


if (move_uploaded_file($_FILES['file']['tmp_name'], $location)){
	echo "<script type='text/javascript'>alert('Fotografia de perfil alterada com sucesso!')</script>";
}else{
	echo "<script type='text/javascript'>alert('Ocorreram problemas ao carregar o ficheiro :(')</script>";
}


die(redirect('success', 'Restaurant updated!'));
?>