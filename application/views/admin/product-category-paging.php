
<table class="striped">
	<thead>
		<tr>
			<th>Kategori</th>
			<th style="text-align: center;">Pilihan</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($category)): foreach($category as $item): ?>
		<tr>
			<td><?php echo $item['name']; ?></td>
			<td style="text-align: center;">
				<a href="#tambah_form" class="waves-effect waves-light blue btn-menu" href="javascript:void(0)" title="Edit" onclick="edit_category(<?php echo $item['id']; ?>)"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a onclick="delete_category(<?php echo $item['id']; ?>)" class="waves-effect waves-blue red btn-menu">Hapus</a>
			</td>
		</tr>
		<?php  endforeach; else: ?>
			<tr><td colspan="3">Category(s) not available.</td></tr>
		<?php endif; ?>	
	</tbody>
	<?php echo $this->ajax_pagination->create_links(); ?>
</table>
