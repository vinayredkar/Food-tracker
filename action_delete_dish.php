<?php

include_once('../includes/session.php');
include_once('../includes/redirect.php');
include_once('../includes/input_validation.php');

include_once('../database/prato.class.php');

$username = $_SESSION['username'];

if ($username == null) {
    die(redirect_login('error', 'Please login to continue.'));
}
$prato_id = $_GET["prato_id"];
deleteDish($prato_id);

die(redirect('success', 'Property deleted!'));
