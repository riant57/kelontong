<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0"/>
	<title>Login Admin</title>
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>assets/css/www_materialize.min.css">

	<style type="text/css">


	   .no-padding{
	   	padding:0px;
	   }

	   h1,h2,h3,h4,h5,h6{
	   	padding: 1px;
	   	margin: 0px;
	   }

	   input{
	   	border-radius: 30px !important;
	   	padding-left: 10px !important;
	   	padding-right: 10px !important;
	   	border: 1px solid #ccc !important;
	   	width: 90% !important;
	   }

	   .input-field.col label{
	   	padding-left: 20px;
	   }
	</style>
</head>
<body>
<div class="floating-login">
	<?php echo form_open("auth/login");?>
		<div class="card-panel card lighten-4 black-text" style="max-width: 400px;margin: auto; margin-top: 30px; padding: 10px; box-shadow: none;">
			<h5 align="center" style="padding: 20px;">Kedai Empek-Empek 86</h5>
			<h6 align="center">#Silahkan Login#</h6>
		   	<div class="row">
				<div align="center"><?php echo $message;?></div>
		      	<div class="input-field col s12">
				  <?php echo form_input($identity);?>
		        </div>
		        <div class="input-field col s12">
		          <?php echo form_input($password);?>
		        </div>
				<!-- <label>
					<?php echo lang('login_remember_label', 'remember');?>
					<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
				</label> -->
				<label>
					<input type="checkbox" name="remember" value="1" id="remember" />
					<span>Remember Me :</span>
				</label>
		        <div class="input-field col s12" style="width:100%; text-align:center">
			       <button type="submit" class="waves-effect waves-light btn-flat blue white-text" name="btn_login">Login Yuk!</button>
				   <!-- p><?php echo form_submit('submit', lang('login_submit_btn'));?></p -->
			    </div>
	       	</div>
		</div>
	<?php echo form_close();?>
</div>
<script src="<?php echo $this->config->item('base_url') ?>assets/js/www_jquery.min.js"></script>
<script src="<?php echo $this->config->item('base_url') ?>assets/js/www_materialize.min.js"></script>
</body>
</html>