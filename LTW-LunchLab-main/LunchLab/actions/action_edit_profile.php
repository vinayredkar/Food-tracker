<?php

include_once('../includes/session.php');
include_once('../includes/input_validation.php');
include_once('../includes/redirect.php');
include_once('../database/user.class.php');

$username = $_SESSION['username'];
if ($username == null) {
    die(redirect_login('error', 'Please log in to edit your profile.'));
}

/*$new_username = $_POST['new_username'];

if ($username != $new_username && !availableUsername($new_username)) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username already taken...');
    die(header('Location: ../pages/edit_profile.php'));
}
*/

$new_name = $_POST['new_name'];
$new_address = $_POST['new_address'];
$new_phonenumber = $_POST['new_phonenumber'];

if (!check_input_names($new_name)) {
    die(redirect('error', 'Title: invalid characters'));
}

if (!check_input_address($new_address)) {
    die(redirect('error', 'Address: invalid characters'));
}


changeProfile($username, $new_name, $new_address, $new_phonenumber);
die(redirect('success', 'Profile updated!'));
