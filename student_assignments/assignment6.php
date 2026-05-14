<?php
require_once __DIR__ . '/../includes/load_data.php';
$characterDataset = load_data();

    unset($characterDataset['_feature_order']);


$random_character_naam = array_rand($characterDataset);
$random_character = $characterDataset[$random_character_naam];
$imagePath = '../images/' . $random_character_naam . '.png';
foreach ($random_character["features"] as $feature){
    echo $feature . "\n";
}




// Opdracht 6: Kies een willekeurig personage en toon zijn/haar afbeelding.
// Tip: Gebruik de array _rand() functie om een willekeurige key uit de array te halen.
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
echo "<img src='$imagePath' alt='$random_character_naam'>";
echo "<br>";
echo " $random_character_naam";
echo "</pre>";
?>
</body>
</html>