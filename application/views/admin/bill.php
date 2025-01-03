<?php
$data['title']= "Tagihan";
$this->load->view("admin/_partial/header.php", $data);
$this->load->view("admin/_partial/sidebar.php");
$this->load->view("admin/_partial/top-header.php");
?>

	<div class="row">
		<!--<div class="col s12">-->
		<!--	<ul class="collection">-->
		<!--		<?php foreach($bill as $item) : ?>-->
		<!--			<li class="collection-item avatar">-->
		<!--				<h4 class="circle green white-text" style="text-align: center;line-height: 42px; margin: 0px"><?php echo $item['desk'] ?></h4>-->
		<!--				<a href="<?php echo base_url('cashier/add_order/'.$item['desk']).'?bill_id='.$item['id'] ?>" class="waves-effect black-text" style="width: 100%">-->
		<!--					<span class="title">#<?php echo $item['id'] ?></span>-->
		<!--					<p><b class="red-text" style="font-size: 20px">Rp. <?php echo number_format($item['total_price']) ?> </b><br>-->
		<!--						<?php echo date('d - m - Y', strtotime($item['created_at']));?>-->
		<!--					</p>-->
		<!--				</a>-->
		<!--			</li>-->
		<!--	    <?php endforeach; ?>-->
		<!--	  </ul>-->
		<!--</div>-->
		
		<div class=" row col s12" id="postList">
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
        			<!--<tr>-->
        			<!--	<td>Jumlah</td>-->
        			<!--	<td>:</td>-->
        			<!--	<td><?php echo number_format($sum_price) ?></td>-->
        			<!--</tr>-->
        			<!--<tr>-->
        			<!--	<td>Dibayar</td>-->
        			<!--	<td>:</td>-->
        			<!--	<td><?php echo number_format($sum_payment) ?></td>-->
        			<!--</tr>-->
        			<tr>
        				<td>Total Tagihan</td>
        				<td>:</td>
        				<td><?php echo number_format($payment_yet) ?></td>
        			</tr>
        		</tbody>
        	</table>
        	<br>
  <!--      </div>-->
		<!--<div class="col s12" id="">-->
			<table class="striped">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Pembeli</th>
						<th>Tagihan</th>
						<th>Dibayar</th>
						<th>Selisih</th>
						<th style="text-align: center;"></th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($sale)): foreach($sale as $key=> $item): ?>
					    <?php //if($item['sale']['total'] > $item['payment'] ): ?>
    						<tr>
    							<td><?php echo tanggal($item['sale']['created_at'])?></td>
    							<td><?php echo $item['sale']['name']?></td>
    							<td><?php echo number_format($item['sale']['total'])?></td>
    							<td <?php echo ($item['sale']['total'] > $item['payment'] )?  "style='color:red'": "style='color:green'" ?>> <?php echo number_format($item['payment']) ?></td>
    							<td><?php echo number_format($item['sale']['total'] - $item['payment'])?></td>
    							<td>
    								<!--<li><a href="<?php echo base_url('sale_detail/detail/'.$item['sale']['id']) ?>" class="blue-text" >Detail</a></li>-->
    								<!--<li><a href="#!" onclick="delete_sale(<?php echo $item['sale']['id']; ?>)" class="red-text">Hapus???</a></li>-->
    								<!--<li><a href="#!" onclick="return_sale(<?php echo $item['sale']['id']; ?>)" class="blue-text" >Return??</a></li>-->
    								
    								<!--<a href="<?php echo base_url('sale_detail/detail/'.$item['sale']['id']) ?>" class="waves-effect waves-light blue btn-menu" title="Detail"><i class="glyphicon glyphicon-pencil"></i>Detail</a>-->
    								<!--<a href="#!" onclick="delete_sale(<?php echo $item['sale']['id']; ?>)" class="waves-effect waves-light red btn-menu" title="Hapus" ><i class="glyphicon glyphicon-pencil"></i>Hapus</a>-->
    							    <!-- Modal Trigger -->
							        <a class=" waves-light btn red lighten-2 modal-trigger" onclick="payment_list(<?php echo $item['sale']['member_id'] ?>, <?php echo $item['sale']['id'] ?>)" href="#modal-payment<?php echo $item['sale']['id'] ?>">Bayar</a>
                                    <a class=" waves-light btn modal-trigger" href="#modal-product<?php echo $item['sale']['id'] ?>">Lihat Produk</a>
                                
                                    <!-- Modal Structure -->
                                    <div id="modal-product<?php echo $item['sale']['id'] ?>" class="modal">
                                        <div class="modal-content">
                                            <h6><?php echo $item['sale']['name']?></h6>
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
                                                        <td><b><?php echo number_format($item['sale']['total'])?></b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Tutup</a>
                                        </div>
                                    </div>
                                    
                                    <!-- Modal Payments -->
                                    <div id="modal-payment<?php echo $item['sale']['id'] ?>" class="modal">
                                        <div id="payments_list<?php echo $item['sale']['id'] ?>"></div>
                                        <div class="modal-footer">
                                          <a href="javascript:void(0)" onclick="location.reload()" class="modal-close waves-effect waves-green btn-flat">Tutup</a>
                                        </div>
                                    </div>
    							
    							</td>
    						</tr>
    					<?php // endif; ?>
					<?php  endforeach; else: ?>
						<tr><td colspan="4">Sale(s) not available.</td></tr>
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
    					  <input placeholder="Tanggal" id="date_from" name="date_from" value="<?php echo date('Y-m-d'); ?>" type="date" class="validate">
    					  <label for="first_name">Tanggal Awal</label>
    					</div>
    					<div class="input-field col s4">
    					  <input placeholder="Tanggal" id="date_until" name="date_until" value="<?php echo date('Y-m-d'); ?>" type="date" class="validate">
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

	<!--<div class="bottom-navigation">-->
	<!--	<a class="bottom-navigation-content">100/300</a>-->
		
	<!--	<a href="#!" class="btn-flat blue white-text right waves-effect waves-light" style="border-radius: 0px;"><i class="material-icons">arrow_forward</i></a>-->
	<!--	<a href="#!" class="btn-flat blue white-text right waves-effect waves-light" style="border-radius: 0px;"><i class="material-icons">arrow_back</i></a>-->
	<!--</div>-->
	
	<div class="floating-button-wrapper">
		<a href="javascript:void(0)" data-target="search_modal" class="btn-floating btn waves-effect waves-light green modal-trigger"><i class="material-icons">search</i></a>
	</div>

