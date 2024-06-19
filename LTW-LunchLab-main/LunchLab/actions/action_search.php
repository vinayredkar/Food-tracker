<?php

include_once('../includes/database.php');
include_once('../database/restaurante.class.php');
include_once('../templates/restaurant_template.php');
$input = $_GET['q'];


$db = Database::instance()->db();

$stmt = $db->prepare('SELECT DISTINCT rest_id, rest_name, rest_address, category, dono FROM restaurante AS r, prato AS p WHERE r.rest_name LIKE ? OR r.category LIKE ? OR (p.prato_nome LIKE ? AND p.restaurante = r.rest_id)');
$input = $input. '%';
$stmt->execute(array($input, $input, $input));
$rests1 = $stmt->fetchAll();

$result = '';

foreach($rests1 as $rest){
    $result .= drawRestCardDisplay($rest);
}



echo $result;




//catch(PDOException $e){}  



?>