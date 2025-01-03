<?php
$data['title']="Return Penjualan";
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
        				<td>Pelanggan</td>
        				<td>:</td>
        				<td>Semua</td>
        			</tr>
        			<tr>
        				<td>Periode</td>
        				<td>:</td>
        				<td>Semua Transaksi</td>
        			</tr>
        			<tr>
        				<td>Jumlah</td>
        				<td>:</td>
        				<td><?php echo number_format($sum_price) ?></td>
        			</tr>
        			<!--<tr>-->
        			<!--	<td>Dibayar</td>-->
        			<!--	<td>:</td>-->
        			<!--	<td><?php echo number_format($sum_payment) ?></td>-->
        			<!--</tr>-->
        			<!--<tr>-->
        			<!--	<td>Selisih</td>-->
        			<!--	<td>:</td>-->
        			<!--	<td><?php echo number_format($payment_yet) ?></td>-->
        			<!--</tr>-->
        		</tbody>
        	</table>
        	<br>
			<table class="striped">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Pembeli</th>
						<th>Harga</th>
						<th>Diskon (%)</th>
						<th>Diskon (Rp)</th>
						<th>Total</th>
						<th style="text-align: center;"></th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($sale_return)): foreach($sale_return as $key=> $item): ?>
						<tr>
							<td><?php echo tanggal($item['sale_return']['created_at'])?></td>
							<td><?php echo $item['sale_return']['name']?></td>
							<td><?php echo number_format($item['sale_return']['total_price'])?></td>
							<td><?php echo number_format($item['sale_return']['discount'])?></td>
							<td><?php echo number_format($item['sale_return']['discount_nominal'])?></td>
							<td><?php echo $item['sale_return']['total']?></td>
							<td>
								<a class=" waves-effect waves-light  modal-trigger" href="#modal<?php echo $item['sale_return']['id'] ?>"><i class="small material-icons" title="Produk Detail">format_list_bulleted</i></a>
                                <!--<a href="<?php echo base_url('prints?sales_id='.$item['sale_return']['id']) ?>" class="waves-effect waves-light "><i class="small material-icons" title="Print">local_printshop</i></a>-->
                                <a  href="javascript:void(0)" id="" onclick="delete_sale_return(<?php echo $item['sale_return']['id'] ?>)" class="waves-effect waves-light "><i class="small material-icons" title="Hapus">delete</i></a>
						        <!-- Modal Structure -->
                                <div id="modal<?php echo $item['sale_return']['id'] ?>" class="modal">
                                    <div class="modal-content">
                                        <h6>Pembeli : <?php echo $item['sale_return']['name']?></h6>
                                       <table>
                                            <thead>
                                              <tr>
                                                  <th>Produk</th>
                                                  <th>Jumlah</th>
                                                  <th>Harga</th>
                                              </tr>
                                            </thead>
                                    
                                            <tbody>
                                                <?php foreach($item['detail'] as $key => $i):?>
                                                    <tr>
                                                        <td><?php  echo $i['product']?></td>
                                                        <td><?php  echo $i['quantity']?></td>
                                                        <td><?php  echo number_format($i['price'])?></td>
                                                    </tr>
                                                <?php  endforeach; ?>
                                                <tr>
                                                    <td></td>
                                                    <td><b>Total</b></td>
                                                    <td><b><?php echo number_format($item['sale_return']['total'])?></b></td>
                                                </tr>
                                            </tbody>
                                          </table>
                                    </div>
                                    <div class="modal-footer">
                                      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Tutup</a>
                                    </div>
                                </div>
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
    					<div class="input-field col s4">
    					  <!--<input placeholder="Tanggal" id="date_from" name="date_from" value="<?php echo date('Y-m-d'); ?>" type="date" class="validate">-->
    					  <input placeholder="Tanggal" id="date_from" name="date_from" value="" type="date" class="validate">
    					  <label for="first_name">Tanggal Awal</label>
    					</div>
    					<div class="input-field col s4">
    					  <!--<input placeholder="Tanggal" id="date_until" name="date_until" value="<?php echo date('Y-m-d'); ?>" type="date" class="validate">-->
    					  <input placeholder="Tanggal" id="date_until" name="date_until" value="" type="date" class="validate">
    					  <label for="first_name">Tanggal Akhir</label>
    					</div>
                        <div class="input-field col s4">
                            <select  searchable='List of options' id="member_id" name="member_id">
                                <option value="" >Pilih Pembeli</option>
                                <?php foreach($members as $item) :?>
                    			    <option value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
                    			<?php endforeach; ?>
                    			<label>Member</label>
                            </select>
                        </div>
                    </form>
		        </div>
		    </div>
		    <div class="modal-footer">
		    	<a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat" style="border:1px solid #ddd">Batal</a>
		      	<a href="javascript:void(0)" onclick="searchFilter()" class="btn-flat modal-close waves-effect waves-light green white-text">Cari</a>
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
		      <a href="#!" class="custom-nav-title">Tambah Return Penjualan</a>
		    </div>
		  </nav>
	    <div class="custom-modal-content">
	    	<form action="#" id="form" onsubmit="return false">
				<input type="hidden" value="" name="id"/> 
				<div class="row">
					<div class="input-field col s12">
                        <select searchable='List of options' id="xxx" name="sales_id" onchange="get_sale_detail_by_id(this.value)">
                            <option value="" disabled selected>Sales</option>
                            <?php foreach($sales as $item) :?>
        					    <option value="<?php echo $item['sale']['id']?>"><?php echo $item['sale']['id']." | ". tanggal($item['sale']['created_at']) ." | ". $item['sale']['name'] ?> </option>
        					<?php endforeach; ?>
                        </select>
                        <label>Sales</label>
                    </div>
                   <div id="list_product"></div>
					
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
var base_url = '<?php echo base_url();?>';

