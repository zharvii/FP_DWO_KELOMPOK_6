   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <div class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6">
                       <h1 class="m-0">Vendor</h1>
                   </div><!-- /.col -->
                   <div class="col-sm-6">
                       <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="<?php echo base_url('Vendor') ?>">Vendor</a></li>
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
                   <div class="col-lg-12 col-6">
                       <!-- small box -->
                       <div class="small-box bg-info">
                           <div class="inner">
                               <h3><?= $param['total'] ?></h3>

                               <p>Vendor</p>
                           </div>
                           <div class="icon">
                               <i class="fas fa-industry"></i>
                           </div>
                       </div>
                   </div>

               </div>

               <div class="card collapsed-card">
                   <div class="card-header">
                       <h3 class="card-title">Vendor Data</h3>

                       <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                           </button>

                       </div>
                   </div>
                   <div class="card-body p-10">
                       <table id="example1" class="table table-striped projects">
                           <thead>
                               <tr>
                                   <th style="width: 10%">
                                       #
                                   </th>


                                   <th>
                                       Vendor Name
                                   </th>



                               </tr>
                           </thead>
                           <tbody>
                               <?php
                                $no = 1;
                                foreach ($param['data'] as $ter) {
                                ?>
                                   <tr>
                                       <td>
                                           <?php echo $no;
                                            ?>
                                       </td>


                                       <td>

                                           <?php echo $ter->VendorName
                                            ?>

                                       </td>



                                   </tr>
                               <?php $no++;
                                }
                                ?>
                           </tbody>
                       </table>
                   </div>
                   <!-- /.card-body -->
               </div>
               <!-- /.row -->
               <div class="card collapsed-card">
                   <div class="card-header">
                       <h3 class="card-title">Vendor Purchase Chart</h3>

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

                               <div id="chartVen"></div>
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