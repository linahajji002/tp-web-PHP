<?php
include("Etudiant.php");

$etudiants = [
    new Etudiant("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]),
    new Etudiant("Skander", [15, 9, 8, 16])
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats des Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .note {
            padding: 8px;
            margin-bottom: 5px;
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
        }
        .bg-vert-clair {
            background-color: #d4edda;
            color: #155724;
        }
        .bg-rouge-clair {
            background-color: #f8d7da;
            color: #721c24;
        }
        .bg-orange-clair {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body class="p-5 bg-light">

<div class="container">
    <div class="row">
        <?php foreach ($etudiants as $etudiant): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header text-center fw-bold">
                        <?= htmlspecialchars($etudiant->nom) ?>
                    </div>
                    <div class="card-body">
                        <?php
                        foreach ($etudiant->notes as $note) {
                            if ($note < 10) {
                                $class = "bg-rouge-clair";
                            } elseif ($note > 10) {
                                $class = "bg-vert-clair";
                            } else {
                                $class = "bg-orange-clair";
                            }
                            echo "<div class='note $class'>$note</div>";
                        }
                        ?>
                        <div class="alert alert-primary mt-3 text-center">
                            Votre moyenne est <?= number_format($etudiant->calculerMoyenne(), 2) ?><br>
                            <strong><?= $etudiant->estAdmis() ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
