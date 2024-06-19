<?php

include_once('../includes/session.php');

if (isset($_SESSION['username'])) {
    header("Location: http://localhost:9000/pages/index.php"); //redirects to index if user not logged in
    exit();
}

include_once('../templates/common.php');


?>

<!DOCTYPE html>
<html>

<?php drawHead(); ?>
    <link href="../css/common.css" rel="stylesheet">
    <link href="../css/authentication.css" rel="stylesheet">

</head>

<body>
    <?php drawHeader(); ?>
    <div class="auth_container">
        <form action="../actions/action_signup.php" method="post">
            <div class=login_div>
                <h1>Vamos saborear?</h1> 
            </div>

            <div class="container">
                <div class="input_group">
                    <label for="username">Username</label>
                    <input type="text" placeholder="Enter Username" name="username" required>
                </div>
                <div class="input_group">
                    <label for="phone">Número de telemóvel</label>
                    <input type="text" placeholder="Enter your phone number" name="phone" pattern= "[9][0-9]{8}" required>
                </div>
                <div class="input_group">
                    <label for="address">Morada</label>
                    <input type="text" placeholder="Enter your address" name="address" required>
                </div>
                <div class="input_group">
                    <label for="password">Password</label>
                    <input id="password1" type="password" placeholder="Enter Password" name="password" pattern="(?=.*\d)(?=.*[A-z]).{5,}" required>
                    <div id="verification" >
                        <div class="popup"> 
                        <span class="popuptext">
                             <p id="number" class="invalid">Contém Números</p>
                             <p id="letter" class="invalid">Contém Letras</p>
                             <p id="length" class="invalid">Pelo menos 5 Caracteres</p>
                        </span>
                        </div>
                     </div>
                </div>
                <div class="input_group">
                    <label for="repeat_password">Repita a password</label>
                    <input id="password2" type="password" placeholder="Repeat Password" name="repeat_password" required>
                </div>

                <button class="submit" type="submit">Resgistrar-se</button>
            </div>
        </form>
    </div>
    <script src="../javascript/password_validation.js" defer></script>

</body>

</html>