<?php
$data['title']="Produk";
$this->load->view("admin/_partial/header.php", $data);
$this->load->view("admin/_partial/sidebar.php");
$this->load->view("admin/_partial/top-header.php");
?>
	<!-- Modal Structure -->
	<div id="edit_form" class="custom-modal responsive-container">
		<nav class="blue">
		    <div class="nav-wrapper blue">
		      <a href="<?php echo base_url('product') ?>" class="btn-back waves-effect waves-light"><i class="material-icons mr-0">arrow_back</i></a>
		      <a href="<?php echo base_url('product') ?>" class="custom-nav-title">Edit Produk</a>
		    </div>
		  </nav>
	    <div class="custom-modal-content" style="padding-left: 0px; padding-right: 0px;">
	    	<form action="#" id="form" onsubmit="return false">
			  <input type="hidden" value="<?php echo $product[0]['product']['id'] ?>" name="id"/> 
	    	  <div class="row">
				<div class="input-field col s12">
					<img id="blah" src="<?php echo $this->config->item('base_url')."assets/uploads/50".$product[0]['product']['image'] ?>" alt="Gambar" />
				</div>
	    	  	<div class="input-field col s12">
		    	  	<div class="">
				        <span id="label-photo" style="font-size: 0.8rem;color: #9e9e9e">Pilih Gambar</span><br>
				        <input name="photo" type="file" id="imgInp">
						<span class="help-block"></span>
				    </div>
				</div>
		        <div class="input-field col s12">
		          <select searchable='List of options' name="category_id">
				      <option value="" disabled selected>Pilih</option>
					  <?php foreach($category as $item) :?>
					  <option <?php echo ($item['id'] == $product[0]['product']['category_id'])? "selected" : "" ; ?>  value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
					  <?php endforeach; ?>
				    </select>
				    <label>Kategori Produk</label>
		        </div>
		        <div class="input-field col s12">
		          <input placeholder="Nama Produk" value="<?php echo $product[0]['product']['name'] ?>" id="first_name" type="text" name="name" class="validate">
		          <label for="">Nama Produk</label>
		        </div>
		        <div class="input-field col s4">
		          <input placeholder="0" value="<?php echo $product[0]['product']['hpp'] ?>" id="" type="number" name="hpp" class="validate">
		          <label for="">Harga Beli</label>
		        </div>
		        <div class="input-field col s4">
		          <input placeholder="0" value="<?php echo $product[0]['product']['sale_price'] ?>" id="" type="number" name="sale_price" class="validate">
		          <label for="">Harga Jual</label>
		        </div>
		        <div class="input-field col s4">
		          <input placeholder="0" value="<?php echo ($product[0]['stock'])? $product[0]['stock'] : 0 ?>" id="" type="number" name="stock" class="validate" disabled>
		          <label for="">Stok</label>
		        </div>
		        <div class="input-field col s4">
		          <input placeholder="0" value="<?php echo $product[0]['product']['weight'] ?>" id="" type="number" name="weight" class="validate">
		          <label for="">Berat</label>
		        </div>
		        <div class="input-field col s4">
		          <select searchable='List of options' name="product_unit_id">
				      <option value="" disabled selected>Pilih</option>
					  <?php foreach($product_unit as $item) :?>
					  <option <?php echo ($item['id'] == $product[0]['product']['product_unit_id'])? "selected" : "" ; ?>  value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
					  <?php endforeach; ?>
				    </select>
				    <label>Satuan</label>
		        </div>
		        <div class="input-field col s12">
		          <textarea id="textarea1" class="materialize-textarea" name="note" placeholder="Catatan"><?php echo $product[0]['product']['note'] ?></textarea>
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

<script>
    $(document).keypress(function(e) {
    	if(e.which == 13) {
    		$('#form').submit();
    	}
    });

    function save()
    {
    	var formData = new FormData($('#form')[0]);
        $.ajax({
            url : base_url+"product/ajax_update",
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
                        location = base_url+"product";
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
