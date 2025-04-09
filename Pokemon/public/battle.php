<?php
require_once '../battle_simulation.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle Log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Les Combattants</h1>

        <?php foreach ($roundStates as $state): ?>
            <div class="battle-round mb-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-light text-center">
                        <?php echo $state['round']; ?>
                    </div>
                </div>

                <?php if (!empty($state['log'])): ?>
                    <div class="battle-log mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <?php
                                    $i = 0;
                                    while ($i < count($state['log'])) {
                                        $log = $state['log'][$i];
                                        if (strpos($log, 'Final Score') !== false && isset($state['log'][$i + 1]) && strpos($state['log'][$i + 1], 'Final Score') !== false) {
                                            $nextLog = $state['log'][$i + 1];
                                            preg_match('/Final Score - .*: (\d+)/', $log, $match1);
                                            preg_match('/Final Score - .*: (\d+)/', $nextLog, $match2);
                                            $score1 = isset($match1[1]) ? $match1[1] : '0';
                                            $score2 = isset($match2[1]) ? $match2[1] : '0';
                                            ?>
                                            <li class="list-group-item final-score">
                                                <div class="score-wrapper">
                                                    <span class="score score-left"><?php echo $score1; ?></span>
                                                    <span class="score score-right"><?php echo $score2; ?></span>
                                                </div>
                                            </li>
                                            <?php
                                            $i += 2; 
                                            $i++;
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <img src="<?php echo $state['pokemon1']->getUrl(); ?>" class="img-fluid pokemon-img" alt="<?php echo $state['pokemon1']->getName(); ?>">
                                <h5 class="card-title"><?php echo $state['pokemon1']->getName(); ?></h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Points: <?php echo $state['pokemon1']->getHp(); ?></li>
                                    <li class="list-group-item">Min Attack Points: <?php echo $state['pokemon1']->getAttackPokemon()->getAttackMinimal(); ?></li>
                                    <li class="list-group-item">Max Attack Points: <?php echo $state['pokemon1']->getAttackPokemon()->getAttackMaximal(); ?></li>
                                    <li class="list-group-item">Special Attack: <?php echo $state['pokemon1']->getAttackPokemon()->getSpecialAttack(); ?></li>
                                    <li class="list-group-item">Probability Special Attack: <?php echo $state['pokemon1']->getAttackPokemon()->getProbabilitySpecialAttack(); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <img src="<?php echo $state['pokemon2']->getUrl(); ?>" class="img-fluid pokemon-img" alt="<?php echo $state['pokemon2']->getName(); ?>">
                                <h5 class="card-title"><?php echo $state['pokemon2']->getName(); ?></h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Points: <?php echo $state['pokemon2']->getHp(); ?></li>
                                    <li class="list-group-item">Min Attack Points: <?php echo $state['pokemon2']->getAttackPokemon()->getAttackMinimal(); ?></li>
                                    <li class="list-group-item">Max Attack Points: <?php echo $state['pokemon2']->getAttackPokemon()->getAttackMaximal(); ?></li>
                                    <li class="list-group-item">Special Attack: <?php echo $state['pokemon2']->getAttackPokemon()->getSpecialAttack(); ?></li>
                                    <li class="list-group-item">Probability Special Attack: <?php echo $state['pokemon2']->getAttackPokemon()->getProbabilitySpecialAttack(); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <h2 class="text-center mt-4">Le Vainqueur est: <?php echo $winner->getName(); ?></h2>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>