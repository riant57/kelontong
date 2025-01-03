<?php
//$data['title']= "Meja ".$desk_no;
$data['title']= "Kasir";
$this->load->view("admin/_partial/header.php", $data);
$this->load->view("admin/_partial/sidebar.php");
$this->load->view("admin/_partial/top-header.php");
?>
    <div class="row display-flex col s12" style="margin-left:10px; margin-right:10px; margin-top:10px;">
      <input placeholder="Cari sesuatu" id="search_input" onkeyup="searchFilter()" type="text" class="search-input">
    </div>
    <div id="postList">
    	<ul class="row display-flex">
    		
    		<?php foreach($product as $key => $item) : ?>
    			<li class="col s6 m3 custom-center">
    				<div class="card">
    					<div id="deleted<?php echo $item['product']['product_id'] ?>">
    						<?php foreach($cart as $c) : ?>
    							<?php if($c['name'] == $item['product']['product_name']) : ?>
    								<a href="#!" id="<?php echo $c['rowid'] ?>" class="romove_cart red white-text waves-effect waves-light order-product-delete"><i class="material-icons mr-0">delete</i></a>
    							<?php endif;?>
    						<?php endforeach; ?>
    					
    					</div>
    					<?php if($item['stock'] < 1): ?>
    					    <a href="#!" title="Stok Habis" class="waves-effect waves-blue meja-link grey lighten-3"><div style=" position: absolute; background: white; padding: 5px;" class="product-title">Stok habis</div>
    					<?php else: ?>
    					    <a href="#!" title="HPP Rp. <?php echo number_format($item['product']['hpp']) ?>" onclick="add_to_cart(<?php echo $item['product']['product_id']; ?>)" class="waves-effect waves-blue meja-link grey lighten-3">
    					<?php endif; ?>
    						<div id="badge<?php echo $item['product']['product_id'] ?>">
    							<?php foreach($cart as $c) : ?>
    							<?php if($c['name'] == $item['product']['product_name']) : ?>
    								<span class="<?php echo $c['rowid'] ?> custom-badge blue product-count"><?php echo $c['qty'] ?></span>
    								<input type="hidden" id="rowidval<?php echo $item['product']['product_id'] ?>" name="" value=<?php echo $c['rowid'] ?>>
    								<input type="hidden" id="stockval<?php echo $c['rowid'] ?>" name="" value=<?php echo $c['stock'] ?>>
    						        <input type="hidden" id="badgeval<?php echo $c['rowid'] ?>" name="" value=<?php echo $c['qty']?>>
    							<?php endif;?>
    							<?php endforeach; ?>
    						</div>
    						<img class="product-img" src="<?php echo $this->config->item('base_url')."assets/uploads/300".$item['product']['image']?>">
    						<p class="product-title"><?php echo $item['product']['product_name'] ?></p>
    						<p class="product-price">Rp. <?php echo number_format($item['product']['sale_price']) ?></p>
    						<p style="margin-top:0; font-size:13px;" class="product-title">Stok <?php echo number_format($item['stock']) ?></p>
    					</a>
    				</div>
    			</li>
    		<?php endforeach; ?>
    		
    	</ul>
    	<div class="bottom-navigation responsive-container">
    		<a class="subtotal bottom-navigation-content">Rp. <?php echo number_format($this->cart->total(),2) ?></a>
    		<!--<a href="#konfirmasi_form" onclick="confirmation()" class="btn-flat blue white-text right waves-effect waves-light" style="border-radius: 0px;">Konfirmasi</a>-->
    		<a href="<?php echo base_url('cashier/confirmation/0?bill_id='.$this->input->get('bill_id', TRUE)) ?>" class="btn-flat blue white-text right waves-effect waves-light" style="border-radius: 0px;">Konfirmasi</a>
    	</div>
    	<div class="loading" style="display: none;">
    	<div class="content"><img style="width:20%" src="<?php echo base_url().'assets/images/loading.gif'; ?>"/></div>
    	<!--<div><?php echo $this->ajax_pagination->create_links();?></div>-->
    	
    	<!--<div class="floating-button-wrapper">
    		<a href="javascript:void(0)" data-target="search_modal" class="btn-floating btn waves-effect waves-light red modal-trigger"><i class="material-icons">search</i></a>
    		<a href="diskon-tambah.php" class="btn-floating btn waves-effect waves-light blue"><i class="material-icons">add</i></a>
    	</div>-->
    </div>

	<!-- Modal Structure -->
	<div id="konfirmasi_form" class="custom-modal responsive-container">
		<nav class="blue">
		    <div class="nav-wrapper blue">
		      <a href="#" class="btn-back waves-effect waves-light"><i class="material-icons mr-0">arrow_back</i></a>
		      <a href="javascript:void(0)" class="custom-nav-title">Rincian Pesanan #<?php echo $desk_no;?></a>
		    </div>
		  </nav>
	    <div class="custom-modal-content">
	    	<!-- form method="POST" action="">
	    		<div class="row">
	    			<div class="col s12">
	    				<table class="striped">
	    					<tr>
	    						<th>Jml</th>
	    						<th>Item</th>
	    						<th class="right-text">Satuan</th>
	    						<th class="right-text">Harga</th>
	    						<th></th>
	    					</tr>
	    					<tr>
	    						<td>1</td>
	    						<td>Nasi Krawu</td>
	    						<td class="right-text">45.000</td>
	    						<td class="right-text">45.000</td>
	    						<td class="center-text"><a href="#!" class="waves-effect waves-blue red-text"><i class="material-icons" style="">close</i></a></td>
	    					</tr>
	    					<tr>
	    						<td>2</td>
	    						<td>Nasi Krawu</td>
	    						<td class="right-text">45.000</td>
	    						<td class="right-text">45.000</td>
	    						<td class="right-text"><a href="#!" class="waves-effect waves-blue red-text"><i class="material-icons" style="">close</i></a></td>
	    					</tr>
	    					<tr>
	    						<td>1</td>
	    						<td>Nasi Krawu</td>
	    						<td class="right-text">45.000</td>
	    						<td class="right-text">45.000</td>
	    						<td style="width: 1px; text-align: center;"><a href="#!" class="waves-effect waves-blue red-text"><i class="material-icons" style="">close</i></a></td>
	    					</tr>
	    					<tr>
	    						<td>2</td>
	    						<td>Nasi Krawu</td>
	    						<td class="right-text">45.000</td>
	    						<td class="right-text">45.000</td>
	    						<td style="width: 1px; text-align: center;"><a href="#!" class="waves-effect waves-blue red-text"><i class="material-icons" style="">close</i></a></td>
	    					</tr>
	    					<tr>
	    						<td colspan="3"><b>Sub Total</b></td>
	    						<td colspan="2" class="right-text"><b>145.000</b></td>
	    					</tr>
	    					<tr>
	    						<td colspan="3"><b>Diskon</b></td>
	    						<td colspan="2" class="right-text"><b>10.000</b></td>
	    					</tr>
	    					<tr>
	    						<td colspan="3" style="font-size: 20px;"><b>Total</b></td>
	    						<td colspan="2" class="right-text" style="font-size: 20px;"><b>145.000</b></td>
	    					</tr>
	    				</table>
	    			</div>
				</div>
		    </form -->
	    </div>

	    <div class="bottom-navigation responsive-container" style="position: absolute;">
		    <a href="<?php echo base_url('bill/save/'.$this->uri->segment(3).'?bill_id='.$this->input->get('bill_id', TRUE)) ?>" class="btn-flat red white-text waves-effect waves-light" style="border-radius: 0px;width: 50%; text-align: center;">SIMPAN</a>
			<a href="<?php echo base_url('payment/?desk_no='.$this->uri->segment(3).'&bill_id='.$this->input->get('bill_id', TRUE))?>" class="btn-flat blue white-text right waves-effect waves-light modal-trigger" style="border-radius: 0px;width:50%; text-align:center;">BAYAR</a>
		</div>

	</div>

