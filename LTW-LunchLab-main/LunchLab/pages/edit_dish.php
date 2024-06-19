<?php
include_once('../includes/session.php');
include_once('../includes/redirect.php');
include_once('../templates/common.php');

include_once('../database/user.class.php');
include_once('../database/restaurante.class.php');
include_once('../database/prato.class.php');
include_once('../templates/prato_card.php');



if ($_SESSION['username'] == null) {
    die(redirect_login('error', 'Please log in to edit your dish.'));
}

$prato_id = $_GET['prato_id'];
$prato = get_plate($prato_id);
//checar se é da pessoa

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

            <form action="../actions/action_edit_dish.php" method="post" id="edit_dish">

                <h1>Editar <?= $prato['prato_nome'] ?></h1>
                <input type="hidden" id="prato_id" name="prato_id" value="<?= $prato['prato_id'] ?>">

                <div class="input_group">
                    <label for="new_name">Nome</label>
                    <input type="text" name="new_name" placeholder="Nome" value="<?= $prato['prato_nome'] ?>" required>
                </div>

                <div class="input_group">
                    <label for="new_price">Preço</label>
                    <input type="number" step="0.01" value="<?= $prato['preco'] ?>" name="new_price" min="0" required>
                </div>

                <div class="input_group">
                    <label for="new_category" form="edit_restaurant">Categoria</label>
                    <select name="new_category">
                        <option selected><?= $prato['categoria'] ?></option>
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

                <button class="submit" onclick="location.href = '../pages/edit_restaurant.php?rest_id=<?= $prato['restaurante'] ?>';" type="submit" value="Update Dish">Guardar Alterações</button>
            </form>

        </div>

        <div class="form-content">
            <h1>Editar Foto do Prato</h1>

            <div class="img-rest">
                <div class="img-container">
                    <?php
                    getDishDisplayPic($prato);
                    ?>>
                    <label for="img-upload" class="upload-image">
                        <i class="fa fa-pencil"></i>
                    </label>
                    </img>
                </div>
                <p> Foto atual </p>

                <form id="upload-img" action="../actions/dish_image.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="prato_id" name="prato_id" value="<?= $prato['prato_id'] ?>" />
                    <input type="file" id="img-upload" name="file" accept="image/*" />
                    <button class="submit" type="submit" value="Update Photo">Mudar foto</button>
                </form>
            </div>
        </div>


</body>

</html>