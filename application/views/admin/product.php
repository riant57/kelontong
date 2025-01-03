<?php
$data['title']="Produk";
$this->load->view("admin/_partial/header.php", $data);
$this->load->view("admin/_partial/sidebar.php");
$this->load->view("admin/_partial/top-header.php");
?>

	<div class="row">
		<div class="col s12" id="postList">
			<!--<ul class="collection product-list">-->
			<!--	<?php if(!empty($product)): foreach($product as $item): ?>-->
			<!--		<li class="collection-item avatar">-->
			<!--			<img src="<?php echo $this->config->item('base_url')."assets/uploads/50".$item['product']['image'] ?>" alt="" class="circle product-list-image">-->
			<!--			<a href="#!" class="waves-effect black-text" style="width: 90%">-->
			<!--			  <span class="title"><b><?php echo $item['product']['product_name'] ?></b></span>-->
			<!--			  <p><b class="blue-text" style="font-size: 20px">Rp. <?php echo number_format($item['product']['hpp'],2) ?> </b><br>-->
			<!--				 <?php echo $item['product']['category_name'] ?>-->
			<!--			  </p>-->
			<!--			  <p><?php echo ($item['stock']->quantity)? $item['stock']->quantity : 0 ?></p>-->
			<!--			</a>-->
			<!--			<a href="#!" onclick="delete_product(<?php echo $item['product']['product_id']; ?>)" class="red-text waves-effect secondary-content"><i class="material-icons">close</i></a>-->
			<!--			<a href="<?php echo base_url('material_product/detail/'.$item['product']['product_id']) ?>">b</a>-->
			<!--		</li>-->
			<!--	<?php  endforeach; else: ?>-->
			<!--		<tr><td colspan="3">Product(s) not available.</td></tr>-->
			<!--	<?php endif; ?>	-->
			<!--  </ul>-->
			
			    <table>
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Aktif</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Berat (pcs)</th>
                            <th>Berat (total)</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <?php if(!empty($product)): foreach($product as $item): ?>
                            <tr>
                                <td><img src="<?php echo $this->config->item('base_url')."assets/uploads/50".$item['product']['image'] ?>" alt="" class="circle product-list-image"></td>
                                <td><?php echo $item['product']['category_name'] ?></td>
                                <td><?php echo $item['product']['product_name'] ?></td>
                                <td><!-- Switch -->
                                    <div class="switch">
                                        <label>
                                          
                                          <input type="checkbox" class="publish_value" value="<?php echo $item['product']['product_id']; ?>" <?php echo ($item['product']['is_active'] == 1 )? "checked":"" ?> >
                                          <span class="lever"></span>
                                          
                                        </label>
                                    </div>
                                    
                                </td>
                                <td><?php echo number_format($item['product']['hpp']) ?></td>
                                <td><?php echo number_format($item['product']['sale_price']) ?></td>
                                <td><?php echo ($item['stock'])? $item['stock'] : 0 ?></td>
                                <td><?php echo $item['product']['weight'] ?></td>
                                <td><?php echo $item['total_weight'] ?></td>
                                <td><?php echo $item['product']['product_unit'] ?></td>
                                <td><a href="#!" onclick="delete_product(<?php echo $item['product']['product_id']; ?>)" class="red-text secondary-content" title="hapus"><i class="material-icons">close</i></a>
                                    <a href="<?php echo base_url('product/edit/'.$item['product']['product_id']) ?>#edit_form" class="blue-text secondary-content" title="edit"><i class="material-icons">edit</i></a>
                                </td>
                            </tr>
                        <?php  endforeach; else: ?>
                            <td colspan="3">Product(s) not available.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
			  <?php echo $this->ajax_pagination->create_links(); ?>
		</div>
		<div class="loading" style="display: none;">
			<div class="content"><img style="width:20%" src="<?php echo base_url().'assets/images/loading.gif'; ?>"/></div>
		</div>
		
		<!-- Modal Structure -->
	    <div id="search_modal" class="modal" style="width:unset">
		    <div class="modal-content">
		        <h5>Masukan Kata Kunci</h5>
		        <!--<input placeholder="Pencarian" id="keywords" onkeyup="searchFilter()" name="txtSearch" type="text" class="validate" value="">-->
		        <div class="row">
		            <form action="#" id="search_form" onsubmit="return false">
    		            <div class="input-field col s5">
                            <select searchable='List of options' id="category_id" name="category_id" class="validate">
                                <option value="" disabled selected>Kategori</option>
                                <?php foreach($category as $item) :?>
            					    <option value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
            					<?php endforeach; ?>
                            </select>
                            <label>Kategori Produk</label>
                        </div>
                        <div class="input-field col s7">
    					  <input placeholder="Pencarian" id="product" name="name" type="text" class="validate" value="">
    					  <label for="first_name">Nama Produk</label>
    					</div>
                    </form>
                </div>
    		    <div class="modal-footer">
    		    	<a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat" style="border:1px solid #ddd">Batal</a>
    		      	<a href="javascript:void(0)" onclick="searchFilter()" class="btn-flat modal-close waves-effect waves-light green white-text">Cari</a>
    		    </div>
		    </div>
		</div>
	</div>
	<!-- Modal Structure -->
	<div id="tambah_form" class="custom-modal responsive-container">
		<nav class="blue">
		    <div class="nav-wrapper blue">
		      <a href="#" class="btn-back waves-effect waves-light"><i class="material-icons mr-0">arrow_back</i></a>
		      <a href="#!" class="custom-nav-title">Tambah Produk</a>
		    </div>
		  </nav>
	    <div class="custom-modal-content" style="padding-left: 0px; padding-right: 0px;">
	    	<form action="#" id="form" onsubmit="return false">
			  <input type="hidden" value="" name="id"/> 
	    	  <div class="row">
				<!--<div class="input-field col s12">-->
				<!--	<img style="width:15%" id="blah" src="#" alt="Gambar" />-->
				<!--</div>-->
	    	  	<div class="input-field col s12">
		    <!--	  	<div class="">-->
				  <!--      <span id="label-photo" style="font-size: 0.8rem;color: #9e9e9e">Pilih Gambar</span><br>-->
				  <!--      <input name="photo" type="file" id="imgInp">-->
						<!--<span class="help-block"></span>-->
				  <!--  </div>-->
				    <div class="btn">
                        <span>Gambar produk</span>
                        <input type="file" name="photo">
                    </div>
				</div>
		        <div class="input-field col s12">
		          <select searchable='List of options' name="category_id" class="validate" required>
				      <option value="" disabled selected>Pilih</option>
					  <?php foreach($category as $item) :?>
					  <option value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
					  <?php endforeach; ?>
				    </select>
				    <label>Kategori Produk</label>
		        </div>
		        <div class="input-field col s12">
		          <input placeholder="Nama Produk" id="" type="text" name="name" class="validate">
		          <label for="">Nama Produk</label>
		        </div>
		        <div class="input-field col s4">
		          <input placeholder="0"  id="" type="number" name="hpp" class="validate">
		          <label for="">Harga Beli</label>
		        </div>
		        <div class="input-field col s4">
		          <input placeholder="0" value="0" id="" type="number" name="sale_price" class="validate">
		          <label for="">Harga Jual</label>
		        </div>
		        <div class="input-field col s4">
		          <input placeholder="0" value="0" id="" type="number" name="stock" class="validate" disabled>
		          <label for="">Stok</label>
		        </div>
		        <div class="input-field col s4">
		          <input placeholder="0" value="0" id="" type="number" name="weight" class="validate">
		          <label for="">Berat</label>
		        </div>
		        <div class="input-field col s4">
		            <select searchable='List of options' name="product_unit_id" class="validate">
				      <option value="" disabled selected>Pilih</option>
					  <?php foreach($product_unit as $item) :?>
					  <option value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
					  <?php endforeach; ?>
				    </select>
				    <label>Satuan</label>
		        </div>
		        <div class="input-field col s12">
		          <textarea id="textarea1" class="materialize-textarea" name="note" placeholder="Catatan"></textarea>
          			<label for="textarea1">Catatan</label>
		        </div>
			  </div>
			  <div class="bottom-navigation responsive-container" style="position: absolute;">
				    <a href="javascript:void(0)" id="btnSave" onclick="save()" class="btn-flat green white-text waves-effect waves-light" style="border-radius: 0px;width: 100%; text-align: center;">SIMPAN</a>
			  </div>
		    </form>
	    </div>
	</div>

	
	<div class="floating-button-wrapper">
		<a href="#tambah_form" onclick="add()" class="btn-floating btn waves-effect waves-light blue"><i class="material-icons">add</i></a>
		<a href="javascript:void(0)" data-target="search_modal" class="btn-floating btn waves-effect waves-light green modal-trigger"><i class="material-icons">search</i></a>
	</div>
<script type="text/javascript">
	var base_url = '<?php echo base_url();?>';
</script>
<?php
$this->load->view("admin/_partial/footer.php");
?>
<script src="<?php echo $this->config->item('base_url') ?>assets/js/product.js"></script>


