<!DOCTYPE html>
<html>
  <head>
      <title>Anggis App Login</title>
      <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/loginStyle.css">
      <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
      <script src="https://kit.fontawesome.com/a81368914c.js"></script>
      <link href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
      <script type="text/javascript">
      $(function() {
          var title = '<?= $this->session->flashdata("title") ?>';
          var text = '<?= $this->session->flashdata("text") ?>';
          var type = '<?= $this->session->flashdata("type") ?>';
          if (title) {
              swal({
                  title: title,
                  text: text,
                  type: type,
                  button: true,
              });
          };
      })
      </script>

      <img class="wave" src="<?php echo base_url(); ?>assets/img/wave.png">
      <div class="container">
          <div class="img">
              <img src="<?php echo base_url(); ?>assets/img/bg.svg">
          </div>
          <div class="login-content">
              <form  method="POST" action="<?php echo site_url('auth/login/login') ?>" novalidate>
                  <img src="<?php echo base_url(); ?>assets/img/avatar.svg">
                  <h2 class="title">Welcome</h2>
                  <div class="input-div one">
                      <div class="i">
                          <i class="fas fa-user"></i>
                      </div>
                      <div class="div">
                          <h5>Username</h5>
                          <input type="text" class="input" name="username" id="username" required>
                      </div>
                  </div>
                  <div class="input-div pass">
                      <div class="i">
                          <i class="fas fa-lock"></i>
                      </div>
                      <div class="div">
                          <h5>Password</h5>
                          <input type="password" class="input" name="password" id="password" required>
                      </div>
                  </div>
                  <input type="submit" class="btn" value="Login">
              </form>
          </div>
      </div>

      <script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>

      <script>
      const inputs = document.querySelectorAll(".input");


      function addcl() {
          let parent = this.parentNode.parentNode;
          parent.classList.add("focus");
      }

      function remcl() {
          let parent = this.parentNode.parentNode;
          if (this.value == "") {
              parent.classList.remove("focus");
          }
      }


      inputs.forEach(input => {
          input.addEventListener("focus", addcl);
          input.addEventListener("blur", remcl);
      });
      </script>

  </body>

</html>