<?php
require_once 'Session.php';

$sessionManager = new Session();

$sessionManager->incrementVisit();

$visitCount = $sessionManager->getVisitCount();

if (isset($_POST['reset'])) {
    $sessionManager->resetSession();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des sessions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        h1 {
            color: #333;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-align: center;
        }
        p {
            font-size: 1.2em;
            color: #555;
            background-color: #fff;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }
        button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #e60000;
        }
        form {
            margin: 0;
        }
    </style>
</head>
<body>
    <h1>Bienvenue !</h1>
    <?php
    if ($visitCount == 1) {
        echo "<p>Bienvenu à notre plateforme.</p>";
    } else {
        echo "<p>Merci pour votre fidélité, c'est votre " . $visitCount . "-ième visite.</p>";
    }
    ?>
    <form method="post">
        <button type="submit" name="reset">Réinitialiser la session</button>
    </form>
</body>
</html>