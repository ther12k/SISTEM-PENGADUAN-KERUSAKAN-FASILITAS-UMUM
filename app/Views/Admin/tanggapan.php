<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tanggapan Complaint | Admin</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .sidebar {
            height: 100vh;
            background-color: #212529;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 15px;
        }
        .sidebar a:hover {
            background-color: #343a40;
        }
        .sidebar .active {
            background-color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 sidebar p-0">
            <h5 class="text-center text-white py-3 border-bottom">ADMIN PANEL</h5>
            <a href="<?= base_url('admin/dashboard') ?>">🏠 Dashboard</a>
            <a href="<?= base_url('admin/tanggapan') ?>" class="active">💬 Tanggapan Complaint</a>
            <a href="<?= base_url('admin/komplaint') ?>">📄 Data Complaint</a>
            <a href="<?= base_url('admin/profil') ?>">👤 Profil Saya</a>
            <a href="<?= base_url('admin/logout') ?>" class="text-danger">🚪 Logout</a>
        </div>

        <!-- CONTENT -->
        <div class="col-md-10 p-4">
            <h3 class="mb-4">Tanggapan Complaint</h3>

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Daftar Complaint
                </div>
                <div class="card-body">

                    <!-- Contoh tabel -->
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Judul Complaint</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Andi</td>
                                <td>Internet Lambat</td>
                                <td><span class="badge bg-warning">Menunggu</span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success">Tanggapi</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Siti</td>
                                <td>Jaringan Putus</td>
                                <td><span class="badge bg-success">Selesai</span></td>
                                <td>
                                    <button class="btn btn-sm btn-secondary" disabled>Selesai</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
