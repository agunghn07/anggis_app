
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <title>Cuti App | By Anonymous</title>
  <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/img/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/vendors/css/forms/icheck/icheck.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/vendors/css/forms/icheck/custom.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN STACK CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/app.css">
  <!-- END STACK CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/pages/login-register.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css">
  <!-- END Custom CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/sweetalert.css">
  <link href="<?php echo base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
</head>
<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image menu-expanded blank-page blank-page"
data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
  <!--Menampilkan Notifikasi Sweet Alert ketika proses telah dijalankan-->
  <script type="text/javascript">
    $(function(){
      var title = '<?= $this->session->flashdata("title") ?>';
      var text  = '<?= $this->session->flashdata("text") ?>';
      var type  = '<?= $this->session->flashdata("type") ?>';
      if(title){
        swal({
          title   : title,
          text    : text,
          type    : type,
          button  : true,
        });
      };
    })
  </script>
  <!--Sweet Alert-->

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-3 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <img src="<?php echo base_url(); ?>assets/img/stack-logo-dark.png" alt="branding logo">
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2" style="margin-bottom: -10px;">
                    <span>LOGIN FORM</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form class="form-horizontal" method="POST" action="<?php echo site_url('auth/login/login') ?>" novalidate>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Your Username"
                        required>
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password"
                        required>
                        <div class="form-control-position">
                          <i class="fa fa-key"></i>
                        </div>
                      </fieldset>
                      <div class="form-group row">
                        <div class="col-md-12 col-12 text-center text-sm-center">
                          <div class="checkbox checkbox-info col-md-12">
                            <input id="checkbox4" type="checkbox" onclick="showhide_login()">
                            <label for="checkbox4">
                              Show Password
                            </label>
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-user"></i> Login</button>
                    </form>
                  </div>
                  <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                    <span>Forgot Password</span>
                  </p>
                  <div class="card-body">
                    <a href="<?php echo base_url('auth/Forget_pass') ?>" class="btn btn-outline-danger btn-block"><i class="ft-unlock"></i> Recover</a>
                  </div>
                  <!-- 
                  <div class="col-md-12 col-12 float-sm-left text-center text-sm-center"><a href="<?php echo base_url('auth/Forget_pass') ?>" class="card-link">Forgot Password?</a></div>
                  -->
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/js/proses/auth.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN STACK JS-->
  <script src="<?php echo base_url(); ?>assets/app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END STACK JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="<?php echo base_url(); ?>assets/app-assets/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>
</body>
</html>
