<!doctype html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    <title>Register | Complaint app</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="Aplikasi complaint adalah layanan pengaduan pelanggan"
    />
    <meta
      name="keywords"
      content="Aplikasi complaint pelanggan"
    />
    <meta name="author" content="codedthemes" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="<?=base_url('assets')?>/images/favicon.svg" type="image/x-icon" />
 <!-- [Google Font] Family -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" id="main-font-link" />
<!-- [phosphor Icons] https://phosphoricons.com/ -->
<link rel="stylesheet" href="<?=base_url('assets')?>/fonts/phosphor/duotone/style.css" />
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="<?=base_url('assets')?>/fonts/tabler-icons.min.css" />
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="<?=base_url('assets')?>/fonts/feather.css" />
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="<?=base_url('assets')?>/fonts/fontawesome.css" />
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="<?=base_url('assets')?>/fonts/material.css" />
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="<?=base_url('assets')?>/css/style.css" id="main-style-link" />
<link rel="stylesheet" href="<?=base_url('assets')?>/css/style-preset.css" />
<link rel="stylesheet" href="<?=base_url('assets')?>/notiflix/notiflix-3.2.8.min.css" />

  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main">
      <div class="auth-wrapper v3">
        <form class="auth-form" method="post" id="form-register">
           <?=csrf_field();?>
          <div class="card mt-5">
            <div class="card-body">
              <a href="#" class="d-flex justify-content-center mt-3">
                <img src="<?=base_url('assets/images/logo-app.png')?>" class="img-fluid">
              </a>
              <div class="row">
                <div class="d-flex justify-content-center">
                  <div class="auth-header">
                    <h2 class="text-secondary"><b>Sign up</b></h2>
                  </div>
                </div>
              </div>
              <h5 class="my-4 d-flex justify-content-center">Sign Up with Email address</h5>
              <div class="form-floating mb-3">

                <input type="text" class="form-control"name="username" id="username" placeholder="Username" />
                <label for="username"> Username</label>
                <div class="invalid-feedback"></div>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="email" id="email" placeholder="Email Address " />
                <label for="email">Email Address </label>
                <div class="invalid-feedback"></div>
              </div>

              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="new_password" id="new_password" placeholder=conf" />
                <label for="new_password">New Password</label>
                <div class="invalid-feedback"></div>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="conf_password" id="conf_password" placeholder="conf_password" />
                <label for="conf_password">Confirm Password</label>
                <div class="invalid-feedback"></div>
              </div>

              <div class="form-check mt-3s">
                <input class="form-check-input input-primary" name="agree" type="checkbox" id="agree" />
                <label class="form-check-label" for="agree">
                  <span class="h5 mb-0">Agree with <span>Terms & Condition.</span></span>
                </label>
              </div>
              <div class="d-grid mt-4">
                <button type="submit" id="btn-register" class="btn btn-secondary p-2">Register Now</button>
              </div>
              <hr />
              <h5 class="d-flex justify-content-center">Already have an account?</h5>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="<?=base_url('assets')?>/js/plugins/popper.min.js"></script>
    <script src="<?=base_url('assets')?>/js/plugins/simplebar.min.js"></script>
    <script src="<?=base_url('assets')?>/js/plugins/bootstrap.min.js"></script>
    <!-- <script src="<?=base_url('assets')?>/js/icon/custom-font.js"></script> -->
    <script src="<?=base_url('assets')?>/js/script.js"></script>
    <script src="<?=base_url('assets')?>/js/theme.js"></script>
    <script src="<?=base_url('assets')?>/js/plugins/feather.min.js"></script>
    <script src="<?=base_url('assets/js/plugins/jquery-3.7.1.min.js')?>"></script>
    <script src="<?=base_url('assets/notiflix/notiflix-3.2.8.min.js')?>"></script>
    <!-- Kirim Data -->
    <script>
      $('#form-register').submit(function (e) { 
        e.preventDefault();
        // Reset Error
        $('.form-control').removeClass('is-invalid')
        $('.invalid-feedback').text('');

        $.ajax({
          type: "post",
          url: "<?=base_url('register/proses')?>",
          data: $(this).serialize(),
          dataType: "json",
          success: function (response) {
            if (response.status==true) {
              Notiflix.Notify.success(response.msg );
              // alert('Pendaftaran Akun Berhasil')
            }else{
              $.each(response, function (field, pesan) { 
                if (field !=="status") {
                  // Tambahkan Error ke Inputan
                  $('#'+field).addClass('is-invalid');
                  // Tampilkan Pesan invalid-feedback
                  $('#'+field).siblings('.invalid-feedback').text(pesan)

                }
                 
              });


              // alert('Pendaftaran Akun Gagal')
            }
            // console.log(response)
          }
        });
        
      });


    </script>

  </body>
  <!-- [Body] end -->
</html>