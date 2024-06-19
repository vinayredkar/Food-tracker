<?php

include_once('../includes/session.php');
include_once('../includes/redirect.php');
include_once('../includes/input_validation.php');

include_once('../database/user.class.php');


$username = $_SESSION['username'];
if ($username == null) {
    die(redirect_login('error', 'Please log in to change your password'));
}

$old_password = $_POST['old_password'];
if (!check_password($old_password)) {
    die(redirect('error', 'Password contains invalid characters.'));
}
if (!validCredentials($username, $old_password)) {
    die(redirect('error', 'Invalid password.'));
}

$new_password = $_POST['new_password'];
$rep_password = $_POST['rep_password'];
// check if the old password and the confirmation one are equal
if ($new_password != $rep_password) {
    die(redirect('error', 'New passwords don\'t match!'));
}
if (!check_password($new_password)) {
    die(redirect('error', 'Invalid password (5 characters or more, minimum 1 letter and 1 number, limited special characthers)'));
}

changePassword($username, $new_password);
die(redirect('success', 'Password changed successfully!'));
