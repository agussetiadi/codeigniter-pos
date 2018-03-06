<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Point of sale | Agus Setiadi</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo base_url()."assets/" ?>css/bootstrap.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="<?php echo base_url()."assets/" ?>css/fontastic.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url()."assets/" ?>css/font-awesome.css">
    <!-- Google fonts - Poppins -->
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url()."assets/" ?>css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo base_url()."assets/" ?>css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/main.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/easyui.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/dataTables.bootstrap4.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/glyphicons.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/sweetalert.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
    
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>

<div class="wrap-alert">
  
</div>
    <!-- Javascript files-->
    <script src="<?php echo base_url()."assets/" ?>js/jquery.js"> </script>
    <script src="<?php echo base_url()."assets/" ?>js/popper.js/umd/popper.min.js"> </script>
    <script src="<?php echo base_url()."assets/" ?>js/jquery.validate.min.js"> </script>
    <script src="<?php echo base_url()."assets/" ?>js/bootstrap.js"></script>
    <script src="<?php echo base_url()."assets/" ?>js/jquery.cookie/jquery.cookie.js"></script>
    <script src="<?php echo base_url()."assets/" ?>js/front.js"></script>
    <script src="<?php echo base_url()."assets/" ?>js/jquery.easyui.min.js"></script>
    <script src="<?php echo base_url()."assets/" ?>js/main.js"></script>
    <script src="<?php echo base_url()."assets/" ?>js/jquery-ui.js"></script>
    <script src="<?php echo base_url()."assets/" ?>js/sweetalert.js"></script>
    <script src="<?php echo base_url()."assets/" ?>js/jquery.number.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()."assets/js/socket.io.js" ?>"></script>

    <!-- DataTable -->
    <script src="<?php echo base_url() ?>assets/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url() ?>assets/js/dataTables.bootstrap4.min.js"></script>




    <script type="text/javascript" src="<?php echo base_url()."assets/js/helper.js" ?>"></script>



<script type="text/javascript">
    var node_url = '<?php echo node_url() ?>';
    var socket = io.connect(node_url);

    var store_id = '<?php echo $this->session_data->store_id() ?>';
    var user_id = '<?php echo $this->session_data->user_id() ?>';

    /*send notif connect*/
    socket.emit("come", {
      store_id : store_id,
      user_id : user_id

    })

