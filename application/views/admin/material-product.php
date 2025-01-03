<?php
$data['title']="Bahan Baku";
$this->load->view("admin/_partial/header.php", $data);
$this->load->view("admin/_partial/sidebar.php");
$this->load->view("admin/_partial/top-header.php");
?>

	<div class="row">
		<div class="col s12" id="postList">
			<table class="striped">
				<thead>
					<tr>
						<th>Nama</th>
						<th>Jml</th>
						<th style="text-align: center;"></th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($material_product)): foreach($material_product as $key=> $item): ?>
						<tr>
							<td><?php echo $item['name']?></td>
							<td><?php echo $item['quantity']?></td>
							<td>
								<li><a href="#tambah_form" onclick="edit_material_product(<?php echo $item['id']; ?>)" class="blue-text" >Perbarui</a></li>
								<li><a href="#!" onclick="delete_material_product(<?php echo $item['id']; ?>)" class="red-text">Hapus???</a></li>
							</td>
						</tr>
					<?php  endforeach; else: ?>
						<tr><td colspan="4">Material Product(s) not available.</td></tr>
					<?php endif; ?>	
				</tbody>
				<?php echo $this->ajax_pagination->create_links();?>
			</table>
				<div class="loading" style="display: none;">
				<div class="content"><img style="width:20%" src="<?php echo base_url().'assets/images/loading.gif'; ?>"/></div>
			</div>

			
		</div>
		
		<!-- Modal Structure -->
		  <div id="search_modal" class="modal bottom-sheet">
		    <div class="modal-content">
		      <h5>Masukan Kata Kunci</h5>
		      <input placeholder="Pencarian" id="keywords" onkeyup="searchFilter()" name="txtSearch" type="text" class="validate" value="">
		    </div>
		    <div class="modal-footer">
		    	<a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat" style="border:1px solid #ddd">Batal</a>
		      	<a href="javascript:void(0)" class="btn-flat modal-close waves-effect waves-light green white-text">Cari</a>
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
					  <select id="material" name="material_id">
						  <option value="" disabled selected>Pilih</option>
						  <?php foreach($material as $item) :?>
						  <option value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
						  <?php endforeach; ?>
						</select>
						<label>Material</label>
					</div>
					<div class="input-field col s12">
					  <input id="quantity" name="quantity" type="number" value="1" placeholder="0" class="validate" autocomplete="off">
					  <label for="quantity">Jumlah</label>
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

function add()
{
	save_method = 'add';
	//alert(save_method);
	$('#tambah_form').show();
}
function edit_material_product(id)
{
    save_method = 'update';
	$('#tambah_form').show();
	//alert(1);
    //Ajax Load data from ajax
    $.ajax({
        url :  base_url+"material_product/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id"]').val(data.id);
            $('[name="detail"]').val(data.detail);
			$('[name="quantity"]').val(data.quantity);
			//$("#material").select2().select2('val','1');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    }); 
}

function save()
{
	var url;
    if(save_method == 'add') {
        url = base_url+"material_product/ajax_add";
    }else {
        url = base_url+"material_product/ajax_update";
    }
	var formData = new FormData($('#form')[0]);
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
						$('input[name='+data.inputerror[i]+']').addClass('invalid');
					}
                }
			}
			
		}
	});
}

function delete_material_product(id)
{
    if(confirm('Are you sure delete this data?'))
    {  
        $.ajax({
            url : base_url+"material_product/ajax_delete/"+id,
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

function searchFilter(page_num) {
	page_num = page_num?page_num:0;
	var keywords = $('#keywords').val();	
	var sortBy = $('#sortBy').val();
	$.ajax({
		type: 'POST',
		url: base_url+'material_product/ajaxPaginationData/'+page_num,
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
</script>