<!-- Modal -->
<div class="modal fade" id="modal-detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-detailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal-detailLabel">Informasi Pengaduan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <!-- Informasi Utama -->
        <div class="info-section mb-4">
          <div class="info-item mb-3 p-3 bg-light rounded">
            <label class="text-muted small d-block mb-1">Judul Pengaduan</label>
            <h4 class="mb-0 text-primary"><?=$d['title']?></h4>
          </div>

          <div class="info-item mb-3">
            <label class="text-muted small d-block mb-2">Keterangan / Deskripsi</label>
            <div class="alert alert-secondary mb-0">
              <i class="ti ti-file-description me-2"></i>
              <?=$d['description']?>
            </div>
          </div>

          <div class="info-item mb-3">
            <label class="text-muted small d-block mb-2">Lampiran</label>
            <?php
            if ($d['attachment'] !==null) {
              ?>
                <a href="<?=base_url('uploads/complaints/'.$d['attachment'])?>"
                class="btn btn-outline-primary btn-sm" target="_blank">
                  <i class="ti ti-download me-1"></i>
                  Lihat Lampiran
                </a>
              <?php
            }else{
              ?>
              <span class="text-muted">
                <i class="ti ti-paperclip me-1"></i>
                Tidak ada lampiran
              </span>
              <?php
            }
            ?>
          </div>
        </div>

        <!-- Status & Timeline -->
        <div class="status-timeline mb-4">
          <div class="row">
            <div class="col-md-6">
              <div class="info-item">
                <label class="text-muted small d-block mb-2">Status</label>
                <div>
                  <?php
                  if ($d['status']=='baru'){
                    ?>
                    <span class="badge bg-dark fs-6 px-3 py-2">
                      <i class="ti ti-circle me-1"></i>
                      <?=$d['status']?>
                    </span>
                    <?php
                  }elseif($d['status']=='proses'){
                    ?>
                    <span class="badge bg-warning fs-6 px-3 py-2">
                      <i class="ti ti-loader me-1"></i>
                      <?=$d['status']?>
                    </span>
                    <?php
                  }elseif($d['status']=='selesai'){
                    ?>
                    <span class="badge bg-success fs-6 px-3 py-2">
                      <i class="ti ti-check me-1"></i>
                      <?=$d['status']?>
                    </span>
                    <?php
                  }
                  ?>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-item">
                <label class="text-muted small d-block mb-2">Waktu Submit</label>
                <div>
                  <i class="ti ti-calendar me-2 text-muted"></i>
                  <strong><?=date('d F Y', strtotime($d['created_at']))?></strong>
                  <br>
                  <i class="ti ti-clock me-2 text-muted"></i>
                  <?=date('H:i:s', strtotime($d['created_at']))?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Tanggapan Section -->
        <hr class="my-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="mb-0">
            <i class="ti ti-message-circle-2 me-2 text-primary"></i>
            Tanggapan dari Admin
          </h5>
          <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleResponses()">
            <i class="ti ti-chevron-down" id="responsesToggleIcon"></i>
            <span id="responsesToggleText">Tampilkan</span>
          </button>
        </div>

        <div class="mt-3" id="responsesList" style="display: none;">
            <?php
            // Load responses for this complaint
            $responseModel = new \App\Models\ResponseModel();
            $responses = $responseModel->getResponsesByComplaint($d['id']);

            if(empty($responses)):
            ?>
                <div class="alert alert-info border-0 bg-light">
                  <i class="ti ti-info-circle me-2"></i>
                  Belum ada tanggapan dari admin
                </div>
            <?php else: ?>
                <?php foreach($responses as $response): ?>
                <div class="card border-primary mb-3">
                  <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                      <div>
                        <span class="badge bg-primary fs-6">
                          <i class="ti ti-shield-check me-1"></i>
                          <?=$response['username']?> (Admin)
                        </span>
                      </div>
                      <small class="text-muted">
                        <i class="ti ti-clock me-1"></i>
                        <?=date('d M Y H:i', strtotime($response['craeted_at']))?>
                      </small>
                    </div>
                    <div class="message-content p-3 bg-light rounded">
                      <?=nl2br(esc($response['message']))?>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <a href="<?=base_url('user/komplaint/edit/' .$d['id'])?>" class="btn btn-primary">Ubah</a>
      </div>
    </div>
  </div>
</div>