</script>
    
    



    <div class="page home-page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>



          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand">
                  <div class="brand-text brand-big"><span>Admin </span><strong>Dashboard</strong></div>
                  <div class="brand-text brand-small"><strong>AD</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Search-->
                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
                <!-- Notifications-->
                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell-o"></i><span class="badge bg-red">12</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-envelope bg-green"></i>You have 6 new messages </div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-upload bg-orange"></i>Server Rebooted</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                          <div class="notification-time"><small>10 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>view all notifications                                            </strong></a></li>
                  </ul>
                </li>
                <!-- Messages                        -->
                <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope-o"></i><span class="badge bg-orange">10</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="<?php echo base_url()."assets/" ?>img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Jason Doe</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="<?php echo base_url()."assets/" ?>img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Frank Williams</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="<?php echo base_url()."assets/" ?>img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Ashley Wood</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>Read all messages    </strong></a></li>
                  </ul>
                </li>
                <!-- Logout    -->
                <li class="nav-item"><a href="<?php echo base_url()."logout/" ?>" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="<?php echo base_url()."assets/img/".$this->session_data->get_user('avatar') ?>" class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h4"><?php echo $this->session_data->get_user('first_name'); ?></h1>
              <p><?php echo $this->session_data->get_user('jabatan_name') ?></p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
          <ul class="list-unstyled">

            <li class="active"> <a href="<?php echo base_url() ?>"><i class="icon-home"></i>Home</a></li>


            <?php if($this->role_module->get(1) == true){ ?>

            <li><a href="#dashvariants" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Master </a>
              <ul id="dashvariants" class="collapse list-unstyled">

              <?php if($this->role_module->get(3) == true){ ?>
                <li><a href="<?php echo base_url()."master/user" ?>">Data Pengguna</a></li>
              <?php } ?>

              <?php if($this->role_module->get(2) == true){ ?>
                <li><a href="<?php echo base_url()."master/category" ?>">Master Kategori</a></li>
              <?php } ?>

              <?php if($this->role_module->get(4) == true){ ?>
                <li><a href="<?php echo base_url()."master/unit" ?>">Master Unit/Satuan</a></li>
              <?php } ?>

              <?php if($this->role_module->get(5) == true){ ?>
                <li><a href="<?php echo base_url()."master/printer" ?>">Jenis Printer</a></li>
              <?php } ?>

              <?php if($this->role_module->get(6) == true){ ?>
                <li><a href="<?php echo base_url()."master/item" ?>">Master Produk</a></li>
              <?php } ?>

              <?php if($this->role_module->get(7) == true){ ?>
                <li><a href="<?php echo base_url()."master/store" ?>">Daftar Store/Cabang</a></li>
              <?php } ?>

              <?php if($this->role_module->get(8) == true){ ?>
                <li><a href="<?php echo base_url()."master/shift" ?>">Manage Shift</a></li>
              <?php } ?>

              <?php if($this->role_module->get(9) == true){ ?>
                <li><a href="<?php echo base_url()."master/jabatan" ?>">MasterJabatan/Divisi</a></li>
              <?php } ?>

              <?php if($this->role_module->get(10) == true){ ?>
                <li><a href="<?php echo base_url()."master/bank" ?>">Master Bank</a></li>
              <?php } ?>

              <?php if($this->role_module->get(11) == true){ ?>
                <li><a href="<?php echo base_url()."master/payment" ?>">Jenis Pembayaran</a></li>
              <?php } ?>

              <?php if($this->role_module->get(12) == true){ ?>
                <li><a href="<?php echo base_url()."master/supplier" ?>">Data Supplier</a></li>
              <?php } ?>
                
              </ul>
            </li>

            <?php } ?>



            <?php if($this->role_module->get(13) == true){ ?>
            <li><a href="#sales_o" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Sales Order</a>
              <ul id="sales_o" class="collapse list-unstyled">
              <?php if($this->role_module->get(14) == true){ ?>
                <li><a href="<?php echo base_url()."sales/billing"; ?>">Billing</a></li>
              <?php } ?>

              <?php if($this->role_module->get(15) == true){ ?>
                <li><a href="<?php echo base_url()."sales/billing/list_order"; ?>">List Order</a></li>
              <?php } ?>

              <?php if($this->role_module->get(16) == true){ ?>
                <li><a href="<?php echo base_url()."sales/billing/piutang"; ?>">Piutang</a></li>
              <?php } ?>

              <?php if($this->role_module->get(17) == true){ ?>
                <li><a href="<?php echo base_url()."sales/billing/paid"; ?>">Lunas</a></li>
              <?php } ?>

              <?php if($this->role_module->get(18) == true){ ?>
                <li><a href="<?php echo base_url()."sales/billing/retur"; ?>">Retur Penjualan</a></li>
              <?php } ?>

              </ul>
            </li>
            <?php } ?>
            


            <?php if($this->role_module->get(19) == true){ ?>
             <li><a href="#stock_o" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Persediaan</a>
              <ul id="stock_o" class="collapse list-unstyled">

                <?php if($this->role_module->get(20) == true){ ?>
                <li><a href="<?php echo base_url()."inventory/stock_card"; ?>">Lihat Stok</a></li>
                <?php } ?>

                <?php if($this->role_module->get(21) == true){ ?>
                <li><a href="<?php echo base_url()."inventory/stock_card/detail"; ?>">Pergerakan Stok</a></li>
                <?php } ?>

                <?php if($this->role_module->get(22) == true){ ?>
                <li><a href="<?php echo base_url()."inventory/stock_flow/item_out"; ?>">Barang Keluar</a></li>
                <?php } ?>

                <?php if($this->role_module->get(23) == true){ ?>
                <li><a href="<?php echo base_url()."inventory/stock_flow/item_in"; ?>">Barang Masuk</a></li>
                <?php } ?>

              </ul>
            </li>
            <?php } ?>


            <?php if($this->role_module->get(24) == true){ ?>
            <li><a href="#antrian_o" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Antrian</a>
              <ul id="antrian_o" class="collapse list-unstyled">

                <?php if($this->role_module->get(25) == true){ ?>
                <li><a href="<?php echo base_url()."queue/display"; ?>">Display</a></li>
                <?php } ?>


                <?php if($this->role_module->get(26) == true){ ?>
                <li><a href="<?php echo base_url()."queue/print_q"; ?>">Print Antrian</a></li>
                <?php } ?>

                <?php if($this->role_module->get(27) == true){ ?>
                <li><a href="<?php echo base_url()."queue/calling"; ?>">Calling</a></li>
                <?php } ?>
                
              </ul>
            </li>
            <?php } ?>


            <?php if($this->role_module->get(28) == true){ ?>
            <li><a href="#produksi_o" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Produksi</a>
              <ul id="produksi_o" class="collapse list-unstyled">
              <?php if($this->role_module->get(29) == true){ ?>
                <li><a href="<?php echo base_url()."produce/spk"; ?>">SPK Masuk</a></li>
              <?php } ?>
                
              </ul>
            </li>
            <?php } ?>



            <?php if($this->role_module->get(30) == true){ ?>
            <li><a href="#app_setting" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Pengaturan</a>
              <ul id="app_setting" class="collapse list-unstyled">

              <?php if($this->role_module->get(31) == true){ ?>
                <li><a href="<?php echo base_url()."app_system/setting/role"; ?>">Hak Akses User</a></li>
              <?php } ?>  
              </ul>
            </li>
            <?php } ?>


            <?php if($this->role_module->get(33) == true){ ?>
            <li><a href="#app_report" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-bar-chart"></i>Laporan</a>
              <ul id="app_report" class="collapse list-unstyled">

              <?php if($this->role_module->get(34) == true){ ?>
                <li><a href="<?php echo base_url()."report/sales"; ?>">Penjualan</a></li>
                <li><a href="<?php echo base_url()."report/stock"; ?>">Stock Barang</a></li>
              <?php } ?>  
              </ul>
            </li>
            <?php } ?>

            
        </nav>
        <div class="content-inner">

         