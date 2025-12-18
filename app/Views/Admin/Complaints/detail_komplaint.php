<!-- Modal -->
<div class="modal fade" id="modal-detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-detailLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal-detailLabel">
          <i class="ti ti-file-description me-2"></i>
          Detail Komplain
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <!-- Informasi Utama -->
        <div class="info-section mb-4">
          <div class="info-item mb-3 p-3 bg-light rounded">
            <label class="text-muted small d-block mb-1">Judul Komplain</label>
            <h4 class="mb-0 text-primary"><?=$d['title']?></h4>
          </div>

          <div class="info-item mb-3">
            <label class="text-muted small d-block mb-1">Pelapor</label>
            <div class="d-flex align-items-center">
              <i class="ti ti-user text-muted me-2"></i>
              <strong><?=$d['username'] ?? 'Unknown'?></strong>
            </div>
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
                class="btn btn-outline-primary btn-sm me-2" target="_blank">
                  <i class="ti ti-download me-1"></i>
                  Download
                </a>
                <a href="<?=base_url('uploads/complaints/'.$d['attachment'])?>"
                class="btn btn-outline-success btn-sm" target="_blank">
                  <i class="ti ti-eye me-1"></i>
                  Preview
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

        <!-- Riwayat Tanggapan Section -->
        <hr class="my-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="mb-0">
            <i class="ti ti-message-circle-2 me-2 text-primary"></i>
            Riwayat Tanggapan
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
              Belum ada tanggapan
            </div>
          <?php else: ?>
            <?php foreach($responses as $response): ?>
            <div class="card mb-3 border-primary">
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

        <!-- Tanggapan Form (Hidden by default) -->
        <div id="tanggapanForm" style="display: none;">
          <hr>
          <h5 class="mb-3">
            <i class="ti ti-message me-2 text-info"></i>
            Beri Tanggapan
          </h5>
          <form id="tanggapanSubmitForm">
            <div class="mb-3">
              <label class="form-label">Pesan Tanggapan <span class="text-danger">*</span></label>
              <textarea name="message" class="form-control" rows="4" placeholder="Ketik tanggapan Anda..." required></textarea>
              <div class="invalid-feedback"></div>
            </div>
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">Kirim Tanggapan</button>
              <button type="button" class="btn btn-secondary" onclick="hideTanggapanForm()">Batal</button>
            </div>
            <?= csrf_field() ?>
            <input type="hidden" name="complaint_id" value="<?=$d['id']?>">
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <?php if($d['status'] != 'selesai'): ?>
          <select class="form-select form-select-sm d-inline-block w-auto me-2" onchange="updateStatus(<?=$d['id']?>, this.value)">
              <option value="">Update Status</option>
              <option value="baru" <?=($d['status'] == 'baru') ? 'selected' : ''?>>Baru</option>
              <option value="proses" <?=($d['status'] == 'proses') ? 'selected' : ''?>>Proses</option>
              <option value="selesai">Selesai</option>
          </select>
          <button type="button" class="btn btn-info" onclick="showTanggapanForm()">
            <i class="ti ti-message me-1"></i>
            Beri Tanggapan
          </button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script>
function updateStatus(id, status) {
    if(!status) return;

    if(!confirm('Apakah Anda yakin ingin mengubah status komplain ini?')) return;

    $.post("<?=base_url('admin/updateStatus')?>", {id: id, status: status}, function(response) {
        if(response.status) {
            Notiflix.Notify.success(response.message);
            location.reload();
        } else {
            Notiflix.Notify.failure('Gagal mengupdate status');
        }
    });
}

function showTanggapanForm() {
    $('#tanggapanForm').slideDown();
    $('textarea[name="message"]').focus();
}

function hideTanggapanForm() {
    $('#tanggapanForm').slideUp();
    $('textarea[name="message"]').val('');
}

function toggleResponses() {
    var responsesList = $('#responsesList');
    var icon = $('#responsesToggleIcon');
    var text = $('#responsesToggleText');

    if (responsesList.is(':visible')) {
        responsesList.slideUp();
        icon.removeClass('ti-chevron-up').addClass('ti-chevron-down');
        text.text('Tampilkan');
    } else {
        responsesList.slideDown();
        icon.removeClass('ti-chevron-down').addClass('ti-chevron-up');
        text.text('Sembunyikan');
    }
}

// Handle form submission
$('#tanggapanSubmitForm').submit(function(e) {
    e.preventDefault();

    // Reset error states
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').empty();

    $.ajax({
        url: "<?=base_url('admin/saveTanggapan')?>",
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        beforeSend: function() {
            $('button[type="submit"]').prop('disabled', true).text('Mengirim...');
        },
        success: function(response) {
            if (response.status) {
                Notiflix.Notify.success(response.message);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                // Show validation errors
                if (response.message) {
                    $('textarea[name="message"]').addClass('is-invalid');
                    $('textarea[name="message"]').siblings('.invalid-feedback').text(response.message);
                }
                Notiflix.Notify.failure('Periksa kembali input Anda');
                $('button[type="submit"]').prop('disabled', false).text('Kirim Tanggapan');
            }
        },
        error: function() {
            Notiflix.Notify.failure('Terjadi kesalahan');
            $('button[type="submit"]').prop('disabled', false).text('Kirim Tanggapan');
        }
    });
});
</script>