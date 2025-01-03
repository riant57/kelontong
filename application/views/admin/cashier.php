<?php
$data['title']="Cashier";
$this->load->view("admin/_partial/header.php", $data);
$this->load->view("admin/_partial/sidebar.php");
$this->load->view("admin/_partial/top-header.php");
?>
	<ul class="row">
		<?php foreach($desk as $item) : ?>
			<li class="col s6 m3 custom-center">
				<div class="card">
					<a href="<?php echo base_url('cashier/add_order/'.$item['desk_number'])?>" class="waves-effect waves-blue meja-link <?php echo ($item['count_order'] >= 1)? "grey lighten-3" : "" ?>">
						<?php if($item['count_order'] >= 1) : ?>
							<span class="custom-badge blue"><?php echo $item['count_order'] ?></span>
						<?php endif; ?>
						<h3 class="meja-header"><?php echo $item['desk_number'] ?></h3>
						<p class="meja-content" style="text-transform:uppercase"><?php echo $item['name'] ?></p>
					</a>
				</div>
			</li>
		<?php endforeach; ?>
		
	</ul>
	
	<div class="floating-button-wrapper">
		<a href="javascript:void(0)" data-target="search_modal" class="btn-floating btn waves-effect waves-light red modal-trigger"><i class="material-icons">search</i></a>
		<a href="diskon-tambah.php" class="btn-floating btn waves-effect waves-light blue"><i class="material-icons">add</i></a>
	</div>

	<!-- Modal Structure -->
	<div id="tambah_form" class="custom-modal">
		<nav>
		    <div class="nav-wrapper blue">
		      <a href="#" class="btn-back waves-effect waves-light"><i class="material-icons mr-0">arrow_back</i></a>
		      <a href="#!" class="custom-nav-title">Tambah Pengguna</a>
		      <ul id="nav-mobile" class="right">
		        <li><a href="javascript:void(0)" class="waves-effect waves-light"><i class="material-icons" style="">check</i></a></li>
		      </ul>
		    </div>
		  </nav>
	    <div class="custom-modal-content" style="padding-left: 0px; padding-right: 0px;">
	    	<form method="POST" action="">
	    		<div class="row">
	    		  <div class="input-field col s12">
				    <select>
				      <option value="" disabled selected>Pilihan</option>
				      <option value="Admin">Admin</option>
				      <option value="Kasir">Kasir</option>
				      <option value="Anggota">Anggota</option>
				    </select>
				    <label>Level User</label>
				  </div>

	    		  <div class="input-field col s12">
				    <select>
				      <option value="" disabled selected>Pilihan</option>
				      <option value="Admin">Admin</option>
				      <option value="Kasir">Kasir</option>
				      <option value="Anggota">Anggota</option>
				    </select>
				    <label>Posisi</label>
				  </div>

		        <div class="input-field col s12">
		          <input placeholder="Nama Lengkap" id="first_name" type="text" class="validate">
		          <label for="first_name">Nama Lengkap</label>
		        </div>

		        <div class="input-field col s12">
		          <input id="email" type="email" class="validate" autocomplete="off">
		          <label for="email">Email</label>
		        </div>

		        <div class="input-field col s12">
		          <input id="password" type="password" class="validate" autocomplete="off">
		          <label for="password">Password</label>
		        </div>

		        <div class="input-field col s12">
		          <textarea id="textarea1" placeholder="Alamat Lengap" class="materialize-textarea"></textarea>
		          <label for="textarea1">Alamat</label>
		        </div>
			  </div>
		    </form>
	    </div>
	</div>

<?php
$this->load->view("admin/_partial/footer.php");
?>