                <?php $this->load->view('script/backend/s_student') ?>
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Online Exam</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url('backend/student') ?>">Tambah Siswa</a>
                            </li>
                            <li class="active">
                                <strong>Daftar Siswa</strong>
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
                                <h5>Daftar Siswa</h5> 
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
                               <form id="form-filter" class="form-horizontal">
                                 <div class="form-group">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                         <select class="form-control" id="id_classroom" name="id_classroom">
                                           <option value="">Semua Kelas</option>
                                            <?php foreach($dataKelas as $kelas) { ?>
                                              <option value="<?php echo $kelas->class_name ?>"><?php echo $kelas->class_name ?></option>
                                            <?php } ?>
                                         </select>
                                      <span class="help-block" align="left"></span>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                      <button type="button" id="btn-filter" class="btn btn-primary" >Filter</button>
                                      <a href="#" class="btn btn-info" onclick="add()">Tambahkan Siswa</a>
                                    </div>
                                  </div>
                              </form>
                              <hr>
                              <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="student" width="100%" align="center">
                                  <thead>
                                    <tr>
                                      <th width="5%"><i class="fa fa-cog"></i></th>
                                      <th>Foto</th>
                                      <th>Nama Siswa</th>
                                      <th>NIS</th>
                                      <th>Kelas</th>
                                      <!--<th>Telepon</th>-->
                                      <th>Email</th>
                                      <th>Tanggal Ditambah</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody></tbody>
                                </table>
                              </div>
                              <?php $this->load->view('modal/student') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div

