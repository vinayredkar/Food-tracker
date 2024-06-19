<?php
include_once('../includes/session.php');
include_once('../includes/redirect.php');
include_once('../templates/common.php');

include_once('../database/user.class.php');
include_once('../database/restaurante.class.php');
include_once('../database/prato.class.php');
include_once('../templates/prato_card.php');
include_once('../templates/order_template.php');


if ($_SESSION['username'] == null) {
    die(redirect_login('error', 'Please log in to edit your restaurant.'));
}

$rest_id = $_GET['rest_id'];

$restaurant =  getRestaurantInfo($rest_id);
$restaurant_dishes = get_restaurant_plates($rest_id);
$number_of_dishes = count($restaurant_dishes);


if (!doesRestaurantBelongToUser($rest_id, $_SESSION['username'])) {
    header("Location: http://localhost:9000/pages/edit_profile_owner.php");
    exit();
}

include_once('../templates/common.php');

include_once('../database/user.class.php');

?>

<!DOCTYPE html>
<html>

<?php drawHead(); ?>
<link href="../css/common.css" rel="stylesheet">
<link href="../css/edit_restaurant.css" rel="stylesheet">

</head>

<body>
    <?php drawHeader(); ?>
    <div class="content">
        <div class="form-content">

            <form action="../actions/action_edit_restaurant.php" method="post" id="edit_restaurant">

                <h1>Editar Restaurante</h1>
                <input type="hidden" id="rest_id" name="rest_id" value="<?= $restaurant['rest_id'] ?>">

                <div class="input_group">
                    <label for="new_rest_name">Nome</label>
                    <input type="text" name="new_rest_name" placeholder="Nome" value="<?= $restaurant['rest_name'] ?>" required>
                </div>

                <div class="input_group">
                    <label for="new_rest_address">Morada</label>
                    <input type="text" value="<?= $restaurant['rest_address'] ?>" name="new_rest_address" required>
                </div>

                <div class="input_group">
                    <label for="new_category" form="edit_restaurant">Categoria</label>
                    <select name="new_category">
                        <option selected><?= $restaurant['category'] ?></option>
                        <?php
                        $categories = getCategories();
                        $number_of_categories = count($categories);
                        if ($number_of_categories > 0) {
                            foreach ($categories as $category) { ?>
                                <option value="<?= $category['category']; ?>"><?= $category['category']; ?></option><?php
                                                                                                                }
                                                                                                            }
                                                                                                                    ?>
                    </select>
                </div>

                <button class="submit" type="submit" value="Update Restaurant">Guardar Alterações</button>
            </form>

        </div>
        <div class="form-content">
            <h1>Editar Foto do Restaurante</h1>

            <div class="img-rest">
                <div class="img-container">
                    <?php
                    getRestProfilePic($restaurant);
                    ?>>
                    <label for="img-upload" class="upload-image">
                        <i class="fa fa-pencil"></i>
                    </label>
                    </img>
                </div>
                <p> Foto atual </p>

                <form id="upload-img" action="../actions/upload_image.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="rest_id" name="rest_id" value="<?= $restaurant['rest_id'] ?>" />
                    <input type="file" id="img-upload" name="file" accept="image/*" />
                    <button class="submit" type="submit" value="Update Photo">Mudar foto</button>
                </form>
            </div>
        </div>

        <div class="edit_plates">
            <h1>Editar Pratos</h1>
            <div class="openBtn">
                <button style="width: 213px;" class=" openButton" onclick="openForm()">Adicionar Prato</button>
            </div>
            <div class="restaurantPopup">
                <div class="formPopup" id="popupForm">
                    <form action="../actions/action_add_dish.php" class="formContainer" method="post">
                        <h1>Adicionar prato</h1>
                        <input type="hidden" id="rest_id" name="rest_id" value="<?= $restaurant['rest_id'] ?>">
                        <div class="input_group" style="margin-bottom: 0px;">
                            <label for="prato_nome">Nome</label>
                            <input type="text" placeholder="Nome do prato" name="prato_nome" required>
                        </div>
                        <div class="input_group" style="margin-bottom: 0px;">
                            <label for="preco">Preço</label>
                            <input type="number" step="0.01"" placeholder=" Preco" name="preco" min="0" required>
                        </div>
                        <div class="input_group" style="margin-bottom: 0px;">
                            <label for="categoria" form="popupForm">Categoria</label>
                            <select name="categoria">
                                <?php
                                $categories = getDishCategories();
                                $number_of_categories = count($categories);
                                if ($number_of_categories > 0) {
                                    foreach ($categories as $category) { ?>
                                        <option value="<?= $category['category_plate']; ?>">
                                            <?= $category['category_plate']; ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <button class="submit" type="submit">Criar Prato</button>
                        <button type="button" class="btn cancel" onclick="closeForm()">Cancelar</button>
                    </form>
                </div>
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
        if ($number_of_dishes > 0) {
            foreach ($restaurant_dishes as $restaurant_dish) {
                drawPratoCardEdit($restaurant_dish);
            }
        } else {
            drawNoPlates();
        }
        ?>
        <div class="gerir_pedidos">
            <h1>Gerir Pedidos</h1>
            <?php
            $orders = get_restaurant_orders($rest_id);
            if ($orders == NULL) {
                echo '<br>';
                echo "<p>Ainda não tem encomendas.</p>";
            } else {
                drawOrder($orders, 'restaurant');
            }


            ?>
        </div>
    </div>

</body>

</html>