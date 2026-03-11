<?php
require_once __DIR__ . '/../includes/load_data.php';
$characterDataset = load_data();


unset($characterDataset['_feature_order']);

$random_character = array_rand($characterDataset);
$imagePath = '../images/' . $random_character . '.png';

// Opdracht 6: Kies een willekeurig personage en toon zijn/haar afbeelding.
// Tip: Gebruik de array_rand() functie om een willekeurige key uit de array te halen.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
echo "<pre>";
echo "<img src='$imagePath' alt='$random_character'>";
echo "<br>";
echo " $random_character";
echo "</pre>";
?>
</body>
</html>