<?= $this->extend('Admin/Template') ?>
<?= $this->section('content') ?>

<!-- [ breadcrumb ] start -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col">
        <div class="page-header-title">
          <h5 class="m-b-10">Profil Admin</h5>
        </div>
      </div>
      <div class="col-auto">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard')?>">Home</a></li>
          <li class="breadcrumb-item" aria-current="page">Profil</li>
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
        <h5>Informasi Akun</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="text-center">
              <img src="<?=base_url()?>assets/images/user/avatar-2.jpg" alt="Admin" class="rounded-circle" width="150">
            </div>
          </div>
          <div class="col-md-8">
            <table class="table table-borderless">
              <tr>
                <td width="150">Username</td>
                <td><strong><?=$user['username']?></strong></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><?=$user['email']?></td>
              </tr>
              <tr>
                <td>Role</td>
                <td><span class="badge bg-primary"><?=ucfirst($user['role'])?></span></td>
              </tr>
              <tr>
                <td>Bergabung Sejak</td>
                <td><?=date('d F Y', strtotime($user['created_at']))?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- [ Main Content ] end -->

<?= $this->endSection() ?>