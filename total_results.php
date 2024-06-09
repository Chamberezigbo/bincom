<?php
require 'res/php/pdo.php';

$db = new DatabaseClass();

// Fetch all LGAs in Delta State (state_id = 25)
$lgas = $db->SelectAll('SELECT * FROM lga WHERE state_id = :state_id', ['state_id' => 25]);

$lga_id = isset($_POST['lga_id']) ? (int)$_POST['lga_id'] : 0;
$results = [];

if ($lga_id > 0) {
    // Fetch all polling units under the selected LGA
    $pollingUnits = $db->SelectAll('SELECT * FROM polling_unit WHERE lga_id = :lga_id', ['lga_id' => $lga_id]);

    // Initialize the results array
    $results = [
        'PDP' => 0,
        'DPP' => 0,
        'ACN' => 0,
        'PPA' => 0,
        'CDC' => 0,
        'JP' => 0,
    ];

    // Sum results for all polling units under the selected LGA
    foreach ($pollingUnits as $unit) {
        $unitResults = $db->SelectAll('SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = :unit_id', ['unit_id' => $unit['polling_unit_id']]);
        foreach ($unitResults as $result) {
            if (isset($results[$result['party_abbreviation']])) {
                $results[$result['party_abbreviation']] += (int)$result['party_score'];
            }
        }
    }
}

require 'templates/total_results.php';
?>
