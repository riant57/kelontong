<br>
<table class="striped">
    <thead>
	</thead>
	<tbody>
		<tr>
			<td>Pelanggan</td>
			<td>:</td>
			<td>Semua</td>
		</tr>
		<tr>
			<td>Periode</td>
			<td>:</td>
			<td>Semua Transaksi</td>
		</tr>
		<tr>
			<td>Jumlah</td>
			<td>:</td>
			<td><?php echo number_format($sum_price) ?></td>
		</tr>
		<!--<tr>-->
		<!--	<td>Dibayar</td>-->
		<!--	<td>:</td>-->
		<!--	<td><?php echo number_format($sum_payment) ?></td>-->
		<!--</tr>-->
		<!--<tr>-->
		<!--	<td>Selisih</td>-->
		<!--	<td>:</td>-->
		<!--	<td><?php echo number_format($payment_yet) ?></td>-->
		<!--</tr>-->
	</tbody>
</table>
<br>
<table class="striped">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Pembeli</th>
			<th>Harga</th>
			<th>Diskon (%)</th>
			<th>Diskon (Rp)</th>
			<th>Total</th>
			<th style="text-align: center;"></th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($sale_return)): foreach($sale_return as $key=> $item): ?>
			<tr>
				<td><?php echo tanggal($item['sale_return']['created_at'])?></td>
				<td><?php echo $item['sale_return']['name']?></td>
				<td><?php echo number_format($item['sale_return']['total_price'])?></td>
				<td><?php echo number_format($item['sale_return']['discount'])?></td>
				<td><?php echo number_format($item['sale_return']['discount_nominal'])?></td>
				<td><?php echo $item['sale_return']['total']?></td>
				<td>
					<a class=" waves-effect waves-light  modal-trigger" href="#modal<?php echo $item['sale_return']['id'] ?>"><i class="small material-icons" title="Produk Detail">format_list_bulleted</i></a>
                    <!--<a href="<?php echo base_url('prints?sales_id='.$item['sale_return']['id']) ?>" class="waves-effect waves-light "><i class="small material-icons" title="Print">local_printshop</i></a>-->
                    <a  href="javascript:void(0)" id="" onclick="delete_sale_return(<?php echo $item['sale_return']['id'] ?>)" class="waves-effect waves-light "><i class="small material-icons" title="Hapus">delete</i></a>
			        <!-- Modal Structure -->
                    <div id="modal<?php echo $item['sale_return']['id'] ?>" class="modal">
                        <div class="modal-content">
                            <h6>Pembeli : <?php echo $item['sale_return']['name']?></h6>
                           <table>
                                <thead>
                                  <tr>
                                      <th>Produk</th>
                                      <th>Jumlah</th>
                                      <th>Harga</th>
                                  </tr>
                                </thead>
                        
                                <tbody>
                                    <?php foreach($item['detail'] as $key => $i):?>
                                        <tr>
                                            <td><?php  echo $i['product']?></td>
                                            <td><?php  echo $i['quantity']?></td>
                                            <td><?php  echo number_format($i['price'])?></td>
                                        </tr>
                                    <?php  endforeach; ?>
                                    <tr>
                                        <td></td>
                                        <td><b>Total</b></td>
                                        <td><b><?php echo number_format($item['sale_return']['total'])?></b></td>
                                    </tr>
                                </tbody>
                              </table>
                        </div>
                        <div class="modal-footer">
                          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Tutup</a>
                        </div>
                    </div>
				</td>
			</tr>
		<?php  endforeach; else: ?>
			<tr><td colspan="4">Purchase return(s) not available.</td></tr>
		<?php endif; ?>	
	</tbody>
	<?php echo $this->ajax_pagination->create_links();?>
</table>
