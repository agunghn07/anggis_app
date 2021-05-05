<div class="wrapper wrapper-content animated fadeInRight m-r-sm m-l-sm">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins shadowBox">
                <div class="ibox-title">
                    <h5>List History Cuti</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content sk-loading" id="listHistoryCuti">
                    <div class="sk-spinner sk-spinner-double-bounce">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <form role="form" class="form-inline">
                                <div class="form-group">
                                    <div class="input-group date historyCuti">
                                        <span class="input-group-addon" style="">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control" id="dariTanggal"
                                            placeholder="Dari Tanggal">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group date historyCuti">
                                        <span class="input-group-addon" style="">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control" id="sampaiTanggal"
                                            placeholder="Sampai Tanggal">
                                    </div>
                                </div>
                                <button class="btn btn-white" type="button" style="margin-bottom: 0px;"
                                    id="btnSearchHistoryCuti">
                                    <i class="fa fa-search"></i>&nbsp; Filter
                                </button>
                                <button class="btn btn-white" type="button" style="margin-bottom: 0px;"
                                    id="btnResetHistoryCuti">
                                    Reset
                                </button>
                                <!-- <a href="<?php echo base_url("HistoryCuti/printHistory"); ?>" class="btn btn-white">
                                    <i class="fa fa-file-pdf-o"></i>&nbsp; Cetak Data
                                </a> -->
                                <button class="btn btn-white" type="button" style="margin-bottom: 0px;"
                                    id="btnDownloadHistoryCuti">
                                    <i class="fa fa-file-pdf-o"></i>&nbsp; Download History
                                </button>
                            </form>
                        </div>

                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="tableHistoryCuti" class="customTable" width="100%" align="center">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Nomor Cuti</th>
                                    <th>Dari Tanggal</th>
                                    <th>Sampai Tanggal</th>
                                    <th>Alasan Cuti</th>
                                    <th>Status</th>
                                    <th>Tanggal Diproses</th>
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
<?php $this->load->view('content/history_cuti/modalHistoryCuti'); ?>