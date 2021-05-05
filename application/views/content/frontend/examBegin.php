            <?php $this->load->view('script/frontend/s_examBegin') ?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <!--Get tipe data ujian dan nama pelajaran -->
                                <h5><i class="fa fa-edit"></i> Ujian : <?php echo $dataAssignment->assignment_type.' - '.$dataAssignment->lesson_name ?></h5> 
                                <div class="ibox-tools">
                                <!-- END -->

                                <!-- COUNTDOWN  -->
                                  <span class="pull-right"><div id="countdown"></div></span>
                                  <span class="pull-right"><i class="fa fa-clock-o"></i> &nbsp;</span>
                                <!-- COUNTDOWN  -->
                                </div>
                            </div>
                            <div class="ibox-content"> 
                              <legend><i class="fa fa-list"> List Soal</i></legend>
                              <?php foreach($dataAssignment->questions as $rBottom => $vBottom) { ?>
                                <button id="buttonNavigation<?= $rBottom ?>" onclick="openQuestion('<?= $rBottom ?>')" type="botton" style="margin-bottom:5px" class="btn btn-flat btn-default"><?= $rBottom + 1 ?>
                                </button>
                              <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-file-text-o"></i>&ensp; Daftar Soal Ujian</h3>
                      </div>
                      <div class="panel-body">
                        <form action="<?php echo site_url('frontend/exam/calculate') ?>" method="POST">
                          <!-- Jumlah total pertanyaan  -->
                          <input type="hidden" id="totalQuestion" value="<?= count($dataAssignment->questions) ?>">
                          <input type="hidden" id="questNow" value="0">
                          <input type="hidden" name="id_assignment" value="<?= $dataAssignment->id_assignment ?>">
                          <?php foreach ($dataAssignment->questions as $rows => $value) { ?>
                            <input type="hidden" name="id_question[]" value="<?php echo $value->id_question ?>">
                            <script type="text/javascript">
                              $(function(){
                                //Validation Hide
                                var count = '<?php echo $rows ?>'
                                if(count > 0){
                                  $('#question'+count).hide();
                                }
                                //End
                              });
                            </script>
                            <div class="row" id="question<?= $rows ?>" class="globalQuestion">
                              <div class="col-sm-1" style="margin-right:-70px">
                                <p style="font-size:14px;margin-top:0px" class="number"><b><?= $rows + 1 ?>.</b></p>
                              </div>
                              <?php if ($value->question_image == ''): ?>
                                <div class="col-sm-11">
                                  <span style="color:black !important;font-size:14px"><?= $value->question_ ?></span>
                                  <?php if ($value->question_sound != ''): ?>
                                    <a href="#questionSound<?= $rows ?>" data-toggle="modal" class="btn btn-info pull-right"><i class="fa fa-play"></i> Putar Suara</a>
                                    <div class="modal fade" id="questionSound<?= $rows ?>">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Dengarkan baik baik</h4>
                                          </div>
                                          <div class="modal-body">
                                            <audio style="width:100%" src="<?= base_url('assets/img/assignments/'.$dataAssignment->assignment_path.'/'.$value->question_sound) ?>"></audio>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  <?php endif ?>
                                  <hr>
                                  <!-- OPTION -->
                                  <?php include('optionList.php') ?>
                                  <!-- END OPTION -->
                                </div>
                              <?php else: ?>
                                <div class="col-sm-3">
                                  <a data-fancybox="gallery" href="<?= base_url('assets/img/assignments/'.$dataAssignment->assignment_path.'/'.$value->question_image) ?>" ><img src="<?= base_url('assets/img/assignments/'.$dataAssignment->assignment_path.'/'.$value->question_image) ?>" class="img-thumbnail img-responsive"></a>
                                </div>
                                <div class="col-sm-7">
                                  <span style="color:black !important;font-size:14px"><?= $value->question_ ?></span>
                                  <hr>
                                  <?php if ($value->question_sound != ''): ?>
                                    <a href="#questionSound<?= $rows ?>" data-toggle="modal" class="btn btn-info pull-right"><i class="fa fa-play"></i> Putar Suara</a>
                                    <div class="modal fade" id="questionSound<?= $rows ?>">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Dengarkan file suara untuk menjawab pertanyaan</h4>
                                          </div>
                                          <div class="modal-body">
                                            <audio style="width:100%" src="<?= base_url('assets/img/assignments/'.$dataAssignment->assignment_path.'/'.$value->question_sound) ?>"></audio>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  <?php endif ?>
                                  <!-- OPTION -->
                                  <?php include('optionList.php') ?>
                                  <!-- END OPTION -->
                                </div>
                              <?php endif ?>
                            </div><!-- / Row -->
                          <?php } ?>
                          <div class="col-sm-4 col-sm-offset-8">
                            <br>
                            <center>
                              <button type="button" id="prev" onclick="prevQuest()" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                              <button type="button" id="next" onclick="nextQuest()" class="btn btn-flat btn-default">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                              <a id="finished" href="#finish" data-toggle="modal" class="btn btn-flat btn-block btn-primary"><i class="fa fa-check-square"></i> Kumpulkan!</a>
                            </center>
                          </div>
                          <!-- MODAL FINISH -->
                          <div class="modal fade" id="finish">
                            <div class="modal-dialog " style="width:35%">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title" align="center">Apa anda sudah yakin dengan jawaban anda ?</h4>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary btn-flat btn-block"><i class="fa fa-check-square"></i> Ya, simpan jawaban saya!</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- END MODAL FINISH -->
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>