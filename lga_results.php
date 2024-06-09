<?php
// lga_results.php

require 'res/php/pdo.php';

$db = new DatabaseClass();

$lga_id = isset($_GET['lga_id']) ? (int)$_GET['lga_id'] : 0;

if ($lga_id > 0) {
    $lga = $db->SelectOne('SELECT * FROM lga WHERE lga_id = :lga_id', ['lga_id' => $lga_id]);
    $pollingUnits = $db->SelectAll('SELECT * FROM polling_unit WHERE lga_id = :lga_id', ['lga_id' => $lga_id]);

    $results = [];
    foreach ($pollingUnits as $unit) {
        $unitResults = $db->SelectAll('SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = :unit_id', ['unit_id' => $unit['polling_unit_id']]);
        $results[$unit['polling_unit_id']] = $unitResults;
    }
} else {
    $lga = null;
    $results = [];
}

require 'templates/lga_results.php';
?>
