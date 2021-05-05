                <?php $this->load->view('script/backend/s_result') ?>
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Online Exam</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url('MainPage') ?>">Dashboard</a>
                            </li>
                            <li class="active">
                                <strong>Hasil Ujian Siswa</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight"> 
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Exam Result</h5> 
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
                                <hr>
                            </div>
                            <div class="ibox-content"> 
                              <form action="<?php echo site_url('backend/result/result_assignment') ?>" method="POST">
                                <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                  <div class="">
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label> Nama Pelajaran</label>
                                        <select class="form-control" name="id_lesson" id="id_lesson" onchange="find(this.value)">
                                          <option value="0">-- Pilih Pelajaran --</option>
                                          <?php foreach($dataLessons as $row => $value){ ?>
                                            <option value="<?php echo $value->id_lesson ?>"><?php echo $value->lesson_name ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label>Kelas</label>
                                        <select class="form-control" name="id_class" id="id_class" readonly></select>
                                      </div>
                                    </div>
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label>Tipe Ujian</label>
                                        <select class="form-control" name="assignment_type" id="assignment_type" readonly></select>
                                      </div>
                                    </div>
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label>&ensp;</label>
                                        <button id="buttonSubmit" type="submit" class="btn btn-primary btn-outline btn-block">
                                          <i class="fa fa-search"> Cari</i>
                                        </button> 
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </form>

                              <?php if(isset($dataAssignments)){  ?>
                                <hr style="margin-top: 2px;">
                                <div class="">
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h3 class="panel-title">
                                        Hasil Ujian : <?= $dataLesson->lesson_name.' - '.$post['assignment_type'].' || Kelas : '. $dataClass->class_name ?>
                                      </h3>
                                    </div>
                                    <div class="panel-body">
                                      <table class="">
                                        <thead></thead>
                                        <tbody>
                                          <?php foreach($dataAssignments as $row => $value){ ?>
                                            <tr>
                                              <td width="20%"><strong>KKM : <?php echo $value->assignment_kkm ?> %</strong></td>
                                              <td width="50%"><strong>Dibuat pada tanggal : <?php echo $value->assignment_created ?></strong></td>
                                              <td width="20%"><strong>Penulis : <?php echo $value->assignment_author ?></strong></td>
                                              <td width="">
                                                <button type="button" onclick="openBox('<?= $row ?>')" class="btn btn-primary btn-sm btn-block">
                                                <i class="fa fa-eye">&ensp;Lihat</i></button>
                                              </td>
                                            </tr>
                                          <?php } ?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>

                                <?php foreach($dataAssignments as $r => $v){ ?>
                                  <div id="boxResult<?= $r ?>">
                                    <hr>
                                    <a href="<?php echo site_url('backend/result/result_pdf/'.$v->id_assignment.'/'.$dataClass->id_class) ?>" target="_blank" class="btn-info btn-sm"><i class="fa fa-download"></i>&ensp;Download Pdf</a>
                                    <h2 class="pull-right">KKM : <?php echo $v->assignment_kkm ?> %</h2>
                                    <br><br>
                                    <table class="table table-striped" id="result">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NIS</th>
                                                <th>Nama Siswa</th>
                                                <th>Benar</th>
                                                <th>Salah</th>
                                                <th>Nilai</th>
                                                <th style="width:13%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $n = 1; foreach ($v->students as $rStudent => $vStudent): ?>
                                                <tr>
                                                    <td><?= $n ?></td>
                                                    <td><?= $vStudent->student_nis ?></td>
                                                    <td><?= $vStudent->student_name ?></td>
                                                    <?php if ($vStudent->result): ?>
                                                        <td><?= $vStudent->result->result_true ?> Soal</td>
                                                        <td><?= $vStudent->result->result_false ?> Soal</td>
                                                        <td><?= $vStudent->result->result_score ?>%</td>
                                                        <td>
                                                            <?php if ($vStudent->result->result_score < $v->assignment_kkm): ?>
                                                                <button type="button" class="btn btn-danger btn-sm btn-block">GAGAL</button>
                                                            <?php else: ?>
                                                                <button type="button" class="btn btn-info btn-sm btn-block">LULUS</button>
                                                            <?php endif ?>
                                                        </td>
                                                    <?php else: ?>
                                                        <td>Belum Mengerjakan</td>
                                                        <td>Belum Mengerjakan</td>
                                                        <td>Belum Mengerjakan</td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm btn-block">Belum Mengerjakan</button>
                                                        </td>
                                                    <?php endif ?>
                                                </tr>
                                            <?php $n++; endforeach ?>
                                        </tbody>
                                    </table>
                                  </div>
                                <?php } ?>
                                <script type="text/javascript">
                                  $(function(){
                                      closeBoxes();
                                  });
                                  function closeBoxes() {
                                      var count = '<?= count($dataAssignments); ?>';
                                      for (var i = 0; i < count; i++) {
                                          $("#boxResult"+i).hide();
                                      };
                                  }
                                  function openBox(row) {
                                      closeBoxes();
                                      $("#boxResult"+row).show();
                                  }
                              </script>
                              <?php } ?>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>