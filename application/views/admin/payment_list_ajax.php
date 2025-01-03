
<table class="striped">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Nama</th>
			<th>Total</th>
			<th style="text-align: center;">Pilihan</th>
		</tr>
	</thead>
	<tbody>
	    <input  name="member_id" id="member_id" type="hidden" value="<?php echo $member_id; ?>" class="validate">
	    <input  name="sales_id" id="sales_id" type="hidden" value="<?php echo $sale_id ?>" class="validate">
	    <?php $total = 0; ?>
		<?php if(!empty($payments)): foreach($payments as $key=> $item): ?>
		<?php $total += $item['total']; ?>
		<tr>
			<td><?php echo tanggal($item['payment_date']); ?></td>
			<td>
			    <?php echo $item['member_name']; ?>
			</td>
			<td><?php echo number_format($item['total']); ?></td>
			<td style="text-align: center;">
				<a href="javascript:void(0)" class="waves-effect waves-light blue btn-menu" title="Edit" onclick="table_edit_payment(<?php echo $item['payment_id']; ?>)"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<?php if($key !== 0): ?>
				    <a onclick="delete_payment(<?php echo $item['payment_id']; ?>)" class="waves-effect waves-blue red btn-menu">Hapus</a>
				<?php else: ?>
				    <a class="btn-menu disabled">Hapus</a>
				<?php endif; ?>
			</td>
		</tr>
		<?php  endforeach; else: ?>
			<tr><td colspan="3">Payment(s) not available.</td></tr>
		<?php endif; ?>	
		<tr>
		    <td><b>Total Pembayaran</b></td>
		    <td></td>
		    <td><b><?php echo number_format($total); ?></b></td>
		    <td></td>
		</tr>
		<tr>
		    <td><b>Sisa Tagihan</b></td>
		    <td></td>
		    <td><b><?php echo number_format($sales->total - $total)?></b></td>
		    <td></td>
		</tr>
	</tbody>
	<?php echo $this->ajax_pagination->create_links(); ?>
</table>
<a href="javascript:void(0)" id="" onclick="table_add_payment()" class="btn-flat green white-text " style="margin-left:15px;">Tambah</a>
<table id="table_add_payment" style="display:none; margin-top:25px;">
	<tr>
	    <td><b>Tambah Pembayaran</b></td>
	    <td></td>
	    <td></td>
	</tr>
	<tr>
	    <td><input placeholder="Tanggal" id="created_at" name="date_from" value="<?php echo date('Y-m-d'); ?>" type="date" class="validate" readonly></td>
	    <td>
	        <input name="max_payment" id="max_payment" value=<?php echo $sales->total - $total?>  type="hidden">
	        <input placeholder="Nominal" name="nominal" id="nominal" min=1 max=<?php echo $sales->total - $total?>  type="number" class="validate">
	    </td>
	    <td><a href="javascript:void(0)" id="btnSave" onclick="save()" class="btn-flat green white-text waves-effect waves-light" style="border-radius: 0px;width: 100%; text-align: center;">SIMPAN</a></td>
	</tr>
</table>
<table id="table_edit_payment" style="display:none; margin-top:25px;">
	<tr>
	    <td><b>Edit Pembayaran</b></td>
	    <td></td>
	    <td></td>
	</tr>
	<tr>
	    <td><input placeholder="Tanggal" id="created_at_edit" name="date_from" value="<?php echo date('Y-m-d'); ?>" type="date" class="validate" readonly></td>
	    <td>
	        <input name="max_payment" id="max_payment" value=<?php echo $sales->total - $total?>  type="hidden">
	        <input name="payment_id" id="payment_id" value="" type="hidden">
	        <input placeholder="Nominal" name="nominal" id="nominal_edit" min=1 max=<?php echo $sales->total - $total?>  type="number" class="validate">
	    </td>
	    <td><a href="javascript:void(0)" id="btnSave" onclick="update_payment()" class="btn-flat green white-text waves-effect waves-light" style="border-radius: 0px;width: 100%; text-align: center;">SIMPAN</a></td>
	</tr>
</table>
