<?php
$data['title']= "Tambah Group";
$this->load->view("admin/_partial/header.php", $data);
$this->load->view("admin/_partial/sidebar.php");
$this->load->view("admin/_partial/top-header.php");
?>

<div class="row custom-container">
<h6><?php echo lang('create_group_heading');?></h6>
<p><?php echo lang('create_group_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/create_group");?>

      <p>
            <?php echo lang('create_group_name_label', 'group_name');?> <br />
            <?php echo form_input($group_name);?>
      </p>

      <p>
            <?php echo lang('create_group_desc_label', 'description');?> <br />
            <?php echo form_input($description);?>
      </p>

      <!--<p><?php echo form_submit('submit', lang('create_group_submit_btn'));?></p>-->
      <button type="submit" class="waves-effect waves-light btn-flat blue white-text" name="btn_login">Tambah</button>

<?php echo form_close();?>
</div>
<script type="text/javascript">
	var base_url = '<?php echo base_url();?>';
</script>
<?php
$this->load->view("admin/_partial/footer.php");
?>