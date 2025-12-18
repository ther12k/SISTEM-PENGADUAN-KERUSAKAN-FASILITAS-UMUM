
<!doctype html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    <title>Login | Complaint App</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="codedthemes" />
    <!-- [Favicon] icon -->
    <link rel="icon" href="<?=base_url('assets/images/favicon.svg')?>" type="image/x-icon" />
 <!-- [Google Font] Family -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" id="main-font-link" />
<!-- [phosphor Icons] https://phosphoricons.com/ -->
<link rel="stylesheet" href="<?=base_url()?>/assets/fonts/phosphor/duotone/style.css" />
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="<?=base_url()?>/assets/fonts/tabler-icons.min.css" />
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="<?=base_url()?>/assets/fonts/feather.css" />
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="<?=base_url()?>/assets/fonts/fontawesome.css" />
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="<?=base_url()?>/assets/fonts/material.css" />
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="<?=base_url()?>/assets/css/style.css" id="main-style-link" />
<link rel="stylesheet" href="<?=base_url()?>/assets/css/style-preset.css" />
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
        <!-- tag form -->
        <form class="auth-form"> 
            <?=csrf_field();?>
          <div class="card my-5">
            <div class="card-body">
              <a href="#" class="d-flex justify-content-center">
                <img src="<?=base_url('assets/images/logo-app.png')?>"style="width:500px;"> 
                </a>
              
              <h5 class="my-4 d-flex justify-content-center">Sign in with Email address</h5>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="email" id="email" placeholder="Email address / Username" />
                <label for="email">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                <label for="password">Password</label>
              </div>
                <div class="d-grid mt-4">
                <button type="submit" id="btn-login" class="btn btn-secondary">Login</button>
              </div>
              <hr />
              <h5 class="d-flex justify-content-center">Don't have an account?</h5>
            </div>
        </form>
        </div>
        <!-- end form tag -->
      </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="<?=base_url()?>/assets/js/plugins/popper.min.js"></script>
    <script src="<?=base_url()?>/assets/js/plugins/simplebar.min.js"></script>
    <script src="<?=base_url()?>/assets/js/plugins/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/assets/js/icon/custom-font.js"></script>
    <script src="<?=base_url()?>/assets/js/script.js"></script>
    <script src="<?=base_url()?>/assets/js/theme.js"></script>
    <script src="<?=base_url()?>/assets/js/plugins/feather.min.js"></script>
    <!-- Jquery -->
    <script src="<?=base_url('assets/js/plugins/jquery-3.7.1.min.js')?>"></script>
    <script src="<?=base_url('assets/notiflix/notiflix-3.2.8.min.js')?>"></script>
    <script>
        $('.auth-form').submit(function (e) { 
            e.preventDefault();
            // Reset pesan error
            $('#email').removeClass('is-invalid');
            $('#password').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $.ajax({
                type: "post",
                url: "<?=base_url('login/proses')?>",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend : function(){
                  $('#btn-login').prop('disabled', true)
                  Notiflix.Loading.standard('Harap Tunggu Sebentar...');
                },
                complete : function(){
                  $('#btn-login').prop('disabled', false)
                  Notiflix.Loading.remove();
                },
                success: function (response) {
                  // jika gagal
                  if(response.status==false){
                    // Error Email
                    if (response.email){
                    $('#email').addClass('is-invalid')
                    $('#email').after('<div class="invalid-feedback">'+response.email+'</div>')
                  }
                    // Error Password
                     if (response.password){
                    $('#password').addClass('is-invalid')
                    $('#password').after('<div class="invalid-feedback">'+response.password+'</div>')
                  }

                  return;

                  }

                  /// jika berhasil

                  if (response.status == true){
                    Notiflix.Notify.success('Login Berhasil...');
                    window.location.href = response.redirect
                  }
                }
            });
            
        });
    </script>

       

  </body>
  <!-- [Body] end -->
</html>
