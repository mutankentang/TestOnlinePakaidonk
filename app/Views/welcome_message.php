<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Input Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">User Data Submission</h1>
        <form id="userForm">
            <div class="mb-3">
                <label for="inputData" class="form-label">Enter Data (NAME AGE CITY):</label>
                <input type="text" class="form-control" id="inputData" placeholder="ex: Falah 25THN MALANG" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div id="response" class="alert mt-3" style="display:none;"></div>
    </div>

    <script>
        document.getElementById('userForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const input = document.getElementById('inputData').value.trim();
            const regex = /^(\d+)\s*(THN|TAHUN|TH)$/i;
    const match = input.match(/(\d+)\s*(THN|TAHUN|TH)\b/i);

    // Validasi format tahun
    if (!match) {
        alert('FORMAT TAHUN TIDAK SESUAI. Format yang benar: "XXTHN", "XXTAHUN", "XTH", atau "X TAHUN".');
        return;
        }

        const age = match[1]; // Ambil angka umur
    const remainingInput = input.replace(match[0], '').trim(); // Hapus angka dan tahun dari input
    const nameCityParts = remainingInput.split(' ');

    // Validasi format nama dan kota
    if (nameCityParts.length < 2) {
        alert('FORMAT CITY TIDAK SESUAI');
        return;
    }

    const name = nameCityParts[0]; // Nama adalah kata pertama
    const cityName = nameCityParts.slice(1).join(' '); // Sisa adalah kota

    // Validasi jika ada data yang tidak lengkap
    if (!name || !age || !cityName) {
        alert('FORMAT TIDAK SESUAI');
        return;
    }
        const payload = { name, age, city: cityName };
        try {
            const response = await fetch('/api/create', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload),
            });
            const result = await response.json();
            document.getElementById('response').style.display = 'block';
            document.getElementById('response').className = 'alert alert-success';
            document.getElementById('response').textContent = JSON.stringify(result);
        } catch (error) {
            document.getElementById('response').style.display = 'block';
            document.getElementById('response').className = 'alert alert-danger';
            document.getElementById('response').textContent = 'Failed to submit data.';
        }
        });
    </script>
</body>
</html>