 PRAGMA foreign_keys = ON;
 
 --Category
INSERT INTO categorias (category) VALUES("fast food");
INSERT INTO categorias (category) VALUES("hamburguer");
INSERT INTO categorias (category) VALUES("chines");
INSERT INTO categorias (category) VALUES("pizza");
INSERT INTO categorias (category) VALUES("sobremesas");
INSERT INTO categorias (category) VALUES("sopa");
INSERT INTO categorias (category) VALUES("gelado e sorvete");
INSERT INTO categorias (category) VALUES("portugues");
INSERT INTO categorias (category) VALUES("brasileiro");
INSERT INTO categorias (category) VALUES("mexicano");
INSERT INTO categorias (category) VALUES("indiano");
INSERT INTO categorias (category) VALUES("italiano");
INSERT INTO categorias (category) VALUES("sushi");
INSERT INTO categorias (category) VALUES("saudavel");
INSERT INTO categorias (category) VALUES("kebab");
INSERT INTO categorias (category) VALUES("breakfast n brunch");
INSERT INTO categorias (category) VALUES("sandes");
INSERT INTO categorias (category) VALUES("vegan");
INSERT INTO categorias (category) VALUES("vegetariano");
INSERT INTO categorias (category) VALUES("massas");
INSERT INTO categorias (category) VALUES("bebidas");
INSERT INTO categorias (category) VALUES("burritos");
INSERT INTO categorias (category) VALUES("outro");

INSERT INTO categoria_prato (category_plate) VALUES("entrada");
INSERT INTO categoria_prato (category_plate) VALUES("prato principal");
INSERT INTO categoria_prato (category_plate) VALUES("sobremesa");
INSERT INTO categoria_prato (category_plate) VALUES("bebida");
INSERT INTO categoria_prato (category_plate) VALUES("outro");

-- insert users
-- password     pass123
INSERT INTO user VALUES ('margarida', '$2y$10$XK073mSk2tc46UKkqBFNqO0AwYOpqo45jOvWPT2vIgtYcyhhUSnh2', 'Margarida', 963407932, 'Rua Alberto');
-- password     pass123
INSERT INTO user VALUES ('matilde','$2y$10$/TQQzzQf7xoifFvdfM9QFO6T/8m2Z34gEKTcr7CEbj5H0GzFdW29m', 'Matilde', 961234567, 'Travessa da Alegria');
-- password     pass123
INSERT INTO user VALUES ('mariana', '$2y$10$7DCw09/2Nc9SMzoLD6kTQ.MvctVhs6SmccsPFU.2PePeGntPx7d0G', 'Mariana',  929876543, 'Rua da Fonte');

INSERT INTO restaurante VALUES (1, 'Chill&Grill', 'travessa nova do covelo nº27', 'chines', 'margarida');
INSERT INTO restaurante VALUES (2, 'Kebab world', 'rua do paraios nº34', 'kebab', 'margarida');
INSERT INTO restaurante VALUES (3, 'Basilico', 'rua do lago nº23', 'italiano', 'matilde');
INSERT INTO restaurante VALUES (4, 'Frankies Hot Dog', 'rua sa carneiro', 'fast food', 'matilde');
INSERT INTO restaurante VALUES (5, 'Tokio Sushi', 'travessa 1000 sóis.', 'sushi', 'mariana');
INSERT INTO restaurante VALUES (6, 'Wok to Walk', 'rua doutor roberto frias', 'chines', 'mariana');
INSERT INTO restaurante VALUES (7, 'Munchie', 'circunvalção porto nº213', 'hamburguer', 'margarida');
INSERT INTO restaurante VALUES (8, 'Minhami', 'rua da alegria nº420', 'saudavel', 'matilde');
INSERT INTO restaurante VALUES (9, 'Robin', 'circunvalção porto nº213', 'mexicano', 'mariana');
INSERT INTO restaurante VALUES (10, 'Thai', 'circunvalção porto nº213', 'saudavel', 'margarida');
INSERT INTO restaurante VALUES (11, 'Basilico', 'circunvalção porto nº213', 'massas', 'matilde');
INSERT INTO restaurante VALUES (12, 'Trevo', 'circunvalção porto nº213', 'portugues', 'mariana');

INSERT INTO prato VALUES (1, 'Dumplings', 3.50, 'entrada', 1);
INSERT INTO prato VALUES (3, 'Ramen', 7.50, 'prato principal', 1);
INSERT INTO prato VALUES (4, 'Spring Rolls', 1.50, 'entrada', 1);
INSERT INTO prato VALUES (5, 'Fried Ice Cream', 3.50, 'sobremesa', 1);
INSERT INTO prato VALUES (6, 'Iced Tea', 3.50, 'bebida', 1);
INSERT INTO prato VALUES (2, 'Kebab', 5.45, 'prato principal', 2);
INSERT INTO prato VALUES (7, 'Rissois', 1.50, 'entrada', 2);
INSERT INTO prato VALUES (8, 'Crepe', 5.45, 'sobremesa', 2);
INSERT INTO prato VALUES (9, 'Pepsi', 1.50, 'bebida', 2);
INSERT INTO prato VALUES (10, 'Carbonara', 11.40, 'prato principal', 3);
INSERT INTO prato VALUES (11, 'Pão de Alho', 1.50, 'entrada', 3);
INSERT INTO prato VALUES (12, 'Tiramissu', 5.45, 'sobremesa', 3);
INSERT INTO prato VALUES (13, 'Vinho da Casa', 9.95, 'bebida', 3);
INSERT INTO prato VALUES (14, 'Mustang', 11.40, 'prato principal', 4);
INSERT INTO prato VALUES (15, 'Corn Dog', 1.50, 'entrada', 4);
INSERT INTO prato VALUES (16, 'Cheesecake', 3.50, 'sobremesa', 4);
INSERT INTO prato VALUES (17, 'Um Bongo', 1.40, 'bebida', 4);
INSERT INTO prato VALUES (18, 'Box 12 peças', 11.40, 'prato principal', 5);
INSERT INTO prato VALUES (19, 'Calamares', 1.50, 'entrada', 5);
INSERT INTO prato VALUES (20, 'Gelado', 3.50, 'sobremesa', 5);
INSERT INTO prato VALUES (21, 'Limonada', 1.40, 'bebida', 5);
INSERT INTO prato VALUES (22, 'Exotico', 11.40, 'prato principal', 6);
INSERT INTO prato VALUES (23, 'Donburi', 1.50, 'entrada', 6);
INSERT INTO prato VALUES (24, 'Gelado', 3.50, 'sobremesa', 6);
INSERT INTO prato VALUES (25, 'Agua com gas', 1.40, 'bebida', 6);
