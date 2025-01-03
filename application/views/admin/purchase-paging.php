<br>
<table class="striped">
    <thead>
	</thead>
	<tbody>
			<tr>
				<td>Supplier</td>
				<td>:</td>
				<td><?php echo $supplier_name?></td>
			</tr>
			<tr>
				<td>Produk</td>
				<td>:</td>
				<td><?php echo $product_name?></td>
			</tr>
			<tr>
				<td>Periode</td>
				<td>:</td>
				<!--<td><?php echo tanggal($date_from) ?>  - <?php echo tanggal($date_until) ?></td>-->
				<td><?php echo (!empty($date_from)? tanggal($date_from) : "") ?>  - <?php echo (!empty($date_until)? tanggal($date_until) : "") ?></td>
			</tr>
			<tr>
				<td>Total</td>
				<td>:</td>
				<td><?php echo number_format($sum_purchase); ?></td>
			</tr>
		</tbody>
</table>
<br>
<table class="">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Expired</th>
			<th>Supplier</th>
			<th>Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Total</th>
			<th style="text-align: center;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($purchase)): foreach($purchase as $key=> $item): ?>
			<tr>
				<td><?php echo ($item['date'])? tanggal($item['date']) : "" ?></td>
				<td><?php echo  ($item['expired'])? tanggal($item['expired']) : ""?></td>
				<td><?php echo $item['supplier_name']?></td>
				<td><?php echo $item['product_name']?></td>
				<td><?php echo number_format($item['price'])?></td>
				<td><?php echo $item['quantity']?></td>
				<td><?php echo number_format($item['total'])?></td>
				<td style="width:25%">
				    <!--<a href="<?php echo base_url('purchase_detail/detail/'.$item['id']) ?>" class="waves-effect waves-light blue btn-menu" title="Detail" ><i class="glyphicon glyphicon-pencil"></i>Detail</a>-->
					<a href="<?php echo base_url('purchase/edit/'.$item['id']) ?>#edit_form" class="waves-effect waves-light blue btn-menu" title="Perbarui"><i class="glyphicon glyphicon-pencil"></i>Perbarui</a>
					<a href="#!" onclick="delete_purchase(<?php echo $item['id']; ?>)" class="waves-effect waves-light red btn-menu" title="Hapus" ><i class="glyphicon glyphicon-pencil"></i>Hapus</a>
					<a href="#!" onclick="return_purchase(<?php echo $item['id']; ?>)" class="waves-effect waves-light blue btn-menu" title="Return"><i class="glyphicon glyphicon-pencil"></i>Return</a>
					<!--<a href="#!" class="waves-effect waves-red red-text btn-more dropdown-trigger" data-target='menu_more_<?php echo $key ?>'><i class="material-icons">more_horiz</i></a>-->
				</td>
			</tr>
		<?php  endforeach; else: ?>
			<tr><td colspan="4">Purchase(s) not available.</td></tr>
		<?php endif; ?>	
	</tbody>
	<?php echo $this->ajax_pagination->create_links();?>
</table>
