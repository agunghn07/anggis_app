<script src="<?php echo base_url(); ?>assets/js/proses/masterList.js"></script>
<div class="wrapper wrapper-content">
    <div class="container">
        <div class="col-md-3 col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="padding-top: 7px; padding-bottom: 0px;">
                    <div class="justify-content-center">
                        <h5><span class="badge mainNavigation">Main Navigation</span></h5>
                    </div>
                </div>
                <div class="ibox-content" style="padding: 30px 20px;">
                    <div class="row">
                        <div class="justify-content-center">
                            <button class="btn btn-outline btn-primary dim" id="btnAddMasterList" style="font-size: 12px;"><span
                                    class="spanAdd">Tambah <br> Data</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-lg-9">
            <div class="ibox float-e-margins" style="border-radius: 5px 5px 0px 0px;">
                <div class="ibox-title" style="background-color: #17b39e; color: #fff; border-radius: 5px 5px 0px 0px;">
                    <h5>Search Criteria</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link" style="color: #fff;">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link" style="color: #fff;">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" style="padding-bottom: 0px;">
                    <div class="row customContainer">
                        <div class="table-responsive">
                            <table id="tableList" class="customTable" width="100%" x align="center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Created Date</th>
                                        <th>Created By</th>
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
</div>
<?php $this->load->view('content/master/modalMasterList') ?>