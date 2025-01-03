<?php
//$data['title']= "Meja ".$desk_no;
$data['title']= "Kasir";
$this->load->view("admin/_partial/header.php", $data);
$this->load->view("admin/_partial/sidebar.php");
$this->load->view("admin/_partial/top-header.php");
?>
<div class="custom-modal-content">
	<form method="POST" action="">
		<div class="row">
			<div class="col s12">
				<table class="striped">
					<tr>
						<th>Nama</th>
						<th>Jumlah</th>
						<th class="right-text">Harga</th>
						<th class="right-text">Sub Total</th>
						<th></th>
					</tr>
					<?php foreach($cart as $key => $item) : ?>
						<tr class="<?php echo $item['rowid'] ?>">
							<td><?php  echo $item['name']?></td>
							<td style="width:10%"><input id="quantity" data-id="<?php echo $item['rowid']?>" placeholder="Quantity" value="<?php  echo $item['qty']?>" min="0" max="<?php  echo $item['stock']?>" type="number" class="validate"></td>
							<input type="hidden" id="price<?php echo $item['rowid']?>" value="<?php echo $item['price']?>" name="">
							<input type="hidden" id="stock<?php echo $item['rowid']?>" value="<?php echo $item['stock']?>" name="">
							<td class="right-text"><?php  echo number_format($item['price'],2)?></td>
							<td class="sub<?php echo $item['rowid']?> right-text"><?php  echo number_format($item['subtotal'],2)?></td>
							<td class="center-text"><a href="#!" id="<?php echo $item['rowid'] ?>" class="romove_cart waves-effect waves-blue red-text"><i class="material-icons" style="">close</i></a></td>
						</tr>
					<?php endforeach; ?>
					<!-- tr>
						<td colspan="3"><b>Sub Total</b></td>
						<td colspan="2" class="right-text"><b>145.000</b></td>
					</tr -->
					<!--tr>
						<td colspan="3"><b>Diskon</b></td>
						<td colspan="2" class="right-text"><b>10.000</b></td>
					</tr -->
					<tr>
						<td colspan="3" style="font-size: 20px;"><b>Total</b></td>
						<td colspan="2" class="subtotal right-text" style="font-size: 20px;"><b><?php echo number_format($this->cart->total(),2) ?></b></td>
					</tr>
				</table>
			</div>
			<div class="loading" style="display: none;">
			<div class="content"><img style="width:20%" src="<?php echo base_url().'assets/images/loading.gif'; ?>"/></div>
		</div>
		</div>
	</form>
	<div class="bottom-navigation responsive-container" style="position: absolute;">
	    <a href="<?php echo base_url('cashier/add_order/0') ?>" class="btn-flat green white-text waves-effect waves-light" style="border-radius: 0px;width: 50%; text-align: center;">KEMBALI</a>
	    <!--<a href="<?php echo base_url('bill/save/'.$this->uri->segment(3).'?bill_id='.$this->input->get('bill_id', TRUE)) ?>" class="btn-flat red white-text waves-effect waves-light" style="border-radius: 0px;width: 40%; text-align: center;">SIMPAN</a>-->
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
			$('.sub').html('Rp. '+number_format(data.sub,2));
			$('.subtotal').html('Rp. '+number_format(data.subtotal,2));
			location.reload();
			//alert(data.rowid);
		}
	});
});

$(":input").on("keyup change", function(e) {
    // do stuff!
    var rowid   = $(this).data("id") ;
 	var qty     = parseInt($(this).val());
 	var price   = $('#price'+rowid).val();
 	var stock   = parseInt($('#stock'+rowid).val());
 	var sub     = qty * price;
 	
 	if(qty >= stock){
 	    console.log('Qty' + qty);
 	    console.log('stok' + stock);
 	    $("#quantity").val(stock);
 	    alert("Maaf, Stok tinggal " +stock );
 	}else if(qty == null || qty == 0){
 	    //alert(1);
 	    $("#quantity").val(1);
 	    location.reload();
 	}else{
 	    console.log(price);
     	$.ajax({
    		type: 'POST',
    		url: base_url+'cashier/updateCartItem',
    		data:'rowid='+rowid+'&qty='+qty,
     		beforeSend: function () {
     			$('.loading').show();
     		},
     		success: function (response) {
     		    var data = JSON.parse(response);
                $('.subtotal').html('Rp. '+number_format(data.subtotal,2));
                $('.sub'+rowid).html('Rp. '+number_format(sub,2));
     			//$('#postList').html(html);
     			$('.loading').fadeOut("slow");
     		}
    	});
 	}
})
</script>