<?php
$this->load->view("admin/_partial/footer.php");
?>

<script>
var base_url = '<?php echo base_url();?>';
    function payment_list(member_id, sale_id)
    {
        var member_id = member_id;
        var sale_id = sale_id;
        //alert(sale_id);
        $.ajax({
    		type: 'POST',
    		url: base_url+'payment/edit_payment',
    		data:'member_id='+member_id+'&sale_id='+sale_id,
    		beforeSend: function () {
    			$('.loading').show();
    		},
    		success: function (html) {	
    			//$('#postList').html(html);
    			$('#payments_list'+sale_id).html(html);
    			$('.loading').fadeOut("slow");
    		}
    	});
    }
    
    function save()
    {
        var max_payment   = $("#max_payment").val();
        var member_id     = $("#member_id").val();
        var sales_id      = $("#sales_id").val();
        var nominal       = $("#nominal").val();
        var created_at    = $("#created_at").val();
        //alert(member_id);
        //alert(nominal);
    	//var url;
        //if(save_method == 'add') {
            url = base_url+"payment/ajax_add";
        // }else {
        //     url = base_url+"payment/ajax_update";
        // }
    	//var formData = new FormData($('#form')[0]);
    	if(!$.trim(nominal)){
            alert('Nominal harus diisi');;
        }else{
            if(nominal > max_payment){
                 alert('Maaf, nominal melebihi jumlah tagihan')
            }else{
                $.ajax({
                    url : url,
                    type: "POST",
            		data:'member_id='+member_id+'&nominal='+nominal+'&created_at='+created_at+'&sales_id='+sales_id,
                    //contentType: false,
                    //processData: false,
                    dataType: "JSON",
                    success: function(data)
                    {
                        //alert(data);
            			if(data.status) 
                        {
                            //alert(data.status)
            				// $('#form')[0].reset();
            				Materialize.toast('Data berhasil disimpan', 2000);
            				setTimeout(function(){location.reload();},3000);
            				// searchFilter(0);
            				// $('#tambah_form').hide();
            			}else{
            				// for (var i = 0; i < data.inputerror.length; i++) 
                //             {
            				// 	$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
            				// 	if(data.error_string[i] !== ""){
            				// 		$('input[name='+data.inputerror[i]+']').addClass('invalid');
            				// 	}
                //             }
            			}
            			
            		}
            	});
            }
                
        }
            
        //}
        
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
    		url: base_url+'bill/ajaxPaginationData/'+page_num,
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
    
    function table_add_payment()
    {
        //alert(1);
        $("#table_add_payment").show();
        $("#table_edit_payment").hide();
    }
    function table_edit_payment(id)
    {
        //alert(id);
        $("#table_add_payment").hide();
        $("#table_edit_payment").show();
        $("#payment_id").val(id);
        $.ajax({
            url :  base_url+"payment/ajax_edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                //alert(data);
                $('#nominal_edit').val(data.total);
                $('#created_at_edit').val(data.created_at);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
        
    }
    
    function update_payment() {
        var payment_id   = $('#payment_id').val();
    	var total        = $('#nominal_edit').val();
    	$.ajax({
            url : base_url+"payment/ajax_update/",
            type: "POST",
    		data:'payment_id='+payment_id+'&total='+total,
            dataType: "JSON",
            success: function(data)
            {
                //alert(data);
    			if(data.status) 
                {
    				Materialize.toast('Data berhasil disimpan', 2000);
    				setTimeout(function(){location.reload();},3000);
    			}else{
    				
    			}
    			
    		}
    	});
    }
    
    function delete_payment(id)
    {
        if(confirm('Are you sure delete this data?'))
        {
            // ajax delete data to database
            $.ajax({
                url : base_url+"payment/ajax_delete/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
    				Materialize.toast('Data berhasil dihapus', 2000);
    				setTimeout(function(){location.reload();},3000);
    				//searchFilter(0);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
    
        }
    }

</script>