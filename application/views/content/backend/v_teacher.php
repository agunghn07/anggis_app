                <?php $this->load->view('script/backend/s_teacher') ?>
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Online Exam</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url('MainPage') ?>">Dashboard</a>
                            </li>
                            <li class="active">
                                <strong>Daftar Guru</strong>
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
                                <h5>Daftar Guru</h5> 
                                <div class="ibox-tools">
                                    <a class="">
                                        <button class="btn btn-info btn-sm" onclick="add()">Tambahkan Guru</button>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content"> 
                              <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="teacher" width="100%" align="center">
                                  <thead>
                                    <tr>
                                      <th><i class="fa fa-cog"></i></th>
                                      <th>Foto</th>
                                      <th>Nama Guru</th>
                                      <th>Username</th>
                                      <th>Telepon</th>
                                      <th>Email</th>
                                      <th>Tanggal Ditambah</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody></tbody>
                                </table>
                              </div>
                              <?php $this->load->view('modal/teacher') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div

