<?php
$data['title']="Pembelian";
$this->load->view("admin/_partial/header.php", $data);
$this->load->view("admin/_partial/sidebar.php");
$this->load->view("admin/_partial/top-header.php");
?>
	<div class="floating-button-wrapper">
		<a href="javascript:void(0)" data-target="search_modal" class="btn-floating btn waves-effect waves-light green modal-trigger"><i class="material-icons">search</i></a>
	</div>

	<!-- Modal Structure -->
	<div id="edit_form" class="custom-modal responsive-container">
		<nav>
		    <div class="nav-wrapper blue">
		      <a href="<?php echo base_url('purchase') ?>" class="btn-back waves-effect waves-light"><i class="material-icons mr-0">arrow_back</i></a>
		      <a href="#!" class="custom-nav-title">Edit Return Pembelian</a>
		    </div>
		  </nav>
	    <div class="custom-modal-content">
	    	<form action="#" id="form" onsubmit="return false">
				<input type="hidden" value="<?php echo $purchase_return->id; ?>" name="id"/> 
				<input type="hidden" value="<?php echo $purchase_return->product_id; ?>" name="product_id"/> 
				<div class="row">
				    
				    <div class="input-field col s12">
                        <select searchable='List of options' id="xxx" name="purchase_id" onchange="get_purchase(this.value)">
                            <option value="" disabled selected>Purchase</option>
                            <?php foreach($purchases as $item) :?>
        					    <option <?php echo ($item['id'] == $purchase_return->purchase_id)? "selected" : "" ; ?>  value="<?php echo $item['id']?>"><?php echo $item['id'] .  " | ". $item['product_name'] .  " | ". $item['supplier_name']. " | ". tanggal($item['date']) . " | ". $item['quantity'] . " | ". number_format($item['price']) ?> </option>
        					<?php endforeach; ?>
                        </select>
                        <label>Purchase</label>
                    </div>
				    
					<div class="input-field col s12">
					  <input id="price" name="price" type="text" value="<?php echo $purchase_return->price ?>" placeholder="0" class="validate" autocomplete="off" readonly>
					  <label for="price">Harga Satuan</label>
					</div>

					<div class="input-field col s12">
					  <input id="quantity" name="quantity" type="text" value="<?php echo $purchase_return->quantity ?>" placeholder="0" class="validate" autocomplete="off">
					  <label for="quantity">Jumlah</label>
					</div>

					<div class="input-field col s12">
					  <input id="inTotal" name="total" readonly type="text" value="<?php echo $purchase_return->total ?>" placeholder="0" class="validate" autocomplete="off" readonly>
					  <label for="inTotal">Total</label>
					</div>

					<div class="input-field col s12">
					  <textarea id="inCatatan" name="note" placeholder="Catatan tambahan" class="materialize-textarea"><?php echo $purchase_return->note ?></textarea>
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
	var save_method; //for save method string
$(document).ready(function() {
  
	
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
		$('input').removeClass('is-invalid');
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
	
	$("#price, #quantity").keyup(function(){
		var price = $('#price').val();
		var qty   = $('#quantity').val();
		$('#inTotal').val(price * qty );
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
            alert('Error get data');
        }
    });
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
	//alert(formData);
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
				setTimeout(function () {
                    location = base_url+"purchase_return";
                }, 500);

				
			}else{
				for (var i = 0; i < data.inputerror.length; i++) 
                {
					$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
					if(data.error_string[i] !== ""){
						$('input[name='+data.inputerror[i]+']').addClass('invalid');
					}
                }
			}
			
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