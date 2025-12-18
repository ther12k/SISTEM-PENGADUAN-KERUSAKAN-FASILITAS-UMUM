<?= $this->extend('Admin/Template') ?>
<?= $this->section('content') ?>

<!-- [ breadcrumb ] start -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col">
        <div class="page-header-title">
          <h5 class="m-b-10">Dashboard</h5>
        </div>
      </div>
      <div class="col-auto">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard')?>">Home</a></li>
          <li class="breadcrumb-item" aria-current="page">Dashboard</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- [ Main Content ] start -->
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-lg bg-light-primary rounded">
                            <i class="ti ti-file-description f-w-600"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Total Komplaint</h6>
                        <div class="d-flex align-items-baseline">
                            <h3 class="mb-0 f-w-600"><?=$stats['total_complaints']?></h3>
                            <span class="ms-2 text-success"><i class="ti ti-arrow-up"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-lg bg-light-warning rounded">
                            <i class="ti ti-clock f-w-600"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Menunggu Proses</h6>
                        <div class="d-flex align-items-baseline">
                            <h3 class="mb-0 f-w-600"><?=$stats['baru']?></h3>
                            <span class="ms-2 text-warning"><i class="ti ti-minus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-lg bg-light-info rounded">
                            <i class="ti ti-loader f-w-600"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Sedang Diproses</h6>
                        <div class="d-flex align-items-baseline">
                            <h3 class="mb-0 f-w-600"><?=$stats['proses']?></h3>
                            <span class="ms-2 text-info"><i class="ti ti-loader-2"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-lg bg-light-success rounded">
                            <i class="ti ti-circle-check f-w-600"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Selesai</h6>
                        <div class="d-flex align-items-baseline">
                            <h3 class="mb-0 f-w-600"><?=$stats['selesai']?></h3>
                            <span class="ms-2 text-success"><i class="ti ti-arrow-up"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Complaints -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Komplain Terbaru</h5>
                <a href="<?=base_url('admin/komplaint')?>" class="btn btn-primary btn-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelapor</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($recent_complaints)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data komplain</td>
                            </tr>
                            <?php else: ?>
                            <?php foreach($recent_complaints as $complaint): ?>
                            <tr>
                                <td><?=$complaint['id']?></td>
                                <td><?=$complaint['username']?></td>
                                <td><?=$complaint['title']?></td>
                                <td>
                                    <?php if($complaint['status'] == 'baru'): ?>
                                        <span class="badge bg-warning">Baru</span>
                                    <?php elseif($complaint['status'] == 'proses'): ?>
                                        <span class="badge bg-primary">Diproses</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Selesai</span>
                                    <?php endif; ?>
                                </td>
                                <td><?=date('d M Y H:i', strtotime($complaint['created_at']))?></td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="viewDetail(<?=$complaint['id']?>)">Detail</button>
                                    <?php if($complaint['status'] != 'selesai'): ?>
                                    <select class="form-select form-select-sm d-inline-block w-auto" onchange="updateStatus(<?=$complaint['id']?>, this.value)">
                                        <option value="">Update Status</option>
                                        <option value="baru" <?=($complaint['status'] == 'baru') ? 'selected' : ''?>>Baru</option>
                                        <option value="proses" <?=($complaint['status'] == 'proses') ? 'selected' : ''?>>Proses</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                    <?php endif; ?>
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