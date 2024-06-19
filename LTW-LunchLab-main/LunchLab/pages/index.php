<?php

include_once('../includes/session.php');
include_once('../templates/common.php');
include_once('../templates/restaurant_template.php');
include_once('../database/restaurante.class.php');
include_once('../database/encomenda.class.php');


$restaurants = getAllRestaurants();
$number_of_restaurants = count($restaurants);


?>

<!DOCTYPE html>
<html>

<?php drawHead(); ?>
    <link href="../css/common.css" rel="stylesheet">
    <link href="../css/index.css" rel="stylesheet">

</head>

<body>
    <?php drawHeader(); ?>
    <?php drawSearch(); ?>
    <div id="restaurants_index">

        <?php

        if ($number_of_restaurants > 0) {
            foreach ($restaurants as $restaurant) {
                drawRestCardDisplay($restaurant);
            }
        } else {
            drawNoRestaurants();
        }
        ?>
    </div>

</body>

</html>