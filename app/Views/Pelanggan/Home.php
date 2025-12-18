<?= $this->extend('Pelanggan\Template') ?>
      <?= $this->section('content') ?>
      

      <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10">Selamat Datang, <strong><?=session()->get('username')?></strong></h5>
                </div>
              </div>
              <div class="col-auto">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/index.html">Home</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0)">Other</a></li>
                  <li class="breadcrumb-item" aria-current="page">Sample Page</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <div class="row">
          <div class="col-md-4">
          <div class="card bg-warning-dark dashnum-card dashnum-card-small text-white overflow-hidden">
              <span class="round bg-warning small"></span>
              <span class="round bg-warning big"></span>
              <div class="card-body p-3">
                <div class="d-flex align-items-center">
                  <div class="avtar avtar-lg bg-warning">
                    <i class="text-dark ti ti-notes"></i>
                  </div>
                  <div class="ms-2">
                    <h4 class="text-dark mb-1"><?=$stat['baru']?> Item</h4>
                    <p class="mb-0 opacity-75 text-sm text-dark">Jumlah Komplaint Baru</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Proses -->
          <div class="col-md-4">
          <div class="card bg-primary-dark dashnum-card dashnum-card-small text-white overflow-hidden">
              <span class="round bg-primary small"></span>
              <span class="round bg-primary big"></span>
              <div class="card-body p-3">
                <div class="d-flex align-items-center">
                  <div class="avtar avtar-lg">
                    <i class="text-white ti ti-notes"></i>
                  </div>
                  <div class="ms-2">
                    <h4 class="text-white mb-1"><?=$stat['proses']?> Item</h4>
                    <p class="mb-0 opacity-75 text-sm">Jumlah Komplaint Diproses</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Selesai -->
          <div class="col-md-4">
          <div class="card bg-success-dark dashnum-card dashnum-card-small text-white overflow-hidden">
              <span class="round bg-success small"></span>
              <span class="round bg-success big"></span>
              <div class="card-body p-3">
                <div class="d-flex align-items-center">
                  <div class="avtar avtar-lg bg-success">
                    <i class="text-dark ti ti-notes"></i>
                  </div>
                  <div class="ms-2">
                    <h4 class="text-dark mb-1"><?=$stat['selesai']?> Item</h4>
                    <p class="mb-0 opacity-75 text-sm text-dark">Jumlah Komplaint Selesai</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?= $this->endSection() ?>