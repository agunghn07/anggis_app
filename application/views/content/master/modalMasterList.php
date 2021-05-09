<link href="<?php echo base_url(); ?>assets/css/plugins/summernote/summernote.css" rel="stylesheet">
<style>
#tblDetail tr th,
#tblDetail tr td {
    width: auto;
    white-space: nowrap;
}

#tblDetail thead th {
    text-align: center;
    vertical-align: middle;
    background-color: #9D9D9D;
    color: #ffffff;
    font-weight: lighter;
    font-size: 12px;
    padding: 0px;
}
</style>

<div class="modal fade in" id="modalMasterList" tabindex="-1" role="dialog" aria-hidden="true" style="font-size: 12px">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated bounceInDown">
            <div class="modal-header" style="padding: 13px 15px;background-color: #17b39e;color: #fff;">
                <span id='titleAddEditMasterList' style="margin: 0px; font-size: 14px;"></span>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="empAddEditForm">
                    <input type="hidden" id="empNoreg" name="nEmpNoreg">
                    <div class="form-group"><label class="col-lg-2 control-label">Title</label>
                        <div class="col-lg-10">
                            <input type="text" id="title" name="title" class="form-control">
                            <small class="text-danger title"></small>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label">Description</label>
                        <div class="col-lg-10">
                            <textarea name="" id="description" name="description"></textarea>
                            <small class="text-danger title"></small>
                        </div>
                    </div>
                </form>
                <div class="panel panel-default" style="margin-bottom: 0px;">
                    <div class="panel-heading" style="padding: 5px 15px;">
                        Detail
                    </div>
                    <div class="panel-body">
                        <div id="divDetail" style="margin-top: 0px">
                            <div style="margin-bottom: 5px" class="divButtonDetail">
                                <div id="gridDetail" class="">
                                    <div class="table-responsive">
                                        <table class="table table-stripped table-condensed table-bordered"
                                            id="tblDetail" style="margin-bottom: 10px;">
                                            <thead>
                                                <tr>
                                                    <th class="grid-checkbox-col" wid>
                                                        <input class="grid-checkboxDetail" type="checkbox"
                                                            id="checkallDetail" />
                                                    </th>
                                                    <th>No</th>
                                                    <th>Subdetail</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <button id="btnAddDtl" class="btn btn-sm btn-info" type="button">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-sm btn-primary btn-outline" id="submitEmpForm" type="button">Submit</button>
                    <button class="btn btn-sm btn-warning btn-outline" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/plugins/summernote/summernote.min.js"></script>