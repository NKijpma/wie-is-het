<?php
session_start();
require_once __DIR__ . '/../includes/load_data.php';
$characterDataset = load_data();
unset($characterDataset['_feature_order']);


if (!isset($_SESSION['secret-char'])) {
    $random_character_naam = array_rand($characterDataset);
    $_SESSION['secret-char'] = $random_character_naam;
    $_SESSION['candidates'] = array_keys($characterDataset);
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Guess Who – Board Game</title>
    <link rel="stylesheet" href="../css/assignment8.css">

    <link href="https://fonts.googleapis.com/css2?family=Boogaloo&display=swap" rel="stylesheet">
</head>
<body>

<div id="board">
    <span id="board-name">guess who?</span>

    <!--    maak clivkbaar met js denk (CLIK IS JE GOKT DEZE PLAYEr)-->

    <?php foreach ($characterDataset as $name => $data): ?>
        <div class="player-card <?= in_array($name, $_SESSION['candidates']) ? 'active' : 'eliminated' ?>">
            <img src="../images/<?= $name ?>.png" alt="<?= $name ?>">
        </div>
    <?php endforeach; ?>


    <div id="guessing">
        <div id="guess-history"></div>

    </div>


</div>


</body>
</html>