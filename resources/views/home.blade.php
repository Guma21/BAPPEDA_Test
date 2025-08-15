<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Usulan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">
        <h2 class="text-center mb-4">Daftar Usulan</h2>

        <div id="loading" class="text-center">Memuat data...</div>
        <div class="row" id="usulan-container"></div>
    </div>

    <script>
        
        const API_URL = "https://example.com/api/usulan"; 
        const TOKEN = "ISI_TOKEN_DI_SINI"; 

        
        fetch(API_URL, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${TOKEN}`
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Gagal mengambil data usulan");
                }
                return response.json();
            })
            .then(data => {
                document.getElementById("loading").style.display = "none";
                const container = document.getElementById("usulan-container");

                if (!data || data.length === 0) {
                    container.innerHTML = "<p class='text-center'>Tidak ada usulan.</p>";
                    return;
                }

                data.forEach(usulan => {
                    container.innerHTML += `
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="${usulan.gambar || 'https://via.placeholder.com/300x200'}" 
                         class="card-img-top" 
                         alt="${usulan.judul}">
                    <div class="card-body">
                        <h5 class="card-title">${usulan.judul}</h5>
                        <p class="card-text">${usulan.deskripsi}</p>
                    </div>
                    <div class="card-footer text-muted">
                        Pengusul: ${usulan.pengusul || 'Tidak diketahui'}
                    </div>
                </div>
            </div>
        `;
                });
            })
            .catch(error => {
                document.getElementById("loading").innerHTML = `<p class="text-danger">${error.message}</p>`;
            });
    </script>

</body>

</html>
