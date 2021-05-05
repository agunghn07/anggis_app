<div class="wrapper wrapper-content animated fadeInRight m-r-sm m-l-sm">
    <div class="container">
        <div class="ibox-content shadowBox" id="ibox-content">

            <div id="vertical-timeline" class="vertical-container dark-timeline">
            
                <?php foreach($approvalTracking as $tracking) { ?>
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon <?php echo ($tracking['read_dt'] != null ? "lazur-bg" : "navy-bg") ?>">
                            <?php if($tracking['read_dt'] != null){ ?>
                                <i class="fa fa-envelope-open"></i>
                            <?php }else{ ?>
                                <i class="fa fa-envelope"></i>
                            <?php } ?>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2><?php echo $tracking['nama']; ?></h2>
                            <p style="margin-bottom: -7px;">
                                Menunggu persetujuan cuti (Nomor Pengajuan : <?php echo $tracking['nomor_cuti'] ?>) oleh <?php echo $tracking['nama']; ?> - <?php echo $tracking['posisi']; ?>
                            </p></p><strong><?php echo $tracking['divisi']; ?></strong></p>
                            <?php if($tracking['status'] != null) { ?>
                                <a href="#" class="btn btn-sm <?php echo $tracking['status'] == 'Rejected' ? "btn-danger" : ($tracking['status'] == 'Approved' ? "btn-info" : "btn-primary") ?> "> <?php echo $tracking['status']; ?></a>
                                <?php if($tracking['id_division'] == 'DK' && $tracking['status'] == 'Approved') { ?>
                                    <a href="<?php echo site_url('PersetujuanCuti/printSuratCuti') ?>" class="btn btn-sm btn-info btn-outline" style="margin-right: 10px;"><i class="fa fa-print"></i>&nbsp; Cetak Surat Cuti</a>
                                <?php } ?>
                            <?php } ?>
                            <span class="vertical-date">
                                <?php if($tracking['read_dt'] != null){ ?>
                                    Dibaca pada tanggal : <span style="color: #1ab394;"><?php echo date('d F Y - H:i:s', strtotime($tracking['read_dt'])) ?></span>
                                <?php } else { ?>
                                    <?php if($tracking['status'] == null) {?>
                                        <label class="label label-default">Belum Menerima Pengajuan</label>
                                    <?php } else { ?>
                                        <label class="label label-primary">Belum Dibaca</label>
                                    <?php } ?>
                                <?php } ?>
                            </span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>