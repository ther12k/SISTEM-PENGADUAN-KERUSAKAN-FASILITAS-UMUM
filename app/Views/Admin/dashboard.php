<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }
        .sidebar {
            width: 230px;
            height: 100vh;
            background: #2c3e50;
            color: #fff;
            position: fixed;
        }
        .sidebar h2 {
            text-align: center;
            padding: 15px;
            margin: 0;
            background: #1a252f;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #fff;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #34495e;
        }
        .content {
            margin-left: 230px;
            padding: 20px;
        }
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>ADMIN</h2>
    <a href="<?= base_url('admin/dashboard') ?>">Home</a>
    <a href="<?= base_url('admin/tanggapan') ?>">Tanggapan Complaint</a>
    <a href="<?= base_url('admin/komplaint') ?>">Data Seluruh Complaint</a>
    <a href="<?= base_url('admin/profil') ?>">Profil Saya</a>
    <a href="<?= base_url('logout') ?>">Logout</a>
</div>

<div class="content">
    <div class="card">
        <h2>Selamat Datang Admin</h2>
        <p>Silakan pilih menu di samping untuk mengelola complaint.</p>
    </div>
</div>

</body>
</html>

