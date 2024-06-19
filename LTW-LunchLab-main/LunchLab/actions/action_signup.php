<?php

include_once('../includes/session.php');
include_once('../includes/input_validation.php');
include_once('../database/user.class.php');
include_once('../includes/redirect.php');


$username = $_POST['username'];
$phonenumber = $_POST['phone'];
$address = $_POST['address'];
$password = $_POST['password'];
$repeat_password = $_POST['repeat_password'];

if ($password !== $repeat_password) {
    die(redirect_signup('error', 'Passwords do not match.'));
}


// check if the username has any invalid characters
if (!check_input($username)) {
    die(redirect_signup('error', 'Username contain letters, numbers and some special characters.'));
}

// check if the username is available
if (!availableUsername($username)) {
    die(redirect_signup('error', 'Username already taken.'));
}

// check if the password is valid
if (!check_password($password)) {
    die(redirect_signup('error', 'Invalid password (5 characters or more, minimum 1 letter and 1 number, limited special chars).'));
}


try {
    insertUser($username, $password, $name, $phonenumber, $address);
    $_SESSION['username'] = $username;
    die(redirect('success', 'Signed up and logged in!'));
} catch (PDOException $e) {
    die(redirect('error', 'Failed to sign up.'));
}
