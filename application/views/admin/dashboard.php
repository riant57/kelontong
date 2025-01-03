<?php
$data['title']= "Dashboard";
$this->load->view("admin/_partial/header.php", $data);
$this->load->view("admin/_partial/sidebar.php");
$this->load->view("admin/_partial/top-header.php");
?>

	<div class="row custom-container">
	    <div class="row">
	        <div class="input-field col s3">
			  <input placeholder="Tanggal" id="date_from" name="date_from" value="" type="date" class="validate">
			  <label for="first_name">Tanggal Awal</label>
			</div>
			<div class="input-field col s3">
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
			<div class="input-field col s2">
			    <a href="javascript:void(0)" id="btnSave" onclick="searchFilter()" class="btn-flat modal-close waves-effect waves-light green white-text">Cari</a>
			</div>
	    </div>
	    <div id="postList">
    		<div class="col s12 m3">
    		    <div class="card horizontal z-depth-1 green" >
    		      <div class="card-stacked">
    		        <div class="card-content">
    		        	<div class="sub-content">
    		        		<p class="custom-card-title">Penjualan</p>
    			        	<p class="custom-card-content"><?php echo number_format($sum_sales)?></p>
    			        	<i class="material-icons white-text">money</i>
    		        	</div>
    		        	<a href="<?php echo base_url('sale') ?>" class="btn-flat waves-effect waves-light">Selengkapnya -></a>
    		        </div>
    		      </div>
    		    </div>
    		</div>
    		<div class="col s12 m3">
    		    <div class="card horizontal z-depth-1 red" >
    		      <div class="card-stacked">
    		        <div class="card-content">
    		        	<div class="sub-content">
    		        		<p class="custom-card-title">Pembelian</p>
    			        	<p class="custom-card-content"><?php echo number_format($sum_purchase - $sum_purchase_return)?></p>
    			        	<i class="material-icons white-text">shopping_cart</i>
    		        	</div>
    		        	<a href="<?php echo base_url('purchase') ?>" class="btn-flat waves-effect waves-light">Selengkapnya -></a>
    		        </div>
    		      </div>
    		    </div>
    		</div>
    		<div class="col s12 m3">
    		    <div class="card horizontal z-depth-1 orange" >
    		      <div class="card-stacked">
    		        <div class="card-content">
    		        	<div class="sub-content">
    		        		<p class="custom-card-title">Jumlah Nota</p>
    			        	<p class="custom-card-content"><?php echo number_format($count_sales->count_sales)?></p>
    			        	<i class="material-icons white-text">assignment</i>
    		        	</div>
    		        	<a href="<?php echo base_url('sale') ?>" class="btn-flat waves-effect waves-light">Selengkapnya -></a>
    		        </div>
    		      </div>
    		    </div>
    		</div>
    		<div class="col s12 m3">
    		    <div class="card horizontal z-depth-1 teal" >
    		      <div class="card-stacked">
    		        <div class="card-content">
    		        	<div class="sub-content">
    		        		<p class="custom-card-title">Tagihan</p>
    			        	<p class="custom-card-content"><?php echo number_format($count_bill->count_bill)?></p>
    			        	<i class="material-icons white-text">assignment_late</i>
    		        	</div>
    		        	<a href="<?php echo base_url('bill') ?>" class="btn-flat waves-effect waves-light">Selengkapnya -></a>
    		        </div>
    		      </div>
    		    </div>
    		</div>
    	</div>
 
		<div class="col s12 hide-on-med-and-down" style="padding-top: 15px;padding-bottom: 15px">
			<div class="row">
				<div class="col m12 s12">
					<div class="card p-10">
						<h6 class="p-10">Penjualan Satu Minggu Terakhir</h6>
						<div id="line_chart" class="ct-chart ct-golden-section"></div>
					</div>
					
				</div>
				<div class="col m5 s12" style="margin-left: ">
					<div class="card p-10">
						<h6 class="p-10">Pembelian Satu Minggu Terakhir</h6>
						<div id="bar_chart" class="ct-chart ct-golden-section"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="col s12">
			<h5>Stok Minim</h5>
			<table class="striped">
				<tr>
					<th>No</th>
					<th>Nama Produk</th>
					<th>Stok</th>
				</tr>
				<?php if(!empty($minim_stock)): foreach($minim_stock as $key => $item): ?>
    				<tr>
    					<td><?php echo $key + 1?></td>
    					<td><?php echo $item['name'] ?></td>
    					<td><?php echo $item['stock'] ?></td>
    				</tr>
    			<?php  endforeach; else: ?>
					<tr><td colspan="3">Product(s) not available.</td></tr>
				<?php endif; ?>
				
			</table>
		</div>
		
		<div class="col s12">
			<h5>Stok Mendekati Expired</h5>
			<table class="striped">
				<tr>
					<th>No</th>
					<th>Nama Produk</th>
					<th>Stok</th>
					<th>Expired</th>
				</tr>
				<?php if(!empty($almost_expired)): foreach($almost_expired as $key => $item): ?>
    				<tr>
    					<td><?php echo $key + 1?></td>
    					<td><?php echo $item['name'] ?></td>
    					<td><?php echo $item['stock'] ?></td>
    					<td><?php echo tanggal($item['expired']) ?></td>
    				</tr>
			    <?php  endforeach; else: ?>
					<tr><td colspan="3">Product(s) not available.</td></tr>
				<?php endif; ?>
			</table>
		</div>
	</div>

<?php
$this->load->view("admin/_partial/footer.php");
?>

<script src="<?php echo $this->config->item('base_url') ?>assets/plugin/chart-ist/chartist.min.js"></script>
<script type="text/javascript">
var base_url = '<?php echo base_url();?>';
		new Chartist.Line('#line_chart', {
		  labels: <?php echo json_encode($sales_date_chart) ?>,
		  series: [
		            <?php echo json_encode($sales_chart) ?>
		            //[1000, 2000, 1500, 4000, 3200],
		          //[3000, 2300, 1340, 3300, 4400, 1200, 3600]
		  ]
		}, {
		  low: 0,
		  showArea: true
		});

		//bar chart
		new Chartist.Bar('#bar_chart', {
		  labels: <?php echo json_encode($purchase_date_chart) ?>,
		  series: [
		    <?php echo json_encode($purchase_chart) ?>,
		    //[3, 2, 9, 5, 4, 6, 4]
		  ]
		}, {
		  seriesBarDistance: 10,
		  reverseData: true,
		  horizontalBars: true,

		  axisY: {
		    offset: 70,
		    scaleMinSpace: 20,
		  }
		});


function searchFilter(page_num) {
    //alert(1);
	page_num = page_num?page_num:0;
	var date_from   = $('#date_from').val();
	var date_until  = $('#date_until').val();
	var member_id = $('#member_id').val();
	var keywords = $('#keywords').val();	
	var sortBy = $('#sortBy').val();
	$.ajax({
		type: 'POST',
		url: base_url+'dashboard/ajaxPaginationData/'+page_num,
		//url: base_url+'dasboard',
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

</script>