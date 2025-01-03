
	<ul class="row display-flex">
		<!--<div class="col s12">-->
  <!--        <input placeholder="Cari sesuatu" id="search_input" onkeyup="searchFilter()" type="text" class="search-input">-->
  <!--      </div>-->
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
					<!--<a href="#!" onclick="add_to_cart(<?php echo $item['product']['product_id']; ?>)" class="waves-effect waves-blue meja-link grey lighten-3">-->
					<!--	<div id="badge<?php echo $item['product']['product_id'] ?>">-->
					<!--		<?php foreach($cart as $c) : ?>-->
					<!--		<?php if($c['name'] == $item['product']['product_name']) : ?>-->
					<!--			<span class="<?php echo $c['rowid'] ?> custom-badge blue product-count"><?php echo $c['qty'] ?></span>-->
					<!--		<?php endif;?>-->
					<!--		<?php endforeach; ?>-->
					<!--	</div>-->
					<!--	<img class="product-img" src="<?php echo $this->config->item('base_url')."assets/uploads/300".$item['product']['image']?>">-->
					<!--	<p class="product-title"><?php echo $item['product']['product_name'] ?></p>-->
					<!--	<p class="product-price">Rp. <?php echo number_format($item['product']['sale_price']) ?></p>-->
					<!--</a>-->
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
						<img class="product-img" src="<?php echo $this->config->item('base_url')."assets/uploads/".$item['product']['image']?>">
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
		<a href="<?php echo base_url('cashier/confirmation/0?bill_id='.$this->input->get('bill_id', TRUE)) ?>" onclick="confirmation()" class="btn-flat blue white-text right waves-effect waves-light" style="border-radius: 0px;">Konfirmasi</a>
	</div>
	<!--<div><?php echo $this->ajax_pagination->create_links();?></div>-->
	
	
