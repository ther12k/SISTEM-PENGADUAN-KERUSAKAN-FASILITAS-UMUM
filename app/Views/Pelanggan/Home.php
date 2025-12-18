<?= $this->extend('Pelanggan/Template') ?>
<?= $this->section('content') ?>

<!-- [ Main Content ] start -->
<div class="row">
    <!-- Welcome Card -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Selamat Datang, <?= session()->get('username') ?>!</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Selamat datang di Sistem Pengaduan Kerusakan Fasilitas Umum. Anda dapat membuat pengaduan kerusakan fasilitas umum di sini.</p>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card border-primary">
                            <div class="card-body text-center">
                                <i class="ti ti-file-description text-primary" style="font-size: 3rem;"></i>
                                <h5 class="card-title mt-2">Buat Pengaduan</h5>
                                <p class="card-text">Buat pengaduan kerusakan fasilitas umum</p>
                                <a href="<?= base_url('user/komplaint/buat') ?>" class="btn btn-primary">Buat Pengaduan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-info">
                            <div class="card-body text-center">
                                <i class="ti ti-list text-info" style="font-size: 3rem;"></i>
                                <h5 class="card-title mt-2">Daftar Pengaduan</h5>
                                <p class="card-text">Lihat daftar pengaduan Anda</p>
                                <a href="<?= base_url('user/komplaint/list') ?>" class="btn btn-info">Lihat Pengaduan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-success">
                            <div class="card-body text-center">
                                <i class="ti ti-user text-success" style="font-size: 3rem;"></i>
                                <h5 class="card-title mt-2">Profil</h5>
                                <p class="card-text">Kelola profil Anda</p>
                                <a href="<?= base_url('user/profil') ?>" class="btn btn-success">Lihat Profil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Card -->
    <div class="col-sm-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h5>Statistik Pengaduan Anda</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="p-3">
                            <h2 class="text-warning"><?= $stats['total'] ?? 0 ?></h2>
                            <p>Total Pengaduan</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <h2 class="text-info"><?= $stats['baru'] ?? 0 ?></h2>
                            <p>Menunggu Proses</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <h2 class="text-primary"><?= $stats['proses'] ?? 0 ?></h2>
                            <p>Sedang Diproses</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <h2 class="text-success"><?= $stats['selesai'] ?? 0 ?></h2>
                            <p>Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

<?= $this->endSection() ?>