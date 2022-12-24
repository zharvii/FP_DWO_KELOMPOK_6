   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <div class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6">
                       <h1 class="m-0">Customer</h1>
                   </div><!-- /.col -->
                   <div class="col-sm-6">
                       <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="<?php echo base_url('Cutomer') ?>">Customer</a></li>
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



               <div class="row">
                   <div class="col-lg-6 col-6">
                       <!-- small box -->
                       <div class="small-box bg-info">
                           <div class="inner">
                               <h3><?= $param['totalCustomer'] ?></h3>

                               <p>Customer</p>
                           </div>
                           <div class="icon">
                               <i class="fas fa-user"></i>
                           </div>
                       </div>
                   </div>

                   <div class="col-lg-6 col-6">
                       <!-- small box -->
                       <div class="small-box bg-info">
                           <div class="inner">
                               <h3><?= $param['totalAktif'] ?></h3>

                               <p>Active Customer</p>
                           </div>
                           <div class="icon">
                               <i class="fas fa-user"></i>
                           </div>
                       </div>
                   </div>

               </div>


               <!-- /.row -->
               <div class="card collapsed-card">
                   <div class="card-header">
                       <h3 class="card-title">Customer Type Chart</h3>

                       <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                           </button>

                       </div>
                   </div>
                   <div class="card-body p-10">
                       <!-- <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas> -->
                       <figure class="highcharts-figure">
                           <div id="chartType"></div>
                           <p class="highcharts-description"></p>
                       </figure>
                   </div>
                   <!-- /.card-body -->
               </div>



               <div class="card  collapsed-card">
                   <div class="card-header">
                       <h3 class="card-title">Top 5 Individual Customer</h3>

                       <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                           </button>

                       </div>
                   </div>
                   <div class="card-body p-10">
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


                       <figure class="highcharts-figure">
                           <div id="chartku">

                               <div id="chartIndi"></div>
                           </div>

                           <p class="highcharts-description"></p>
                       </figure>

                   </div>
                   <!-- /.card-body -->
               </div>

               <div class="card  collapsed-card">
                   <div class="card-header">
                       <h3 class="card-title">Top 5 Reseller Customer</h3>

                       <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                           </button>

                       </div>
                   </div>
                   <div class="card-body p-10">

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
                                           <select class="form-control" id="tahun2">
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
                                           <select class="form-control" id="kuartal2">
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
                                           <select class="form-control" id="bulan2">
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
                               <button class="btn btn-primary float-right" role="button" id="gen2">Generate</button>
                           </div>
                       </div>
                       <figure class="highcharts-figure">
                           <div id="chartku2">

                               <div id="chartResel"></div>
                           </div>

                           <p class="highcharts-description"></p>
                       </figure>

                   </div>

               </div>
               <!-- /.card-body -->
           </div>







       </div>
   </div>
   <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->