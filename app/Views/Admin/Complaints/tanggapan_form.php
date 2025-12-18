<!-- Tanggapan Modal -->
<div class="modal fade" id="tanggapanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Beri Tanggapan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="tanggapanForm">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Judul Komplain</label>
            <input type="text" class="form-control" value="<?=esc($complaint['title'])?>" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Tanggapan <span class="text-danger">*</span></label>
            <textarea name="message" class="form-control" rows="5" placeholder="Ketik tanggapan Anda..." required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
        <?= csrf_field() ?>
        <input type="hidden" name="complaint_id" value="<?=$complaint['id']?>">
      </form>
    </div>
  </div>
</div>

<script>
$('#tanggapanForm').submit(function(e) {
    e.preventDefault();

    $.ajax({
        url: "<?=base_url('admin/saveTanggapan')?>",
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                Notiflix.Notify.success(response.message);
                $('#tanggapanModal').modal('hide');
            } else {
                Notiflix.Notify.failure('Gagal mengirim tanggapan');
            }
        },
        error: function() {
            Notiflix.Notify.failure('Terjadi kesalahan');
        }
    });
});
</script>