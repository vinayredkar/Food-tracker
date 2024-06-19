<?php

include_once('../database/review.class.php');
include_once('../includes/database.php');
include_once('../database/restaurante.class.php');
include_once('../database/categoria.enum.php');
include_once('../database/categoria.prato.enum.php');
include_once('../database/review.class.php');
include_once('../database/prato.class.php');



class Restaurante
{
    public int $rest_id;
    public string $rest_name;
    public string $rest_address;
    public Categoria $category;

    public function __construct(int $rest_id, string $rest_name, string $rest_address, string $category)
    {
        $this->rest_id = $rest_id;
        $this->rest_name = $rest_name;
        $this->rest_address = $rest_address;
        $this->category = Categoria::matchCatValue($category);
    }


    static public function getRestObject($rest_id): Restaurante
    {
        $db = Database::instance()->db();


        $stmt = $db->prepare('SELECT rest_id, rest_name, rest_address, category FROM restaurante WHERE rest_id = ?');
        $stmt->execute(array($rest_id));
        $val = $stmt->fetch();

        return new Restaurante($val['rest_id'], $val['rest_name'], $val['rest_address'], $val['category']);
    }


    public function getScore(): float
    {
        $db = Database::instance()->db();
        //comando sql nao verificado
        $stmt = $db->prepare('SELECT AVG(rating) as av FROM reviews AS r, restaurante AS c WHERE c.rest_id = r.rest_id AND c.rest_id = ?');
        $stmt->execute(array($this->rest_id));
        $rating = $stmt->fetch();
        if ($rating['av'] === NULL) {
            return 0.0;
        } else {
            return $rating['av'];
        }
    }

    public function getDishes(): array
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT prato_id, prato_nome, preco, categoria FROM prato WHERE restaurante = ?');
        $stmt->execute(array($this->rest_id));
        $all = $stmt->fetchAll();

        $dishes = array();

        foreach ($all as $dish) {
            if ($dish['prato_id'] === NULL) {
                continue;
            }
            $dishes[] = new Prato(
                $dish['prato_id'],
                $dish['prato_nome'],
                $dish['preco'],
                $dish['categoria'],
                $dish['restaurant']
            );
        }
        return $dishes;
    }


    public function getNumberOfReviews(): int
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT COUNT(rating) as cnt FROM reviews WHERE rest_id = ?');
        $stmt->execute(array($this->rest_id));
        $val = $stmt->fetch();
        if ($val['cnt'] === NULL) {
            return 0;
        } else {
            return $val['cnt'];
        }
    }

    public function getReviews(): array
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT rating, review_date, user, review_text FROM reviews WHERE rest_id = ?');
        $stmt->execute(array($this->rest_id));
        $all = $stmt->fetchAll();
        $reviews = array();

        foreach ($all as $review) {
            $reviews[] = new Review(
                $review['review_text'],
                $review['review_date'],
                $review['rating'],
                $review['user'],
                $this->rest_id
            );
        }

        return $reviews;
    }

    public function addDish(string $prato_nome, float $price, CategoriaPrato $categoria)
    {

        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO prato(prato_nome, preco, categoria, restaurante) VALUES(?, ?, ?, ?)');
        $stmt->execute(array($prato_nome, $price, $categoria, $this->rest_id));
    }
}


function addRestaurant($rest_name, $rest_address, $category, $dono)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO restaurante(rest_id, rest_name, rest_address, category, dono) VALUES(null, ?, ?, ?, ?)');
    $stmt->execute(array($rest_name, $rest_address, $category->value, $dono));
}


function getRestaurantInfo($restaurante_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM restaurante WHERE rest_id = ?');
    $stmt->execute(array($restaurante_id));

    return $stmt->fetch();
}

function  getRestaurantObject($restaurante_id): Restaurante
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM restaurante WHERE rest_id = ?');
    $stmt->execute(array($restaurante_id));
    $rest = $stmt->fetch();

    return new Restaurante($rest['rest_id'], $rest['rest_name'], $rest['rest_address'], $rest['category']);
}

function get_user_restaurants($owner)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM restaurante WHERE dono = ?');
    $stmt->execute(array($owner));

    return $stmt->fetchAll();
}

function deleteRestaurant($rest_id)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('DELETE FROM restaurante WHERE rest_id = ?');
    $stmt->execute(array($rest_id));
    $location = "../images/restaurant/" . $rest_id;
    $filename = $_FILES['file']['name'];
    unlink($location);
}

function updateRestaurant($rest_id, $new_rest_name, $new_rest_address, $new_category, $owner)
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('UPDATE restaurante SET (rest_name, rest_address, category, dono) = (?, ?, ?, ?) WHERE rest_id = ?');
    $stmt->execute(array($new_rest_name, $new_rest_address, $new_category->value, $owner, $rest_id));
}

function getAllRestaurants()
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM restaurante');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getCategories()
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM categorias ORDER BY category');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getDishCategories()
{
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM categoria_prato ORDER BY category_plate');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getRestProfilePic($restaurant)
{
    if (file_exists("../images/restaurant/" . $restaurant['rest_id'])) { ?>
        <img class="rest_logo" src="../images/restaurant/<?= $restaurant['rest_id'] ?>" alt="Foto do restaurante" <?php } else { ?> <img class="rest_logo" src="../images/restaurant/default1.png" alt="Faca e colher cruzadas diagonalmente" 
        <?php }
}

function doesRestaurantBelongToUser($rest_id, string $username): bool
{

    $db = Database::instance()->db();


    $stmt = $db->prepare('SELECT dono FROM restaurante WHERE rest_id = ?');
    $stmt->execute(array($rest_id));
    $val = $stmt->fetch();


    return ($val['dono'] === $username);
}

?>