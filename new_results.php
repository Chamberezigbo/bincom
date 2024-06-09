<?php

require 'res/php/pdo.php';


$db = new DatabaseClass();

// Fetch all LGAs and Wards for the dropdowns
$lgas = $db->SelectAll('SELECT * FROM lga WHERE state_id = :state_id', ['state_id' => 25]);
$wards = $db->SelectAll('SELECT * FROM ward WHERE lga_id IN (SELECT lga_id FROM lga WHERE state_id = :state_id)', ['state_id' => 25]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $polling_unit_name = $_POST['polling_unit_name'];
    $lga_id = $_POST['lga_id'];
    $ward_id = $_POST['ward_id'];
    $results = [
        'PDP' => $_POST['PDP'],
        'DPP' => $_POST['DPP'],
        'ACN' => $_POST['ACN'],
        'PPA' => $_POST['PPA'],
        'CDC' => $_POST['CDC'],
        'JP' => $_POST['JP']
    ];

    try {
        // Insert new polling unit
        $polling_unit_id = $db->Insert('INSERT INTO polling_unit (polling_unit_name, ward_id, lga_id) VALUES (:polling_unit_name, :ward_id, :lga_id)', [
            'polling_unit_name' => $polling_unit_name,
            'ward_id' => $ward_id,
            'lga_id' => $lga_id
        ]);

        // Insert results for the new polling unit
        foreach ($results as $party => $score) {
            $db->Insert('INSERT INTO announced_pu_results (polling_unit_uniqueid, party_abbreviation, party_score) VALUES (:polling_unit_uniqueid, :party_abbreviation, :party_score)', [
                'polling_unit_uniqueid' => $polling_unit_id,
                'party_abbreviation' => $party,
                'party_score' => $score
            ]);
        }

        echo "Results successfully stored!";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

require 'templates/new_results.php';
?>