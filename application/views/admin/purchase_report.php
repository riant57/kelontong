<?php
$data['title']="Laporan Pembelian";
$this->load->view("admin/_partial/header.php", $data);
$this->load->view("admin/_partial/sidebar.php");
$this->load->view("admin/_partial/top-header.php");
?>
	<div class="row">
		<div class="col s12" id="postList">
		    <br>
    	    <table class="striped">
        	    <thead>
        		</thead>
        		<tbody>
        			<tr>
        				<td>Supplier</td>
        				<td>:</td>
        				<td>Semua</td>
        			</tr>
        			<tr>
        				<td>Produk</td>
        				<td>:</td>
        				<td>Semua</td>
        			</tr>
        			<tr>
        				<td>Periode</td>
        				<td>:</td>
        				<td>Semua Transaksi</td>
        			</tr>
        			<tr>
        				<td>Total</td>
        				<td>:</td>
        				<td><?php echo number_format($sum_purchase); ?></td>
        			</tr>
        		</tbody>
        	</table>
        	<br>
			<table class="">
				<thead>
					<tr>
					    <th>id</th>
						<th>Tanggal</th>
						<th>Expired</th>
						<th>Supplier</th>
						<th>Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Return</th>
						<th>Total</th>
						<!--<th style="text-align:center;">Aksi</th>-->
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($purchase)): foreach($purchase as $key=> $item): ?>
						<tr>
						    <td><?php echo $item['id']?></td>
							<td><?php echo ($item['date'])? tanggal($item['date']) : "" ?></td>
							<td><?php echo  ($item['expired'])? tanggal($item['expired']) : ""?></td>
							<td><?php echo $item['supplier_name']?></td>
							<td><?php echo $item['product_name']?></td>
							<td><?php echo number_format($item['price'])?></td>
							<td><?php echo $item['quantity']?></td>
							<td><?php echo ( $item['pr_quantity'])?  $item['pr_quantity'] : 0 ?></td>
							<td><?php echo number_format($item['total'] - $item['pr_total'])?></td>
						</tr>
					<?php  endforeach; else: ?>
						<tr><td colspan="4">Purchase(s) not available.</td></tr>
					<?php endif; ?>	
				</tbody>
				<?php echo $this->ajax_pagination->create_links();?>
			</table>
				<div class="loading" style="display: none;">
				<div class="content"><img style="width:20%" src="<?php echo base_url().'assets/images/loading.gif'; ?>"/></div>
		</div>

			
		</div>
		
		<!-- Modal Structure -->
		  <div id="search_modal" class="modal" style="width:unset">
		    <div class="modal-content">
		        <h5>Masukan Kata Kunci</h5>
		        <!--<input placeholder="Pencarian" id="keywords" onkeyup="searchFilter()" name="txtSearch" type="text" class="validate" value="">-->
		        <div class="row">
		            <form action="#" id="search_form" onsubmit="return false">
    					<div class="input-field col s2">
    					  <input placeholder="Tanggal" id="date_from" name="date_from" value="" type="date" class="validate">
    					  <label for="first_name">Tanggal Awal</label>
    					</div>
    					<div class="input-field col s2">
    					  <input placeholder="Tanggal" id="date_until" name="date_until" value="" type="date" class="validate">
    					  <label for="first_name">Tanggal Akhir</label>
    					</div>
    					<div class="input-field col s2">
                            <select searchable='List of options' id="supplier_id" name="supplier_id">
                                <option value="" disabled selected>Supplier</option>
                                <?php foreach($suppliers as $item) :?>
            					    <option value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
            					<?php endforeach; ?>
                            </select>
                            <label>Supplier</label>
                        </div>
                        <div class="input-field col s6">
                            <select searchable='List of options' id="product_id" name="product_id">
                                <option value="" disabled selected>Produk</option>
                                <?php foreach($products as $item) :?>
            					    <option value="<?php echo $item['product']['product_id'] ?>" ><?php echo $item['product']['product_name'] .  " | Harga Beli : ". $item['product']['hpp'] . " | Harga Jual : ". $item['product']['sale_price']. " | Stok : ". $item['stock'] ?> </option>
            					<?php endforeach; ?>
                            </select>
                            <label>Produk</label>
                        </div>
                    </form>
		        </div>
		    <div class="modal-footer">
		    	<a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat" style="border:1px solid #ddd">Batal</a>
		      	<a href="javascript:void(0)" id="btnSave" onclick="searchFilter()" class="btn-flat modal-close waves-effect waves-light green white-text">Cari</a>
		    </div>
		</div>
	</div>

	
	
	<div class="floating-button-wrapper">
		<a href="javascript:void(0)" data-target="search_modal" class="btn-floating btn waves-effect waves-light green modal-trigger"><i class="material-icons">search</i></a>
	</div>

	<!-- Modal Structure -->
	<div id="tambah_form" class="custom-modal responsive-container">
		<nav>
		    <div class="nav-wrapper blue">
		      <a href="#" class="btn-back waves-effect waves-light"><i class="material-icons mr-0">arrow_back</i></a>
		      <a href="#!" class="custom-nav-title">Tambah Pembelian</a>
		    </div>
		  </nav>
	    <div class="custom-modal-content">
	    	<form action="#" id="form" onsubmit="return false">
				<input type="hidden" value="" name="id"/> 
				<div class="row">
            	    <div class="input-field col s12">
                        <select searchable='List of options' id="xxx" name="product_id">
                            <option value="" disabled selected>Produk</option>
                            <?php foreach($products as $item) :?>
        					    <option value="<?php echo $item['product']['product_id'] ?>" ><?php echo $item['product']['product_name'] .  " | Harga Beli : ". $item['product']['hpp'] . " | Harga Jual : ". $item['product']['sale_price']. " | Stok : ". $item['stock'] ?> </option>
        					<?php endforeach; ?>
                        </select>
                        <label>Produk</label>
                    </div>
                    
                    <div class="input-field col s12">
                        <select searchable='List of options' id="xxxx" name="supplier_id">
                            <option value="" disabled selected>Supplier</option>
                            <?php foreach($suppliers as $item) :?>
        					    <option value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
        					<?php endforeach; ?>
                        </select>
                        <label>Supplier</label>
                    </div>
                    
                    <div class="input-field col s12">
					  <input placeholder="Tanggal" id="first_name" name="date" value="<?php echo date('Y-m-d'); ?>" type="date" class="validate">
					  <label for="first_name">Tanggal Pembelian</label>
					</div>
					
					<div class="input-field col s12">
					  <input placeholder="Tanggal" id="first_name" name="expired" value="<?php echo date('Y-m-d'); ?>" type="date" class="validate">
					  <label for="first_name">Tanggal Expired</label>
					</div>

					<div class="input-field col s12">
					  <input id="price" name="price" type="text" value="0" placeholder="0" class="validate" autocomplete="off">
					  <label for="price">Harga Satuan</label>
					</div>

					<div class="input-field col s12">
					  <input id="quantity" name="quantity" type="text" value="1" placeholder="0" class="validate" autocomplete="off">
					  <label for="quantity">Jumlah</label>
					</div>

					<div class="input-field col s12">
					  <input id="inTotal" name="total" readonly type="text" value="10" placeholder="0" class="validate" autocomplete="off">
					  <label for="inTotal">Total</label>
					</div>

					<div class="input-field col s12">
					  <textarea id="inCatatan" name="note" placeholder="Catatan tambahan" class="materialize-textarea"></textarea>
					  <label for="inCatatan">Catatan</label>
					</div>
				</div>
		    </form>
	    </div>

	    <div class="bottom-navigation responsive-container" style="position: absolute;">
		    <a href="javascript:void(0)" id="btnSave" onclick="save()" class="btn-flat green white-text waves-effect waves-light" style="border-radius: 0px;width: 100%; text-align: center;">SIMPAN</a>
		</div>
	</div>

<?php
$this->load->view("admin/_partial/footer.php");
?>
<script type="text/javascript">
	var base_url = '<?php echo base_url();?>';
	$(document).keypress(function(e) {
		if(e.which == 13) {
			$('#btnSave').trigger('click');
		}
	});
</script>

<script>


function searchFilter(page_num) {
    //alert(1);
	page_num = page_num?page_num:0;
	var date_from   = $('#date_from').val();
	var date_until  = $('#date_until').val();
	var supplier_id = $('#supplier_id').val();
	var product_id  = $('#product_id').val();
	//alert(keywords);
	var sortBy = $('#sortBy').val();
	$.ajax({
		type: 'POST',
		url: base_url+'purchase_report/ajaxPaginationData/'+page_num,
		data:'page='+page_num+'&date_from='+date_from+'&date_until='+date_until+'&supplier_id='+supplier_id+'&product_id='+product_id+'&sortBy='+sortBy,
		beforeSend: function () {
			$('.loading').show();
		},
		success: function (html) {	
			$('#postList').html(html);
			$('.loading').fadeOut("slow");
		}
	});
}

</script>