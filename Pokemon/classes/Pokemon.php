<?php
require_once 'AttackPokemon.php';

class Pokemon {
    protected $name;
    protected $url;
    protected $hp;
    protected $attackPokemon;
    protected $type;

    public function __construct($name, $url, $hp, AttackPokemon $attackPokemon, $type = 'Normal') {
        $this->name = $name;
        $this->url = $url;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
        $this->type = $type;
    }
    public function getName() {
        return $this->name;
    }
    public function getUrl() {
        return $this->url;
    }
    public function getHp() {
        return $this->hp;
    }
    public function getAttackPokemon() {
        return $this->attackPokemon;
    }
    public function getType() {
        return $this->type;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setUrl($url) {
        $this->url = $url;
    }
    public function setHp($hp) {
        $this->hp = $hp;
    }
    public function setAttackPokemon(AttackPokemon $attackPokemon) {
        $this->attackPokemon = $attackPokemon;
    }
    public function setType($type) {
        $this->type = $type;
    }
    public function isDead() {
        return $this->hp <= 0;
    }
    public function attack(Pokemon $p) {
        $attackPoints = rand($this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal());
        $isSpecialAttack = rand(1, 100) <= $this->attackPokemon->getProbabilitySpecialAttack();

        if ($isSpecialAttack) {
            $attackPoints *= $this->attackPokemon->getSpecialAttack();
        }

        $multiplier = $this->getTypeEffectiveness($p);
        $finalDamage = $attackPoints * $multiplier;

        $p->setHp($p->getHp() - $finalDamage);
        if ($p->getHp() < 0) {
            $p->setHp(0);
        }

        return [
            'damage' => $finalDamage,
            'isSpecialAttack' => $isSpecialAttack
        ];
    }
    protected function getTypeEffectiveness(Pokemon $p) {
        $attackerType = $this->type;
        $defenderType = $p->getType();

        if ($attackerType === 'Feu') {
            if ($defenderType === 'Plante') return 2;
            if ($defenderType === 'Eau' || $defenderType === 'Feu') return 0.5;
        } elseif ($attackerType === 'Eau') {
            if ($defenderType === 'Feu') return 2;
            if ($defenderType === 'Eau' || $defenderType === 'Plante') return 0.5;
        } elseif ($attackerType === 'Plante') {
            if ($defenderType === 'Eau') return 2;
            if ($defenderType === 'Plante' || $defenderType === 'Feu') return 0.5;
        }

        return 1; 
    }
    public function whoAmI() {
        return "Name: {$this->name}, HP: {$this->hp}, Type: {$this->type}, " .
               "Attack Min: {$this->attackPokemon->getAttackMinimal()}, " .
               "Attack Max: {$this->attackPokemon->getAttackMaximal()}, " .
               "Special Attack: {$this->attackPokemon->getSpecialAttack()}, " .
               "Special Attack Probability: {$this->attackPokemon->getProbabilitySpecialAttack()}";
    }
}
?>