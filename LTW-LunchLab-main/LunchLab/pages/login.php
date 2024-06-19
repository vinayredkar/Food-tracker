<?php
include_once('../includes/session.php');
include_once('../includes/redirect.php');

if (isset($_SESSION['username'])) {
    header("Location: http://localhost:9000/pages/index.php"); //redirects to index if user logged in
    exit();
}

include_once('../templates/common.php');
include_once('../database/user.class.php');

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
        <form action="../actions/action_login.php" method="post">
            <div class=login_div>
                <img src="../images/simple_logo.svg" alt="LunchLab Logo"></img>
                <h1>Vamos saborear?</h1>
                <p>Entre na sua conta!</p>
            </div>

            <div class="container">
                <div class="input_group">
                    <!--label for="username">Username</label-->
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="input_group">
                    <!--label for="password">Password</label-->
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <button class="submit" type="submit">Entrar</button>
            </div>

            <div class="signin_div">
                <p>Não tem uma conta? </p>
                <a href="../pages/signup.php"">Crie uma!</a>
        </div>
    </form> 
</div>
   

</body>

</html>