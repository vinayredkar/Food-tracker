<?php
include_once('../includes/session.php');
include_once('../includes/redirect.php');

if ($_SESSION['username'] == null) {
    die(redirect_login('error', 'Please log in to edit your dish.'));
}

$user = $_SESSION['username'];

include_once('../templates/common.php');
include_once('../templates/order_template.php');

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
        <h1>As minhas Encomendas</h1>
        <?php
        $orders = get_user_orders($user);
        if ($orders == NULL) {
            echo '<br>';
            echo "<p>Sem pedidos.</p>";
        } else {
            drawOrder($orders, 'client');
        }


        ?>
    </div>
</body>

</html>