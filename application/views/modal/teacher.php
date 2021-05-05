<div class="modal inmodal" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h5 class="modal-title"></h5>
                    
                </div>
                <div class="modal-body">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> Data Guru</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">Pilih Pelajaran</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3">Pilih Kelas</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <form id="form" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="teacher_name">Nama Lengkap</label>
                                            <div class="col-sm-9 col-sm-9 col-xs-12">
                                                <input type="hidden" name="id_teacher" id="id_teacher">
                                                <input type="text" name="teacher_name" id="teacher_name" class="form-control">
                                                <span class="help-block" align="left"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="teacher_username">Username</label>
                                            <div class="col-sm-9 col-sm-9 col-xs-12">
                                                <input type="text" name="teacher_username" id="teacher_username" class="form-control">
                                                <span class="help-block" align="left"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="teacher_password">Password</label>
                                            <div class="col-sm-9 col-sm-9 col-xs-12">
                                                <input type="password" name="teacher_password" id="teacher_password" class="form-control">
                                                <span class="help-block" align="left"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="teacher_email">Email</label>
                                            <div class="col-sm-9 col-sm-9 col-xs-12">
                                                <input type="email" name="teacher_email" id="teacher_email" class="form-control" required>
                                                <span class="help-block" align="left"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="teacher_phone">Nomor Telepon</label>
                                            <div class="col-sm-9 col-sm-9 col-xs-12">
                                                <input type="number" name="teacher_phone" id="teacher_phone" class="form-control">
                                                <span class="help-block" align="left"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="teacher_address">Alamat</label>
                                            <div class="col-sm-9 col-sm-9 col-xs-12">
                                                <input type="text" name="teacher_address" id="teacher_address" class="form-control">
                                                <span class="help-block" align="left"></span>
                                            </div>
                                        </div>
                                        <div class="form-group" id="photo-preview">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto Guru</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12" align="left">
                                                (No Result)
                                            <span class="help-block"></span>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3 col-sm-3 col-xs-12" for="teacher_photo" id="label-photo">Upload Foto</label>
                                            <div class="col-sm-9 col-sm-9 col-xs-12">
                                                <input type="file" name="teacher_photo" id="teacher_photo" class="form-control">
                                                <span class="help-block" align="left"></span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Pelajaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($dataMapel as $mapel){ ?>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox checkbox-info">
                                                            <input type="checkbox" name="id_lesson[]" value="<?php echo $mapel->id_lesson ?>">
                                                            <label for="">
                                                                <?php echo $mapel->lesson_name ?>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($dataKelas as $kelas) { ?> 
                                                <tr>
                                                    <td>
                                                        <div class="checkbox checkbox-info">
                                                            <input type="checkbox" name="id_class[]" value="<?php echo $kelas->id_class ?>">
                                                            <label for="">
                                                                <?php echo $kelas->class_name ?>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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