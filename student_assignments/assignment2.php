<?php
require_once __DIR__ . '/../includes/load_data.php';
$characterDataset = load_data();

// Opdracht 2: Kies één personage en toon al zijn/haar kenmerken (features).
// Tip: Haal eerst de features op en loop er doorheen.
// Toon per feature of het 'JA' (true) of 'NEE' (false) is.


foreach ($characterDataset as $name => $data) {
    if ($name == "_feature_order") {
        continue;
    }


    if ($name == "Anita") {
        echo "Dit is personage: " . $name . "<br>";
        foreach ($data['features'] as $feature => $value) {
            echo "<pre>";
            echo "Kenmerk " . $feature . "= " . "<br>";
            if ($value == 1) {

                echo "JA\n";

            } else
                echo "NEE\n";
        }
        echo "</pre>";
    }

}