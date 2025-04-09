<?php
require_once 'classes/PokemonFeu.php';
require_once 'classes/PokemonEau.php';
require_once 'classes/PokemonPlante.php';
require_once 'config/database.php';

$stmt = $pdo->query("SELECT * FROM pokemons ORDER BY RAND() LIMIT 2");
$pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);

while ($pokemons[0]['id'] === $pokemons[1]['id']) {
    $stmt = $pdo->query("SELECT * FROM pokemons ORDER BY RAND() LIMIT 2");
    $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (count($pokemons) < 2) {
    die("Not enough Pokémon in the database to start a battle. Please add at least two Pokémon.");
}

$attack1 = new AttackPokemon(
    $pokemons[0]['attack_minimal'],
    $pokemons[0]['attack_maximal'],
    $pokemons[0]['special_attack'],
    $pokemons[0]['probability_special_attack']
);
$attack2 = new AttackPokemon(
    $pokemons[1]['attack_minimal'],
    $pokemons[1]['attack_maximal'],
    $pokemons[1]['special_attack'],
    $pokemons[1]['probability_special_attack']
);
function createPokemon($pokemonData, $attack) {
    $type = $pokemonData['type'];
    switch ($type) {
        case 'Feu':
            return new PokemonFeu(
                $pokemonData['name'],
                $pokemonData['url'],
                $pokemonData['hp'],
                $attack
            );
        case 'Eau':
            return new PokemonEau(
                $pokemonData['name'],
                $pokemonData['url'],
                $pokemonData['hp'],
                $attack
            );
        case 'Plante':
            return new PokemonPlante(
                $pokemonData['name'],
                $pokemonData['url'],
                $pokemonData['hp'],
                $attack
            );
        default:
            return new Pokemon(
                $pokemonData['name'],
                $pokemonData['url'],
                $pokemonData['hp'],
                $attack,
                'Normal'
            );
    }
}

$pokemon1 = createPokemon($pokemons[0], $attack1);
$pokemon2 = createPokemon($pokemons[1], $attack2);

$round = 1;
$battleLog = [];
$roundStates = [];
$roundStates[] = [
    'round' => "Initial State",
    'pokemon1' => clone $pokemon1,
    'pokemon2' => clone $pokemon2,
    'log' => []
];

while (!$pokemon1->isDead() && !$pokemon2->isDead()) {
    $roundLog = [];
    $roundLog[] = "ROUND $round";

    $result1 = $pokemon1->attack($pokemon2);
    if ($pokemon2->isDead()) {

        $roundLog[] = "Final Score - {$pokemon1->getName()}: {$pokemon1->getHp()} HP";
        $roundLog[] = "Final Score - {$pokemon2->getName()}: {$pokemon2->getHp()} HP";
        $roundStates[] = [
            'round' => "ROUND $round",
            'pokemon1' => clone $pokemon1,
            'pokemon2' => clone $pokemon2,
            'log' => $roundLog
        ];
        break;
    }

    $result2 = $pokemon2->attack($pokemon1);
    if ($pokemon1->isDead()) {
        $roundLog[] = "Final Score - {$pokemon1->getName()}: {$pokemon1->getHp()} HP";
        $roundLog[] = "Final Score - {$pokemon2->getName()}: {$pokemon2->getHp()} HP";
        $roundStates[] = [
            'round' => "ROUND $round",
            'pokemon1' => clone $pokemon1,
            'pokemon2' => clone $pokemon2,
            'log' => $roundLog
        ];
        break;
    }
    $roundLog[] = "Final Score - {$pokemon1->getName()}: {$pokemon1->getHp()} HP";
    $roundLog[] = "Final Score - {$pokemon2->getName()}: {$pokemon2->getHp()} HP";
    $roundStates[] = [
        'round' => "ROUND $round",
        'pokemon1' => clone $pokemon1,
        'pokemon2' => clone $pokemon2,
        'log' => $roundLog
    ];
    $round++;
}

$winner = $pokemon1->isDead() ? $pokemon2 : $pokemon1;
?>