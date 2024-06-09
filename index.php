
<?php

require 'res/php/pdo.php';

$db = new DatabaseClass();

$unit_id = isset($_GET['unit_id']) ? (int)$_GET['unit_id'] : 0;

if ($unit_id > 0) {
    $pollingUnit = $db->SelectOne('SELECT * FROM polling_unit WHERE polling_unit_id = :unit_id', ['unit_id' => $unit_id]);
    $results = $db->SelectAll('SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = :unit_id', ['unit_id' => $unit_id]);
} else {
    $pollingUnit = null;
    $results = [];

}

require './templates/results.php';
?>

