    <br>
    <table class="striped">
	    <thead>
		</thead>
		<tbody>
			<tr>
				<td>Pelanggan</td>
				<td>:</td>
				<td><?php echo $member_name ?></td>
			</tr>
			<tr>
				<td>Periode</td>
				<td>:</td>
				<!--<td><?php echo tanggal($date_from) ?>  - <?php echo tanggal($date_until) ?></td>-->
				<td><?php echo (!empty($date_from)? tanggal($date_from) : "") ?>  - <?php echo (!empty($date_until)? tanggal($date_until) : "") ?></td>
			</tr>
			<tr>
				<td>Produk</td>
				<td>:</td>
				<td><?php echo $product_name ?></td>
			</tr>
			<tr>
				<td>Harga Pokok</td>
				<td>:</td>
				<td><?php echo number_format($sum_hpp) ?></td>
			</tr>
			<tr>
				<td>Harga Jual</td>
				<td>:</td>
				<td><?php echo number_format($sum_price) ?></td>
			</tr>
			<tr>
				<td>Total</td>
				<td>:</td>
				<td><?php echo number_format($sum_total) ?></td>
			</tr>
			<tr>
				<td>Laba</td>
				<td>:</td>
				<td><?php echo number_format($sum_margin) ?></td>
			</tr>
		</tbody>
	</table>
	<br>
	<table class="striped">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Pembeli</th>
				<th>Produk</th>
				<th>Jumlah</th>
				<th>HPP</th>
				<th>Harga</th>
				<th>Total</th>
				<th>Margin</th>
				
				<th style="text-align: center;"></th>
			</tr>
		</thead>
		<tbody>
			<?php if(!empty($sale_detail)): foreach($sale_detail as $key=> $item): ?>
				<tr>
					<td><?php echo tanggal($item['created_at'])?></td>
					<td><?php echo $item['member_name']?></td>
					<td><?php echo $item['product']?></td>
					<td><?php echo $item['quantity']?></td>
					<td><?php echo number_format($item['hpp'])?></td>
					<td><?php echo number_format($item['price'])?></td>
					<td><?php echo number_format($item['total'])?></td>
					<td><?php echo number_format($item['margin'])?></td>
				</tr>
			<?php  endforeach; else: ?>
				<tr><td colspan="4">Purchase Detail(s) not available.</td></tr>
			<?php endif; ?>	
		</tbody>
		<?php echo $this->ajax_pagination->create_links();?>
	</table>
