				<?php $this->load->view('script/backend/s_assignment') ?>                
                <div class="row wrapper border-bottom white-bg page-heading">
                	<form action="<?php echo site_url('backend/Assignment/update') ?>" method="POST">
	                    <div class="col-md-4 col-sm-4 col-xs-12">
	                        <h2>Online Exam</h2>
	                        <ol class="breadcrumb">
	                            <li>
	                                <a href="<?php echo base_url('backend/Lesson') ?>">Buat Ujian</a>
	                            </li>
	                            <li class="active">
	                                <strong>Edit Ujian</strong>
	                            </li>
	                        </ol>
	                    </div>
	                    <div class="col-md-5 col-sm-5 col-xs-12">
	                    	<br><br>
					                <label>
					                    <input type="checkbox" name="show_report" class="js-switch" data-color="#8253eb" data-size="small" 
					                    <?php if($dataAssignment->show_report == 1): echo "checked"; endif;?> >
					                    <span class="text-muted mr-l-20 d-inline-block">Show Result</span>
					                    <input type="checkbox" name="show_analytic" class="js-switch_2" data-color="#8253eb" data-size="small" 
					                    <?php if($dataAssignment->show_analytic == 1): echo "checked"; endif; ?> >
					                    <span class="text-muted mr-l-20 d-inline-block">Analisis Soal</span>
					                </label>
	                    </div>
	                    <div class="col-md-3 col-sm-3 col-xs-12">
	                    	<br><br>
	                    	<button class="btn btn-outline btn-rounded btn-sm btn-success"><i class="fa fa-edit"> Save</i></button>
	                    	<button type="button" data-toggle="modal" data-target="#classes" class="btn btn-outline btn-rounded btn-sm btn-primary"><i class="fa fa-home"> Kelas &ensp;</i></button>
	                    </div>
	                </div>
	                <div class="wrapper wrapper-content animated fadeInRight"> 
	                  <div class="row">
	                    <div class="col-sm-12">
	                        <div class="ibox float-e-margins">
	                            <div class="ibox-title">
	                                <h5>Form Edit Ujian</h5> 
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
                                    <h2>Edit Data Ujian</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Mata Pelajaran</label>
                                                <select class="form-control" name="id_lesson">
                                                	<?php foreach($dataLessons as $mapel){ ?>
                                                		<option <?php if($mapel->id_lesson == $dataAssignment->id_lesson): echo "selected"; endif; ?> value="<?php echo $mapel->id_lesson ?>"><?php echo $mapel->lesson_name ?></option>
                                                	<?php } ?>
                                                </select>
                                                <input type="hidden" name="id_assignment" value="<?php echo $dataAssignment->id_assignment ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Tipe Ujian</label>
                                                <input name="assignment_type" type="text" class="form-control required" 
                                                	placeholder="ex: UTS / UAS" value="<?php echo $dataAssignment->assignment_type ?>">
                                                	<span style="color: red"><?= form_error('assignment_type') ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Urutkan Soal</label>
                                                <?php $order = [['val'=>'asc','name'=>'Urutkan Terlama'],['val'=>'desc','name'=>'Urutkan Terbaru'],['val'=>'random','name'=>'Acak Soal']] ?>
		                                        <select class="form-control" name="assignment_order">
		                                            <?php foreach ($order as $vOrder): ?>
		                                                <option <?php if($vOrder['val'] == $dataAssignment->assignment_order): echo "selected"; endif; ?> value="<?= $vOrder['val'] ?>"><?= $vOrder['name'] ?></option>
		                                            <?php endforeach ?>
		                                        </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                        	<div class="form-group">
                                                <label>Nilai KKM</label>
                                                <input name="assignment_kkm" type="number" class="form-control required" 
                                                	placeholder="ex: 50" value="<?php echo $dataAssignment->assignment_kkm ?>">
                                                <span style="color: red"><?= form_error('assignment_kkm') ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Durasi Ujian (Dalam Menit)</label>
                                                <input name="assignment_duration" type="number" class="form-control required" 
                                                	placeholder="Durasi Ujian(menit)" value="<?php echo $dataAssignment->assignment_duration ?>">
                                                <span style="color: red"><?= form_error('assignment_duration') ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Penulis Ujian</label>
                                                <input name="assignment_author" type="text" class="form-control required" 
                                                	placeholder="Pembuat Soal" value="<?php echo $dataAssignment->assignment_author ?>">
                                                <span style="color: red"><?= form_error('assignment_author') ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="text-center">
                                                <div style="margin-top: 20px">
                                                    <i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--MODAL-->
                                    <div class="modal inmodal" id="classes" tabindex="-1" role="dialog" aria-hidden="true">
									    <div class="modal-dialog modal-md">
									        <div class="modal-content animated bounceInRight">
									            <div class="modal-header">
									                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									                <h4 class="modal-title">Daftar Kelas</h4>        
									            </div>
									            <div class="modal-body">
									                <div class="panel-body">
									                    <div class="panel panel-default panel-body">
									                        <table class="table table-striped">
									                            <thead>
									                                <tr>
									                                    <th>Nama Kelas</th>
									                                </tr>
									                            </thead>
									                            <tbody>
									                            <?php foreach($dataClasses as $kelas) { ?> 
									                            	<?php 
									                            		$val = false;
									                            		foreach ($dataAssignment->classes as $key => $value) {
									                            			if($value->id_class == $kelas->id_class){
									                            				$val = true;
									                            			}
									                            		}
									                            	?>
									                                <tr>
									                                    <td>
									                                        <div class="checkbox checkbox-info">
									                                            <input <?php if($val): echo "checked"; endif; ?> type="checkbox" name="id_class[]" value="<?php echo $kelas->id_class ?>">
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
									                </div>
									            </div>
									            <div class="modal-footer">
									    	        <br><button type="button" class="btn btn-outline btn-primary btn-block" data-dismiss="modal">Save changes</button>
									            </div>
									        </div>
									    </div>
									</div>
	                            </div>
	                        </div>
	                    </div>
	            	</form>
	            </div>
           	</div>