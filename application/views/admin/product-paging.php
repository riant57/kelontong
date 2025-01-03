
	 <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Berat (pcs)</th>
                <th>Berat (total)</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php if(!empty($product)): foreach($product as $item): ?>
                <tr>
                    <td><img src="<?php echo $this->config->item('base_url')."assets/uploads/50".$item['product']['image'] ?>" alt="" class="circle product-list-image"></td>
                    <td><?php echo $item['product']['category_name'] ?></td>
                    <td><?php echo $item['product']['product_name'] ?></td>
                    <td><?php echo number_format($item['product']['hpp']) ?></td>
                    <td><?php echo number_format($item['product']['sale_price']) ?></td>
                    <td><?php echo ($item['stock'])? $item['stock'] : 0 ?></td>
                    <td><?php echo $item['product']['weight'] ?></td>
                    <td><?php echo $item['total_weight'] ?></td>
                    <td><?php echo $item['product']['product_unit'] ?></td>
                    <td><a href="#!" onclick="delete_product(<?php echo $item['product']['product_id']; ?>)" class="red-text secondary-content" title="hapus"><i class="material-icons">close</i></a>
                        <a href="<?php echo base_url('product/edit/'.$item['product']['product_id']) ?>#edit_form" class="blue-text secondary-content" title="edit"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
            <?php  endforeach; else: ?>
                <td colspan="3">Product(s) not available.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo $this->ajax_pagination->create_links(); ?>
	  
