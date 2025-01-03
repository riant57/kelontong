<?php
$data['title']="Return Pembelian";
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
        			<!--<tr>-->
        			<!--	<td>Supplier</td>-->
        			<!--	<td>:</td>-->
        			<!--	<td>Semua</td>-->
        			<!--</tr>-->
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
			<table class="striped">
				<thead>
					<tr>
						<th>Tgl retur</th>
						<th>Purchase Id</th>
						<th>Tgl purchase</th>
						<th>Supplier</th>
						<th>Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Total</th>
						<th>Notes</th>
						<th style="text-align: center;"></th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($purchase_return)): foreach($purchase_return as $key=> $item): ?>
						<tr>
							<td><?php echo tanggal($item['pr_created_at'])?></td>
							<td><?php echo $item['purchase_id']?></td>
							<td><?php echo tanggal($item['date'])?></td>
							<td><?php echo $item['supplier_name']?></td>
							<td><?php echo $item['product_name']?></td>
							<td><?php echo number_format($item['pr_price'])?></td>
							<td><?php echo $item['pr_quantity']?></td>
							<td><?php echo number_format($item['pr_total'])?></td>
							<td><?php echo $item['pr_note']?></td>
							<td>
								<!--<li><a href="<?php echo base_url('purchase_detail/detail/'.$item['id']) ?>" class="blue-text" >Detail</a></li>-->
								<!--<li><a href="#!" onclick="delete_purchase_return(<?php echo $item['id']; ?>)" class="red-text">Hapus???</a></li>-->
								<!--<li><a href="#!" onclick="restore_purchase(<?php echo $item['id']; ?>)" class="blue-text" >Restore??</a></li>-->
								<!--<a href="#!" class="waves-effect waves-red red-text btn-more dropdown-trigger" data-target='menu_more_<?php echo $key ?>'><i class="material-icons">more_horiz</i></a>-->
								<a href="<?php echo base_url('purchase_return/edit/'.$item['pr_id']) ?>#edit_form" class="waves-effect waves-light blue btn-menu" title="Perbarui"><i class="glyphicon glyphicon-pencil"></i>Perbarui</a>
								<a href="#!" onclick="delete_purchase_return(<?php echo $item['pr_id']; ?>)" class="waves-effect waves-light red btn-menu" title="Hapus" ><i class="glyphicon glyphicon-pencil"></i>Hapus</a>
							</td>
						</tr>
					<?php  endforeach; else: ?>
						<tr><td colspan="4">Purchase return(s) not available.</td></tr>
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
					<!--<div class="input-field col s2">-->
     <!--                   <select searchable='List of options' id="supplier_id" name="supplier_id">-->
     <!--                       <option value="" disabled selected>Supplier</option>-->
     <!--                       <?php foreach($suppliers as $item) :?>-->
     <!--   					    <option value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>-->
     <!--   					<?php endforeach; ?>-->
     <!--                   </select>-->
     <!--                   <label>Supplier</label>-->
     <!--               </div>-->
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
		      <a href="#!" class="custom-nav-title">Return Pembelian</a>
		    </div>
		  </nav>
	    <div class="custom-modal-content">
	    	<form action="#" id="form" onsubmit="return false">
				<!--<input type="hidden" value="" name="id"/> -->
				<input id="product_id" type="hidden" value="" name="product_id"/> 
				<div class="row">
				    
				    <div class="input-field col s12">
                        <select searchable='List of options' id="xxx" name="purchase_id" onchange="get_purchase(this.value)">
                            <option value="" disabled selected>Purchase</option>
                            <?php foreach($purchases as $item) :?>
        					    <option value="<?php echo $item['id']?>"><?php echo $item['id'] .  " | ". $item['product_name'] .  " | ". $item['supplier_name']. " | ". $item['date'] . " | ". $item['quantity'] . " | ". number_format($item['price']) ?> </option>
        					<?php endforeach; ?>
                        </select>
                        <label>Purchase</label>
                    </div>

					<div class="input-field col s12">
					  <input id="price" name="price" type="text" value="0" placeholder="0" class="validate" autocomplete="off" readonly>
					  <label for="price">Harga Satuan</label>
					</div>

					<div class="input-field col s12">
					  <input id="quantity" name="quantity" type="text" value="0" placeholder="0" class="validate" autocomplete="off">
					  <label for="quantity">Jumlah</label>
					</div>

					<div class="input-field col s12">
					  <input id="inTotal" name="total" readonly type="text" value="0" placeholder="0" class="validate" autocomplete="off" readonly>
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
<script>

	var save_method; //for save method string

