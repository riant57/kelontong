
		<div>
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
 
	