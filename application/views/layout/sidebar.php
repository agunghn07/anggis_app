<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header" style="padding-top: 20px; padding-bottom: 20px;">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" id="profileSidebar" width="50px" height="50px" class="img-circle"
                            style="box-shadow: 1px 1px 3px rgba(0,0,0,0.5)"
                            src="<?php echo base_url('assets/img/noimage.png') ?>" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs">
                                <strong class="font-bold" id="sidebarEmpUsername">Administrator</strong>
                            </span>
                    </a>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="<?php if($this->uri->segment(1) == 'MainPage'){ echo 'active';} ?>">
                <a href="<?php echo site_url('MainPage') ?>"><i class="fa fa-home"></i> <span
                        class="nav-label">Dashboard</span></a>
            </li>
            <li class="<?php if($this->uri->segment(1) == 'NotifikasiSurel'){ echo 'active';} ?>">
                <a href="<?php echo site_url('NotifikasiSurel') ?>"><i class="fa fa-envelope"></i> <span
                        class="nav-label">Notifikasi Surel</span></a>
            </li>
        </ul>

    </div>
</nav>