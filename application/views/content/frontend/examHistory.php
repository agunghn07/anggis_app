            <script type="text/javascript">
              $(document).ready(function(){

                table = $('#history').DataTable({ 

                        "processing": true, //Feature control the processing indicator.
                        "order": [], //Initial no order.

                        //Set column definition initialisation properties.
                        "columnDefs": [
                            { 
                                "targets": [ ], //last column
                                "orderable": false, //set not orderable
                            },
                        ],

                    });
              });
            </script>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Riwayat Ujian</h5> 
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
                                      <i class="fa fa-info-circle fa-lg"></i>&ensp;<strong>Maaf !</strong> Anda belum mengerjakan ujian satu pun, mohon untuk menyelasaikan ujian anda dan melihat hasilnya disini. Terima kasih: )
                                    </li>
                                  </ul>
                                </div> 
                              </div>
                            <?php }else{ ?>
                              <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="history" width="100%" align="center">
                                  <thead>
                                    <tr>
                                      <th width="5%">No</th>
                                      <th>Pelajaran - Tipe</th>
                                      <th>KKM</th>
                                      <th>LamaUjian</th>
                                      <th>Soal</th>
                                      <th>Penulis</th>
                                      <th>Dikumpulkan</th>
                                      <th>Hasil Ujian</th>
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
                                                <td><?php echo $value->resultCreated ?></td>
                                                <td>
                                                    <?php if ($value->show_report == 1): ?>
                                                      <a href="<?= site_url('frontend/exam/report/'.$value->id_assignment) ?>" class="btn btn-primary"><i class="fa fa-file"></i> Lihat</a>
                                                    <?php else: ?>
                                                        <span class="label label-warning">Tidak diperbolehkan melihat</span>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
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