<?php

declare(strict_types=1);
include_once('../templates/common.php');
include_once('../templates/prato_card.php');
include_once('../templates/restaurant_template.php');
include_once('../includes/session.php');
//include_once('../templates/favorites.tpl.php');
include_once('../database/prato.class.php');
include_once('../database/restaurante.class.php');
include_once('../database/user.class.php');
include_once('../templates/restaurant_template.php');


if ($_SESSION['username'] == null) {
    die(redirect_login('error', 'Please log in to check your favorites.'));
}

$user = getUserObj($_SESSION['username']);

?>

<!DOCTYPE html>
<html>

<?php drawHead(); ?>
<link href="../css/common.css" rel="stylesheet">
<link href="../css/favorites.css" rel="stylesheet">
</head>

<body>
    <?php drawHeader(); ?>

    <div class="content">
        <h1>Restaurantes Favoritos</h1>
        <?php
        $fav_rests = $user->getFavRest();
        if (count($fav_rests) > 0) {
            foreach ($fav_rests as $fav_rest) {
                drawRestCardDisplay($fav_rest);
            }
        } else { ?>
            <p>Ainda não tens aqui os teus favoritos? :( </p>
        <?php
        }
        ?>

        <h1>Pratos Favoritos</h1>
        <?php
        $fav_dishes = $user->getFavDishes();
        if (count($fav_dishes) != 0) drawPratosCards($fav_dishes);
        else {
        ?>
            <p>Nem uma sandocha? :( </p>
        <?php
        }

        ?>
    </div>

</body>

</html>