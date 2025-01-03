<?php
$data['title']= "Ganti Password";
$this->load->view("admin/_partial/header.php", $data);
$this->load->view("admin/_partial/sidebar.php");
$this->load->view("admin/_partial/top-header.php");
?>

<div class="row custom-container">
    <h6><?php echo lang('change_password_heading');?></h6>
	<div class="col s12" id="postList">

        <div id="infoMessage"><?php echo $message;?></div>
        
        <?php echo form_open("auth/change_password");?>
        
              <p>
                    <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
                    <?php echo form_input($old_password);?>
              </p>
        
              <p>
                    <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
                    <?php echo form_input($new_password);?>
              </p>
        
              <p>
                    <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                    <?php echo form_input($new_password_confirm);?>
              </p>
        
              <?php echo form_input($user_id);?>
              <button type="submit" class="waves-effect waves-light btn-flat blue white-text" name="btn_login">Ganti</button>
              <!--<p><?php echo form_submit('submit', lang('change_password_submit_btn'));?></p>-->
        
        <?php echo form_close();?>
    </div>
</div>

<script type="text/javascript">
	var base_url = '<?php echo base_url();?>';
</script>
<?php
$this->load->view("admin/_partial/footer.php");
?>
