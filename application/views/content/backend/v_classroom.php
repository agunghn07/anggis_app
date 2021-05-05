                <?php $this->load->view('script/backend/s_classroom') ?>
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Online Exam</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url('MainPage') ?>">Dashboard</a>
                            </li>
                            <li class="active">
                                <strong>Daftar Kelas</strong>
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
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">Daftar Kelas</h3>
                            </div>
                            <div class="panel-body">
                              <div class=""> 
                                <form id="form" action="#" method="POST" style="padding-bottom: 50px;">
                                  <div class="form-group">
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                      <label class="control-label col-md-6 col-sm-6 col-xs-12">&ensp;</label><br>
                                      <button type="button" id="btnReset" class="btn btn btn-default" onclick="resetdata()">
                                          <span id="reset">Reset</span>
                                        </button>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                      <label class="control-label col-md-8 col-sm-8 col-xs-12">Input Kelas</label>
                                      <input type="hidden" name="id_class" id="id_class">
                                      <input type="text" name="class_name" id="class_name" class="form-control" placeholder="Nama Kelas">
                                      <span class="help-block" align="left"></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                      <label class="control-label col-md-12 col-sm-12 col-xs-12">Action</label><br>
                                        <button type="submit" id="btnTambah" class="btn btn-primary">Tambah</button>
                                        <button type="button" id="btnUpdate" class="btn btn-info" onclick="update()">Edit</button>
                                    </div>
                                  </div>
                                </form>
                                <hr>
                                <div class="table-responsive" style="margin-left: 25px; margin-right: 25px;">
                                  <table id="classroom" class="table table-striped table-bordered table-hover" width="100%" align="center">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Nama Kelas</th>
                                        <th>Tanggal Ditambah</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>