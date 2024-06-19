<?php

include_once('../includes/session.php');
include_once('../includes/redirect.php');
include_once('../includes/input_validation.php');

include_once('../database/user.class.php');
include_once('../database/restaurante.class.php');

include_once('../database/review.class.php');

$username = $_SESSION['username'];

$review_id = $_POST['review_id'];
$comment = $_POST['comment'];
//$rest_id = $_POST['rest_id'];

//verify if user is logged in
if (!isset($_SESSION['username'])) {
    die(redirect_login('error', 'Please log in to list your restaurant.'));
}

if (!check_review($comment)) {
    die(redirect('error', 'Comment: invalid characters'));
}


add_response($review_id, $comment);

die(redirect('success', 'Review added'));
