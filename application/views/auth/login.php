<html>

<head>
  <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
  <link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>assets/css/www_materialize.min.css">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
    }

    main {
      flex: 1 0 auto;
    }

    body {
      background: #fff;
    }

    .input-field input[type=date]:focus + label,
    .input-field input[type=text]:focus + label,
    .input-field input[type=email]:focus + label,
    .input-field input[type=password]:focus + label {
      color: #e91e63;
    }

    .input-field input[type=date]:focus,
    .input-field input[type=text]:focus,
    .input-field input[type=email]:focus,
    .input-field input[type=password]:focus {
      border-bottom: 2px solid #e91e63;
      box-shadow: none;
    }
  </style>
</head>

<body>
  <div class="section"></div>
  <main>
    <center>
      <img class="responsive-img" style="width: 250px;" src="https://i.imgur.com/ax0NCsK.gif" />
      <div class="section"></div>

      <h5 class="indigo-text">Silahan Login</h5>
      <h6 class="" style="color:#e91e63;"><?php echo $message;?></h6>
      
      <div class="section"></div>

      <div class="container">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

          <?php echo form_open("auth/login");?>
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <?php echo form_input($identity);?>
                <!--<label for='email'><?php echo lang('login_identity_label', 'identity');?></label>-->
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <?php echo form_input($password);?>
                <!--<label for='password'><?php echo lang('login_password_label', 'password');?></label>-->
              </div>
              <label style='float: right;'>
					<a class='pink-text' href='#!'><b>Forgot Password?</b></a>
				</label>
            </div>

            <br />
            <center>
              <div class='row'>
                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Login</button>
                <!--<?php echo form_submit('submit', lang('login_submit_btn'));?>-->
              </div>
            </center>
          <?php echo form_close();?>
        </div>
      </div>
      <a href="#!">Create account</a>
    </center>

    <div class="section"></div>
    <div class="section"></div>
  </main>

  <script src="<?php echo $this->config->item('base_url') ?>assets/js/www_jquery.min.js"></script>
  <script src="<?php echo $this->config->item('base_url') ?>assets/js/www_materialize.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
</body>
</html>