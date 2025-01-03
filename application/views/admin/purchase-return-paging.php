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
<table class="striped">
	<thead>
		<tr>
			<tr>
				<th>Tgl retur</th>
				<th>Purchase Id</th>
				<th>Tgl purchase</th>
				<th>Supplier</th>
				<th>Produk</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Total</th>
				<th>Notes</th>
				<th style="text-align: center;"></th>
			</tr>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($purchase_return)): foreach($purchase_return as $key=> $item): ?>
			<tr>
				<td><?php echo tanggal($item['pr_created_at'])?></td>
				<td><?php echo $item['purchase_id']?></td>
				<td><?php echo tanggal($item['date'])?></td>
				<td><?php echo $item['supplier_name']?></td>
				<td><?php echo $item['product_name']?></td>
				<td><?php echo number_format($item['pr_price'])?></td>
				<td><?php echo $item['pr_quantity']?></td>
				<td><?php echo number_format($item['pr_total'])?></td>
				<td><?php echo $item['pr_note']?></td>
				<td>
					<a href="<?php echo base_url('purchase_return/edit/'.$item['pr_id']) ?>#edit_form" class="waves-effect waves-light blue btn-menu" title="Perbarui"><i class="glyphicon glyphicon-pencil"></i>Perbarui</a>
					<a href="#!" onclick="delete_purchase_return(<?php echo $item['pr_id']; ?>)" class="waves-effect waves-light red btn-menu" title="Hapus" ><i class="glyphicon glyphicon-pencil"></i>Hapus</a>
				</td>
			</tr>
		<?php  endforeach; else: ?>
			<tr><td colspan="4">Purchase return(s) not available.</td></tr>
		<?php endif; ?>	
	</tbody>
	<?php echo $this->ajax_pagination->create_links();?>
</table>
