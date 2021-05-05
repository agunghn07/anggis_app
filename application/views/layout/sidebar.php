    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <img alt="image" id="profileSidebar" width="50px" height="50px" class="img-circle"
                                style="box-shadow: 1px 1px 3px rgba(0,0,0,0.5)"
                                src="<?php echo base_url('assets/img/empPhoto/').$userDetail->photo; ?>" />
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> 
                                <strong class="font-bold" id="sidebarEmpUsername"><?php echo $userDetail->username; ?></strong>
                            </span> 
                            <span class="text-muted text-xs block">
                                <?php echo $userDetail->position.($userDetail->id_position != 1 ? ' '.$userDetail->id_division : '') ?><b class="caret"></b>
                            </span></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="<?php echo base_url('MainPage') ?>">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url('MainPage/logout'); ?>">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li class="<?php if($this->uri->segment(1) == 'MainPage'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('MainPage') ?>"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span></a>
                </li>   
                <?php if($userDetail->id_position != 1) { ?>
                    <?php if($userDetail->id_position != 2) { ?>
                        <?php if($userDetail->until_dt == null || ((date('Y-m-d') > $userDetail->until_dt && $userDetail->is_approve == 3) || $userDetail->is_approve == 1)) { ?>
                            <li class="<?php if($this->uri->segment(1) == 'PengajuanCuti'){ echo 'active';} ?>">
                                <a href="<?php echo site_url('PengajuanCuti') ?>"><i class="fa fa-desktop"></i><span class="nav-label">Pengajuan Cuti</span></a>
                            </li>
                        <?php } else {  ?>
                            <li class="<?php if($this->uri->segment(1) == 'PersetujuanCuti'){ echo 'active';} ?>">
                                <a href="<?php echo site_url('PersetujuanCuti') ?>"><i class="fa fa-check-square-o"></i><span class="nav-label">Persetujuan Cuti</span></a>
                            </li>
                        <?php } ?>
                        <li class="<?php if($this->uri->segment(1) == 'HistoryCuti'){ echo 'active';} ?>">
                            <a href="<?php echo site_url('HistoryCuti') ?>"><i class="fa fa-history"></i><span class="nav-label">History Cuti</span></a>
                        </li>
                    <?php } else { ?>
                        <li class="<?php if($this->uri->segment(1) == 'ListPengajuanCuti'){ echo 'active';} ?>">
                            <a href="<?php echo site_url('ListPengajuanCuti') ?>"><i class="fa fa-list-alt"></i><span class="nav-label">List Pengajuan</span><span class="label label-warning pull-right" id="countListPengajuanCuti"></span></a>
                        </li>
                    <?php } ?>
                <?php } ?>
                <li class="<?php if($this->uri->segment(1) == 'NotifikasiSurel'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('NotifikasiSurel') ?>"><i class="fa fa-envelope"></i> <span class="nav-label">Notifikasi Surel</span></a>
                </li>
            </ul>

        </div>
    </nav>