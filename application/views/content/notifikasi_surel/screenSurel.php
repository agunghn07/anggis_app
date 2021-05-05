<div class="fh-breadcrumb animated fadeInRight">
    <?php if(count($listMessages) != 0) { ?>
        <div class="fh-column">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                <div class="full-height-scroll" style="overflow: auto; width: auto; height: 100%;">
                    <ul class="list-group elements-list">
                        <?php foreach($listMessages as $list){ ?>
                            <li data-toggle="tab" class="list-group-item" style="cursor: pointer;" id="panelSurel" onclick="getMessage('<?php echo $list->nomor_cuti; ?>', <?php echo $list->id_email; ?>, this)" 
                                data-idemail="<?php echo $list->id_email; ?>"
                                data-nomorcuti="<?php echo $list->nomor_cuti; ?>" 
                                data-division="<?php echo $list->division; ?>" 
                                data-picnoreg="<?php echo $list->pic; ?>" data-noreg="<?php echo $list->noreg; ?>">
                                <small class="pull-right text-muted">
                                    <?php echo date('d-m-Y', strtotime($list->receive_dt)); ?></small>
                                <strong id="namaPengirim"><?php echo $list->name; ?></strong>
                                <div class="small m-t-xs">
                                    <p class="m-b-xs"><?php echo $list->subject; ?> </p>
                                    <p class="m-b-none">
                                        <?php if($list->read_status == 0) { ?>
                                            <span class="label pull-right label-info" id="readStatus">New Message</span>
                                        <?php } ?>
                                        <i class="fa fa-map-marker"></i>
                                        <?php echo time_ago(date('H:i:s, d F Y', strtotime($list->receive_dt))); ?>
                                    </p>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="full-height">
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
            <div class="preloadEmail hide">
                <div class="spinnerDisplay"></div>
            </div>
            <div class="full-height-scroll white-bg border-left" style="overflow: auto; width: auto; height: 100%;">

                

                <div class="middle-box text-center <?php echo ($emailMessage != null ? "hide" : "") ?>" style="margin-top: 70px;" id="halamanSurel">
                    <i class="fa fa-envelope big-icon"></i>
                    <h2 class="font-bold" style="opacity: 0.7"><?php echo (count($listMessages) != 0 ? "Surat Elektronik" : "Tidak Ada Pesan") ?></h2>
                    <div class="error-desc" style="opacity: 0.7">
                        Jika ada pesan masuk, pilih salah satu panel disamping untuk menampilkan isi pesan ke bagian ini
                    </div>
                </div>
                <div class="element-detail-box">

                    <div class="tab-content">
                        
                        <div id="headerEmail" class="tab-pane animated <?php echo ($emailMessage != null ? "" : "hide") ?> active">
                            <div>
                                <div class="pull-right" style="margin-top: -5px;">
                                    <div class="tooltip-demo">
                                        <small id="receiveDate"><?php echo ($emailMessage != null ? $emailMessage['receive_date'] : "") ?></small><br>
                                        <span class="label pull-right <?php echo ($emailMessage == null ? "" : $emailMessage['isProcessed'] != 2) ? "label-primary" : "label-warning" ?>" id="isProcessed" style="margin-top: 2px;"><?php echo ($emailMessage == null ? "" : $emailMessage['isProcessed'] != 2) ? "Sudah diproses" : "Belum diproses" ?></span>
                                    </div>
                                </div>
                                <div class="small text-muted" style="margin-top: -10px; margin-bottom: 10px;">
                                    <img alt="image" class="img-circle" width="30px" height="30px" id="senderPhoto" src="<?php echo ($emailMessage != null ? base_url('assets/img/empPhoto/'.$emailMessage['photo']) : "") ?>" style="margin-top: -15px;">&nbsp;
                                    <div style="display: inline-block">
                                        <strong id="subjectEmail"><?php echo ($emailMessage != null ?  $emailMessage['subject'] : ""); ?></strong><br>
                                        <span id="positionSender"><?php echo ($emailMessage != null ?  $emailMessage['position'] : ""); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div id="isiSurat"><?php echo ($emailMessage != null ?  $emailMessage['message'] : ""); ?></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('content/notifikasi_surel/modalSurel') ?>