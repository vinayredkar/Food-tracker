<?php function drawProfile($profile)
{
    if ((isset($_SESSION['username']))) {
        if ($profile['username'] != $_SESSION['username']) {
            die('Erro! Não pode aceder a um perfil que não é o seu');
        }
    }
?>
    <div class="content">
        <h1>O meu Perfil</h1>
        <div class="main_info">
            <div class="input_group">
                <h2>Username</h2>
                <p id="margin_left"><?= $profile['username'] ?></p>
            </div>
            <div class="input_group">
                <h2>Nome</h2>
                <p id="margin_left"><?= $profile['name'] ?></p>
            </div>
            <div class="input_group">
                <h2>Morada</h2>
                <p id="margin_left"></i><?= $profile['address'] ?></p>
            </div>
            <div class="input_group">
                <h2>Número de Telemóvel</h2>
                <p id="margin_left"><?= $profile['phonenumber'] ?></p>
            </div>
        </div>
        <a class="button" href="./edit_profile.php">Editar perfil</a>
    </div>

<?php } ?>