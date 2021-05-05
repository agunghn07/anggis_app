    <div class="row border-bottom white-bg">
        <nav class="navbar navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <i class="fa fa-reorder"></i>
                </button>
                <a href="#" class="navbar-brand">OnlineExam</a>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a aria-expanded="false" role="button" href="<?php echo site_url('frontend/exam') ?>"> Daftar Ujian Aktif</a>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="<?php echo site_url('frontend/exam/history') ?>"> Riwayat Ujian </a>
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">&ensp;Nama siswa : <strong><?php echo $this->session->userdata('globalStudent')->student_name ?></strong></span>
                        <img alt="image" width="35px" height="35px" class="img-circle" src="<?php echo base_url('assets/img/foto_siswa/').$this->session->userdata('globalStudent')->student_photo ?>"/>
                    </li>
                    <li>
                        <a href="<?php echo site_url('frontend/exam/logout') ?>">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>