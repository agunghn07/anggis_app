
<div class="modal inmodal" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h5 class="modal-title"></h5>
                    
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <div class="panel panel-default panel-body">
                            <form id="form" class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="student_name">Nama Siswa</label>
                                    <div class="col-sm-9 col-sm-9 col-xs-12">
                                        <input type="hidden" name="id_student" id="id_student">
                                        <input type="text" name="student_name" id="student_name" class="form-control" placeholder="Username">
                                        <span class="help-block" align="left"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="student_nis">NIS</label>
                                    <div class="col-sm-9 col-sm-9 col-xs-12">
                                        <input type="number" name="student_nis" id="student_nis" class="form-control" placeholder="NIS">
                                        <span class="help-block" align="left"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="student_password">Password</label>
                                    <div class="col-sm-9 col-sm-9 col-xs-12">
                                        <input type="password" name="student_password" id="student_password" class="form-control" placeholder="Password">
                                        <span class="help-block" align="left"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="student_email">Email</label>
                                    <div class="col-sm-9 col-sm-9 col-xs-12">
                                        <input type="email" name="student_email" id="student_email" class="form-control" placeholder="Email" required>
                                        <span class="help-block" align="left"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="student_phone">Nomor HP</label>
                                    <div class="col-sm-9 col-sm-9 col-xs-12">
                                        <input type="number" name="student_phone" id="student_phone" class="form-control" placeholder="Telephone Number">
                                        <span class="help-block" align="left"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="id_class">Kelas</label>
                                    <div class="col-sm-9 col-sm-9 col-xs-12">
                                        <select class="form-control" name="id_class">
                                        	<option value="">--Pilih Kelas--</option>
                                        	<?php foreach($dataKelas as $kelas){ ?>
                                        		<option value="<?php echo $kelas->id_class ?>"><?php echo $kelas->class_name?>
                                        		</option>
                                        	<?php } ?>
                                        </select>
                                        <span class="help-block" align="left"></span>
                                    </div>
                                </div>
                                <div class="form-group" id="photo-preview">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto Siswa</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12" align="left">
                                        (No Result)
                                    <span class="help-block"></span>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="student_photo" id="label-photo">Upload Foto</label>
                                    <div class="col-sm-9 col-sm-9 col-xs-12">
                                        <input type="file" name="student_photo" id="student_photo" class="form-control">
                                        <span class="help-block" align="left"></span>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save()">Save changes</button>
                </div>
                </form>
            </div>
        </div>
</div>