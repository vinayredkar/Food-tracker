<?php

include_once('../includes/session.php');
include_once('../includes/redirect.php');


session_destroy();
session_start();


$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged out!');
header('Location: ../index.php');
