
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Online Exam | By Anonymous</title>
  <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/img/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
  rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/vendors/css/forms/icheck/icheck.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/vendors/css/forms/icheck/custom.css">
 
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/app.css">
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/pages/login-register.css">
 
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/sweetalert.css">
  <link href="<?php echo base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
</head>
<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image menu-expanded blank-page blank-page"
data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
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
  <script>var site_url = '<?php echo site_url(); ?>';</script>

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <img src="<?php echo base_url(); ?>assets/img/stack-logo-dark.png" alt="branding logo">
                  </div>
                </div>
                <div class="card-content">
                  <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                    <span>Pemulihan Kata Sandi</span>
                  </p>
                  <div class="card-body">
                    <form class="form-horizontal" id="passwordRecovery" method="POST" action="<?php echo site_url('auth/Forget_pass/changePassword') ?>" novalidate>
                   
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="hidden" name="isSubmit" value="1">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Your Password" value="<?= set_value('password') ?>" required>
                        <div class="form-control-position">
                          <i class="fa fa-lock"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm Your Password" value="<?= set_value('confirm') ?>" required>
                        <div class="form-control-position">
                          <i class="fa fa-key"></i>
                        </div>
                      </fieldset>
                      <div class="form-group row">
                        <div class="col-md-12 col-12 text-center text-sm-center">
                          <div class="checkbox checkbox-info col-md-12">
                            <input id="checkbox4" type="checkbox" onclick="showhide_reset()">
                            <label for="checkbox4">
                              Show Password
                            </label>
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-user"></i><span id='textSubmit'>&nbsp;Submit<span></button>
                    </form>
                  </div>
                  <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                    <span>Reset Password Form</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>



  <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"
  type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>

  <script src="<?php echo base_url(); ?>assets/app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/app-assets/js/scripts/customizer.js" type="text/javascript"></script>

  <script src="<?php echo base_url(); ?>assets/app-assets/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
  
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>
  
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/proses/passRecovery.js"></script>

  
  <script>
      $('input').on('change', function(){
        $(this).css('border-color', '#ccd6e6');
        $(this).closest('fieldset').find('small').remove();
      });
      
      $("#passwordRecovery").unbind('submit').bind('submit', function (e) {
          e.preventDefault();
          
          var form = $(this);
          $('input').css('border-color', '#ccd6e6').closest('fieldset').find('small').remove();
          $('button[type="submit"] #textSubmit').text(' Submitting.......')
          $('button[type="submit"]').prop('disabled', true);
          $.ajax({
            url : form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
              if (response.success == true) {
                swal({
                    title: "Great!",
                    text: "Kata sandi anda berhasil dipulihkan",
                    showConfirmButton: true,
                    confirmButtonColor: '#00BFFF',
                    type: "success"
                  },
                  function () {
                    window.location.href = site_url + "Auth/Login";
                  });
              } else {
                $.each(response.messages, function (index, value) {
                  var element = $("#" + index);
                  if(value != ''){
                    $(element).css('border-color', 'red');
                  }

                  $(element).after(value);

                });
              }
              $('button[type="submit"] #textSubmit').text(' Submit')
              $('button[type="submit"]').prop('disabled', false);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus, "Error: " + errorThrown);
                console.log(XMLHttpRequest);
            } 
          }); 
        });
   </script>

</body>
</html>
