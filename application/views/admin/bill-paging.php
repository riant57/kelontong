
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
		<!--<tr>-->
		<!--	<td>Jumlah</td>-->
		<!--	<td>:</td>-->
		<!--	<td><?php echo number_format($sum_price) ?></td>-->
		<!--</tr>-->
		<!--<tr>-->
		<!--	<td>Dibayar</td>-->
		<!--	<td>:</td>-->
		<!--	<td><?php echo number_format($sum_payment) ?></td>-->
		<!--</tr>-->
		<tr>
			<td>Total Tagihan</td>
			<td>:</td>
			<td><?php echo number_format($payment_yet) ?></td>
		</tr>
	</tbody>
</table>
<br>
<!--      </div>-->
<!--<div class="col s12" id="">-->
<table class="striped">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Pembeli</th>
			<th>Tagihan</th>
			<th>Dibayar</th>
			<th>Selisih</th>
			<th style="text-align: center;"></th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($sale)): foreach($sale as $key=> $item): ?>
		    <?php //if($item['sale']['total'] > $item['payment'] ): ?>
				<tr>
					<td><?php echo tanggal($item['sale']['created_at'])?></td>
					<td><?php echo $item['sale']['name']?></td>
					<td><?php echo number_format($item['sale']['total'])?></td>
					<td <?php echo ($item['sale']['total'] > $item['payment'] )?  "style='color:red'": "style='color:green'" ?>> <?php echo number_format($item['payment']) ?></td>
					<td><?php echo number_format($item['sale']['total'] - $item['payment'])?></td>
					<td>
						<!--<li><a href="<?php echo base_url('sale_detail/detail/'.$item['sale']['id']) ?>" class="blue-text" >Detail</a></li>-->
						<!--<li><a href="#!" onclick="delete_sale(<?php echo $item['sale']['id']; ?>)" class="red-text">Hapus???</a></li>-->
						<!--<li><a href="#!" onclick="return_sale(<?php echo $item['sale']['id']; ?>)" class="blue-text" >Return??</a></li>-->
						
						<!--<a href="<?php echo base_url('sale_detail/detail/'.$item['sale']['id']) ?>" class="waves-effect waves-light blue btn-menu" title="Detail"><i class="glyphicon glyphicon-pencil"></i>Detail</a>-->
						<!--<a href="#!" onclick="delete_sale(<?php echo $item['sale']['id']; ?>)" class="waves-effect waves-light red btn-menu" title="Hapus" ><i class="glyphicon glyphicon-pencil"></i>Hapus</a>-->
					    <!-- Modal Trigger -->
				        <a class=" waves-light btn red lighten-2 modal-trigger" onclick="edit_payment(<?php echo $item['sale']['member_id'] ?>, <?php echo $item['sale']['id'] ?>)" href="#modal-payment<?php echo $item['sale']['id'] ?>">Bayar</a>
                        <a class=" waves-light btn modal-trigger" href="#modal-product<?php echo $item['sale']['id'] ?>">Lihat Produk</a>
                    
                        <!-- Modal Structure -->
                        <div id="modal-product<?php echo $item['sale']['id'] ?>" class="modal">
                            <div class="modal-content">
                                <h6><?php echo $item['sale']['name']?></h6>
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
                                            <td><b><?php echo number_format($item['sale']['total'])?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                              <a href="#!" class="modal-close waves-effect waves-green btn-flat">Tutup</a>
                            </div>
                        </div>
                        
                        <!-- Modal Payments -->
                        <div id="modal-payment<?php echo $item['sale']['id'] ?>" class="modal">
                            <div id="payments_list<?php echo $item['sale']['id'] ?>"></div>
                            <div class="modal-footer">
                              <a href="javascript:void(0)" onclick="location.reload()" class="modal-close waves-effect waves-green btn-flat">Tutup</a>
                            </div>
                        </div>
					
					</td>
				</tr>
			<?php // endif; ?>
		<?php  endforeach; else: ?>
			<tr><td colspan="4">Sale(s) not available.</td></tr>
		<?php endif; ?>	
	</tbody>
	<?php echo $this->ajax_pagination->create_links();?>
</table>