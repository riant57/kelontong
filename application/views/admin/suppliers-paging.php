
<table class="striped">
	<thead>
		<tr>
			<th>Supplier</th>
			<th>Pemilik</th>
			<th>Alamat</th>
			<th>Telepon</th>
			<th style="text-align: center;">Pilihan</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($suppliers)): foreach($suppliers as $item): ?>
		<tr>
			<td><?php echo $item['name']; ?></td>
			<td><?php echo $item['owner']; ?></td>
			<td><?php echo $item['address']; ?></td>
			<td><?php echo $item['phone']; ?></td>
			<td style="text-align: center;">
				<a href="#tambah_form" class="waves-effect waves-light blue btn-menu" href="javascript:void(0)" title="Edit" onclick="edit_supplier(<?php echo $item['id']; ?>)"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a onclick="delete_supplier(<?php echo $item['id']; ?>)" class="waves-effect waves-blue red btn-menu">Hapus</a>
			</td>
		</tr>
		<?php  endforeach; else: ?>
			<tr><td colspan="3">Supplier(s) not available.</td></tr>
		<?php endif; ?>	
	</tbody>
	<?php echo $this->ajax_pagination->create_links(); ?>
</table>
