                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Online Exam</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url('MainPage') ?>">Dashhboard</a>
                            </li>
                            <li class="active">
                                <strong>Edit Guru</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight"> 
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="ibox float-e-margins">
                        <form role="form" method="POST" action="<?php echo site_url('backend/Teacher/update_teacher') ?>" enctype="multipart/form-data">
                          <div class="ibox-title">
                              <h5>Edit Data Guru</h5>
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
                              <div class="row">
                                    <div class="col-sm-4"><h4>Pilih Kelas</h4>
                                      <table class="table table-striped table-bordered"><hr>
                                        <thead>
                                        </thead>
                                        <tbody>
                                          <?php foreach($dataClasses as $classroom => $kelas){ ?>
                                            <?php
                                              $classActive = '';
                                              foreach($dataTeacher->classes as $_classroom => $_kelas){
                                                if($kelas->id_class == $_kelas->id_class){
                                                  $classActive = 'checked';
                                                }
                                              }
                                            ?>
                                            <tr>
                                              <td>
                                                <div class="checkbox checkbox-info">
                                                <input type="checkbox" <?= $classActive ?> name="id_class[]" 
                                                value="<?php echo $kelas->id_class ?>">
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
                                  <div class="col-sm-4">
                                      <h4 align="center">Teacher Photo</h4>
                                        <input type="hidden" name="id_teacher" value="<?= $dataTeacher->id_teacher ?>">
                                        <center>
                                          <img class="img-responsive" 
                                          src="<?php echo base_url('assets/img/foto_guru/').$dataTeacher->teacher_photo ?>">
                                        </center><br>
                                          <div class="form-group"><label>Nama Lengkap</label> <input type="text" placeholder="Enter Fullname" name="teacher_name" value="<?= $dataTeacher->teacher_name ?>" class="form-control" required></div>
                                          <div class="form-group"><label>Username</label> <input type="text" placeholder="Enter Username" name="teacher_username" value="<?= $dataTeacher->teacher_username ?>" class="form-control" required></div>
                                          <div class="form-group"><label>Password</label> <input type="password" placeholder="Boleh Dikosongkan" name="teacher_password" class="form-control"></div>
                                          <div class="form-group"><label>Email</label> <input type="email" placeholder="Enter Email" name="teacher_email" value="<?= $dataTeacher->teacher_email ?>" required class="form-control"></div>
                                          <div class="form-group"><label>Nomor Telepon</label> <input type="number" name="teacher_phone" placeholder="Enter Phone Number" value="<?= $dataTeacher->teacher_phone ?>" required class="form-control"></div>
                                          <div class="form-group"><label>Alamat</label> <input type="text" placeholder="Enter Address" name="teacher_address" value="<?= $dataTeacher->teacher_address ?>" class="form-control"></div>
                                          <div class="form-group"><label>Ganti Foto</label> <input type="file" class="form-control" name="teacher_photo" id="teacher_photo"></div>
                                          <div>
                                              <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Submit</strong></button>
                                          </div>
                                      </form>
                                  </div>
                                  <div class="col-sm-4"><h4>Pilih Pelajaran</h4>
                                      <table class="table table-striped table-bordered"><hr>
                                        <thead>
                                        </thead>
                                        <tbody>
                                          <?php foreach($dataLessons as $lesson => $mapel){ ?>
                                            <?php
                                              $classActive = '';
                                              foreach($dataTeacher->lessons as $_lesson => $_mapel){
                                                if($mapel->id_lesson == $_mapel->id_lesson){
                                                  $classActive = 'checked';
                                                }
                                              }
                                            ?>
                                            <tr>
                                              <td>
                                                <div class="checkbox checkbox-info">
                                                <input type="checkbox" <?= $classActive ?> name="id_lesson[]" 
                                                value="<?php echo $mapel->id_lesson ?>">
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
                          </div>
                        </form>
                      </div>
                  </div>
                </div>
            </div

