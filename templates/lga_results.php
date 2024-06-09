<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LGA Results</title>
</head>
<body>
    <h1>LGA Results</h1>
    <?php if ($lga): ?>
        <h2>LGA: <?= htmlspecialchars($lga['lga_name']) ?></h2>
        <h3>Polling Units</h3>
        <?php foreach ($results as $unit_id => $unitResults): ?>
            <h4>Polling Unit ID: <?= htmlspecialchars($unit_id) ?></h4>
            <table border="1">
                <thead>
                    <tr>
                        <th>Party Abbreviation</th>
                        <th>Party Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($unitResults as $result): ?>
                        <tr>
                            <td><?= htmlspecialchars($result['party_abbreviation']) ?></td>
                            <td><?= htmlspecialchars($result['party_score']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No data found for this LGA.</p>
    <?php endif; ?>
</body>
</html>
