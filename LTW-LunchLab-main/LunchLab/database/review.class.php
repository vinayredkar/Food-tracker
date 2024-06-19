<?php

include_once('../database/user.class.php');
include_once('../database/restaurante.class.php');

class Review
{
    public string $description;
    //public string $data = date("Y-m-d H:i:s");
    public float $rating;
    public string $cliente;
    public int $restaurante;

    public function __construct(string $description, string $data, float $rating, string $cliente, int $restaurante)
    {
        $this->description = $description;
        //$this->data = $data;
        $this->rating = $rating;
        $this->cliente = $cliente;
        $this->restaurante = $restaurante;
    }
}

function all_restaurant_reviews($rest_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM reviews WHERE rest_id = ?');
    $stmt->execute(array($rest_id));

    return $stmt->fetchAll();
}

function add_review($rating, $username, $rest_id, $review_text)
{
    $date = DATE("d/m/Y");
    $db = Database::instance()->db();

    $stmt = $db->prepare('INSERT INTO reviews(id, rating, review_date, user, rest_id, review_text) VALUES(NULL, ?, ?, ?, ?, ?)');
    $stmt->execute(array($rating, $date, $username, $rest_id, $review_text));
}

function has_reviewd($username, $rest_id,)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM reviews WHERE user = ? AND rest_id = ?');
    $stmt->execute(array($username, $rest_id));

    return $stmt->fetch();
}

function get_reply($review_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM reviewResponse WHERE review_id = ?');
    $stmt->execute(array($review_id));

    return $stmt->fetchAll();
}

function add_response($review_id, $response_text)
{
    $date = DATE("d/m/Y");
    $db = Database::instance()->db();

    $stmt = $db->prepare('INSERT INTO reviewResponse(response_date, review_id, response_text) VALUES(?, ?, ?)');
    $stmt->execute(array($date, $review_id, $response_text));
}
