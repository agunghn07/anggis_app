<div class="modal fade" id="modalProcessSurel">
    <div class="modal-dialog" style="width: 30%">
        <div class="modal-content animated bounceInRight">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>    
                    <h4 class="" align="center">Apakah anda ingin Approve atau Reject surel ini?</h4>
                    <!-- <input type="hidden" id="positionPic"> -->
                    <input type="hidden" id="idEmailCuti">
                    <input type="hidden" id="nomorPengajuanCuti">
                </div>
                <div class="modal-footer">
                    <button type="button" id="rejectSurel" class="btn btn-sm btn-default btn-block">Reject</button>
                    <button type="button" id="approveSurel" class="btn btn-sm btn-info btn-block">Approve</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="modalRejectSUrel" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content animated bounceInRight">
                <div class="modal-body">
                    <div class="row">
                        <h3 class="m-t-none m-b" id=''>Tolak Surel</h3>
                        <hr class="hr-line-solid" style="margin-bottom: 10px">
                        <form class="form-horizontal m-r-md m-l-md" id="editOccupationForm">
                            <input type="hidden" id="occupationId" name="nOccupationId">
                            <div class="form-group">
                                <label class="control-label">Alasan</label>
                                <textarea spellcheck="false" name="" rows="5" id="idAlasanTolak" class="form-control"></textarea>
                                <small class="text-danger idAlasanTolak"></small>
                            </div>  
                            <div class="modal-footer" style="margin-bottom: -15px;">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-sm btn-primary" id="submitRejectMessage"
                                        type="button">Submit</button>
                                    <button class="btn btn-sm btn-warning btn-outline"
                                        data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>