<?php
$this->load->view("admin/_partial/footer.php");
?>

<script>
var base_url = '<?php echo base_url();?>';

function number_format (number, decimals, decPoint, thousandsSep) { 
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
	var n = !isFinite(+number) ? 0 : +number
	var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
	var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
	var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
	var s = ''

	var toFixedFix = function (n, prec) {
		var k = Math.pow(10, prec)
		return '' + (Math.round(n * k) / k)
		  .toFixed(prec)
	}

	// @todo: for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || ''
		s[1] += new Array(prec - s[1].length + 1).join('0')
	}

	return s.join(dec)
}

function add_to_cart(id)
{
	 //alert(id);
	 var rowidval = $("#rowidval"+id).val();
	 var getqty   = parseInt($("#badgeval"+rowidval).val());
	 var getstock = parseInt($("#stockval"+rowidval).val());
	 
	 //var getqty   = ($("#badgeval"+rowidval).val() === undefined)? 0 : $("#badgeval"+rowidval).val();
	 //var getstock = ($("#stockval"+rowidval).val() === undefined)? 1 : $("#stockval"+rowidval).val();
 	 
 	 
     if(getqty >= getstock){
         console.log('QTY'+ getqty);
 	     console.log('STOCK'+ getstock);
         alert("Maaf, Quantity melebihi Stock");
          location.reload();
     }else{
         $.ajax({
    		url : base_url+"cashier/add_to_cart/"+id,
    		type: "POST",
    		dataType: "JSON",
    		success: function(data)
    		{
    			for(var i = 0; i < data.id.length; i++ )
    			{
    				//console.log(data.qty[i]);
    				//$('#badge'+data.id[i]).html('<span class="'+data.rowid[i]+' custom-badge blue product-count">'+data.qty[i]+'</span>');
    				$('#badge'+data.id[i]).html('<span class="'+data.rowid[i]+' custom-badge blue product-count">'+data.qty[i]+'</span> <input type="hidden" id="rowidval'+data.id[i]+'" name="" value='+data.rowid[i]+'> <input type="hidden" id="badgeval'+data.rowid[i]+'" name="" value='+data.qty[i]+'> <input type="hidden" id="stockval'+data.rowid[i]+'" name="" value='+data.stock[i]+'>');
    				$('#deleted'+data.id[i]).html('<a href="#!" id="'+data.rowid[i]+'" class="romove_cart red white-text waves-effect waves-light order-product-delete"><i class="material-icons mr-0">delete</i></a>');
    			}	
    			$('.subtotal').html('Rp. '+number_format(data.subtotal,2));
    			//Materialize.toast('Data berhasil dihapus', 2000);
    			//searchFilter(0);
    		},
    		error: function (jqXHR, textStatus, errorThrown)
    		{
    			//alert('Error deleting data');
    		}
    	}); 
     }
	 
}

$(document).on('click','.romove_cart',function(){
	var row_id = $(this).attr("id");
	$.ajax({
		url : base_url+"cashier/delete_cart",
		method : "POST",
		data : {row_id : row_id},
		success :function(response)
		{
			var data = JSON.parse(response);
			$('#'+data.rowid).hide();
			$('.'+data.rowid).hide();
			$('.subtotal').html('Rp. '+number_format(data.subtotal,2));
			//alert(data.rowid);
		}
	});
}); 

function confirmation()
{
	$.ajax({
		url : base_url+"cashier/confirmation",
		method : "POST",
		//data : {row_id : row_id},
		success :function(response)
		{
			/* var data = JSON.parse(response);
			$('#'+data.rowid).hide();
			$('.'+data.rowid).hide();*/
			$('.custom-modal-content').html(response); 
			//alert(response);
		}
	});
}

function searchFilter(page_num) {
	page_num = page_num?page_num:0;
	var keywords = $('#search_input').val();	
	console.log(keywords); 
	var sortBy = $('#sortBy').val();
	$.ajax({
		type: 'POST',
		url: base_url+'cashier/ajaxPaginationData/'+page_num,
		data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
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

</script>
