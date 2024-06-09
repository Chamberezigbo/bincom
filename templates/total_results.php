<!DOCTYPE html>
<html>
<head>
    <title>Total Results by LGA</title>
</head>
<body>
    <h1>Total Results by LGA</h1>
    <form method="POST" action="total_results.php">
        <label for="lga_id">Select LGA:</label>
        <select name="lga_id" id="lga_id">
            <option value="">Select an LGA</option>
            <?php foreach ($lgas as $lga): ?>
                <option value="<?php echo $lga['lga_id']; ?>" <?php echo $lga_id == $lga['lga_id'] ? 'selected' : ''; ?>>
                    <?php echo $lga['lga_name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Get Results</button>
    </form>

    <?php if ($lga_id > 0): ?>
        <h2>Results for LGA: <?php echo htmlspecialchars($lgas[array_search($lga_id, array_column($lgas, 'lga_id'))]['lga_name']); ?></h2>
        <table border="1">
            <tr>
                <th>Party</th>
                <th>Total Votes</th>
            </tr>
            <?php foreach ($results as $party => $totalVotes): ?>
                <tr>
                    <td><?php echo htmlspecialchars($party); ?></td>
                    <td><?php echo htmlspecialchars($totalVotes); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>