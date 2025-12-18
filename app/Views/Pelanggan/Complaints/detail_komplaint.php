<!-- Modal -->
<div class="modal fade" id="modal-detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-detailLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal-detailLabel">Informasi Pengaduan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <h5>Judul Pengaduan</h5>
          <h4><?=$d['title']?></h4>
          <h5>Keterangan /Deskripsi</h5>
          <div class="alert bg-light shadow-sm">
            <?=$d['description']?>
          </div>
          <h5>Lampiran</h5>
          <?php
          if ($d['attachment'] !==null) {
            ?>
              <a href="<?=base_url('uploads/complaints/'.$d['attachment'])?>"
              class="btn btn-dark btn-sm" target="_blank">Lihat Lampiran</a>
            <?php
          }else{
            echo "Tidak ada lampiran";
          }
          ?>

        <h5>Status</h5>
        <div>
          <?php
          if ($d['status']=='baru'){
            ?>
            <span class="badge rounded-pill text-bg-dark"><?=$d['status']?></span>
            <?php
          }elseif($d['status']=='proses'){
            ?>
            <span class="badge rounded-pill text-bg-warning"><?=$d['status']?></span>
            <?php
          }elseif($d['status']=='selesai'){
            ?>
            <span class="badge rounded-pill text-bg-success"><?=$d['status']?></span>
            <?php
          }else{
            ?>
            <span class="badge rounded-pill text-bg-success">Belum ada status</span>
            <?php
          }

          ?>
        </div>
        <h5>Waktu Submit</h5>
        <li>Tanggal : <?=date('d F Y', strtotime($d['created_at']))?></li>
        <li>Jam : <?=date('H:i:s', strtotime($d['created_at']))?></li>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <a href="<?=base_url('user/komplaint/edit/' .$d['id'])?>" class="btn btn-primary">Ubah</a>
      </div>
    </div>
  </div>
</div>