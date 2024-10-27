<!DOCTYPE html>
<html>
<head>
    <title>Data Jumlah Penduduk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .table-container {
            animation: fadeIn 0.6s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <h2 class="display-6 mb-3">Data Jumlah Penduduk</h2>
                <div class="card shadow-sm table-container">
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                            // Sesuaikan dengan setting MySQL
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "dbsleman";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("<div class='alert alert-danger'>Connection failed: " . $conn->connect_error . "</div>");
                            }

                            $sql = "SELECT * FROM jumlah_penduduk";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<table class='table table-hover align-middle mb-0'>
                                    <thead class='table-light'>
                                        <tr>
                                            <th>Kecamatan</th>
                                            <th>Longitude</th>
                                            <th>Latitude</th>
                                            <th>Luas</th>
                                            <th class='text-end'>Jumlah Penduduk</th>
                                            <th class='text-center'>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . $row["kecamatan"] . "</td>
                                        <td>" . $row["longitude"] . "</td>
                                        <td>" . $row["latitude"] . "</td>
                                        <td>" . $row["luas"] . "</td>
                                        <td class='text-end'>" . number_format($row["jumlah_penduduk"]) . "</td>
                                        <td class='text-center'>
                                            <button type='button' 
                                                class='btn btn-outline-danger btn-sm' 
                                                onclick='confirmDelete(\"" . urlencode($row["kecamatan"]) . "\")'>
                                                <i class='bi bi-trash'></i> Hapus
                                            </button>
                                        </td>
                                    </tr>";
                                }
                                echo "</tbody></table>";
                            } else {
                                echo "<div class='alert alert-info'>Tidak ada data yang ditemukan</div>";
                            }
                            $conn->close();
                            ?>
                        </div>
                        <div class="mt-3 d-flex justify-content-end">
                            <a href="form.html" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 untuk konfirmasi delete -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(kecamatan) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete.php?kecamatan=' + kecamatan;
                }
            });
        }
    </script>
</body>
</html>