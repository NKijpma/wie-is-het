<!--assignment8.php-->
<?php
session_start();
handle_restart();
require_once __DIR__ . '/../includes/load_data.php';

// Opdracht 8: Bouw het "Wie is het?" spel.
// 1. Kies een willekeurig personage en sla dit op in de sessie.
// 2. Maak een formulier waarmee de speler een feature kan kiezen om te vragen.
// 3. Vergelijk de gekozen feature met die van het geheime personage.
// 4. Geef antwoord ("Ja" of "Nee").
// 5. Filter de lijst van overgebleven kandidaten op basis van het antwoord.
// 6. Toon de overgebleven kandidaten.
// 7. Voeg een reset-knop toe om een nieuw spel te starten.

function start_game($characters)
{
    unset($characters['_feature_order']);
    if (!isset($_SESSION['secret-char'])) {
        $_SESSION['secret-char'] = array_rand($characters);
        $_SESSION['candidates'] = array_keys($characters);
        $_SESSION['asked'] = [];
    }
    return $characters;
}

function render_cards($characters): void
{
    echo "<div id='cards-grid'>";
    foreach ($characters as $name => $data) {
        $status = in_array($name, $_SESSION['candidates']) ? 'active' : 'eliminated';
        echo "<div class='player-background $status'><img src='images/$name.png' alt='' class='player-card'></div>";
    }
    echo "</div>";
}

function questions($characters): void
{
    $features = array_keys($characters[array_key_first($characters)]['features']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['feature'])) {
        $feature = $_POST['feature'];
        $secret = $characters[$_SESSION['secret-char']]['features'];
        $answer = $secret[$feature];

        $_SESSION['candidates'] = array_values(array_filter(
                $_SESSION['candidates'],
                fn($name) => $characters[$name]['features'][$feature] == $answer
        ));

        $_SESSION['last_answer'] = "$feature? " . ($answer ? "Ja" : "Nee");
        $_SESSION['asked'][] = $feature;

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    if (isset($_SESSION['last_answer'])) {
        echo $_SESSION['last_answer'];
    }

    echo "<form method='POST'>";
    echo "<select name='feature'>";
    foreach ($features as $feature) {
        if (in_array($feature, $_SESSION['asked'] ?? [])) continue;

        $values = array_unique(array_map(
                fn($name) => $characters[$name]['features'][$feature],
                $_SESSION['candidates']
        ));

        if (count($values) > 1) {
            echo "<option value='$feature'>$feature</option>";
        }
    }
    echo "</select>";
    echo "<button type='submit'>Vraag</button>";
    echo "</form>";
}

function guess_name(): void
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
        $guess = $_POST['name'];
        $secret = $_SESSION['secret-char'];

        if ($guess === $secret) {
            $_SESSION['last_answer'] = "Correct! Het was $secret!";
            $_SESSION['candidates'] = [$secret];
        } else {
            $_SESSION['candidates'] = array_values(array_filter(
                    $_SESSION['candidates'],
                    fn($name) => $name !== $guess
            ));
            $_SESSION['last_answer'] = "Fout! $guess is het niet.";
        }

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    echo "<form method='POST'>";
    echo "<select name='name'>";
    foreach ($_SESSION['candidates'] as $name) {
        echo "<option value='$name'>$name</option>";
    }
    echo "</select>";
    echo "<button type='submit'>Gok naam</button>";
    echo "</form>";
}

function history($characters)
{
}

function restart_game(): void
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['restart'])) {
        session_unset();
        session_destroy();
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    echo "<form method='POST'>";
    echo "<button type='submit' name='restart'>⟳</button>";
    echo "</form>";
}

function handle_restart(): void
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['restart'])) {
        session_unset();
        session_destroy();
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}