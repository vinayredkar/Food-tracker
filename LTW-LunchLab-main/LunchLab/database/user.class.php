<?php

declare(strict_types=1);
include_once('../includes/database.php');
include_once('../database/restaurante.class.php');
include_once('../database/encomenda.class.php');

class User
{
    public string $username;
    public string $name;
    private int $phone;
    private string $address;

    public function __construct(string $username, string $name, int $phone, string $address)
    {
        $this->username = $username;
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
    }

    public function getOwnedRests(): array
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT rest_id, rest_name, rest_address, category FROM restaurante WHERE dono = ?');
        $stmt->execute(array($this->username));
        $rests = $stmt->fetchAll();
        $answer = array();

        while ($rest = $stmt->fetch()) {
            $restaurants[] = new Restaurante(
                $rest['rest_id'],
                $rest['rest_name'],
                $rest['rest_address'],
                $rest['category']
            );
        }
        return $answer;
    }

    public function getFavDishes(): array
    {
        $db = Database::instance()->db();
        //nao verifiquei se o comando sql esta bem escrito
        $stmt = $db->prepare('SELECT p.prato_id, p.prato_nome, p.preco, p.categoria, p.restaurante FROM PratosFavoritos AS pf, Prato AS p WHERE username = ? AND pf.prato_id = p.prato_id');
        $stmt->execute(array($this->username));
        $all = $stmt->fetchAll();
        $dishes = array();

        foreach ($all as $dish) {
            $dishes[] = new Prato(
                $dish['prato_id'],
                $dish['prato_nome'],
                $dish['preco'],
                $dish['categoria'],
                $dish['restaurante']
            );
        }

        return $dishes;
    }

    public function getFavRest(): array
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT r.rest_id, r.rest_name, r.rest_address, r.category FROM restaurantesFavoritos AS rf, Restaurante AS r WHERE username = ? AND rf.rest_id=r.rest_id');
        $stmt->execute(array($this->username));
        $rests = $stmt->fetchAll();

        return $rests;
    }

    public function doesDishBelongToFav($id): bool
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM pratosFavoritos WHERE username = ? AND prato_id = ?');
        $stmt->execute(array($this->username, $id));
        $rest = $stmt->fetchAll();
        return ($rest != NULL);
    }

    public function doesRestBelongToFav($id): bool
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM restaurantesFavoritos WHERE username = ? AND rest_id = ?');
        $stmt->execute(array($this->username, $id));
        $rest = $stmt->fetchAll();
        return ($rest != NULL);
    }
}

function addFavRest($username, $rest_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO restaurantesFavoritos(username, rest_id) VALUES(?, ?)');
    $stmt->execute(array($username, $rest_id));
}

function addFavDish($username, $prato_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO pratosFavoritos(username, prato_id) VALUES(?, ?)');
    $stmt->execute(array($username, $prato_id));
}

function removeFavDish($username, $prato_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('DELETE FROM pratosFavoritos WHERE username = ? AND prato_id = ?');
    $stmt->execute(array($username, $prato_id));
}

function removeFavRest($username, $rest_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('DELETE FROM restaurantesFavoritos WHERE username = ? AND rest_id = ?');
    $stmt->execute(array($username, $rest_id));
}

function availableUsername($username)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
    $stmt->execute(array($username));

    return $stmt->fetch() ? false : true;
}

function insertUser($username, $password, $name, $phonenumber, $address)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('INSERT INTO user(username, password, name, phonenumber, address) VALUES(?, ?, ?, ?, ?)');

    $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT), $name, $phonenumber, $address));
}

function validCredentials($username, $password)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
    $stmt->execute(array($username));

    $user = $stmt->fetch();

    return $user !== false && password_verify($password, $user['password']);
}

function getUserInfo($username)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
    $stmt->execute(array($username));

    return $stmt->fetch();
}

function getUserObj($username): User
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
    $stmt->execute(array($username));

    $obj = $stmt->fetch();

    return new User($obj['username'], ' ', $obj['phonenumber'], $obj['address']);
}

function changePassword($username, $new_password)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('UPDATE user SET password = ? WHERE username = ?');
    $stmt->execute(array(password_hash($new_password, PASSWORD_DEFAULT), $username));

    return $stmt->fetch();
}

function changeProfile($username, $new_name, $new_address, $new_phonenumber)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('UPDATE user SET (name, phonenumber, address) = (?, ?, ?) WHERE username = ?');
    $stmt->execute(array($new_name, $new_phonenumber, $new_address, $username));

    return $stmt->fetch();
}


