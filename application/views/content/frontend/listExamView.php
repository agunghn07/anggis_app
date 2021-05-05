            <?php $this->load->view('script/frontend/s_listExam') ?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>List Ujian kelas : <?php echo $dataClassStudent->class_name; ?></h5> 
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                            <?php if($dataAssignments == NULL){ ?>
                              <div class="alert alert-success">
                                <ul class="fa-ul">
                                  <li>
                                    <i class="fa fa-info-circle fa-lg"></i>&ensp;<strong>Mohon maaf !</strong> Ujian belum tersedia, harap hubungi guru anda dan silahkan refresh halaman jika ujian sudah tersedia. Terima Kasih : )
                                  </li>
                                </ul>
                              </div> 
                            </div>
                            <?php }else{ ?>
                              <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="assignment" width="100%" align="center">
                                  <thead>
                                    <tr>
                                      <th width="5%">No</th>
                                      <th>Pelajaran - Tipe</th>
                                      <th>KKM</th>
                                      <th>LamaUjian</th>
                                      <th>Soal</th>
                                      <th>Penulis</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                        <?php foreach ($dataAssignments as $row => $value) { ?>
                                            <tr>
                                                <td><?php echo $row + 1 ?></td>
                                                <td><?php echo $value->lesson_name.' - '.$value->assignment_type ?></td>
                                                <td><?php echo $value->assignment_kkm ?>%</td>
                                                <td><?php echo $value->assignment_duration ?> Menit</td>
                                                <td><?php echo $value->totalQuestion ?> Soal</td>
                                                <td><?php echo $value->assignment_author ?></td>
                                                <td>
                                                    <a href="#question<?= $row ?>" data-toggle="modal" class="btn btn-primary"><i class="fa fa-pencil"></i> Ujian</a>
                                                </td>
                                            </tr>
                                             <!-- MODAL -->
                                            <div class="modal fade" id="question<?= $row ?>">
                                              <div class="modal-dialog" style="width:30%">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" align="center">Anda sudah siap ingin melaksanakan ujian ?</h4>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <a href="<?= site_url('frontend/exam/begin/'.$value->id_assignment) ?>" class="btn btn-primary btn-block">Ya, Saya siap!</a>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- MODAL -->
                                        <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          <?php } ?>
                        </div>
                    </div>
                </div>
            </div>