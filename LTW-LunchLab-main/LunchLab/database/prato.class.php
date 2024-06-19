<?php
include_once('../includes/database.php');
include_once('../database/restaurante.class.php');
include_once('../database/categoria.prato.enum.php');


class Prato
{
    public int $prato_id;
    public string $prato_nome;
    public float $preco;
    public CategoriaPrato $categoria;
    public int $rest_id;

    public function __construct(int $prato_id, string $prato_nome, float $preco, string $categoria, int $rest_id)
    {
        $this->prato_id = $prato_id;
        $this->prato_nome = $prato_nome;
        $this->preco = $preco;
        $this->categoria = CategoriaPrato::matchCatValue($categoria);
        $this->rest_id = $rest_id;
    }
}


function add_plate($restaurante, $prato_nome, $preco, $categoria)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('INSERT INTO prato(prato_id, prato_nome, preco, categoria, restaurante) VALUES(null, ?, ?, ?, ?)');
    $stmt->execute(array($prato_nome, $preco, $categoria->value, $restaurante));
}

function get_restaurant_plates($restaurant)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM prato WHERE restaurante = ?');
    $stmt->execute(array($restaurant));

    return $stmt->fetchAll();
}

function get_plate($prato_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM prato WHERE prato_id = ?');
    $stmt->execute(array($prato_id));

    return $stmt->fetch();
}

function deleteDish($prato_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('DELETE FROM prato WHERE prato_id = ?');
    $stmt->execute(array($prato_id));
}

function updateDish($prato_id, $new_name, $new_price, $new_category, $rest_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('UPDATE prato SET (prato_nome, preco, categoria, restaurante) = (?, ?, ?, ?) WHERE prato_id = ?');
    $stmt->execute(array($new_name, $new_price, $new_category->value, $rest_id, $prato_id));
}

function getDishDisplayPic($prato)
{
    if (file_exists("../images/dishes/" . $prato['prato_id'])) { ?>     
        <img src="../images/dishes/<?= $prato['prato_id'] ?>" alt="Foto do prato <?php $prato['prato_nome'] ?>" <?php } else { ?> <img src="../images/dishes/default1.png" alt="Cloche com mão a segurar gradiente de vermelho a laranja." <?php }
                                                                                                                                                                                                                                                                    }
