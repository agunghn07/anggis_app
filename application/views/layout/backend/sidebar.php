    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <img alt="image" id="profileSidebar" width="50px" height="50px" class="img-circle"
                                style="box-shadow: 1px 1px 3px rgba(0,0,0,0.5)"
                                src="<?php echo base_url('assets/img/foto_admin/').$userDetail->photo; ?>" />
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                                        <?php echo $this->session->userdata('full_name') ?></strong>
                                </span> <span class="text-muted text-xs block"><?php echo $userDetail->position ?>
                                    <b class="caret"></b></span></span>
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
                    <a href="<?php echo site_url('MainPage') ?>"><i class="fa fa-home"></i> <span
                            class="nav-label">Dashboard</span></a>
                </li>
                <?php if($this->session->userdata('level') == 'admin' OR $this->session->userdata('level') == 'staff'){ ?>
                <li class="<?php if($this->uri->segment(2) == 'lesson'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('backend/lesson') ?>"><i class="fa fa-book"></i> <span
                            class="nav-label">Daftar Pelajaran
                        </span></a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'classroom'){ echo 'active';} ?>"
                    class="<?php if($this->uri->segment(2) == 'classroom'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('backend/classroom') ?>"><i class="fa fa-briefcase"></i> <span
                            class="nav-label">Daftar Kelas
                        </span></a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'teacher'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('backend/teacher')?>"><i class="fa fa-user"></i> <span
                            class="nav-label">Daftar Guru </span></a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'student'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('backend/student') ?>"><i class="fa fa-user-o"></i> <span
                            class="nav-label">Daftar Siswa</span> </a>
                </li>
                <?php if($this->session->userdata('level') == 'admin'){?>
                <li class="<?php if($this->uri->segment(2) == 'Assignment'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('backend/Assignment') ?>"><i class="fa fa-flask"></i> <span
                            class="nav-label">List Ujian</span></a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'result'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('backend/result') ?>"><i class="fa fa-file-text-o"></i> <span
                            class="nav-label">Hasil Ujian Siswa</span></a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'analytic'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('backend/analytic') ?>"><i class="fa fa-desktop"></i><span
                            class="nav-label">Analisis</span></a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'notification'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('backend/notification') ?>"><i class="fa fa-envelope-open-o"></i><span
                            class="nav-label">Live Notification</span></a>
                </li>
                <?php } ?>
                <?php }else{ ?>
                <li class="<?php if($this->uri->segment(2) == 'Assignment'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('backend/Assignment') ?>"><i class="fa fa-flask"></i> <span
                            class="nav-label">List Ujian</span></a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'result'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('backend/result') ?>"><i class="fa fa-file-text-o"></i> <span
                            class="nav-label">Hasil Ujian Siswa</span></a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'analytic'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('backend/analytic') ?>"><i class="fa fa-desktop"></i><span
                            class="nav-label">Analisis</span></a>
                </li>
                <?php } ?>
                <li class="<?php if($this->uri->segment(2) == 'chat'){ echo 'active';} ?>">
                    <a href="<?php echo site_url('backend/chat') ?>"><i class="fa fa-wechat"></i><span
                            class="nav-label">Live chat</span></a>
                </li>
            </ul>

        </div>
    </nav>