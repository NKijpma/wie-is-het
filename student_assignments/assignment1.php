<?php

require_once __DIR__ . '/../includes/load_data.php';
$characterDataset = load_data();

// Opdracht 1: Toon alle namen van de personages uit de dataset.
// Tip: Gebruik een foreach-loop.
// Let op: '_feature_order' is geen personage.

//echo '<pre>';
//var_dump($characterDataset);
//echo '</pre>';


foreach ($characterDataset as $name => $data) {
    if ($name == "_feature_order") {
        continue;
    }
    echo "Dit is personage: " . $name . "<br>";
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}