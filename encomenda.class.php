<?php
include_once('../database/prato.class.php');
include_once('../database/restaurante.class.php');

class Encomenda
{

    public Estado $estado;
    public $pratos;
    public string $cliente_id;

    public function __construct(string $cliente)
    {
        $this->cliente_id = $cliente;
        $pratos = array();
    }
}

function all_restaurant_orders($rest_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM encomenda WHERE rest_id = ?');
    $stmt->execute(array($rest_id));

    return $stmt->fetchAll();
}

function update_order($order_id, $state)
{
    $date = DATE("d/m/Y");
    $db = Database::instance()->db();

    $stmt = $db->prepare('UPDATE encomenda SET (order_date, order_state) = (?,?) WHERE order_id = ?');
    $stmt->execute(array($date, $state, $order_id));

    return $stmt->fetchAll();
}

function add_order($rest_id, $username)
{
    $date = DATE("d/m/Y");
    $state = 'Unfinished';
    $db = Database::instance()->db();

    $stmt = $db->prepare('INSERT INTO encomenda(order_id, order_date, order_state, order_restaurant, order_customer) VALUES(NULL, ?, ?, ?, ?)');
    $stmt->execute(array($date, $state, $rest_id, $username));
}

function get_user_orders($username)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM encomenda WHERE order_customer = ?');
    $stmt->execute(array($username));

    return $stmt->fetchAll();
}

//does user have an order not placed yet
function get_user_current_order($username)
{
    $state = 'Unfinished';
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM encomenda WHERE order_customer = ? AND order_state = ?');
    $stmt->execute(array($username, $state));

    return $stmt->fetchAll();
}

function cancel_order($order_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('DELETE FROM encomenda WHERE order_id = ?');
    $stmt->execute(array($order_id));
}

function get_order_info($order_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM encomenda WHERE order_order_id = ?');
    $stmt->execute(array($order_id));

    return $stmt->fetch();
}

function get_order_plates($order_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM pratoEncomenda WHERE encomenda = ?');
    $stmt->execute(array($order_id));

    return $stmt->fetchAll();
}

function get_order_plate($order_id, $plate_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM pratoEncomenda WHERE encomenda = ? AND prato= ?');
    $stmt->execute(array($order_id, $plate_id));

    return $stmt->fetch();
}

function add_order_plate($plate_id, $order_id, $quantity)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('INSERT INTO pratoEncomenda(prato, encomenda, quantidade) VALUES(?, ?, ?)');
    $stmt->execute(array($plate_id, $order_id, $quantity));
}

function delete_order_plate($plate_id, $order_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('DELETE FROM pratoEncomenda WHERE prato = ? AND encomenda = ?');
    $stmt->execute(array($plate_id, $order_id));
}

function update_order_plate($plate_id, $order_id, $quantity)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('UPDATE pratoEncomenda SET quantidade = ? WHERE prato = ? AND encomenda = ?');
    $stmt->execute(array($quantity, $plate_id, $order_id));

    return $stmt->fetchAll();
}


//funções que retornar as encomendas dos restaurantes
function orders_of_restaurant($rest_id, $state)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM encomenda WHERE order_restaurant = ? AND order_state = ?');
    $stmt->execute(array($rest_id, $state));

    return $stmt->fetchAll();
}

function get_restaurant_orders($rest_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM encomenda WHERE order_restaurant = ?');
    $stmt->execute(array($rest_id));

    return $stmt->fetchAll();
}


//funções que retornar as encomendas de um username
function orders_of_user($user, $state)
{

    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM encomenda WHERE order_customer = ? AND order_state = ?');
    $stmt->execute(array($user, $state));

    return $stmt->fetchAll();
}

function orders_of_user_restaurant($user, $state, $rest_id)
{

    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM encomenda WHERE order_customer = ? AND order_state = ? AND order_restaurant = ?');
    $stmt->execute(array($user, $state, $rest_id));

    return $stmt->fetchAll();
}

function get_user_current_order_price($username): float
{

    $order = get_user_current_order($username);
    if ($order == NULL) {
        return 0.0;
    } else {
        $order = get_user_current_order($username)[0];
    }
    $id = $order['order_id'];


    $plates = get_order_plates($id);

    $total = 0;

    foreach ($plates as $plate) {
        $var = get_plate($plate['prato']);
        $preco = $var['preco'];
        $total += ($preco) * ($plate['quantidade']);
    }
    return $total;
}
