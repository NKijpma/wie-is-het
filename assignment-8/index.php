<!--index.php-->
<?php
include 'php/assignment8.php';

$characters = load_data();
$characters = start_game($characters);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Guess Who?</title>
    <link rel="stylesheet" href="css/assignment8.css">
    <link href="https://fonts.googleapis.com/css2?family=Boogaloo&display=swap" rel="stylesheet">
</head>
<body>

<div id="board">
    <span id="board-name">guess who?</span>

    <?php render_cards($characters); ?>

    <div id="controls">

        <div id="guessing">
            <?php questions($characters); ?>
            <?php guess_name(); ?>
        </div>

        <div id="reset">
            <?php restart_game(); ?>

        </div>

        <div id="guess-history">
            <?php history($characters); ?>
        </div>

    </div>

</div>

</body>
</html>