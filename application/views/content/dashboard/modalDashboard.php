    <div class="modal fade in" id="modalAddEmployee" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content animated bounceInRight">
                <div class="modal-body">
                    <div class="row">
                        <form class="form-horizontal" id="empAddEditForm">
                            <input type="hidden" id="empNoreg" name="nEmpNoreg">
                            <h3 class="m-t-none m-b" id='titleAddEditEmp'></h3>
                            <hr class="hr-line-solid" style="margin-bottom: 25px">
                            <div class="form-group"><label class="col-lg-2 control-label">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" id="empName" name="nEmpName" placeholder="Employee Name"
                                        class="form-control">
                                    <small class="text-danger empName"></small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Username</label>
                                <div class="col-lg-10">
                                    <input type="text" id="empUsename" name="nEmpUsername"
                                        placeholder="Employee Username" class="form-control">
                                    <small class="text-danger empUsename"></small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Gender</label>
                                <div class="col-lg-10">
                                    <?php foreach($Gender as $gend) : ?>
                                    <input type="radio" id="empGender" name="nEmpGender"
                                        <?php echo ($gend->id == 'M' ) ? 'checked' : '' ?>
                                        value="<?php echo $gend->id; ?>"> <?php echo $gend->description; ?> &nbsp;
                                    <?php endforeach; ?>
                                    <small class="text-danger empGender"></small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="email" id="empEmail" name="nEmpEmail" placeholder="Employee Email"
                                        class="form-control">
                                    <small class="text-danger empEmail"></small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Division</label>
                                <div class="col-lg-10">
                                    <select name="nEmpDivision" id="empDivision" class="form-control">
                                        <option value="">-- Choose Division --</option>
                                        <?php foreach($Division as $div) : ?>
                                        <option value="<?php echo $div->id; ?>"><?php echo $div->description; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger empDivision"></small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Position</label>
                                <div class="col-lg-10">
                                    <select name="nEmpPosition" id="empPosition" class="form-control">
                                        <option value="">-- Choose Position --</option>
                                        <?php foreach($Position as $post) { ?>
                                        <option value="<?php echo $post['id']; ?>"><?php echo $post['position']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    <small class="text-danger empPosition"></small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="password" placeholder="Password" name="nEmpPassword" id="empPassword"
                                        class="form-control">
                                    <small class="text-danger empPassword"></small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Signature</label>
                                <div class="col-lg-10">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-primary btn-file">
                                            <span class="fileinput-new">
                                                Select file
                                            </span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="nEmpSignature" id="empSignature" accept=".svg"/>
                                        </span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput"
                                            style="float: none">×</a>
                                    </div>
                                    <br><small class="text-danger empSignature"></small>
                                </div>
                            </div>
                            <div class="modal-footer" style="margin-bottom: -15px;">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-sm btn-primary btn-outline" id="submitEmpForm"
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

    <div class="modal fade in" id="modalAddEditDivision" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content animated bounceInRight">
                <div class="modal-body">
                    <div class="row">
                        <h3 class="m-t-none m-b" id='titleDivisionForm'></h3>
                        <hr class="hr-line-solid" style="margin-bottom: 10px">
                        <form class="form-horizontal m-r-md m-l-md" id="addEditDivisionForm">
                            <div class="form-group">
                                <label class="control-label">Division ID</label>
                                <input type="text" id="divisionId" name="nDivisionId" placeholder="ID Division"
                                    class="form-control">
                                <small class="text-danger divisionId"></small>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Division Name</label>
                                <input type="text" id="divisionName" name="nDivisionName" placeholder="Nama Division"
                                    class="form-control">
                                <small class="text-danger divisionName"></small>
                            </div>
                            <div class="modal-footer" style="margin-bottom: -15px;">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-sm btn-primary btn-outline" id="submitDivsForm"
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

    <div class="modal fade in" id="modalEditOccupation" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content animated bounceInRight">
                <div class="modal-body">
                    <div class="row">
                        <h3 class="m-t-none m-b" id='titleOccupationForm'></h3>
                        <hr class="hr-line-solid" style="margin-bottom: 10px">
                        <form class="form-horizontal m-r-md m-l-md" id="editOccupationForm">
                            <input type="hidden" id="occupationId" name="nOccupationId">
                            <div class="form-group">
                                <label class="control-label">Posisi</label>
                                <input type="text" id="occupationName" name="nOccupationName" placeholder="Nama Posisi"
                                    class="form-control">
                                <small class="text-danger occupationName"></small>
                            </div>
                            <div class="modal-footer" style="margin-bottom: -15px;">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-sm btn-primary btn-outline" id="submitOccForm"
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
var photo = '<?php echo $userDetail->photo ?>';
    </script>