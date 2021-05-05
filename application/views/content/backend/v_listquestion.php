                <?php $this->load->view('script/backend/s_question') ?>
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-sm-6">
                        <h2>Online Exam</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url('MainPage') ?>">Dashboard</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('backend/assignment') ?>">Buat Ujian</a>
                            </li>
                            <li class="active">
                                <strong>Daftar Soal</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6" align="right">
                      <br><br>
                      <a class="btn btn-info" href="<?php echo site_url('backend/Question/create_question/'.$dataAssignment->id_assignment)?>"><i class="fa fa-plus"> Tambahkan Soal</i></a>
                      <a href="<?php echo site_url('backend/Assignment') ?>" class="btn btn-warning btn-md"><i class="fa fa-arrow-circle-left"> Kembali</i></a>
                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight"> 
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Daftar Soal <?= $dataAssignment->lesson_name; ?> Kelas 
                                  <?php foreach($dataClassroom as $class){ echo "$class->class_name";} ?></h5> 
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
                              <div class="table-responsive">
                                  <table class="table table-striped table-bordered" id="question">
                                      <thead>
                                          <tr>
                                              <th width="5%">No</th>
                                              <th width="55%">Pertanyaan</th>
                                              <th width="15%">Total</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach ($dataAssignment->questions as $row => $value): ?>
                                          <tr>
                                              <td><?= $row + 1 ?></td>
                                              <td><?= $value->question_ ?></td>
                                              <td><?= $value->totalAnswer ?> Jawaban</td>
                                              <td>
                                                  <a title="Lihat detail" href="<?= site_url('backend/Question/detail_question/'.$dataAssignment->id_assignment.'/'.$value->id_question) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                  <a title="Edit soal" href="<?= site_url('backend/Question/edit_question/'.$dataAssignment->id_assignment.'/'.$value->id_question) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                  <a href="#delete<?= $row ?>" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                              </td>
                                          </tr>
                                          <!-- MODAL DELETE -->
                                          <div class="modal fade" id="delete<?= $row ?>">
                                              <div class="modal-dialog" style="width:30%">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                          <h4 class="modal-title" align="center">Anda yakin ingin menghapus soal ini ?</h4>
                                                      </div>
                                                      <div class="modal-footer">
                                                          <a href="<?= site_url('backend/question/removeQuestion/'.$value->id_question.'/'.$dataAssignment->id_assignment.'/'.$dataAssignment->assignment_path) ?>" class="btn btn-primary btn-block">Ya, Hapus soal ini!</a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                        <?php endforeach ?>
                                      </tbody>
                                  </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>