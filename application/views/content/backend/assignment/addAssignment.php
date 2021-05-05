				<?php $this->load->view('script/backend/s_assignment') ?>                
                <div class="row wrapper border-bottom white-bg page-heading">
                	<form action="<?php echo site_url('backend/assignment/create') ?>" method="POST">
	                    <div class="col-md-4 col-sm-4 col-xs-12">
	                        <h2>Online Exam</h2>
	                        <ol class="breadcrumb">
	                            <li>
	                                <a href="<?php echo base_url('MainPage') ?>">Dashboard</a>
	                            </li>
	                            <li class="active">
	                                <strong>Tambah Ujian</strong>
	                            </li>
	                        </ol>
	                    </div>
	                    <div class="col-md-5 col-sm-5 col-xs-12">
	                    	<br><br>
					            <div class="">
					                <label>
					                    <input type="checkbox" name="show_report" class="js-switch" data-color="#8253eb" data-size="small">
					                    <span class="text-muted mr-l-20 d-inline-block">Show Result</span>
					                    <input type="checkbox" name="show_analytic" class="js-switch_2" data-color="#8253eb" data-size="small">
					                    <span class="text-muted mr-l-20 d-inline-block">Analisis Soal</span>
					                </label>
					            </div>
	                    </div>
	                    <div class="col-md-3 col-sm-3 col-xs-12">
	                    	<br><br>
	                    	<button class="btn btn-outline btn-sm btn-rounded btn-success"><i class="fa fa-edit"> Save</i></button>
	                    	<button type="button" data-toggle="modal" data-target="#classes" class="btn btn-sm btn-outline btn-rounded btn-primary"><i class="fa fa-home"> Kelas &ensp;</i></button>
	                    </div>
	                </div>
	                <div class="wrapper wrapper-content animated fadeInRight"> 
	                  <div class="row">
	                    <div class="col-sm-12">
	                        <div class="ibox float-e-margins">
	                            <div class="ibox-title">
	                                <h5>Form Tambah Ujian</h5> 
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
                                    <h2>Input Data Ujian</h2>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Mata Pelajaran</label>
                                                <select class="form-control" name="id_lesson">
                                                	<?php foreach($dataLessons as $mapel){ ?>
                                                		<option value="<?php echo $mapel->id_lesson ?>"><?php echo $mapel->lesson_name ?></option>
                                                	<?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tipe Ujian</label>
                                                <input name="assignment_type" type="text" class="form-control required" 
                                                	placeholder="ex: UTS / UAS" >
                                                	<span style="color: red"><?= form_error('assignment_type') ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Urutkan Soal</label>
                                                <?php $order = [['val'=>'asc','name'=>'Urutkan Terlama'],['val'=>'desc','name'=>'Urutkan Terbaru'],['val'=>'random','name'=>'Acak Soal']] ?>
		                                        <select class="form-control" name="assignment_order">
		                                            <?php foreach ($order as $vOrder): ?>
		                                                <option value="<?= $vOrder['val'] ?>"><?= $vOrder['name'] ?></option>
		                                            <?php endforeach ?>
		                                        </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                        	<div class="form-group">
                                                <label>Nilai KKM</label>
                                                <input name="assignment_kkm" type="number" class="form-control required" 
                                                	placeholder="ex: 50" >
                                                <span style="color: red"><?= form_error('assignment_kkm') ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Durasi Ujian (Dalam Menit)</label>
                                                <input name="assignment_duration" type="number" class="form-control required" 
                                                	placeholder="Durasi Ujian(menit)" >
                                                <span style="color: red"><?= form_error('assignment_duration') ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Penulis Ujian</label>
                                                <input name="assignment_author" type="text" class="form-control required" 
                                                	placeholder="Pembuat Soal" >
                                                <span style="color: red"><?= form_error('assignment_author') ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="text-center">
                                                <div style="margin-top: 20px">
                                                    <i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $this->load->view('modal/add_exam') ?>
	                            </div>
	                        </div>
	                    </div>
	            	</form>
	            	<div class="col-lg-12">
	                    <div class="ibox float-e-margins">
	                       <div class="ibox-title">
	                            <h5>List Ujian</h5> 
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
	                            	<table id="assignment" class="table table-striped table-bordered" width="100%" align="center">
	                            		<thead>
	                            			<tr>
	                            				<th>Pelajaran - Tipe</th>
	                            				<th>KKM</th>
	                            				<!-- <th>Jumlah Soal</th> -->
	                            				<th>Penulis</th>
	                            				<th>Aktif</th>
	                            				<th>Tanggal Dibuat</th>
	                            				<th width="20%">Action</th>
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