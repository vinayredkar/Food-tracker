<?php
include_once('../includes/session.php');
include_once('../includes/redirect.php');
include_once('../templates/common.php');
include_once('../database/user.class.php');

if ($_SESSION['username'] == null) {
    die(redirect_login('error', 'Please log in to edit your profile.'));
}

$profile_info = getUserInfo($_SESSION['username']);
?>

<!DOCTYPE html>
<html>

<?php drawHead(); ?>
    <link href="../css/common.css" rel="stylesheet">
    <link href="../css/edit_profile.css" rel="stylesheet">
</head>

<body>
    <?php drawHeader(); ?>
    <div class="content">
        <form action="../actions/action_edit_profile.php" method="post" id="edit_profile">
            <h1>Editar Perfil</h1>
            <input type="hidden" name="username" placeholder="Username" value="<?= $profile_info['username'] ?>" required>
            <div class="input_group">
                <label for="name">Nome</label>
                <input type="text" name="new_name" placeholder="Nome" value="<?= $profile_info['name'] ?>" required>
            </div>
            <div class="input_group">
                <label for="address">Morada</label>
                <input type="text" name="new_address" placeholder="Morada" value="<?= $profile_info['address'] ?>" required>
            </div>
            <div class="input_group">
                <label for="phonenumber">Número de Telemóvel</label>
                <input type="text" name="new_phonenumber" placeholder="Número de telemóvel" pattern="[9][0-9]{8}" value="<?= $profile_info['phonenumber'] ?>" required> <!-- TODO por os espaços onde se quiser e reconhecer na msm -->
            </div>
        </form>
        <div id="buttons">
            <button class="submit" class=" openButton" onclick="openForm()">Alterar Password</button>
            <button class=" submit" form="edit_profile" type="submit" value="Update profile">Guardar Alterações</button>
        </div>
        <!--div class="openBtn">
            <button style="width: 213px;" class=" openButton" onclick="openForm()">Criar Restaurante</button>
        </div-->
        <div class="restaurantPopup">
            <div class="formPopup" id="popupForm">
                <form action="../actions/action_change_password.php" class="formContainer" method="post">
                    <h1>Alterar Password</h1>
                    <div class="input_group" style="margin-bottom: 0px;">
                        <label for="old_password">Password antiga</label>
                        <input type="password" name="old_password" required>
                    </div>
                    <div class="input_group" style="margin-bottom: 0px;">
                        <label for="new_password">Password nova</label>
                        <input type="password" name="new_password" required>
                    </div>
                    <div class="input_group" style="margin-bottom: 0px;">
                        <label for="rep_password">Confirme a password nova</label>
                        <input type="password" name="rep_password" required>
                    </div>
                    <button class="submit" type="submit">Alterar Password</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Cancelar</button>
                </form>
            </div>
        </div>
        <script>
            function openForm() {
                document.getElementById("popupForm").style.display = "block";
            }

            function closeForm() {
                document.getElementById("popupForm").style.display = "none";
            }
        </script>
    </div>
</body>

</html>