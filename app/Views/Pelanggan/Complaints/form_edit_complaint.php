<?= $this->extend('Pelanggan/Template') ?>
<?= $this->section('content') ?>

<!-- [ breadcrumb ] start -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col">
        <div class="page-header-title">
          <h5 class="m-b-10">Form Komplaint</h5>
        </div>
      </div>
      <div class="col-auto">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url('user/home')?>">Home</a></li>
          <li class="breadcrumb-item"><a href="javascript: void(0)">Komplaint</a></li>
          <li class="breadcrumb-item" aria-current="page">Edit</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- [ Main Content ] start -->
<div class="row">
  <!-- [ sample-page ] start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Edit Komplaint </h5>
      </div>
      <div class="card-body">
        <form method="post" id="form-complaint" enctype="multipart/form-data">
         <?= csrf_field() ?>
         <input type="hidden" name="id" value="<?=$d['id']?>">
        <div class="mb-4">
          <div class="form-group mb-3">
            <label for="title">Judul Komplaint<span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan Judul Pengaduan" value="<?=$d['title']?>">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group mb-3">
            <label for="description">Deskripsi <span class="text-danger">*</span></label>
            <textarea name="description" rows="3" id="description" class="form-control" placeholder="Tuliskan / Deskripsikan permasalahan anda..."><?=$d['description']?></textarea>
            <div class="invalid-feedback"></div>
          </div>
           <div class="form-group">
            <label for="attachment">Lampiran (opsional)</label>
            <input type="file" name="attachment" id="attachment" class="form-control">
            <div class="invalid-feedback"></div>
          </div>
          </div>
          <div>
            <button type="reset" class="btn btn-warning"><i class="ti ti-arrow-left"></i>Batal</button>
            <button type="submit" class="btn btn-primary"><i class="ti ti-send"></i>Ubah Komplaint</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- [ sample-page ] end -->
</div>
<script>
  $('#form-complaint').submit(function (e) {
e.preventDefault();
// Reset Error
$('.form-control').removeClass('is-invalid');
$('.invalid-feedback').text('');

let formData = new FormData(this);

$.ajax({
    type: "post",
    url: "<?= base_url('user/komplaint/buat') ?>",
    data: formData,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (response) {
        if (response.status==true) {
            // Tampilkan notifikasi sukses
            Notiflix.Notify.success(response.message);
            $('#form-complaint')[0].reset();
        } else {
            // Tampilkan error per field
            $.each(response, function (field, pesan) {
                if (field !== "status") {
                    $('#'+field).addClass('is-invalid');
                    $('#'+field).siblings('.invalid-feedback').text(pesan);
                }
            });
        }
    },
    error: function(){
        Notiflix.Notify.failure('Terjadi kesalahan server.');
    }
});
});
</script>
<?= $this->endSection() ?>