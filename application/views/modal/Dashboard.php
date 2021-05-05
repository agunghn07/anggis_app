    <div id="modal_form" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 b-r" align="center">
                            <h3>User's Photo</h3>
                            <hr>
                            <div class="form-group" id="photo-preview" align="center">
                                <div class="col-md-9" align="center">
                                    (No Result)
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <h3 class="m-t-none m-b" align="center">Change user's level and status</h3>
                            <hr>
                            <form id="form" role="form">
                                <input type="hidden" name="id_admin" id="id_admin">
                                <div class="form-group">
                                    <label>Level</label>
                                    <select class="form-control" id="level" name="level">
                                        <option value="staff">Staff</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="Status" name="status">
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                                <div class="well form-actions" align="left">
                                    <button type="button" id="btnSave" onclick="save()"
                                        class="btn btn-info">Save</button>
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                </div> <!-- /form-actions -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade in" id="modalAddEmployee" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content animated bounceInRight">
                <div class="modal-body">
                    <div class="row">
                        <form class="form-horizontal" id="empAddEditForm">
                            <h3 class="m-t-none m-b">Add Employee</h3>
                            <hr class="hr-line-solid" style="margin-bottom: 25px">
                            <div class="form-group"><label class="col-lg-2 control-label">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" id="empName" name="nEmpName" placeholder="Employee Name" class="form-control">
                                    <small class="text-danger empName"></small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Username</label>
                                <div class="col-lg-10">
                                    <input type="text" id="empUsename" name="nEmpUsername" placeholder="Employee Username" class="form-control">
                                    <small class="text-danger empUsename"></small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Gender</label>
                                <div class="col-lg-10">
                                    <?php foreach($Gender as $gend) : ?>
                                        <input type="radio" id="empGender" name="nEmpGender" <?php echo ($gend->id == 'M' ) ? 'checked' : '' ?> value="<?php echo $gend->id; ?>"> <?php echo $gend->description; ?> &nbsp;
                                    <?php endforeach; ?>
                                    <small class="text-danger empGender"></small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Position</label>
                                <div class="col-lg-10">
                                    <select name="nEmpPosition" id="empPosition" class="form-control">
                                        <option value="">-- Choose Position --</option>
                                        <?php foreach($Position as $post) { ?>
                                            <option value="<?php echo $post['id']; ?>"><?php echo $post['position']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <small class="text-danger empPosition"></small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Division</label>
                                <div class="col-lg-10">
                                    <select name="nEmpDivision" id="empDivision" class="form-control">
                                        <option value="">-- Choose Division --</option>
                                        <?php foreach($Division as $div) : ?>
                                            <option value="<?php echo $div->id; ?>"><?php echo $div->description; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger empDivision"></small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="password" placeholder="Password" name="nEmpPassword" id="empPassword" class="form-control">
                                    <small class="text-danger empPassword"></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-sm btn-primary btn-outline" id="submitEmpForm" type="button">Submit</button>
                                    <button class="btn btn-sm btn-warning btn-outline" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal fade" id="modalChangePhoto" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px 15px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span></button>
                    <small class="modal-title">Ganti Foto Profile</small>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('MainPage/change_photo') ?>" class="dropzone no-padding"
                        id="dropzoneForm">
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <script>
var photo = '<?php echo $userDetail->photo ?>'
    </script>