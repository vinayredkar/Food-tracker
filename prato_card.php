<?php

declare(strict_types=1);
include_once('../database/prato.class.php');

function drawPratoCardEdit($prato)
{ ?>
    <div class="card" id="plate">
        <div class="card_info">
            <p title="<?= $prato['prato_nome'] ?>"><?= $prato['prato_nome'] ?></p>
            <p class="price"><?= $prato['preco'] ?>€</p>
            <p class="price"><?= $prato['categoria'] ?></p>
            <div class="card_buttons">
                <button class="card_fav_btn" onclick="location.href = '../pages/edit_dish.php?prato_id=<?= $prato['prato_id'] ?>';">
                    <img src="../images/edit.svg" alt="Icone de um lápis (editar)"></img>
                </button>
                <button class="card_fav_btn" onclick="location.href='../actions/action_delete_dish.php?prato_id=<?= $prato['prato_id'] ?>';">
                    <img src="../images/delete.svg" alt="Icone de um caixote do lixo (apagar)"></img>
                </button>
            </div>
        </div>

        <div class="card_image">
            <?php
            getDishDisplayPic($prato);
            ?>></img>
        </div>
    </div>
<?php } ?>

<?php function drawNoPlates()
{ ?>
    <section id="no_plates">
        Ainda sem pratos? 😢
    </section>
<?php } ?>

<?php function drawPratosCards(array $favorites)
{ ?>
    <section id="pratos fav">
        <?php foreach ($favorites as $prato) { ?>
            <div class="card <?php echo $prato->categoria->value ?>" id="plate">
                <div class="card_info">
                    <?php
                    $var = false;
                    if ($_SESSION['username'] != NULL) {
                        $user = getUserObj($_SESSION['username']);
                        $var = $user->doesDishBelongToFav($prato->prato_id);
                    }
                    ?>
                    <p><?php echo $prato->prato_nome ?></p>
                    <p class="price"><?php echo $prato->preco    ?>€</p>
                    <div class="card_buttons">
                        <script src="../javascript/favorite_button.js" defer></script>
                        <button class="card_fav_btn" onclick="addToFavDish('<?php echo $prato->prato_id; ?>')">
                            <img id="prato<?php echo $prato->prato_id ?>" src=<?php
                                                                                if ($var) {
                                                                                    echo '"../images/favourite_selected.svg" alt="Favorite icon; heart stroke"';
                                                                                } else {
                                                                                    echo '"../images/favourite_not_selected.svg" alt="Favorite outline"';
                                                                                }
                                                                                ?>></img>
                        </button>
                        <form action="../actions/action_add_to_cart.php" method="post">
                            <input type="hidden" name="rest_id" placeholder="rest_id" value="<?php echo $prato->rest_id ?>">
                            <input type="hidden" name="plate_id" placeholder="plate_id" value="<?php echo $prato->prato_id ?>">
                            <button type="submit" class="card_score_btn">
                                <img src="../images/carrinho.svg" alt="Cart icon"></img>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card_image">
                    <?php
                    $arg = array();
                    $arg['prato_id'] = $prato->prato_id;
                    $arg['prato_nome'] = $prato->prato_nome;
                    getDishDisplayPic($arg);
                    ?>></img>
                </div>
            </div>
        <?php } ?>
    </section>

<?php } ?>

<?php function drawPratoCard($prato)
{ ?>
    <div class="card <?= $prato['categoria'] ?>" id="plate">
        <div class="card_info">
            <?php
            $var = false;
            if (isset($_SESSION['username'])) {
                $user = getUserObj($_SESSION['username']);
                $var = $user->doesDishBelongToFav($prato['prato_id']);
            }
            ?>
            <p><?= $prato['prato_nome'] ?></p>
            <p class="price"><?= $prato['preco'] ?>€</p>
            <div class="card_buttons">
                <script src="../javascript/favorite_button.js" defer></script>
                <button class="card_fav_btn" onclick="addToFavDish('<?php echo $prato['prato_id']; ?>')">
                    <img id="prato<?php echo $prato['prato_id'] ?>" src=<?php
                                                                        if ($var) {
                                                                            echo '"../images/favourite_selected.svg" alt="Favorite icon; heart stroke"';
                                                                        } else {
                                                                            echo '"../images/favourite_not_selected.svg" alt="Favorite outline"';
                                                                        }
                                                                        ?>></img>
                </button>
                <form action="../actions/action_add_to_cart.php" method="post">
                    <input type="hidden" name="rest_id" placeholder="rest_id" value="<?= $prato['restaurante'] ?>">
                    <input type="hidden" name="plate_id" placeholder="plate_id" value="<?= $prato['prato_id'] ?>">
                    <button type="submit" class="card_score_btn">
                        <img src="../images/carrinho.svg" alt="Cart icon"></img>
                    </button>
                </form>
            </div>
        </div>
        <div class="card_image">
            <?php
            getDishDisplayPic($prato);
            ?>></img>
        </div>
    </div>

<?php } ?>