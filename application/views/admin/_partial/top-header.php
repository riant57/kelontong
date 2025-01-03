    	<div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper blue">
             <a href="#" data-target="slide-out" class="sidenav-trigger waves-effect waves-light"><i class="material-icons mr-0">menu</i></a>
             <a href="#!" class="custom-nav-title"><?php echo $title;?></a>

             <ul class="right">
                <li style="display:inline">
                  <a href="stok.php" class="waves-effect waves-light modal-trigger">
                    <span class="badge red white-text notification-badge">2</span>
                    <i class="material-icons" style="">notifications</i>
                  </a>
                </li>

                <li>
                  <a href="javascript:void(0)" onclick="location.reload()" class="waves-effect waves-light" >
                    <i class="material-icons">refresh</i>
                  </a>
                </li>

                <?php if ($title=='Pengguna' || $title=='Pembelian' ||  $title=='Kategori' ||
                          $title=='Material' || $title=='Bahan Baku' || $title=='Supplier' || $title=='Members' || 
                          $title=='Return Pembelian' || $title=='Return Penjualan') { ?>
                <li>
                  <a href="#tambah_form" onclick="add()" class="waves-effect waves-light custom-modal-open" >
                    <i class="material-icons">add</i>
                  </a>
                </li>
                <?php } ?>
                <li class="hide-on-med-and-down">
                  <a href="javascript:void(0)" class="waves-effect waves-light dropdown-trigger" data-target='menu_dropdown'>
                    <?php $user =  $this->ion_auth->user()->row();?>
                    <?php $group = $this->ion_auth->groups($user->id)->result(); 
                      //print_r($group);
                    ?>
                    <span><?php echo $user->username; ?></span>
                    <i class="material-icons right mr-0">arrow_drop_down</i>
                  </a>
                </li>
              </ul>
                            <!-- Dropdown Structure -->
              <style>
                  ul#menu_dropdown.dropdown-content{
                      width:auto !important;
                  }
                  
                  .dropdown-content li>a>i{
                      margin:0 10px 0 0 !important;
                  }
              </style>
              <ul id='menu_dropdown' class='dropdown-content blue-text'>
                  <?php  $user = $this->ion_auth->user()->row(); ?>
                <li><a href="<?php echo base_url('auth/edit_user/'.$user->id) ?>"><i class="material-icons">person</i>Kelola Profil</a></li>
                <li><a href="<?php echo base_url('auth/logout') ?>"><i class="material-icons">lock_open</i>Keluar</a></li>
              </ul>
            </div>
        </nav>
      </div>