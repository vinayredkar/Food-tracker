<?php

declare(strict_types=1);
include_once('../includes/session.php');
include_once('../database/encomenda.class.php');
include_once('../database/prato.class.php');
include_once('../templates/cart_card.php');
include_once('../database/user.class.php');


function drawOrder($orders, $type)
{
    foreach ($orders as $order) {
        $order_plates = get_order_plates($order['order_id']);
        $order_restaurant = getRestaurantObject($order['order_restaurant'])->rest_name;

        if ($type == 'client') {
            drawOrderClient($order, $order_restaurant, $order_plates);
        } else if ($type == 'restaurant' && $order['order_state'] != 'Unfinished') {
            drawOrderRestaurant($order, $order_plates);
        }
    }
}
?>

<?php function drawOrderClient($order, $name, $order_plates)
{ ?>
    <h1>Pedido # <?= $order['order_id'] ?></h1>
    <div class="cart_info">
        <div class="input_group">
            <h2><b>Data</b></h2>
            <p><?= $order['order_date'] ?></p>
        </div>
        <div class="input_group">
            <h2><b>Estado</b></h2>
            <p><?= $order['order_state'] ?></p>
        </div>
        <div class="input_group">
            <h2><b>Restaurante</b></h2>
            <p></i><?= $name ?></p>
        </div>
        <div class="input_group">
            <h2><b>Pedido</b></h2>
            <?php foreach ($order_plates as $order_plate) {
                $id_prato = $order_plate['prato'];
                $prato = get_plate($id_prato);
                drawPratosOrder($prato, $order_plate);
            } ?>
        </div>
    </div>

<?php } ?>

<?php function drawOrderRestaurant($order, $order_plates)
{ ?>
    <h2><b>Pedido # <?= $order['order_id'] ?></b></h1>
        <div class="cart_info">
            <div class="input_group">
                <h2><b>Data</b></h2>
                <p><?= $order['order_date'] ?></p>
            </div>
            <div class="input_group">
                <h2><b>Username</b></h2>
                <p></i><?= $order['order_customer'] ?></p>
            </div>
            <div class="input_group">
                <h2><b>Pedido</b></h2>
                <?php foreach ($order_plates as $order_plate) {
                    $id_prato = $order_plate['prato'];
                    $prato = get_plate($id_prato);
                    drawPratosOrder($prato, $order_plate);
                } ?>
            </div>
            <div class="input_group">
                <h2><b>Estado</b></h2>
                <form action="../actions/action_change_order_state.php" method="post" id="get_orders">
                    <input type="hidden" id="order_id" name="order_id" value="<?= $order['order_id'] ?>">
                    <div class="input_group">
                        <select name="state">
                            <option selected><?= $order['order_state'] ?></option>
                            <option value="Received"> Received</option>
                            <option value="Preparing"> Preparing</option>
                            <option value="Ready"> Ready</option>
                            <option value="Delivered"> Delivered</option>
                        </select>
                    </div>
                    <button class="submit" type="submit">Alterar estado</button>
                </form>
            </div>
        </div>

    <?php } ?>

    <?php function drawPratosOrder($prato, $pratoEncomenda)
    { ?>
        <section>
            <div class="cart_info">
                <p><?= $prato['prato_nome'] ?> x </p>
                <p><?= $pratoEncomenda['quantidade'] ?></p>
                <p> (<?= $prato['preco'] * $pratoEncomenda['quantidade'] ?>€)</p>
            </div>
        </section>

    <?php } ?>