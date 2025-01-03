<?php
$data['title']="Kategori";
$this->load->view("admin/_partial/header.php", $data);
$this->load->view("admin/_partial/sidebar.php");
$this->load->view("admin/_partial/top-header.php");
?>

	<div class="row">
		<!--<input type="hidden" id="keywords" onkeyup="searchFilter()"/>-->
		<div class="col s12" id="postList">
			<table class="striped">
				<thead>
					<tr>
						<th>Kategori</th>
						<th style="text-align: center;">Pilihan</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($category)): foreach($category as $item): ?>
					<tr>
						<td><?php echo $item['name']; ?></td>
						<td style="text-align: center;">
							<a href="#tambah_form" class="waves-effect waves-light blue btn-menu" href="javascript:void(0)" title="Edit" onclick="edit_category(<?php echo $item['id']; ?>)"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
							<a onclick="delete_category(<?php echo $item['id']; ?>)" class="waves-effect waves-blue red btn-menu">Hapus</a>
						</td>
					</tr>
					<?php  endforeach; else: ?>
						<tr><td colspan="3">Category(s) not available.</td></tr>
					<?php endif; ?>	
				</tbody>
				<?php echo $this->ajax_pagination->create_links();?>
			</table>
		</div>
		<div class="loading" style="display: none;">
			<div class="content"><img style="width:20%" src="<?php echo base_url().'assets/images/loading.gif'; ?>"/></div>
		</div>
		
		<!-- Modal Structure -->
		  <div id="search_modal" class="modal bottom-sheet">
		    <div class="modal-content">
		      <h5>Masukan Kata Kunci</h5>
		      <input placeholder="Pencarian" id="keywords" onkeyup="searchFilter()" id="txtSearch" name="txtSearch" type="text" class="validate" value="">
		    </div>
		    <div class="modal-footer">
			  <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat" style="border:1px solid #ddd">Batal</a>
		      <!-- a href="javascript:void(0)" onclick="mulai_cari()" class="modal-close waves-effect waves-green btn-flat">Cari</a -->
		    </div>
		</div>
	</div>
	<div class="floating-button-wrapper">
		<a href="javascript:void(0)" data-target="search_modal" class="btn-floating btn waves-light green modal-trigger"><i class="material-icons">search</i></a>
	</div>
	
	<!-- Modal Structure -->
	<div id="tambah_form" class="custom-modal responsive-container">
		<nav class="blue">
		    <div class="nav-wrapper blue">
		      <a href="#" class="btn-back waves-effect waves-light"><i class="material-icons mr-0">arrow_back</i></a>
		      <a href="#!" class="custom-nav-title">Tambah Kategori</a>
		    </div>
		  </nav>
	    <div class="custom-modal-content" style="padding-left: 0px; padding-right: 0px;">
	    	<form action="#" id="form" onsubmit="return false">
				<input type="hidden" value="" name="id"/> 
				<div class="row">
					<div class="input-field col s12">
					  <input placeholder="Nama Lengkap" name="name" id="first_name" type="text" class="validate">
					  <label for="first_name">Nama Kategori</label>
					</div>
				</div>
				<div class="bottom-navigation responsive-container" style="position: absolute;">
				    <a href="javascript:void(0)" id="btnSave" onclick="save()" class="btn-flat green white-text waves-effect waves-light" style="border-radius: 0px;width: 100%; text-align: center;">SIMPAN</a>
				</div>
		    </form>
	    </div>
	</div>
<script type="text/javascript">
	var base_url = '<?php echo base_url();?>';
</script>
<?php
$this->load->view("admin/_partial/footer.php");
?>
<script src="<?php echo $this->config->item('base_url') ?>assets/js/product_category.js"></script>
<script>
$(document).keypress(function(e) {
	if(e.which == 13) {
		$('#btnSave').trigger('click');
	}
}); 
</script>
