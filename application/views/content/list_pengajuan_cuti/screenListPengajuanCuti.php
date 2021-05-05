<style>
    td{ padding: 10px !important; }

    .table-responsive .label{
        width: 110px !important;
        display:  inline-block; 
        padding: 5px;
    }
</style>
<script>var tblListPengajuanCuti;</script>
<div class="wrapper wrapper-content animated fadeInRight m-r-sm m-l-sm">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins shadowBox">
                <div class="ibox-title">
                    <h5>Data Yang Mengajukan Cuti</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content sk-loading" id="listPengajuanCuti">
                    <div class="sk-spinner sk-spinner-double-bounce">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <div class="table-responsive">
                        <table id="tableListPengajuanCuti" class="customTable" width="100%" align="center">
                            <thead>
                                <tr style="padd">
                                    <th>#</th>
                                    <th>Nomor Registrasi</th>
                                    <th>Nama</th>
                                    <th>Dari Tanggal</th>
                                    <th>Sampai Tanggal</th>
                                    <th>Alasan Cuti</th>
                                    <th>Keterangan</th>
                                    <!-- <th>Diproses Oleh</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('content/notifikasi_surel/modalSurel') ?>