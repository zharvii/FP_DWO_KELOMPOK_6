   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <div class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6">
                       <h1 class="m-0">Dashboard</h1>
                   </div><!-- /.col -->
                   <div class="col-sm-6">
                       <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="<?php echo base_url('Dashboard') ?>">Dashboard</a></li>
                       </ol>
                   </div><!-- /.col -->
               </div><!-- /.row -->
           </div><!-- /.container-fluid -->
       </div>
       <!-- /.content-header -->

       <!-- Main content -->
       <div class="content">
           <div class="container-fluid">
               <!-- Small boxes (Stat box) -->
               <!-- Small boxes (Stat box) -->
               <div class="card card-primary">
                   <div class="card-header">
                       <h3 class="card-title">Filter</h3>
                   </div>
                   <!-- /.card-header -->
                   <!-- form start -->
                   <div class="card-body">
                       <div class="row">
                           <div class="col-lg-4">
                               <!-- select -->
                               <div class="form-group">
                                   <label>Tahun</label>
                                   <select class="form-control" id="tahun">
                                       <option value="all" selected>Semua</option>
                                       <option value="2001">2001</option>
                                       <option value="2002">2002</option>
                                       <option value="2003">2003</option>
                                       <option value="2004">2004</option>
                                   </select>
                               </div>
                           </div>
                           <div class="col-lg-4">
                               <!-- select -->
                               <div class="form-group">
                                   <label>Kuartal</label>
                                   <select class="form-control" id="kuartal">
                                       <option value="all" selected>Semua</option>
                                       <option value="1">1</option>
                                       <option value="2">2</option>
                                       <option value="3">3</option>
                                       <option value="4">4</option>
                                   </select>
                               </div>
                           </div>
                           <div class="col-lg-4">
                               <!-- select -->
                               <div class="form-group">
                                   <label>Bulan</label>
                                   <select class="form-control" id="bulan">
                                       <option value="all" selected>Semua</option>
                                       <option value="1">Januari</option>
                                       <option value="2">Februari</option>
                                       <option value="3">Maret</option>
                                       <option value="4">April</option>
                                       <option value="5">Mei</option>
                                       <option value="6">Juni</option>
                                       <option value="7">Juli</option>
                                       <option value="8">Agustus</option>
                                       <option value="9">Spetember</option>
                                       <option value="10">Oktober</option>
                                       <option value="11">November</option>
                                       <option value="12">Desember</option>

                                   </select>
                               </div>
                           </div>
                       </div>
                   </div>
                   <!-- /.card-body -->

                   <div class="card-footer">
                       <button class="btn btn-primary float-right" role="button" id="gen">Generate</button>
                   </div>
               </div>
               <div class="row">
                   <div class="col-lg-6 col-6">
                       <!-- small box -->
                       <div class="small-box bg-primary">
                           <div class="inner">
                               <h3 id="srevenue"></h3>

                               <p>Sales Revenue</p>
                           </div>
                           <div class="icon">
                               <i class="ion ion-cash"></i>
                           </div>
                           <a href="<?php echo base_url('Sales') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                       </div>
                   </div>
                   <div class="col-lg-6 col-6">
                       <!-- small box -->
                       <div class="small-box bg-success">
                           <div class="inner">
                               <h3 id="pexpanses"></h3>

                               <p>Purchase Expense</p>
                           </div>
                           <div class="icon">
                               <i class="ion ion-stats-bars"></i>
                           </div>
                           <a href="<?php echo base_url('Purchase') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                       </div>

                   </div>
                   <!-- ./col -->

                   <!-- ./col -->



               </div>

               <div class="row">
                   <div class="col-lg-3 col-6">
                       <!-- small box -->
                       <div class="small-box bg-info">
                           <div class="inner">
                               <h3><?= $param['totalCustomer']  ?></h3>

                               <p>Customer</p>
                           </div>
                           <div class="icon">
                               <i class="fas fa-user"></i>
                           </div>
                           <a href="<?php echo base_url('Customer') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                       </div>
                   </div>
                   <!-- ./col -->
                   <div class="col-lg-3 col-6">
                       <!-- small box -->
                       <div class="small-box bg-info">
                           <div class="inner">
                               <h3><?= $param['totalTerritory']  ?></h3>

                               <p>Sales Territory</p>
                           </div>
                           <div class="icon">
                               <i class="fas fa-map"></i>
                           </div>
                           <a href="<?php echo base_url('Territory') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                       </div>
                   </div>
                   <div class="col-lg-3 col-6">
                       <!-- small box -->
                       <div class="small-box bg-info">
                           <div class="inner">
                               <h3><?= $param['totalVendor']  ?></h3>

                               <p>vendor</p>
                           </div>
                           <div class="icon">
                               <i class="fas fa-industry"></i>
                           </div>
                           <a href="<?php echo base_url('Vendors') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                       </div>
                   </div>
                   <div class="col-lg-3 col-6">
                       <!-- small box -->
                       <div class="small-box bg-info">
                           <div class="inner">
                               <h3><?= $param['totalProduct']  ?></h3>

                               <p>Product</p>
                           </div>
                           <div class="icon">
                               <i class="fas fa-box"></i>
                           </div>
                           <a href="<?php echo base_url('Produk') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                       </div>
                   </div>
                   <!-- ./col -->
               </div>


               <!-- /.row -->
               <div class="card card-warning collapsed-card">
                   <div class="card-header">
                       <h3 class="card-title">Advenvtureworks Olap</h3>

                       <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                           </button>

                       </div>
                   </div>
                   <div class="card-body p-10">

                       <iframe name="mondrian" src="http://localhost:8081/mondrian" style="height: 500px; width:100%; border:none; align-content:center"> </iframe>

                   </div>
                   <!-- /.card-body -->
               </div>






           </div>
       </div>
       <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->