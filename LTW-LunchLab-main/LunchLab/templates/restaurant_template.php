<?php

declare(strict_types=1);
include_once('../database/restaurante.class.php');
include_once('../database/user.class.php');
include_once('../includes/session.php');

if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
}

function drawRestCardEdit($restaurant)
{ ?>
    <div class="card" id="restaurant">
        <div class="card_info">
            <p title="<?= $restaurant['rest_name'] ?>"><?= $restaurant['rest_name'] ?></p>
            <p class="price"><?= $restaurant['category'] ?></p>
            <div class="card_buttons">
                <button class="card_fav_btn" onclick="location.href = '../pages/edit_restaurant.php?rest_id=<?= $restaurant['rest_id'] ?>';">
                    <img src="../images/edit.svg" alt="Icone de um lápis (editar)"></img>
                </button>
                <button class="card_fav_btn" onclick="location.href='../actions/action_delete_restaurant.php?rest_id=<?= $restaurant['rest_id'] ?>';">
                    <img src="../images/delete.svg" alt="Icone de um caixote do lixo (apagar)"></img>
                </button>
            </div>
        </div>
        <div class="card_image">
            <?php
            getRestProfilePic($restaurant);
            ?>></img>
        </div>
    </div>
<?php } ?>

<?php function drawNoRestaurants()
{ ?>
    <section id="no_restaurants">
        Ainda não tem restaurantes.
    </section>
<?php } ?>

<?php function drawRestCardDisplay($restaurant)
{
    $restObj = getRestaurantObject($restaurant['rest_id']);
    $average_rating = round($restObj->getScore() * 10) / 10;

    echo '<div class="card" id="restaurant">
        <div class="card_info">';
    $var = false;
    if (isset($_SESSION['username'])) {
        $user = getUserObj($_SESSION['username']);
        $var = $user->doesRestBelongToFav($restaurant['rest_id']);
    }


    echo '<p title="' . $restaurant['rest_name'] . '"> <a href="../templates/restaurant.page.php?rest_id=' . $restaurant['rest_id'] . '">' . $restaurant['rest_name'] . '</a></p>';
    echo '<p class="category">' . $restaurant['category'] . '</p>';
    echo '<div class="card_buttons">
                    <script src="../javascript/favorite_button.js" defer></script>
                    <button class="card_fav_btn rest' . $restaurant['rest_id'] . '" onclick="addToFavRest(' . $restaurant['rest_id'] . ')">';
    echo '<img id="rest' . $restaurant['rest_id'] . '" src=';
    if ($var) {
        echo '"../images/favourite_selected.svg" alt="Favorite icon; heart stroke"';
    } else {
        echo '"../images/favourite_not_selected.svg" alt="Favorite outline"';
    }
    echo '></img>
                    </button>
                    <button class="card_score_btn">' . $average_rating . '</button>
                </div>
        </div>
        <div class="card_image">';
    echo getRestProfilePic($restaurant);
    echo '></img>

        </div>
    </div>';
} ?>