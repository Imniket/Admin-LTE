<?php
$controller = str_replace(' ', '', $this->router->fetch_class());
$action = str_replace(' ', '', $this->router->fetch_method());
?> 
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="<?= ($controller == "dashboard") ? "active" : "" ?>">
                <a href="<?= base_url() ?>admin/dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
