                
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
                                <form method="post" id="comment_form">
                                  <div class="form-group">
                                    <label>Enter Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label>Enter Comment</label>
                                    <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
                                  </div>
                                  <div class="form-group">
                                    <button type="submit" class="btn btn-info"/>Submit</button>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

