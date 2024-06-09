<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polling Unit Results</title>
</head>
<body>
    <h1>Polling Unit Results</h1>
    <?php if ($pollingUnit): ?>
        <h2>Polling Unit: <?= htmlspecialchars($pollingUnit['polling_unit_name']) ?></h2>
        <p>Description: <?= htmlspecialchars($pollingUnit['polling_unit_description']) ?></p>
        <h3>Results</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Party Abbreviation</th>
                    <th>Party Score</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?= htmlspecialchars($result['party_abbreviation']) ?></td>
                        <td><?= htmlspecialchars($result['party_score']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No data found for this polling unit.</p>
    <?php endif; ?>
</body>
</html>