$(document).ready(function() {
	
	$("#price, #quantity").keyup(function(){
		var price = $('#price').val();
		var qty   = $('#quantity').val();
		$('#inTotal').val(price * qty );
	});
	
});

var base_url = '<?php echo base_url();?>';

function delete_purchase_return(id)
{
    if(confirm('Are you sure delete this data?'))
    {  
        $.ajax({
            url : base_url+"purchase_return/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
				Materialize.toast('Data berhasil dihapus', 2000);
				searchFilter(0);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

function restore_purchase(id)
{
    if(confirm('Are you sure restore this data?'))
    {
        $.ajax({
            url : base_url+"purchase_return/ajax_return/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
				Materialize.toast('Data berhasil direstore', 2000);
				searchFilter(0);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

function searchFilter(page_num) {
	page_num = page_num?page_num:0;
	
	var date_from   = $('#date_from').val();
	var date_until  = $('#date_until').val();
	var supplier_id = $('#supplier_id').val();
	var product_id  = $('#product_id').val();
	
	var keywords = $('#keywords').val();	
	var sortBy = $('#sortBy').val();
	$.ajax({
		type: 'POST',
		url: base_url+'purchase_return/ajaxPaginationData/'+page_num,
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


// Script Search Select
document.addEventListener('DOMContentLoaded', event => {

    document.querySelectorAll('select[searchable]').forEach(elem => {
        const select = elem.M_FormSelect;
        const options = select.dropdownOptions.querySelectorAll('li:not(.optgroup)');

        // Add search box to dropdown
        const placeholderText = select.el.getAttribute('searchable');
        const searchBox = document.createElement('div');
        searchBox.style.padding = '6px 16px 0 16px';
        searchBox.innerHTML = `
            <input type="text" placeholder="${placeholderText}">
            </input>`
        select.dropdownOptions.prepend(searchBox);
        
        // Function to filter dropdown options
        function filterOptions(event) {
            const searchText = event.target.value.toLowerCase();
            
            options.forEach(option => {
                const value = option.textContent.toLowerCase();
                const display = value.indexOf(searchText) === -1 ? 'none' : 'block';
                option.style.display = display;
            });

            select.dropdown.recalculateDimensions();
        }

        // Function to give keyboard focus to the search input field
        function focusSearchBox() {
            searchBox.firstElementChild.focus({
                preventScroll: true
            });
        }

        select.dropdown.options.autoFocus = false;

        if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
            select.input.addEventListener('click', focusSearchBox);
            options.forEach(option => {
                option.addEventListener('click', focusSearchBox);
            });
        }
        searchBox.addEventListener('keyup', filterOptions);
    });
});

function get_purchase(value)
{
	var id = value;
	//console.log(id);
	$.ajax({
        url : base_url+"purchase_return/get_purchase/"+id,
        type: "POST",
        //dataType: "JSON",
        success: function(e)
        {
            var data = JSON.parse(e);
            //alert(data.price);
            $("#product_id").val(data.product_id);
            $("#price").val(data.price);
            $("#quantity").val(data.quantity);
            $("#inTotal").val(data.total);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error get data');
        }
    });
}

function add()
{
	save_method = 'add';
	$('#tambah_form').show();
}

function save()
{
	var url;
    if(save_method == 'add') {
        url = base_url+"purchase_return/ajax_add";
    }else {
        url = base_url+"purchase_return/ajax_update";
    }
	var formData = new FormData($('#form')[0]);
	console.log(formData);
    $.ajax({
        url : url,
        type: "POST",
		data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
			if(data.status) 
            {
				$('#form')[0].reset();
				Materialize.toast('Data berhasil disimpan', 2000);
				searchFilter(0);
				$('#tambah_form').hide();
			}else{
				for (var i = 0; i < data.inputerror.length; i++) 
                {
					$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
					if(data.error_string[i] !== ""){
						//$('input[name='+data.inputerror[i]+']').addClass('invalid');
						Materialize.toast(data.error_string[i], 4000);
					}
                }
			}
			
		}
	});
}

</script>