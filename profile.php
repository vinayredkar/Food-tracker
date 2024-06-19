<?php

include_once('../includes/session.php');
include_once('../templates/common.php');
include_once('../templates/profile_template.php');
include_once('../database/user.class.php');
include_once('../includes/input_validation.php');
include_once('../includes/redirect.php');

$username = $_GET['username'];
if (!check_input($username)) {
    die(redirect('error', 'Username: invalid characters'));
}

$profile_info = getUserInfo($username);

if ($profile_info == null) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Could not find user with username: ' . $username);
    die(header('Location: ../index.php'));
}

?>

<!DOCTYPE html>
<html>

<?php drawHead(); ?>
    <link href="../css/common.css" rel="stylesheet">
    <link href="../css/edit_profile.css" rel="stylesheet">
</head>

<body>

    <?php drawHeader(); ?>
    <?php drawProfile($profile_info); ?>

</body>

</html>