<?php

declare(strict_types=1);
include_once('../includes/session.php');
include_once('../templates/common.php');
include_once('../templates/restaurant_template.php');
include_once('../database/user.class.php');
include_once('../database/restaurante.class.php');

if ($_SESSION['username'] == null) {
    die(redirect_login('error', 'Please log in to see your restaurants.'));
}

//$user = getUserObj($_SESSION['username']);
$username = $_SESSION['username'];
$user_restaurants = get_user_restaurants($username);
$number_of_restaurants = count($user_restaurants);

?>



<!DOCTYPE html>
<html>

<?php drawHead(); ?>
    <link href="../css/common.css" rel="stylesheet">
    <link href="../css/favorites.css" rel="stylesheet">
    <link href="../css/edit_restaurant.css" rel="stylesheet">
</head>

<body>
    <?php drawHeader(); ?>

    <div class="content">
        <h1>Os meus Restaurantes</h1>
        <div class="openBtn">
            <button style="width: 213px;" class=" openButton" onclick="openForm()">Criar Restaurante</button>
        </div>
        <div class="restaurantPopup">
            <div class="formPopup" id="popupForm">
                <form action="../actions/action_add_restaurant.php" class="formContainer" method="post">
                    <h1>Criar Restaurante</h1>
                    <div class="input_group" style="margin-bottom: 0px;">
                        <label for="rest_name">Nome</label>
                        <input type="text" placeholder="Restaurant name" name="rest_name" required>
                    </div>
                    <div class="input_group" style="margin-bottom: 0px;">
                        <label for="rest_address">Morada</label>
                        <input type="text" placeholder="Restaurant address" name="rest_address" required>
                    </div>
                    <div class="input_group" style="margin-bottom: 0px;">
                        <label for="category" form="edit_restaurant">Categoria</label>
                        <select name="category">
                            <?php 
                            $categories = getCategories();
                            $number_of_categories = count($categories);
                            if ($number_of_categories > 0) {
                                foreach ($categories as $category) {?>
                                    <option value="<?=$category['category'];?>"><?=$category['category']; ?></option><?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <button class="submit" type="submit">Criar Restaurante</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Cancelar</button>
                </form>
            </div>
        </div>
        <script>
            function openForm() {
                document.getElementById("popupForm").style.display = "block";
            }

            function closeForm() {
                document.getElementById("popupForm").style.display = "none";
            }
        </script>

        <?php
        if ($number_of_restaurants > 0) {
            foreach ($user_restaurants as $user_restaurant) {
                //$image = get_restaurant_preview_image($user_restaurant['id']);
                drawRestCardEdit($user_restaurant);
            }
        } else {
            drawNoRestaurants();
        }
        ?>

    </div>

</body>

</html>