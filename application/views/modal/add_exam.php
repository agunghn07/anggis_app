<div class="modal inmodal" id="classes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h5 class="modal-title">Daftar Kelas</h5>        
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <div class="panel panel-default panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($dataClasses as $kelas) { ?> 
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
            <div class="modal-footer">
                <br><button type="button" class="btn btn-outline btn-primary btn-block" data-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>