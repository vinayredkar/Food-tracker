<?php

declare(strict_types=1);

include_once('../includes/session.php');
include_once('../includes/cart_items.php');


?>

<script>
    function addDishToOrder(prato_id) {
        id = "prato_" + prato_id;
        console.log(id);
        console.log(document.getElementById(id).innerHTML);
        document.getElementById(id)[0].innerHTML++;
    }

    function removeDishFromOrder(prato_id) {
        if (document.getElementById("prato_" + prato_id).innerHTML == 0) return;
        document.getElementById("prato_" + prato_id).innerHTML--;
    }
</script>


<?php function drawPratosCart($prato, $pratoEncomenda)
{ ?>
    <section id="pratos carrinho">
        <div id="cart">
            <div class="cart_image">
                <img src="../images/Chill&Grill/Dumplings.png" alt="Chill&Grill Restaurant Logo"></img>
            </div>
            <div class="card_info">
                <p><?= $prato['prato_nome'] ?></p>
                <div class="card_buttons">
                    <div class="item_quantity">
                        <form action="../actions/action_decrease_quantity.php" method="post">
                            <input type="hidden" name="encomenda_id" placeholder="encomenda_id" value="<?= $pratoEncomenda['encomenda'] ?>">
                            <input type="hidden" name="prato_id" placeholder="prato_id" value="<?= $prato['prato_id'] ?>">
                            <button class="minus" style="margin-top: 20px; " type="submit">-</button>
                        </form>
                        <div><?= $pratoEncomenda['quantidade'] ?></div>
                        <form action="../actions/action_increase_quantity.php" method="post">
                            <input type="hidden" name="encomenda_id" placeholder="encomenda_id" value="<?= $pratoEncomenda['encomenda'] ?>">
                            <input type="hidden" name="prato_id" placeholder="prato_id" value="<?= $prato['prato_id'] ?>">
                            <button class="plus" style="margin-top: 20px;" type="submit">+</button>
                        </form>
                    </div>
                    <p class="price"><?= $prato['preco'] * $pratoEncomenda['quantidade'] ?>€</p>

                </div>
            </div>

        </div>
    </section>

<?php } ?>