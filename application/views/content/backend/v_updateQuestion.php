            <?php $this->load->view('script/backend/s_editQuestion') ?>
            <form method="POST" action="<?php echo site_url('backend/Question/update_question') ?>" enctype="multipart/form-data">
            <input type="hidden" name="id_assignment" value="<?php echo $dataAssignment->id_assignment ?>">  
            <input type="hidden" name="assignment_path" value="<?php echo $dataAssignment->assignment_path ?>">
            <input type="hidden" name="id_lesson" value="<?php echo $dataAssignment->id_lesson ?>">
            <input type="hidden" name="id_question" value="<?php echo $dataQuestion->id_question ?>">
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-sm-6">
                        <h2>Online Exam</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url('backend/assignment') ?>">Tambah Ujian</a>
                            </li>
                            <li class="active">
                                <strong>Edit Soal</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6" align="right">
                        <br><br><a href="<?php echo site_url('backend/Question/list_question/'.$dataAssignment->id_assignment) ?>" class="btn btn-warning">
                            <i class="fa fa-arrow-circle-left"> Kembali</i></a>
                        <button class="btn btn-info"><i class="fa fa-check-square-o"> Simpan</i></button>
                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight"> 
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Pertanyaan Soal <?= $dataAssignment->lesson_name ?></h5> 
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#">Config option 1</a>
                                        </li>
                                        <li><a href="#">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">    
                                <?php if($dataQuestion->question_image != ''){ ?>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img  class="img-thumbnail img-responsive" src="<?php echo base_url('assets/img/assignments/'.$dataAssignment->assignment_path.'/'.$dataQuestion->question_image) ?>">
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="question_" >
                                            <?= $dataQuestion->question_ ?>
                                            </textarea>
                                            <br>
                                            <a href="#imageQuestion" data-toggle="modal" class="btn btn-outline btn-primary btn-sm"><i class="fa fa-image">  </i> Ganti Gambar</a>
                                            <a href="#imageQuestion" data-toggle="modal" class="btn btn-outline btn-success btn-sm"><i class="fa fa-music">  </i> Ganti Suara</a>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <textarea class="form-control" name="question_" >
                                    <?= $dataQuestion->question_ ?>
                                    </textarea><br>
                                    <a href="#imageQuestion" data-toggle="modal" class="btn btn-outline btn-primary btn-sm">
                                        <i class="fa fa-image">  </i> Unggah Gambar</a>
                                    <a href="#imageQuestion" data-toggle="modal" class="btn btn-outline btn-success btn-sm">
                                        <i class="fa fa-music">  </i> Unggah Suara</a>
                                    <br>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Jawaban</h5> 
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#">Config option 1</a>
                                        </li>
                                        <li><a href="#">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">  
                                <button type="button" onclick="cloneAnswer()" class="btn btn-success" title="Tambah 1 Jawaban"><i class="fa fa-plus-circle"> Tambah Jawaban</i></button><hr>
                                <input type="hidden" name="totalAnswer" id="totalAnswer" value="<?= count($dataQuestion->options) -1 ?>">    
                                <input type="hidden" name="choosedAnswer" id="choosedAnswer" value="<?= $dataQuestion->trueAnswer ?>">
                                <input type="hidden" name="JSONanswer" id="JSONanswer">
                                <script type="text/javascript">
                                   var JSONanswer = [];
                                    $(function(){
                                        for (var forI = 0; forI < parseInt('<?= count($dataQuestion->options) ?>'); forI++) {
                                            var initAnswer = { row : forI };
                                            JSONanswer.push(initAnswer);
                                        };
                                        $("#JSONanswer").val(JSON.stringify(JSONanswer));
                                    });
                                </script>
                                <div id="option_">
                                    <!--lakukan perulangan untuk meng-GET beberapa option -->
                                    <?php for ($i=0; $i < count($dataQuestion->options) ; $i++) : ?>
                                        <script type="text/javascript">
                                            
                                            $(function(){
                                                var c = '<?= $i ?>';
                                                $('#option_image'+c).on('change', function(){
                                                    imagePreview(this);
                                                });

                                                var imagePreview = function(input){
                                                    if(input.files && input.files[0]){
                                                        var reader = new FileReader();

                                                        reader.onload = function(e){
                                                            $('#image_option'+c).attr('src', e.target.result);
                                                        }

                                                        reader.readAsDataURL(input.files[0]);
                                                    }
                                                };
                                            });
                                            
                                        </script>
                                        <div class="row" id="rowAnswer">
                                            <!--get id option -->
                                            <input type="hidden" name="id_option<?= $i ?>" value="<?= $dataQuestion->options[$i]->id_option ?>">
                                            <!--get id option -->
                                            <div class="col-sm-1">
                                                <!-- cek jika $dataQuestion->trueAnswer = $i dimana $i merupakan $data_question->option -->
                                                <div id="chooseAnswer<?= $i ?>" class="chooseAnswer <?php if($dataQuestion->trueAnswer == $i): echo "active"; endif; ?>" onclick="chooseAnswer('<?= $i ?>')">
                                                    <?php include "numberToChar.php"; ?>
                                                    <input type="hidden" name="option_char<?= $i ?>" 
                                                        value="<?php $char = include('numberToChar.php'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-11">
                                                <?php if($dataQuestion->options[$i]->option_image != ''){ ?>
                                                    <div class="row">
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control" style="height:150px" name="option_<?= $i ?>" data-toggle="tinymce"><?= $dataQuestion->options[$i]->option_ ?></textarea>
                                                            <a style="margin-top:10px" href="#answerImage<?= $i ?>" data-toggle="modal" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-image"></i>&nbsp; Ganti Gambar</a>
                                                            <a style="margin-top:10px" href="#option<?= $i, $dataQuestion->id_question, $dataAssignment->assignment_path, $dataQuestion->options[$i]->id_option ?>" data-toggle="modal" class="btn btn-sm btn-outline btn-danger"><i class="fa fa-trash"></i> Hapus Jawaban</a>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <img class="img-thumbnail img-responsive" src="<?php echo base_url('assets/img/assignments/'.$dataAssignment->assignment_path.'/'.$dataQuestion->options[$i]->option_image) ?>">
                                                        </div>
                                                        <!-- MODAL -->
                                                        <div class="modal fade" id="option<?= $i, $dataQuestion->id_question, $dataAssignment->assignment_path, $dataQuestion->options[$i]->id_option ?>">
                                                          <div class="modal-dialog" style="width:30%">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title" align="center">Anda yakin ingin menghapus jawaban ini ?</h4>
                                                              </div>
                                                              <div class="modal-footer">
                                                                <a href="<?= site_url('backend/question/deleteImageOption/'.$dataAssignment->id_assignment.'/'.$dataQuestion->id_question.'/'.$dataAssignment->assignment_path.'/'.$dataQuestion->options[$i]->id_option) ?>" class="btn btn-primary btn-block">Ya, Hapus Jawaban!</a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <!-- MODAL -->
                                                    </div>
                                                <?php }else{ ?>
                                                    <textarea class="form-control" style="height:150px" name="option_<?= $i ?>" data-toggle="tinymce"><?= $dataQuestion->options[$i]->option_ ?>
                                                    </textarea>
                                                    <a style="margin-top:10px" href="#answerImage<?= $i ?>" data-toggle="modal" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-image"></i>&nbsp; Unggah Gambar</a>
                                                    <!-- 
                                                    <a style="margin-top:10px" href="<?= site_url('backend/question/delete_option/'.$dataAssignment->id_assignment.'/'.$dataQuestion->id_question.'/'.$dataQuestion->options[$i]->id_option) ?>" onclick="return confirm('Anda yakin ingin menghapus jawaban ini ?')" class="btn btn-sm btn-outline btn-danger"><i class="fa fa-trash"></i>&nbsp; Hapus jawaban</a>
                                                    -->
                                                    <a style="margin-top:10px" href="#option<?= $i, $dataQuestion->id_question, $dataQuestion->options[$i]->id_option ?>" data-toggle="modal" class="btn btn-sm btn-outline btn-danger"><i class="fa fa-trash"></i> Hapus Jawaban</a>
                                                    <!-- MODAL -->
                                                    <div class="modal fade" id="option<?= $i, $dataQuestion->id_question, $dataQuestion->options[$i]->id_option ?>">
                                                      <div class="modal-dialog" style="width:30%">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" align="center">Anda yakin ingin menghapus jawaban ini ?</h4>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <a href="<?= site_url('backend/question/delete_option/'.$dataAssignment->id_assignment.'/'.$dataQuestion->id_question.'/'.$dataQuestion->options[$i]->id_option) ?>" class="btn btn-primary btn-block">Ya, Hapus Jawaban!</a>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!-- MODAL -->
                                                <?php } ?>
                                            </div>
                                        </div><!-- / Row -->

                                        <!-- MODAL IMAGE -->
                                        <div class="modal inmodal fade" id="answerImage<?= $i ?>" tabindex="-1" role="dialog"  aria-hidden="true">
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
                                                                    <img class="img-responsive" id="image_option<?= $i ?>">
                                                                </center>
                                                            </div>
                                                            <div class="form-group">
                                                                <center>
                                                                    <input type="file" name="option_image<?= $i ?>" id="option_image<?= $i ?>" class="form-control">
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
                                        <!-- MODAL IMAGE -->
                                    <?php endfor; ?>

                                    <script type="text/javascript">
                                        function cloneAnswer() {
                                            // TOTAL ANSWER //
                                            var totalAnswer = $("#totalAnswer").val();
                                            totalAnswer++;
                                            $("#totalAnswer").val(totalAnswer);
                                            // JSON ANSWER //
                                            var newInit = { row : totalAnswer };
                                            JSONanswer.push(newInit);
                                            $("#JSONanswer").val(JSON.stringify(JSONanswer));
                                            // FOR ANSWER //
                                            var _html = '';
                                            var alph = alphabet(totalAnswer);
                                            _html += '<div class="row" id="rowAnswer'+totalAnswer+'">';
                                                _html += '<div class="col-sm-1">';
                                                    _html += '<div id="chooseAnswer'+totalAnswer+'" class="chooseAnswer" onclick="chooseAnswer(\'' + totalAnswer + '\')"><span class="forAlph">'+alph+'</span></div>';
                                                    _html += '<input type="hidden" name="option_char'+totalAnswer+'" value="'+alph+'" >';
                                                _html += '</div>';
                                                _html += '<div class="col-sm-11">';
                                                    _html += '<textarea class="form-control" style="height:150px" name="option_'+totalAnswer+'" id="textareaBlank'+totalAnswer+'"></textarea>';
                                                    _html += '<a style="margin-top:10px" href="#answerImage'+totalAnswer+'" data-toggle="modal" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-image"></i>&nbsp; Unggah Gambar</a>';
                                                    _html += '<button type="button" style="margin-top:10px;margin-left:10px" onclick="removeAnswer(\'' + totalAnswer + '\')" class="btn btn-sm btn-outline btn-danger"><i class="fa fa-trash"></i>&nbsp; Hapus Jawaban</a>';
                                                _html += '</div>';
                                            _html += '</div>'; // ROW END
                                            // FOR MODAL IMAGE //
                                            _html += '<div class="modal inmodal fade" id="answerImage'+totalAnswer+'"> tabindex="-1" role="dialog"  aria-hidden="true"';
                                                _html += '<div class="modal-dialog" style="width: 30%">';
                                                    _html += '<div class="modal-content">';
                                                        _html += '<div class="modal-header">';
                                                            _html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                                                            _html += '<h4 class="modal-title text-inverse">Unggah Gambar (max. 2mb)</h4>';
                                                        _html += '</div>';
                                                        _html += '<div class="modal-body">';
                                                            _html += '<div class="form-body">';
                                                                _html += '<img class="img-responsive" id="image_option'+totalAnswer+'">';
                                                            _html += '</div>';
                                                            _html += '<div class="form-group">';
                                                                _html += '<input type="file" name="option_image'+totalAnswer+'" id="option_image'+totalAnswer+'" class="form-control">';
                                                            _html += '</div>';
                                                        _html += '</div>';
                                                        _html += '<div class="modal-footer">';
                                                            _html += '<button type="button" class="btn btn-info btn-outline btn-block" data-dismiss="modal">Simpan!</button>';
                                                        _html += '</div>';
                                                    _html += '</div>';
                                                _html += '</div>';
                                            _html += '</div>';
                                            // END MODAL IMAGE //
                                            _html += '<br />';
                                            swal("Great!", "Jawaban berhasil ditambah, periksa dibagian bawah!", "success");
                                            $("#appendAnswer").append(_html);
                                             // VALIDATION IMAGE //
                                            $('#option_image'+totalAnswer).on('change', function(){
                                                imagePreview(this);
                                            });

                                            var imagePreview = function(input){
                                                if(input.files && input.files[0]){
                                                    var reader = new FileReader();

                                                    reader.onload = function(e){
                                                        $('#image_option'+totalAnswer).attr('src', e.target.result);
                                                    }

                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            };
                                            
                                            tinymce.EditorManager.execCommand('mceAddEditor',true, "textareaBlank"+totalAnswer);
                                            // END VALIDATION IMAGE //
                                        }
                                    </script>
                                    <!-- FOR APPEND ANSWER -->
                                    <div id="appendAnswer"></div>
                                    <!-- FOR APPEND ANSWER -->
                                </div>
                                <script type="text/javascript">
                                    function chooseAnswer(count) {
                                        $.each($(".chooseAnswer"),function(i,v){
                                            $(this).removeClass('active');
                                        });
                                        $("#chooseAnswer"+count).addClass('active');
                                        $("#choosedAnswer").val(count);
                                    }
                                    function removeAnswer(row) {
                                        swal({
                                              title: "Anda yakin ?",
                                              text: "Ingin menghapus jawaban ini",
                                              type: "warning",
                                              showCancelButton: true,
                                              confirmButtonColor: "#DD6B55",
                                              confirmButtonText: "Hapus",
                                              cancelButtonText: "Batal",
                                              closeOnConfirm: false,
                                              closeOnCancel: false
                                            },
                                            function(isConfirm) {
                                                if (isConfirm) {
                                                    var choosedAnswer = $("#choosedAnswer").val();
                                                    var totalAnswer = $("#totalAnswer").val();
                                                    totalAnswer--;
                                                    $("#totalAnswer").val(totalAnswer);
                                                    if (row === choosedAnswer) {
                                                        chooseAnswer(0);
                                                    };
                                                    $("#rowAnswer"+row).remove();
                                                    swal("Deleted!", "Jawaban Telah Dihapus !", "success");
                                                    // RE-PUSH JSONanswer
                                                    JSONanswer.splice(row,1);
                                                    $("#JSONanswer").val(JSON.stringify(JSONanswer));
                                                    recount();
                                                } else {
                                                swal("Cancelled", "Tidak jadi menghapus jawaban !", "error");
                                            }
                                        }); 
                                    }
                                    function recount() {
                                        var x = 1;
                                        $.each($(".forAlph"),function(){
                                            $(this).text(alphabet(x));
                                            x++;
                                        });
                                    }
                                </script>
                                <!-- END OPTION -->

                                <!-- MODAL-->
                                <?php $this->load->view('modal/edit_question') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>