function add()
{
	save_method = 'add';
	//$('#tambah_form').show();
}

function save()
{
	var url;
    if(save_method == 'add') {
        url = base_url+"sale_return/ajax_add";
    }else {
        url = base_url+"sale_return/ajax_update";
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

function delete_sale_return(id)
{
    if(confirm('Are you sure delete this data?'))
    {  
        $.ajax({
            url : base_url+"sale_return/ajax_delete/"+id,
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

// function restore_sale(id)
// {
//     if(confirm('Are you sure restore this data?'))
//     {
//         $.ajax({
//             url : base_url+"sale_return/ajax_return/"+id,
//             type: "POST",
//             dataType: "JSON",
//             success: function(data)
//             {
// 				Materialize.toast('Data berhasil direstore', 2000);
// 				searchFilter(0);
//             },
//             error: function (jqXHR, textStatus, errorThrown)
//             {
//                 alert('Error deleting data');
//             }
//         });

//     }
// }

function get_sale_detail_by_id(id)
{
    //alert(1);
    $.ajax({
        url : base_url+"sale_return/get_sale_detail_by_id/"+id,
        type: "POST",
        //dataType: "JSON",
        beforeSend: function () {
			$('.loading').show();
		},
        success: function(html)
        {
            $('#list_product').html(html);
			$('.loading').fadeOut("slow");
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error deleting data');
        }
    });
}

function searchFilter(page_num) {
	page_num = page_num?page_num:0;
	var date_from   = $('#date_from').val();
	var date_until  = $('#date_until').val();
	var member_id = $('#member_id').val();
	var keywords = $('#keywords').val();	
	var sortBy = $('#sortBy').val();
	$.ajax({
		type: 'POST',
		url: base_url+'sale_return/ajaxPaginationData/'+page_num,
		//data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
		data:'page='+page_num+'&date_from='+date_from+'&date_until='+date_until+'&member_id='+member_id+'&sortBy='+sortBy,
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