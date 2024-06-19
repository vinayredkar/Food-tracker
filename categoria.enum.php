<?php

include_once('../database/categoria.enum.php');
include_once('../includes/database.php');
include_once('../database/restaurante.class.php');

//backed enum
enum Categoria: string
{
    case FASTFOOD = 'fast food';
    case HAMBURGUER = 'hamburguer';
    case CHINES = 'chines';
    case PIZZA = 'pizza';
    case SOBREMESAS = 'sobremesas';
    case SOPA = 'sopa';
    case GELADO = 'gelado e sorvete';
    case PORTUGUES = 'portugues';
    case BRASILEIRO = 'brasileiro';
    case MEXICANO = 'mexicano';
    case INDIANO = 'indiano';
    case ITALIANO = 'italiano';
    case SUHI = 'sushi';
    case SAUDAVEL = 'saudavel';
    case KEBAB = 'kebab';
    case BREAKFAST = 'breakfast n brunch';
    case SANDES = 'sandes';
    case VEGAN = 'vegan';
    case VEGETARIANO = 'vegetariano';
    case MASSAS = 'massas';
    case BEBIDAS = 'bebidas';
    case BURRITOS = 'burritos';
    case OTHER = 'outro';

    static public function matchCatValue(string $cat_in): Categoria
    {
        $cat = Categoria::tryFrom(strtolower($cat_in)) ?? Categoria::OTHER;
        return $cat;
    }
}
