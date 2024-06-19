PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS categoria_prato;
DROP TABLE IF EXISTS encomenda;
DROP TABLE IF EXISTS restaurantesFavoritos;
DROP TABLE IF EXISTS pratosFavoritos;
DROP TABLE IF EXISTS prato;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS review_response;
DROP TABLE IF EXISTS restaurante;
DROP TABLE IF EXISTS user;


CREATE TABLE categorias(
    category text primary key
); 

CREATE TABLE categoria_prato(
    category_plate text primary key
); 

CREATE TABLE user (
  username VARCHAR PRIMARY KEY,      -- unique username
  password VARCHAR,                  -- password stored in sha-1
  name VARCHAR,                      -- real name
  phonenumber int,
  address VARCHAR, 
  CONSTRAINT phonenumber_valid CHECK(phonenumber >= 900000000 & phonenumber<= 999999999)
);

create table restaurante(
    rest_id INTEGER primary key AUTOINCREMENT,
    rest_name VARCHAR,
    rest_address text not null,
    category text references categorias(category) ON DELETE CASCADE ON UPDATE CASCADE,
    dono VARCHAR REFERENCES user(username)
);

create table encomenda(
    order_id INTEGER primary key AUTOINCREMENT,
    order_date date not null,
    order_state text not null,
    order_restaurant text references restaurante(rest_id) ON DELETE CASCADE ON UPDATE CASCADE,
    order_customer VARCHAR references user(username),
    CONSTRAINT isOrderStateValid CHECK(order_state="Unfinished" or order_state="Received" or order_state="Preparing" or order_state="Ready" or order_state="Delivered")
    --como adicionar conjunto de pratos?
);

CREATE TABLE prato(
    prato_id INTEGER primary key AUTOINCREMENT,
    prato_nome VARCHAR,
    preco real,
    categoria VARCHAR references categoria_prato(category_plate),
    restaurante INTEGER references restaurante(rest_id) ON DELETE CASCADE ON UPDATE CASCADE
);

create table reviews(
    id INTEGER primary key AUTOINCREMENT,
    rating int not null,
    review_date date,
    user VARCHAR REFERENCES user(username) ON DELETE CASCADE ON UPDATE CASCADE,
    rest_id INT REFERENCES restaurante(rest_id) ON DELETE CASCADE ON UPDATE CASCADE,
    review_text VARCHAR,
    CONSTRAINT isRatingValid CHECK(rating <= 5 and rating >= 1)
); 

create table reviewResponse(
    response_date date,
    review_id INT NOT NULL REFERENCES reviews(id) ON DELETE CASCADE ON UPDATE CASCADE,
    response_text VARCHAR,
    PRIMARY KEY(review_id)
); 

--parece um bocado inefeciente criar um objeto para cada prato mas nao vejo uma forma melhor de o fazer
CREATE TABLE pratosFavoritos(
    username VARCHAR, 
    prato_id int,
    FOREIGN KEY (username) REFERENCES user(username),
    FOREIGN KEY (prato_id) REFERENCES prato(prato_id)
    PRIMARY KEY (username, prato_id)
);

CREATE TABLE restaurantesFavoritos(
    username VARCHAR REFERENCES user(username),
    rest_id int REFERENCES restaurante(rest_id),
    PRIMARY KEY (username, rest_id)
);

CREATE TABLE pratoEncomenda(
    prato NOT NULL REFERENCES prato(prato_id)  ON DELETE CASCADE ON UPDATE CASCADE,
    encomenda NOT NULL REFERENCES encomenda(order_id)  ON DELETE CASCADE ON UPDATE CASCADE,
    quantidade int,
    PRIMARY KEY(prato,encomenda)
    --restrição: restaurante_id do prato tem de ser igual ao restaurante_id da encomenda
);
