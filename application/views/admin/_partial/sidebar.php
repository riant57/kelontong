<ul id="slide-out" class="sidenav sidenav-fixed resize-sidenav">
	<li>
    <div class="user-view">
	      <div class="background" style="background-color:#ddd"></div>
	      <a href="#user" class="waves-effect waves-light"><img class="circle" src="<?php echo $this->config->item('base_url') ?>assets/img/user.png"></a>
	      <a href="javascript:void(0)">
          <span class='blue-text name'>
            <b>Master Admin</b>
          </span>
        </a>
        <ul id='user_dropdown' class='dropdown-content blue-text'>
          <li><a href="profil.php"><i class="material-icons">person</i>Profil</a></li>
          <li><a href="login.php"><i class="material-icons">lock_open</i>Keluar</a></li>
        </ul>
	      <a href="#email" class="dropdown-trigger" data-target='user_dropdown'>
          <span class="blue-text email">Masuk sbg Admin<i class="material-icons right mr-0">arrow_drop_down</i></span>
        </a>
	  </div>
  </li>
    <?php $group = array('admin'); ?>
        <?php if ($this->ion_auth->in_group($group)): ?>
        <li class="">
            <a href="<?php echo base_url('dashboard') ?>">Dashboard<i class="material-icons">home</i></a>
        </li>
    <?php endif; ?>
  <li>
    <div class="divider"></div>
  </li>

  <li>
      <a class="subheader">Transaksi</a>
  </li>
  <li class="">
      <ul class="collapsible collapsible-accordion">
        <?php $group = array('admin'); ?>
        <?php if ($this->ion_auth->in_group($group)): ?>
            <li class="bold"><a class="collapsible-header">Pembelian<i class="material-icons">shopping_cart</i><i class="material-icons right mr-0">arrow_drop_down</i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a class="sidenav-close" href="<?php echo base_url('purchase') ?>#tambah_form">Tambah Baru</a></li>
                  <li><a href="<?php echo base_url('purchase') ?>">Semua Pembelian</a></li>
                  <li><a href="<?php echo base_url('purchase_return') ?>">Return Pembelian</a></li>
                </ul>
              </div>
            </li>
        <?php endif; ?>
        <?php $group = array('admin'); ?>
        <?php if ($this->ion_auth->in_group($group)): ?>
            <li class="bold"><a class="collapsible-header">Penjualan<i class="material-icons">money</i><i class="material-icons right mr-0">arrow_drop_down</i></a>
              <div class="collapsible-body">
                <ul>
                  <!--<li><a href="<?php echo base_url('cashier') ?>">Tambah Baru</a></li>-->
                  <li><a href="<?php echo base_url('sale') ?>">Penjualan</a></li>
                  <li><a href="<?php echo base_url('sale_detail') ?>">Penjualan Detail</a></li>
                  <li><a href="<?php echo base_url('sale_return') ?>">Return Penjualan</a></li>
                  <!--<li><a href="#">Return Penjualan Detail</a></li>-->
                </ul>
              </div>
            </li>
        <?php endif; ?>
        <li class="bold"><a class="collapsible-header">Kasir<i class="material-icons">streetview</i><i class="material-icons right mr-0">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
                <?php $group = array('admin'); ?>
                <?php if ($this->ion_auth->in_group($group)): ?>
			        <li><a href="<?php echo base_url('material_product') ?>">Bahan Baku</a></li>
			    <?php endif; ?>
              <li><a href="<?php echo base_url('cashier') ?>/add_order/0">Tambah Nota</a></li>
              <!--<li><a href="<?php echo base_url('sale') ?>">Daftar Penjualan</a></li>-->
              <!--<li><a href="<?php echo base_url('sale_return') ?>">Return Penjualan</a></li>-->
              <li><a href="<?php echo base_url('bill') ?>">Tagihan</a></li>
              <li><a href="<?php echo base_url('payment_report') ?>">Pembayaran</a></li>
              <li><a href="#">Return Pembayaran</a></li>
            </ul>
          </div>
        </li>

        <li>
          <div class="divider"></div>
        </li>

        <li>
            <a class="subheader">Data Supplier</a>
        </li>

        <li class="bold"><a class="collapsible-header">Supplier<i class="material-icons">directions_car</i><i class="material-icons right mr-0">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a class="sidenav-close" href="<?php echo base_url('suppliers') ?>#tambah_form">Tambah Supplier</a></li>
              <li><a href="<?php echo base_url('suppliers') ?>">Lihat Supplier</a></li>
            </ul>
          </div>
        </li>

        <li>
          <div class="divider"></div>
        </li>


        <li>
            <a class="subheader">Data Pelanggan</a>
        </li>

        <li class="bold"><a class="collapsible-header">Pelanggan<i class="material-icons">people_outline</i><i class="material-icons right mr-0">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a class="sidenav-close" href="<?php echo base_url('members') ?>#tambah_form">Tambah Pelanggan</a></li>
              <li><a href="<?php echo base_url('members') ?>">Lihat Pelanggan</a></li>
            </ul>
          </div>
        </li>

        <li>
          <div class="divider"></div>
        </li>

        <li>
            <a class="subheader">Stok Barang</a>
        </li>

        <li class="bold"><a class="collapsible-header">Stok<i class="material-icons">storage</i><i class="material-icons right mr-0">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a class="sidenav-close" href="<?php echo base_url('product') ?>#tambah_form">Tambah Produk</a></li>
              <li><a href="<?php echo base_url('product') ?>">Daftar Produk</a></li>
              <li><a href="<?php echo base_url('category') ?>">Kategori Produk</a></li>
              <li><a href="#">Satuan Produk</a></li>
            </ul>
          </div>
        </li>

        <li>
          <div class="divider"></div>
        </li>
        
        <?php $group = array('admin'); ?>
        <?php if ($this->ion_auth->in_group($group)): ?>
            <li>
                <a class="subheader">Data Pengguna</a>
            </li>
    
            <li class="bold"><a class="collapsible-header">Pengguna<i class="material-icons">people</i><i class="material-icons right mr-0">arrow_drop_down</i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a class="sidenav-close" href="pengguna.php#tambah_form">Tambah Pengguna</a></li>
                  <li><a href="<?php echo base_url('auth/users') ?>">Lihat Pengguna</a></li>
                </ul>
              </div>
            </li>
            <li>
              <div class="divider"></div>
            </li>
        <?php endif; ?>

        

        <li>
            <a class="subheader">Data Laporan</a>
        </li>

        <li class="bold"><a class="collapsible-header">Laporan<i class="material-icons">streetview</i><i class="material-icons right mr-0">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="<?php echo base_url('purchase_report') ?>">Pembelian</a></li>
              <li><a href="#!">Penjualan</a></li>
              <!--<li><a href="#!">Laporan Tahunan</a></li>-->
            </ul>
          </div>
        </li>

        <li>
          <div class="divider"></div>
        </li>

        <li>
          <a class="subheader">Akun Saya</a>
        </li>

        <li>
          <?php  $user = $this->ion_auth->user()->row(); ?>
          <a href="<?php echo base_url('auth/edit_user/'.$user->id) ?>">Profil<i class="material-icons">people</i></a>
        </li>

        <li>
          <a href="<?php echo base_url('auth/change_password') ?>">Ganti Password<i class="material-icons">lock</i></a>
        </li>
              
        <li>
          <a href="<?php echo base_url('auth/logout') ?>">Keluar<i class="material-icons">directions_run</i></a>
        </li>

        <li>
          <div class="divider"></div>
        </li>

        <li>
          <a class="subheader">Aplikasi</a>
        </li>

        <li class="bold"><a class="collapsible-header">Pengaturan<i class="material-icons">settings</i><i class="material-icons right mr-0">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="toko.php">Pengaturan Toko</a></li>
              <li><a href="#!">Pengaturan Printer</a></li>
            </ul>
          </div>
        </li>

        <li class="">
          <a href="tentang-app.php">Tentang<i class="material-icons">info</i><!--<span class="new badge blue"></span>--></a>
        </li>

        <li>
          <a href="https://api.whatsapp.com/send?phone=6281231431212&text=Selamat%20datang%20di%20Surya%20Daya%20Digital%20Creative%0AAda%20yang%20bisa%20kami%20bantu?%0A_Silahkan%20edit%20pesan%20ini_" class="waves-effect waves-blue">Bantuan?<i class="material-icons">help</i></a>
        </li>

        <li>
          <div class="divider"></div>
        </li>

        <li style="text-align: center;">
          <a href="#!" class="blue-text"><em>App V 1.0.0</em></a>
        </li>

      </ul>
    </li>
  </ul>