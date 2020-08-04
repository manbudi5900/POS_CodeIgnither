<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SMBK</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SEMBAKO</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama'); ?></p>
         <div id="status"></div>
          <div id="log"></div>
          <p>This is a test</p>
        </div>
      </div>
      

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <?php if ($this->session->userdata('level') =='kasir'){ ?>
        <li class="active"><a href="<?php echo base_url('');?>"><i class="fa fa-balance-scale"></i> <span>Transaksi</span></a></li>
        <li class="active"><a href="<?php echo site_url('Kasir/history');?>"><i class="fa fa-calendar-check-o"></i><span>History Penjualan</span></a></li>
        <?php }else if ($this->session->userdata('level') =='admin') {?>
        <li class="active"><a href="<?php echo base_url('Kasir/transaksi');?>"><i class="fa fa-balance-scale"></i> <span>Transaksi</span></a></li>
        <li class="active"><a href="<?php echo site_url('pembelian/awal');?>"><i class="fa fa-money"></i><span>Pembelian</span></a></li>
        <li class="active"><a href="<?php echo site_url('Kasir/history');?>"><i class="fa fa-calendar-check-o"></i><span>History Penjualan</span></a></li>
        <li class="active"><a href="<?php echo site_url('Kasir/hutang');?>"><i class="fa fa-money"></i><span>Pembayaran Hutang</span></a></li>
        <li class="active"><a href="<?php echo site_url('Kasir/Tbarang');?>"><i class="fa fa-cubes"></i><span>Barang</span></a></li>
        <li class="active"><a href="<?php echo site_url('pegawai/awal');?>"><i class="fa  fa-odnoklassniki"></i><span>Pegawai</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class='fa fa-file-text-o fa-fw'></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
            <li><a href="<?php echo site_url('laporan'); ?>"><i class="fa fa-circle-o"></i>Laporan Penjualan</a></li>
            <li><a href="<?php echo site_url('laporan/pembelian'); ?>"><i class="fa fa-circle-o"></i>Laporan Pembelian</a></li>
            <li><a href="<?php echo site_url('laporan/anggota'); ?>"><i class="fa fa-circle-o"></i>Laporan Angggota</a></li>
            <li><a href="<?php echo site_url('laporan/hutang'); ?>"><i class="fa fa-circle-o"></i>Laporan Hutang</a></li>
          </ul>
        </li>
        <?php }?>
        <li class="active"><a href="<?php echo site_url('pegawai/gantipass');?>"><i class="fa fa-link"></i><span>Password</span></a></li>


       
      <li class="active"><a href="<?php echo site_url('login/logout');?>"><i class="fa fa-link"></i><span>logout</span></a></li> 
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content container-fluid">
    
      

 
  
