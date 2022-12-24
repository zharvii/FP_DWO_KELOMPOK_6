   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <div class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6">
                       <h1 class="m-0">Purchase</h1>
                   </div><!-- /.col -->
                   <div class="col-sm-6">
                       <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="<?php echo base_url('Purchase') ?>">Purchase</a></li>
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
                               <h3><?= "$ " . number_format($param['total'], 2);  ?></h3>

                               <p>Purchase Expanses</p>
                           </div>
                           <div class="icon">
                               <i class="ion ion-cash"></i>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-6 col-6">
                       <!-- small box -->
                       <div class="small-box bg-info">
                           <div class="inner">
                               <h3><?= "$ " . number_format($param['avg'], 2);  ?></h3>

                               <p>Purchase Average</p>
                           </div>
                           <div class="icon">
                               <i class="ion ion-stats-bars"></i>
                           </div>
                       </div>
                   </div>


               </div>





               <div class="card  collapsed-card">
                   <div class="card-header">
                       <h3 class="card-title">Purchase Expanses Chart</h3>

                       <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                           </button>

                       </div>
                   </div>
                   <div class="card-body p-10">


                       <center>
                           <h1>Purchase Expanses</h1>
                       </center>
                       <br>
                       <!-- <center>
                           <h3 id="kosong">Tidak Ada Data</h3>
                       </center> -->

                       <!-- <canvas id="barChart" style="min-height: 250px; height: 600px; max-height: 600px; max-width: 100%;"></canvas> -->
                       <figure class="highcharts-figure">
                           <div id="chartku">
                               <div id="chartEx"></div>
                           </div>
                           <p class="highcharts-description"></p>
                       </figure>

                   </div>
                   <!-- /.card-body -->
               </div>

               <div class="card  collapsed-card">
                   <div class="card-header">
                       <h3 class="card-title">Purchase Average Chart</h3>

                       <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                           </button>

                       </div>
                   </div>
                   <div class="card-body p-10">

                       <center>
                           <h1>Purchase Average</h1>
                       </center>
                       <br>
                       <!-- <center>
                           <h3 id="kosong">Tidak Ada Data</h3>
                       </center> -->

                       <!-- <canvas id="barChart" style="min-height: 250px; height: 600px; max-height: 600px; max-width: 100%;"></canvas> -->
                       <figure class="highcharts-figure">
                           <div id="chartku2">
                               <div id="chartAvg"></div>
                           </div>
                           <p class="highcharts-description"></p>
                       </figure>

                   </div>
                   <!-- /.card-body -->
               </div>






           </div>
       </div>
       <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->