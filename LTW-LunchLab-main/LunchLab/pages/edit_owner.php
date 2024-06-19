<?php include_once('../templates/common.php'); ?>

<!DOCTYPE html>
<html>
    
<?php drawHead(); ?>
    <link href="../css/common.css" rel="stylesheet">
    <link href="../css/edit_owner.css" rel="stylesheet">

</head>

<body>
<?php if (isset($_SESSION['username'])) { //depois trocar a condiçao p o oposto é só p ver a pag
            header("Location: http://localhost:9000/pages/index.php"); //redirects to index if user not logged in
            exit();
        }else{
            drawHeader();
            ?>
    <form action="../actions/action_edit_profile.php" method="post" id="edit_owner">
    <h1>Os meus Restaurantes</h1>  

    <div id="rest_table"></div>
    </form>

    <?php } ?> 
</body>

</html>