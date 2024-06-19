<?php
include_once('../includes/database.php');
include_once('../database/prato.class.php');

enum CategoriaPrato: string
{
    case ENTRADA = 'entrada';
    case PRATO_PRINCIPAL = 'prato principal';
    case SOBREMESA = 'sobremesa';
    case BEBIDA = 'bebida';
    case OTHER = 'outro';

    static public function matchCatValue(string $cat_in): CategoriaPrato
    {
        $cat = CategoriaPrato::tryFrom(strtolower($cat_in)) ?? CategoriaPrato::OTHER;
        return $cat;
    }
}
