<?php

include_once('../templates/cart_card.php');
include_once('../database/restaurante.class.php');
include_once('../database/encomenda.class.php');
include_once('../database/prato.class.php');

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $orders = get_user_current_order($username);
}
$order = NULL;
$pratosEncomenda = NULL;
if (isset($orders)) {
  if ($orders != []) {
    $order = $orders[0];
  }
} else {
  $order = NULL;
}
if (isset($order)) {
  $pratosEncomenda = get_order_plates($order['order_id']);
  $restaurant = getRestaurantInfo($order['order_restaurant']);
  $total_price = get_user_current_order_price($username);
} else {
  $pratosEncomenda = NULL;
  $total_price = 0;
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="cart_buttons">
      <h1 style="margin-top: 18px;">O meu Carrinho</h1>
      <?php if ($order != NULL) { ?>
        <form action="../actions/action_cancel_order.php" method="post">
          <input type="hidden" name="order_id" placeholder="order_id" value="<?= $order['order_id'] ?>">
          <button type=submit>Cancelar</button>
        </form>
      <?php } ?>
    </div>

    <div style="overflow:scroll; height: 55%;">
      <?php if ($order != NULL) { ?>
        <h2 style="margin-left: 63px;">Restaurante: <?= $restaurant['rest_name'] ?></h2>
      <?php } ?>

      <?php if ($pratosEncomenda != NULL) { //depois trocar a condiçao p o oposto é só p ver a pag
        foreach ($pratosEncomenda as $pratoEncomenda) {
          $prato = get_plate($pratoEncomenda['prato']);
          drawPratosCart($prato, $pratoEncomenda);
        }
      ?>
      <?php  } else { ?>
        <p style="margin-left: 63px;">Adiciona itens ao carrinho para continuar o pedido</p>
      <?php } ?>
    </div>

    <hr class=line_cart>
    <div class="cart_buttons">
      <p><b>Entrega:</b> 5 min</p>
      <p>2,5€</p>
    </div>
    <div class="cart_buttons">
      <p><b>Total Amount:</b></p>
      <p><?= $total_price + 2.5 ?>€</p>
    </div>

    <?php if ($pratosEncomenda != NULL) { ?>
      <form action="../actions/action_change_order_state.php" method="post">
        <input type="hidden" name="order_id" placeholder="order_id" value="<?= $order['order_id'] ?>">
        <input type="hidden" name="state" placeholder="state" value="Received">
        <button class="cart_button" type=submit>Fazer pedido</button>
      </form>
    <?php } ?>


  </div>

  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "500px";
      document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
    }
  </script>



</body>

</html>