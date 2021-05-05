<?php $this->load->view('script/frontend/s_result') ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                <!--Get tipe data ujian dan nama pelajaran -->
                <h5><i class="fa fa-edit"></i> Laporan Hasil Ujian </h5> 
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="ibox-content">
                    <div class="row" style="margin-left: 20px; margin-right: 20px;">
                        <div class=""> 
                            <div class="col-lg-3">
                                <div class="widget style1 lazur-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-check-square fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">
                                            <h3> Total Benar</h3>
                                            <h2 class="font-bold"><?php echo $dataResult->result_true ?> Soal</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="widget style1 yellow-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-times fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">
                                            <h3> Total Salah </h3>
                                            <h2 class="font-bold"><?php echo $dataResult->result_false ?> Soal</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="widget style1 navy-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-edit fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">
                                            <h3> Hasil Nilai </h3>
                                            <h2 class="font-bold"><?php echo $dataResult->result_score ?> %</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($dataResult->result_score < $dataAssignment->assignment_kkm){ ?>
                                <div class="col-lg-3">
                                    <div class="widget style1 red-bg">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <i class="fa fa-exclamation fa-5x"></i>
                                            </div>
                                            <div class="col-xs-8 text-right">
                                                <h3> Keterangan</h3>
                                                <h2 class="font-bold">Gagal</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }else{?>
                                <div class="col-lg-3">
                                    <div class="widget style1 blue-bg">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <i class="fa fa-graduation-cap fa-5x"></i>
                                            </div>
                                            <div class="col-xs-8 text-right">
                                                <h3> Keterangan</h3>
                                                <h2 class="font-bold">Lulus</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="">
                            <?php if($dataAssignment->show_analytic == 1){ ?>
                                <table class="table table-striped table-bordered" id="result">
                                    <thead>
                                        <tr>
                                            <th >No</th>
                                            <th>Pertanyaaan</th>
                                            <th>Jawaban Benar</th>
                                            <th >Jawaban Anda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataAnalytics as $row => $value) { ?>
                                            <tr>  
                                                <td><?php echo $row + 1 ?></td>
                                                <td><?php echo $value->question_ ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-white">
                                                        <i class="fa fa-thumbs-up">
                                                            Jawaban Benar : <?php $char = $value->trueAnswer->option_char; echo $char?>
                                                        </i>
                                                    </button>
                                                    <?= $value->trueAnswer->option_ ?>
                                                </td>
                                                <td>
                                                    <?php if($value->id_option == 0){ ?>
                                                        <button class="btn btn-sm btn-warning">
                                                            <i class="fa fa-exclamation"> 
                                                                Jawaban tidak diisi atau kosong
                                                            </i>
                                                        </button>
                                                    <?php }else{ ?>
                                                        <?php if ($value->option_char == $char): ?>
                                                            <button class="btn btn-sm btn-primary">
                                                                <i class="fa fa-check">
                                                                    Jawaban Anda : <?= $value->option_char?>
                                                                </i>
                                                            </button>
                                                            <span style="color: green"><?= $value->studentChoosed->option_ ?></span>
                                                        <?php else: ?>
                                                            <button class="btn btn-sm btn-danger">
                                                                <i class="fa fa-times">
                                                                    Jawaban Anda : <?= $value->option_char?>
                                                                </i>
                                                            </button>
                                                            <span style="color: red"><?= $value->studentChoosed->option_ ?></span>
                                                        <?php endif ?>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php }else{ ?>
                                <div class="alert alert-success">
                                    <ul class="fa-ul">
                                      <li>
                                        <center>
                                            <i class="fa fa-info-circle fa-lg"></i><strong>&ensp;Maaf !</strong> Siswa tidak diizinkan untuk melihat laporan analisis soal ini. Laporan akan ditampilkan dibawah jika siswa diizinkan untuk melihat. Terima kasih : )
                                        </center>
                                      </li>
                                    </ul>
                                </div>  
                            <?php } ?>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>