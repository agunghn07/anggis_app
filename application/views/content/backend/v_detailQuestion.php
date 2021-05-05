                
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-sm-6">
                        <h2>Online Exam</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url('backend/assignment') ?>">Tambah Ujian</a>
                            </li>
                            <li class="active">
                                <strong>Daftar Soal</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6" align="right">
                      <br><br>
                      <a class="btn btn-info" href="<?php echo base_url('backend/question/list_question/'.$dataAssignment->id_assignment)?>"><i class="fa fa-arrow-circle-left"> Kembali
                      </i></a>
                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight"> 
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Pertanyaan</h5> 
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
                              <div class="question_">
                                  <div class="row">
                                      <?php if ($dataQuestion->question_image != ''): ?>
                                          <div class="col-sm-12">
                                      <?php else: ?>
                                          <div class="col-sm-12">
                                      <?php endif; ?>
                                          <h5><?= $dataQuestion->question_ ?></h5>
                                          <?php if ($dataQuestion->question_sound != ''): ?>
                                              <a href="#playMusic" data-toggle="modal" class="btn btn-sm btn-outline-primary"><i class="feather feather-music"></i>&nbsp; Mainkan Suara</a>
                                              <div class="modal modal-primary fade" id="playMusic">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                              <h4 class="modal-title text-inverse">Mainkan Suara</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                              <audio class="audio" src="<?= base_url('assets/images/assignments/'.$dataAssignment->assignment_path.'/'.$dataQuestion->question_sound) ?>" type="audio/mp3"></audio>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          <?php endif ?>
                                      </div>
                                      <?php if ($dataQuestion->question_image != ''): ?>
                                          <div class="col-sm-5">
                                              <a href="<?= base_url('assets/img/assignments/'.$dataAssignment->assignment_path.'/'.$dataQuestion->question_image) ?>"><img width="70%" height="70%" src="<?= base_url('assets/img/assignments/'.$dataAssignment->assignment_path.'/'.$dataQuestion->question_image) ?>" class="img-thumbnail"></a>
                                          </div>
                                      <?php endif ?>
                                  </div><!-- / Row -->
                              </div><!-- / Question -->
                              <br>
                              <legend>Jawaban</legend>
                              <div class="option_">
                                  <?php foreach ($dataQuestion->options as $row => $value): ?>
                                      <div class="row" style="margin-bottom:20px;border-bottom:1px solid #E9E9E9">
                                          <div class="col-sm-1">
                                              <center><?php $i = $row; include "numberToChar.php"; ?></center>
                                          </div>
                                          <div class="col-sm-11">
                                              <div class="row">
                                                  <?php if ($value->option_image != ''): ?>
                                                      <div class="col-sm-12">
                                                  <?php else : ?>
                                                      <div class="col-sm-12">
                                                  <?php endif; ?>
                                                      <?php if ($value->option_true == 1): ?>
                                                          <div class="alert alert-success" style="padding:5px">
                                                              Jawaban Benar
                                                          </div>
                                                      <?php endif ?>
                                                      <?= $value->option_ ?>
                                                  </div>
                                                  <?php if ($value->option_image != ''): ?>
                                                      <div class="col-sm-12">
                                                          <a data-fancybox="gallery" href="<?= base_url('assets/img/assignments/'.$dataAssignment->assignment_path.'/'.$value->option_image) ?>"><img style="margin-bottom:10px;" height="20%" width="20%" src="<?= base_url('assets/img/assignments/'.$dataAssignment->assignment_path.'/'.$value->option_image) ?>" class="img-thumbnail"></a>
                                                      </div>
                                                  <?php endif ?>
                                              </div><!-- / Row -->
                                          </div>
                                      </div><!-- / Row -->
                                  <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>