<table class="striped">
	<thead>
		<tr>
			<th>Rincian</th>
			<th>Jml</th>
			<th>Satuan</th>
			<th>Harga</th>
			<th style="text-align: center;"></th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($purchase_detail)): foreach($purchase_detail as $key=> $item): ?>
			<tr>
				<td><?php echo $item['detail']?></td>
				<td><?php echo $item['quantity']?></td>
				<td><?php echo number_format($item['price'],2)?></td>
				<td><?php echo number_format($item['total'],2)?></td>
				<td>
					<li><a href="#tambah_form" onclick="edit_purchase_detail(<?php echo $item['id']; ?>)" class="blue-text" >Perbarui</a></li>
					<li><a href="#!" onclick="delete_purchase_detail(<?php echo $item['id']; ?>)" class="red-text">Hapus???</a></li>
				</td>
			</tr>
		<?php  endforeach; else: ?>
			<tr><td colspan="4">Purchase Detail(s) not available.</td></tr>
		<?php endif; ?>	
	</tbody>
	<?php echo $this->ajax_pagination->create_links();?>
</table>
