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
				<td><?php echo tanggal($date_from) ?>  - <?php echo tanggal($date_until) ?></td>
			</tr>
			<tr>
				<td>Dibayar</td>
				<td>:</td>
				<td><?php echo number_format($sum_payment) ?></td>
			</tr>
		</tbody>
</table>
<br>
<table class="striped">
	<thead>
		<tr>
			<th>Tanggal Order</th>
			<th>Tanggal Bayar</th>
			<th>Pembeli</th>
			<th>Jumlah</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($payment_report)): foreach($payment_report as $key=> $item): ?>
			<tr>
				<td><?php echo tanggal($item['payment']['sale_date'])?></td>
				<td><?php echo tanggal($item['payment']['payment_date'])?></td>
				<td><?php echo $item['payment']['member_name']?></td>
				<td><?php echo number_format($item['payment']['total']) ?></td>
			</tr>
		<?php  endforeach; else: ?>
			<tr><td colspan="4">Sale(s) not available.</td></tr>
		<?php endif; ?>	
	</tbody>
	<?php echo $this->ajax_pagination->create_links();?>
</table>
