<?= $this->extend('Pelanggan\Template') ?>
      <?= $this->section('content') ?>
      
      <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10">Data Komplaint</h5>
                </div>
              </div>
              <div class="col-auto">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url('user/home')?>">Home</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0)">Komplaint</a></li>
                  <li class="breadcrumb-item" aria-current="page">List</li>
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
                <h5>Daftar Komplaint Saya </h5>
              </div>
              <div class="card-body">
              <table - class = "table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Waktu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($list as $d) {?>
                    <tr>
                        <td><?=$d['title']?></td>
                        <td><?=date ('d F Y H:i:s', strtotime($d['created_at']))?></td>
                        <td>
                          <a href="#" class="btn btn-light btn-sm btn-detail" data-id="<?=$d['id']?>">Detail</a>
                          <a href="<?=base_url('user/komplaint/edit/' .$d['id'])?>" class="btn btn-warning btn-sm">Edit</a>
                          <a href="#" onclick="HapusComplaint(<?=$d['id']?>)" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
              </table> 

              </div>
            </div>
          </div>
        </div>
        <div class="viewmodal"></div>
        
        <script>
          function HapusComplaint(id) {
          
            Notiflix.Confirm.show(
          'Konfirmasi Hapus Data',
          'Apakah Anda yakin menghapus data ini ?',
          'Ya, Hapus',
          'Batal',
          function okCb() {
         $.ajax({
          type: "post",
          url: "<?= base_url('user/Komplaint/delete') ?>",
          data: {
            id : id
          },
          dataType: "json",
          success: function (response) {
            if (response.status==true){
              Notiflix.Notify.success(response.msg);
                 window.location.reload()
          }
         }
        });
      },
    );
    }

    // tombol detail
    $('.btn-detail').click(function(e) {
      e.preventDefault();
      let id = $(this).data('id');
      $.ajax({
        url: "<?=base_url('user/komplaint/detail')?>",
        data: {
          id : id
        },
        dataType: "json",
        success: function (response) {
          $('.viewmodal').html(response.form_detail)
          $('#modal-detail').modal('show');
          console.log(response)
        }
      });
    });


        </script>
        <?= $this->endSection() ?>