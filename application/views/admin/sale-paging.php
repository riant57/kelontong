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
				<!--<td><?php echo tanggal($date_from) ?>  - <?php echo tanggal($date_until) ?></td>-->
				<td><?php echo (!empty($date_from)? tanggal($date_from) : "") ?>  - <?php echo (!empty($date_until)? tanggal($date_until) : "") ?></td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td>:</td>
				<td><?php echo number_format($sum_price) ?></td>
			</tr>
			<tr>
				<td>Dibayar</td>
				<td>:</td>
				<td><?php echo number_format($sum_payment) ?></td>
			</tr>
			<tr>
				<td>Selisih</td>
				<td>:</td>
				<td><?php echo number_format($payment_yet) ?></td>
			</tr>
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
			<th>Dibayar</th>
			<th>Selisih</th>
			<th style="text-align: center;"></th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($sale)): foreach($sale as $key=> $item): ?>
			<tr>
				<td><?php echo tanggal($item['sale']['created_at'])?></td>
				<td><?php echo $item['sale']['name']?></td>
				<td><?php echo number_format($item['sale']['total_price'])?></td>
				<td><?php echo number_format($item['sale']['discount'])?></td>
				<td><?php echo number_format($item['sale']['discount_nominal'])?></td>
                <td><?php echo $item['sale']['total']?></td>
				<td <?php echo ($item['sale']['total'] > $item['payment'] )?  "style='color:red'": "style='color:green'" ?>> <?php echo number_format($item['payment']) ?></td>
				<td><?php echo number_format($item['sale']['total'] - $item['payment'])?></td>
				<td>
					<!--<li><a href="<?php echo base_url('sale_detail/detail/'.$item['sale']['id']) ?>" class="blue-text" >Detail</a></li>-->
					<!--<li><a href="#!" onclick="delete_sale(<?php echo $item['sale']['id']; ?>)" class="red-text">Hapus???</a></li>-->
					<!--<li><a href="#!" onclick="return_sale(<?php echo $item['sale']['id']; ?>)" class="blue-text" >Return??</a></li>-->
					
					<!--<a href="<?php echo base_url('sale_detail/detail/'.$item['sale']['id']) ?>" class="waves-effect waves-light blue btn-menu" title="Detail"><i class="glyphicon glyphicon-pencil"></i>Detail</a>-->
					<!--<a href="#!" onclick="delete_sale(<?php echo $item['sale']['id']; ?>)" class="waves-effect waves-light red btn-menu" title="Hapus" ><i class="glyphicon glyphicon-pencil"></i>Hapus</a>-->
				    <!-- Modal Trigger -->
                      <a class=" waves-effect waves-light  modal-trigger" href="#modal<?php echo $item['sale']['id'] ?>"><i class="small material-icons" title="Produk Detail">format_list_bulleted</i></a>
                      <a href="<?php echo base_url('prints?sales_id='.$item['sale']['id']) ?>" class="waves-effect waves-light "><i class="small material-icons" title="Print">local_printshop</i></a>
                      <a  href="javascript:void(0)" id="" onclick="delete_sale(<?php echo $item['sale']['id'] ?>)" class="waves-effect waves-light "><i class="small material-icons" title="Hapus">delete</i></a>
                    
                      <!-- Modal Structure -->
                      <div id="modal<?php echo $item['sale']['id'] ?>" class="modal">
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
				</td>
			</tr>
		<?php  endforeach; else: ?>
			<tr><td colspan="4">Sale(s) not available.</td></tr>
		<?php endif; ?>	
	</tbody>
	<?php echo $this->ajax_pagination->create_links();?>
</table>
