<!-- MODAL IMAGE -->
    <div class="modal inmodal fade" id="imageQuestion" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width: 30%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span></button>
                    <small class="modal-title">Ganti Gambar (max. 2mb)</small>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group" id="photo-preview">
                            <center>
                                <img class="img-responsive" id="image_question">
                            </center>
                        </div>
                        <div class="form-group">
                            <center>
                                <input type="file" name="question_image" id="question_image" class="form-control">
                            </center>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline btn-info btn-block" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
<!-- MODAL SOUND -->
<div class="modal modal-success fade" id="soundQuestion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-inverse">Unggah Suara (max. 2mb, .mp3)</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="file" name="question_sound" class="form-control">
                    <?php if ($dataQuestion->question_sound != ''): ?>
                        <audio class="audio" src="<?= base_url('assets/images/assignments/'.$dataAssignment->assignment_path.'/'.$dataQuestion->question_sound) ?>" type="audio/mp3"></audio>
                    <?php endif ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success btn-block" data-dismiss="modal">Simpan!</button>
            </div>
        </div>
    </div>
</div>