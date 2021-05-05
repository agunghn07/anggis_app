<div class="wrapper wrapper-content animated fadeInRight m-r-sm m-l-sm">
    <div class="middle-box text-center animated fadeInRightBig" style="margin-top: 50px;" id="validasiCuti">
        <i class="fa fa-paste big-icon"></i>
        <h2 class="font-bold" style="opacity: 0.7">Form Pengajuan Cuti</h2>
        <div class="error-desc"  style="opacity: 0.7">
            Silahkan klik tombol pengajuan cuti dibawah untuk proses verifikasi data anda sebelum mengajukan cuti
            <br><button type="button" class="btn btn-primary m-t" id="ajukanCuti"
                data-noreg="<?php echo $userDetail->noreg; ?>">Ajukan Cuti</button>
        </div>
    </div>
    <div class="col-lg-12 animated" id="formCuti" style="display: none;">
        <div class="ibox shadowBox">
            <div class="ibox-title">
                <h5>Panel Cuti</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content" id="formPengajuan">
                <div class="sk-spinner sk-spinner-double-bounce">
                    <div class="sk-double-bounce1"></div>
                    <div class="sk-double-bounce2"></div>
                </div>
                <h2>Form Pengajuan Cuti</h2>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-sm-6 b-r">
                        <h3 class="m-t-none m-b">Informasi Pegawai</h3>
                        <p>Informasi Umum Pegawai Yang Bersangkutan</p>
                        <form role="form">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" id="cutiName" class="form-control"
                                    value="<?php echo $userDetail->name ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Noreg</label>
                                <input type="text" id="cutiNoreg" class="form-control"
                                    value="<?php echo $userDetail->noreg ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Posisi</label>
                                <input type="text" id="cutiPosition" class="form-control"
                                    value="<?php echo $userDetail->position; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Divisi</label>
                                <input type="text" id="cutiDivision" class="form-control"
                                    value="<?php echo $userDetail->division ?>" readonly>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 ">
                        <h3 class="m-t-none m-b">Data Cuti</h3>
                        <p>Sisa Cuti Anda Sebanyak <?php echo $jatahCuti; ?> Hari</p>
                        <form role="form">
                            <div class="form-group">
                                <label>Nomor Pengajuan</label>
                                <input type="text" class="form-control" id="nomorPengajuan" readonly>
                                <small class="text-danger nomorPengajuan"></small>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Dari Tanggal</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon" style="">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control" id="dateStart"
                                                placeholder="Masukan Tanggal">
                                        </div>
                                        <small class="text-danger dateStart"></small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Sampai Tanggal</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon" style="">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control" id="dateEnd"
                                                placeholder="Masukan Tanggal">
                                        </div>
                                        <small class="text-danger dateEnd"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan / Alasan</label>
                                <textarea spellcheck="false" name="" rows="5" id="idAlasanCuti" class="form-control"></textarea>
                                <small class="text-danger idAlasanCuti"></small>
                            </div>
                            <div></div>
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" id="btnAjukanCuti"
                                    type="button"><strong>Ajukan Permohonan Cuti</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>