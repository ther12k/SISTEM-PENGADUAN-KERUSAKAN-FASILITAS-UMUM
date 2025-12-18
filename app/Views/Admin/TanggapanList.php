<?= $this->extend('Admin/Template') ?>
<?= $this->section('content') ?>

<div class="container-xl">
  <div class="row g-2 align-items-center">
    <div class="col">
      <h2 class="page-title">Manajemen Tanggapan</h2>
    </div>
  </div>
</div>

<div class="page-body">
  <div class="container-xl">
    <div class="row row-deck row-cards">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Semua Pengaduan</h3>
          </div>
          <div class="table-responsive">
            <table class="table table-vcenter table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul Komplain</th>
                  <th>Pelapor</th>
                  <th>Status</th>
                  <th>Tanggapan</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($complaints as $complaint): ?>
                <tr>
                  <td><?=$no++?></td>
                  <td>
                    <div class="d-flex py-1 align-items-center">
                      <span class="avatar me-2" style="background-image: url(<?=base_url('images/fasum.jpg')?>)"></span>
                      <div class="flex-fill">
                        <div class="font-weight-medium"><?=$complaint['title']?></div>
                        <div class="text-muted"><?=$complaint['email']?></div>
                      </div>
                    </div>
                  </td>
                  <td><?=$complaint['username']?></td>
                  <td>
                    <?php if($complaint['status'] == 'baru'): ?>
                      <span class="badge bg-gray-lt text-gray"><?=$complaint['status']?></span>
                    <?php elseif($complaint['status'] == 'proses'): ?>
                      <span class="badge bg-orange-lt text-orange"><?=$complaint['status']?></span>
                    <?php elseif($complaint['status'] == 'selesai'): ?>
                      <span class="badge bg-green-lt text-green"><?=$complaint['status']?></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <span class="badge bg-blue"><?=$complaint['response_count']?> Tanggapan</span>
                  </td>
                  <td>
                    <span class="text-muted"><?=date('d M Y', strtotime($complaint['created_at']))?></span>
                  </td>
                  <td>
                    <div class="btn-list flex-nowrap">
                      <button class="btn btn-info btn-sm" onclick="viewDetail(<?=$complaint['id']?>)">
                        <i class="ti ti-eye me-1"></i> Detail
                      </button>
                      <?php if($complaint['status'] != 'selesai'): ?>
                      <button class="btn btn-primary btn-sm" onclick="giveResponse(<?=$complaint['id']?>)">
                        <i class="ti ti-message me-1"></i> Tanggapi
                      </button>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="detailModalContent">
      <!-- Content will be loaded via AJAX -->
    </div>
  </div>
</div>

<script>
function viewDetail(id) {
  $.ajax({
    url: "<?=base_url('admin/detail')?>",
    type: 'GET',
    data: { id: id },
    success: function(response) {
      $('#detailModalContent').html(response.form_detail);
      $('#detailModal').modal('show');
    },
    error: function() {
      Notiflix.Notify.failure('Gagal memuat detail');
    }
  });
}

function giveResponse(id) {
  $.ajax({
    url: "<?=base_url('admin/getTanggapanForm')?>",
    type: 'GET',
    data: { complaint_id: id },
    success: function(response) {
      $('body').append(response.form);
      $('#tanggapanModal').modal('show');
      $('#tanggapanModal').on('hidden.bs.modal', function () {
        $(this).remove();
      });
    },
    error: function() {
      Notiflix.Notify.failure('Gagal memuat form tanggapan');
    }
  });
}
</script>

<?= $this->endSection() ?>