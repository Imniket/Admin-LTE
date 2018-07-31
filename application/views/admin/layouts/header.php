<?php
$userData = $this->session->userdata('AdminUserData');
// echo '<pre>';
// print_r($userData);
?>
<header class="main-header">

    <!-- Logo -->
    <a href="<?= base_url() ?>admin/dashboard" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><?= APP_NAME_SHORT ?></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><?= APP_NAME ?></b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url() . 'uploads/users/thumb/' . $userData['profile'] ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= $userData['firstName'] . ' ' . $userData['lastName'] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= base_url() . 'uploads/users/thumb/' . $userData['profile'] ?>" class="img-circle" alt="User Image">

                            <p>
                                <?= $userData['firstName'] . ' ' . $userData['lastName'] . ' - ' . $userData['email'] ?> 
                                <small></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= base_url() ?>admin/dashboard/profile" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= base_url() ?>admin/admin/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>