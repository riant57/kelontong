<?php
$data['title']="Cetak";
$this->load->view("admin/_partial/header.php", $data);
//$this->load->view("admin/_partial/sidebar.php");
//$this->load->view("admin/_partial/top-header.php");
?>



    <div class="row">
        <div class="col s6 m6">
            <div class="card">
                <div class="card-content" style="color:unset;text-align:center">
                    <h8>TOKO SERBA ADA</h8>
                      <p>0857 3341 6680 </p>
                </div>
                <hr>
                <div class="row" style="margin-bottom:unset; padding-left:4px;">
                    <div class="col s6">
                        <p style="margin-top:4px; margin-bottom:4px;"><?php echo $sales->id ?> / <?php echo tanggal($sales->created_at) ?></p>
                    </div> 
                    <div class="col s6">
                        <?php $user =  $this->ion_auth->user()->row();?>
                        <p style="margin-top:4px; margin-bottom:4px; text-align: right; padding-right: 4px;"><?php echo $user->username; ?></p>
                    </div>
                </div>
                <hr>
                <?php if(!empty($sales_detail)): foreach($sales_detail as $key=> $item): ?>
                <div class="row" style="margin-bottom:unset; padding-left:4px;">
                    <div class="col s12">
                        <p style="margin-top:4px; margin-bottom:4px;"><b> <?php echo $key + 1 ?>. <?php echo $item['product'] ?> </b></p>
                    </div>
                </div>
                <div class="row" style="margin-bottom:unset; padding-left:4px;">
                    <div class="col s6">
                        <p style="margin-top:4px; margin-bottom:4px;"><?php echo number_format($item['price']) ?> x <?php echo $item['quantity'] ?></p>
                    </div> 
                    <div class="col s6">
                        <p style="margin-top:4px; margin-bottom:4px; text-align: right; padding-right: 4px;"><?php echo number_format($item['total']) ?></p>
                    </div>
                </div>
                <?php  endforeach; ?>
                <?php endif; ?>	
                <hr>
                <div class="row" style="margin-bottom:unset; padding-left:4px;">
                    <div class="col s6">
                        <p style="margin-top:4px; margin-bottom:4px;"><b>Sub Total</b></p>
                    </div> 
                    <!--<div class="col s6">-->
                    <!--    <p style="margin-top:4px; margin-bottom:4px; text-align: right; padding-right: 4px;"><b><?php echo number_format($payment['total']) ?></b></p>-->
                    <!--</div>-->
                    <?php 
                        $sum = 0; 
                        $nominal = 0;
                        $sisa = 0;
                        foreach($payment as $key=>$value)
                        {
                           $sum+= $value['total'];
                           $nominal+= $value['nominal'];
                           $sisa+= $value['sisa'];
                        }
                    ?>
                    <div class="col s6">
                        <p style="margin-top:4px; margin-bottom:4px; text-align: right; padding-right: 4px;"><b><?php echo number_format($sales->total_price) ?></b></p>
                    </div>
                    
                </div>
                <div class="row" style="margin-bottom:unset; padding-left:4px;">
                    <div class="col s6">
                        <p style="margin-top:4px; margin-bottom:4px;">Diskon</p>
                    </div> 
                    <div class="col s6">
                        <p style="margin-top:4px; margin-bottom:4px; text-align: right; padding-right: 4px;">- <?php echo number_format($sales->discount_nominal) ?></p>
                    </div>
                </div>
                <div class="row" style="margin-bottom:unset; padding-left:4px;">
                    <div class="col s6">
                        <p style="margin-top:4px; margin-bottom:4px;"><b>Total</b></p>
                    </div> 
                    <div class="col s6">
                        <p style="margin-top:4px; margin-bottom:4px; text-align: right; padding-right: 4px;"><b><?php echo number_format($sales->total_price - $sales->discount_nominal) ?></b></p>
                    </div>
                </div>
                <div class="row" style="margin-bottom:unset; padding-left:4px;">
                    <div class="col s6">
                        <p style="margin-top:4px; margin-bottom:4px;">Tunai</p>
                    </div> 
                    <div class="col s6">
                        <p style="margin-top:4px; margin-bottom:4px; text-align: right; padding-right: 4px;"><?php echo number_format($nominal) ?></p>
                    </div>
                </div>
                <div class="row" style="margin-bottom:unset; padding-left:4px;">
                    <div class="col s6">
                        <p style="margin-top:4px; margin-bottom:4px;">Kembali</p>
                    </div> 
                    <div class="col s6">
                        <!--<p style="margin-top:4px; margin-bottom:4px; text-align: right; padding-right: 4px;"><?php echo number_format($nominal - $sales->total_price) ?></p>-->
                        <p style="margin-top:4px; margin-bottom:4px; text-align: right; padding-right: 4px;"><?php echo number_format($sisa) ?></p>
                    </div>
                </div>
                <div class="card-action" style="text-align:center;">
                  <p>Terima kasih</p>
                </div>
            </div>
        </div>
    </div>

<script>
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });
</script>  