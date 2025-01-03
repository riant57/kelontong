<?php
$data['title']= "Pembayaran";
$this->load->view("admin/_partial/header.php",$data);
$this->load->view("admin/_partial/sidebar.php");
//$this->load->view("admin/_partial/top-header.php");
?>

	<div class="row">
		<div class="col s12">
			<!--<h5 align="center" style="margin-bottom: 30px; margin-top: 30px; color: #777">Total Tagihan</h5>-->
			<h3 align="center" class="card blue white-text" style="padding:10px; margin:0px">Tagihan Rp. <?php echo number_format($this->cart->total(),2) ?></h3>
			<input type="hidden" id="bill" name="bill" value="<?php echo $this->cart->total() ?>">
			<input type="hidden" id="total" name="total" value="">
			<input type="hidden" id="refund" name="refund" value="">
			<input type="hidden" id="desk_no" name="desk_no" value="<?php echo $this->input->get('desk_no', TRUE) ?>">
			<input type="hidden" id="bill_id" name="bill_id" value="<?php echo $this->input->get('bill_id', TRUE) ?>">
			<p align="center" style="color: #aaa; margin-top: 30px"><b>Nama Pembeli</b></p>
			
			<style>
			    .select-wrapper input.select-dropdown
                {
                  text-align: center;
                  color: #aaa;
                }
			    .dropdown-content li > span
                {
                  text-align: center;
                }
			</style>
            <select  searchable='List of options' id="member_id" name="member_id">
                <?php foreach($members as $item) :?>
    			    <option value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
    			<?php endforeach; ?>
            </select>
            <label>Nama Pembeli</label>
            <p align="center" style="color: #aaa; margin-top: 30px"><b>Nominal</b></p>
			<input placeholder="" id="nominal" onkeyup="nominal(this.value)" name="txtNominal" type="number" class="nominal-input" value="" required>

			<div style="text-align: center; margin-top: 50px">
				<a href="#!" onclick="nominal(<?php echo $this->cart->total() ?>)" class="btn-flat red white-text waves-effect waves-light btn-nominal" style="border-radius: 0px;">Uang Pass</a>
				<a href="#!" onclick="nominal(20000)" class="btn-flat red white-text waves-effect waves-light btn-nominal" style="border-radius: 0px;">Rp. 20.000</a>
				<a href="#!" onclick="nominal(50000)" class="btn-flat red white-text waves-effect waves-light btn-nominal" style="border-radius: 0px;">Rp. 50.000</a>
				<a href="#!" onclick="nominal(100000)" class="btn-flat red white-text waves-effect waves-light btn-nominal" style="border-radius: 0px;">Rp. 100.000</a>
				<a href="#!" onclick="nominal(150000)" class="btn-flat red white-text waves-effect waves-light btn-nominal" style="border-radius: 0px;">Rp. 150.000</a>
				<a href="#!" onclick="nominal(200000)" class="btn-flat red white-text waves-effect waves-light btn-nominal" style="border-radius: 0px;">Rp. 200.000</a>
			</div>
        </div>
        <div class="col s6">
			<p align="center" style="color: #aaa; margin-top: 30px"><b>Diskon (%)</b></p>
			<input style="font-size:2em !important" placeholder="0" id="discount" onkeyup="discount()" name="discount" type="number" class="nominal-input" value="0">
		</div>
		<div class="col s6">
			<p align="center" style="color: #aaa; margin-top: 30px"><b>Diskon (Rp)</b></p>
			<input style="font-size:2em !important" placeholder="0" id="discount_rp_text"  name="discount_rp_text" type="text" class="nominal-input" value="0" readonly>
			<input placeholder="0" id="discount_rp"  name="discount_rp" type="hidden" class="nominal-input" value="0" readonly>
		</div>
        <div class="col s6">
			<p align="center" style="color: #333">Total Tagihan</p>
			<h5 align="center" class="green-text total"><b>Rp. 0</b></h5>
		</div>
		<div class="col s6">
			<p align="center" style="color: #333">Uang Kembali</p>
			<h5 align="center" class="green-text refund"><b>Rp. 0</b></h5>
		</div>

		<div class="bottom-navigation responsive-container">
			<a href="#modal1" onclick="payment()" class="btn-flat green white-text waves-effect waves-light modal-trigger" style="border-radius: 0px; width: 100%; text-align: center;">Proses Pembayaran</a>
		</div>

	</div>
	
	<!-- Modal Structure -->
  <div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
      <h4 class="green-text pc-center">Sukses!</h4>
      <p class="pc-center">Transaksi telah berhasil dengan <b>KEMBALIAN</b> sbb:<br>
      	<span style="font-size: 2em;" id="return" class="green-text">Rp. 200.000,00</span>
  	  </p>

    </div>
    <div class="modal-footer">
    	<a href="<?php echo base_url('cashier') ?>/add_order/0" class="modal-close waves-effect waves-green btn-flat" style="border: 1px solid #ddd">Selesai</a>
      <a href="#" id="print" class="modal-close waves-effect waves-light btn-flat green white-text">Cetak Nota</a>
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

	function nominal(obj)
	{
		$('#nominal').val(obj);
		var bill 	= $("#bill").val(); 
		var discount_rp 	= $("#discount_rp").val(); 
		if(discount_rp > 0){
		    //alert(1);
		    // var total   = obj - (bill - discount_rp);
		    var total   = bill - discount_rp;
		    var refund = obj - total;
		}else{
		    
		    var total   = bill;
		    var refund = obj - bill;
		}
		
		$('#total').val(total);
		
		$('.total').html("Rp. "+number_format(total,2));
		$('.refund').html("Rp. "+number_format(refund,2));
		$('#refund').val(refund);
		$('#total').val(total);
		//console.log(a);
	}
	function discount() 
	{
	  var discount = $('#discount').val() /100;
	  var nominal     = $('#nominal').val();
	  //var discount_rp = $("#discount_rp").val(); 
	  var bill     = $('#bill').val();
	  var discount_rp    = bill * discount;
	  var total = bill - discount_rp;
	  var refund = nominal - total;
	  

	  $('.total').html("Rp. "+number_format(total,2));
	  $('.refund').html("Rp. "+number_format(refund,2));
	  $('#total').val(total);
	  $('#refund').val(refund);
	  $('#discount_rp_text').val("Rp. "+number_format(discount_rp,2));
	  $('#discount_rp').val(discount_rp);
	  //console.log(discount);
	}
	
	function payment()
	{
		var nominal  = $('#nominal').val();
		var refund 	 = $("#refund").val(); 
		var total 	 = $("#total").val(); 
		var bill 	 = $("#bill").val();
		//var return_money = nominal - total;
		//var return_money = nominal - bill;
		var return_money = refund;
		var discount = $('#discount').val();
		var discount_rp = $('#discount_rp').val();
		
		var bill_id  = $('#bill_id').val();
		var desk_no  = $('#desk_no').val();
		var member_id  = $('#member_id').val();
		//console.log(nominal);
		//console.log(total);
		$('#return').html("Rp. "+number_format(return_money,2));
		$.ajax({
    		url : base_url+"payment/save",
    		method : "POST",
    		data : {discount : discount, bill_id : bill_id, desk_no : desk_no, member_id : member_id, nominal:nominal, refund:refund, total:total, discount_rp:discount_rp},
    		success :function(response)
    		{
    			
    			var data = JSON.parse(response);
    			console.log(data.sales_id);
    			$("#print").attr("href", base_url+"prints?sales_id="+data.sales_id);
    			/* var data = JSON.parse(response);
    			$('#'+data.rowid).hide();
    			$('.'+data.rowid).hide();
    			$('.subtotal').html('Rp. '+number_format(data.subtotal,2)); */
    			//alert(data.rowid);
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