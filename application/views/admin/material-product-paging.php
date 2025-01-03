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
