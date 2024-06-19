<?php

include_once('../templates/cart.php');

function drawHead()
{ ?>

    <head>
        <title>LunchLab</title>
        <meta charset="utf-8">
        <link rel="icon" href="../images/simple_logo.svg" type="image/icon type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/https://fonts.google.com/share?selection.family=Raleway" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <?php
} ?>
    <?php
    function drawHeader()
    { ?>
        <div class="topnav" id="myTopnav">
            <a class="logo" href="../index.php"><img src="../images/logo.svg" alt="LunchLab Logo"></a>
            <?php if (isset($_SESSION['username'])) { ?>
                <a class="button btn" id="nav_link" onclick="openNav()"><img src="../images/carrinho.svg" alt="Icone com um carrinho de mão branco.">
                    <p>Carrinho</p>
                </a>
                <div class="dropdown">
                    <button class="dropbtn" href="javascript:void(0)" onclick="w3_open_nav('references')" id="navbtn_references" title="Perfil">
                        <img src="../images/user.svg" width="20px" height="20px" alt="Icone de uma pessoa a branco">
                        <p> Perfil </p>
                        <svg width="17" height="12" viewBox="0 0 17 12" fill="none" style="margin-left:10px" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.72113 2.31046L8.442 9.77783C8.52205 9.88232 8.67947 9.88232 8.75952 9.77783L11.5406 6.14777L14.4804 2.31048" stroke="white" stroke-width="3.5" stroke-linecap="round" />
                        </svg>
                    </button>
                    <div class="dropdown-content">
                        <a href="../pages/profile.php?username=<?= $_SESSION['username'] ?>">O meu Perfil</a>
                        <a href="../pages/edit_profile.php">Editar Perfil</a>
                        <a href="../pages/edit_profile_owner.php">Os meus Restaurantes</a>
                        <a href="../pages/favorites.php">Favoritos</a>
                        <a href="../pages/orders.php">As Minhas Encomendas</a>
                        <a href=" ../actions/action_logout.php">Logout</a>
                    </div>
                </div>
                <a href="javascript:void(0);" style="font-size:40px;" class="icon" onclick="myFunction()">&#9776;</a>
            <?php } else { ?>
                <a class="button btn" id="nav_link" href="../pages/login.php">
                    <p>Entrar</p>
                </a>
                <div class="dropdown">
                    <button class="dropbtn" onclick="location.href = '../pages/signup.php';" title="Signup">
                        Registrar-se
                    </button>
                </div>
                <a href="javascript:void(0);" style="font-size:40px;" class="icon" onclick="myFunction()">&#9776;</a>
            <?php } ?>
        </div>

        <script>
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
        </script>
    <?php } ?>

    <?php function drawSearch()
    { ?>
        <script src="../javascript/search.js" defer></script>
        <form class="search">
            <input type="text" placeholder="Pesquisa" id="myInput" onkeyup="search()">
            <button type="submit">
                <img class="icone_pesquisa" src="../images/pesquisa.svg" alt="Icone de pesquisa (lupa)">
            </button>
        </form>
        <!--input type="text" placeholder="Pesquisa" class="search" id="myInput" onkeyup="filterFunction()"-->


    <?php } ?>