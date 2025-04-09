<?php
require_once 'Pokemon.php';

class PokemonEau extends Pokemon {
    public function __construct($name, $url, $hp, AttackPokemon $attackPokemon) {
        parent::__construct($name, $url, $hp, $attackPokemon, 'Eau');
    }
}
?>