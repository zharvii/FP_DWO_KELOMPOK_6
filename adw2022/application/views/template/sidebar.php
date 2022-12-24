<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('Home') ?>" class="brand-link">
        <img src="<?php echo base_url() ?>/assets/dist/img/logo1.png" alt="Adventureworks Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

        <span class="brand-text font-weight-light">AdventureWorks</span>
    </a>



    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url() ?>/assets/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $this->session->userdata('username') ?></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="<?php echo base_url('Dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('Employee') ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Employee
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('Customer') ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Customer
                        </p>
                    </a>
                </li>





                <li class="nav-item">
                    <a href="<?php echo base_url('Territory') ?>" class="nav-link">
                        <i class="nav-icon fas fa-map"></i>
                        <p>
                            Territory
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url('Vendors') ?>" class="nav-link">
                        <i class="nav-icon fas fa-industry"></i>
                        <p>
                            Vendor
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url('Produk') ?>" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Product
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('Sales') ?>" class="nav-link">
                        <i class="nav-icon ion ion-cash"></i>
                        <p>
                            Sales
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url('Purchase') ?>" class="nav-link">
                        <i class="nav-icon ion ion-stats-bars"></i>
                        <p>
                            Purchase
                        </p>
                    </a>
                </li>





            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>