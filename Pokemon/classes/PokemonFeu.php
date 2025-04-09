<?php
require_once 'Pokemon.php';

class PokemonFeu extends Pokemon {
    public function __construct($name, $url, $hp, AttackPokemon $attackPokemon) {
        parent::__construct($name, $url, $hp, $attackPokemon, 'Feu');
    }
}
?>