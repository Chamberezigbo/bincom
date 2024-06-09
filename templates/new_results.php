<!DOCTYPE html>
<html>
<head>
    <title>New Polling Unit Results</title>
    <script>
        function loadWards(lga_id) {
            const wards = <?php echo json_encode($wards); ?>;
            const wardSelect = document.getElementById('ward_id');
            wardSelect.innerHTML = '';

            wards.forEach(ward => {
                if (ward.lga_id == lga_id) {
                    const option = document.createElement('option');
                    option.value = ward.ward_id;
                    option.textContent = ward.ward_name;
                    wardSelect.appendChild(option);
                }
            });
        }
    </script>
</head>
<body>
    <h1>New Polling Unit Results</h1>
    <form method="POST" action="new_results.php">
        <label for="polling_unit_name">Polling Unit Name:</label>
        <input type="text" name="polling_unit_name" id="polling_unit_name" required>
        <br>

        <label for="lga_id">Select LGA:</label>
        <select name="lga_id" id="lga_id" onchange="loadWards(this.value)">
            <option value="">Select an LGA</option>
            <?php foreach ($lgas as $lga): ?>
                <option value="<?php echo $lga['lga_id']; ?>"><?php echo $lga['lga_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="ward_id">Select Ward:</label>
        <select name="ward_id" id="ward_id">
            <option value="">Select a Ward</option>
            <!-- Wards will be loaded here based on the selected LGA -->
        </select>
        <br>

        <h2>Enter Results for Each Party</h2>
        <label for="PDP">PDP:</label>
        <input type="number" name="PDP" id="PDP" required>
        <br>
        <label for="DPP">DPP:</label>
        <input type="number" name="DPP" id="DPP" required>
        <br>
        <label for="ACN">ACN:</label>
        <input type="number" name="ACN" id="ACN" required>
        <br>
        <label for="PPA">PPA:</label>
        <input type="number" name="PPA" id="PPA" required>
        <br>
        <label for="CDC">CDC:</label>
        <input type="number" name="CDC" id="CDC" required>
        <br>
        <label for="JP">JP:</label>
        <input type="number" name="JP" id="JP" required>
        <br>

        <button type="submit">Submit Results</button>
    </form>
</body>
</html>
