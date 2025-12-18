<?= $this->extend('Admin/Template') ?>
<?= $this->section('content') ?>

<!-- [ breadcrumb ] start -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col">
        <div class="page-header-title">
          <h5 class="m-b-10">Tanggapan</h5>
        </div>
      </div>
      <div class="col-auto">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard')?>">Home</a></li>
          <li class="breadcrumb-item" aria-current="page">Tanggapan</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- [ Main Content ] start -->
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Komplain Menunggu Tanggapan</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Pelapor</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if(empty($complaints)): ?>
              <tr>
                <td colspan="7" class="text-center">Tidak ada komplain yang menunggu tanggapan</td>
              </tr>
              <?php else: ?>
              <?php foreach($complaints as $complaint): ?>
              <tr>
                <td><?=$complaint['id']?></td>
                <td><?=$complaint['username']?></td>
                <td><?=$complaint['title']?></td>
                <td><?=character_limiter($complaint['description'], 100)?></td>
                <td>
                  <?php if($complaint['status'] == 'baru'): ?>
                      <span class="badge bg-warning">Baru</span>
                  <?php elseif($complaint['status'] == 'proses'): ?>
                      <span class="badge bg-primary">Diproses</span>
                  <?php endif; ?>
                </td>
                <td><?=date('d M Y H:i', strtotime($complaint['created_at']))?></td>
                <td>
                  <button class="btn btn-sm btn-info" onclick="viewDetail(<?=$complaint['id']?>)">Detail</button>
                  <select class="form-select form-select-sm d-inline-block w-auto" onchange="updateStatus(<?=$complaint['id']?>, this.value)">
                      <option value="">Update Status</option>
                      <option value="baru" <?=($complaint['status'] == 'baru') ? 'selected' : ''?>>Baru</option>
                      <option value="proses" <?=($complaint['status'] == 'proses') ? 'selected' : ''?>>Proses</option>
                      <option value="selesai">Selesai</option>
                  </select>
                </td>
              </tr>
              <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="viewmodal"></div>
<!-- [ Main Content ] end -->

<script>
function updateStatus(id, status) {
    if(!status) return;

    $.post("<?=base_url('admin/updateStatus')?>", {id: id, status: status}, function(response) {
        if(response.status) {
            Notiflix.Notify.success(response.message);
            setTimeout(() => location.reload(), 1000);
        }
    });
}

function viewDetail(id) {
    $.ajax({
        url: "<?=base_url('admin/komplaint/detail')?>",
        type: 'GET',
        data: { id: id },
        dataType: "json",
        success: function(response) {
            if(response.error) {
                Notiflix.Notify.failure(response.error);
                return;
            }
            $('.viewmodal').html(response.form_detail);
            $('#modal-detail').modal('show');
        },
        error: function() {
            Notiflix.Notify.failure('Gagal memuat detail komplain');
        }
    });
}
</script>

<?= $this->endSection() ?>