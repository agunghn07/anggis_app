<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
    table td {
        vertical-align: top;
    }

    .container-email {
        display: block !important;
        margin: 0 auto !important;
        clear: both !important;
    }

    .content-email {
        font-family: Arial, sans-serif;
        font-size: 14px;
        margin: 40px 0px 30px 0px;
        display: block;
        padding: 5px;
    }

    .content-wrap-email {
        padding: 5px;
    }

    .content-block-email {
        padding: 0 0 20px;
    }

    .lineWrapper {
        border-bottom: 4px double #333;
        padding: 5px 0;
        margin-bottom: 25px;
    }

    .topTitle {
        text-align: center;
        margin: 10px;
    }
    </style>
</head>

<body>
    <div class="lineWrapper">
        <h3 class="topTitle">Surat Pengajuan Cuti Nomor Registrasi : <?php echo $empInfo['nomor_cuti']; ?></h3>
    </div>
    <table class="body-wrap-email">
        <tr>
            <td></td>
            <td class="container-email">
                <div class="content-email">
                    <table class="main-email" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content-wrap-email">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="content-block-email">
                                            Kepada <br>
                                            Yth. Bapak/Ibu Atasan
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block-email">
                                            Dengan hormat,
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block-email">
                                            Saya dengan keterangan sebagai berikut :
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block-email">
                                            <table>
                                                <tr>
                                                    <td>Nama</td>
                                                    <td>&emsp; :</td>
                                                    <td>&nbsp; <?php echo $empName; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor Registrasi</td>
                                                    <td>&emsp; :</td>
                                                    <td>&nbsp; <?php echo $empInfo['noreg']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Posisi</td>
                                                    <td>&emsp; :</td>
                                                    <td>&nbsp; <?php echo $posisi; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Divisi Karyawan</td>
                                                    <td>&emsp; :</td>
                                                    <td>&nbsp; <?php echo $divisi; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block-email">
                                            Hendak melakukan pengajuan cuti dari tanggal
                                            <?php echo date_format(date_create($empInfo['start_dt']), "d M Y") ; ?>
                                            sampai tanggal
                                            <?php echo date_format(date_create($empInfo['until_dt']), "d M Y"); ?>
                                            dengan alasan :
                                            <span
                                                style="font-style: italic;"><strong>"<?php echo $pesan; ?>"</strong>.</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block-email">
                                            Demikian surat elektronik ini dibuat, semoga Bapak/Ibu berkenan memberikan
                                            izin atas cuti saya.
                                            Atas perhatiannya, saya ucapkan terima kasih.
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table style="<?php echo ($id_division == "DK" ? "margin-left: 450px;" : "margin: 15px auto;"); ?>">
                        <tr>
                            <td style="text-align: center; width: 300px; ">
                                <span><?php echo $picInfo[0]['posisi']; ?></span><br>
                                <img src="<?php echo base_url('assets/img/Signature/').$picInfo[0]['signature']; ?>"
                                    style="width:100px; height:100px; margin-bottom: 5px;" alt="">
                                <p><?php echo $picInfo[0]['nama'] ;?></p>
                                <p><?php echo $picInfo[0]['divisi'] ;?></p>
                            </td>
                            <?php if($id_division != 'DK'){ ?>
                                <td style="text-align: center; width: 300px;">
                                    <span><?php echo $picInfo[1]['posisi']; ?></span><br>
                                    <img src="<?php echo base_url('assets/img/Signature/').$picInfo[1]['signature']; ?>"
                                        style="width:100px; height:100px; margin-bottom: 5px;" alt="">
                                    <p><?php echo $picInfo[1]['nama'] ;?></p>
                                    <p><?php echo $picInfo[1]['divisi'] ;?></p>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php if($id_position == 4 && $id_division != 'DK'){ ?>
                            <tr>
                                <td colspan="2" style="text-align: center; padding-top: 25px;">
                                    <span><?php echo $picInfo[2]['posisi']; ?></span><br>
                                    <img src="<?php echo base_url('assets/img/Signature/').$picInfo[2]['signature']; ?>"
                                        style="width:100px; height:100px; margin-bottom: 5px;" alt="">
                                    <p><?php echo $picInfo[2]['nama'] ;?></p>
                                    <p><?php echo $picInfo[2]['divisi'] ;?></p>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </td>
            <td></td>
        </tr>
    </table>

</body>

</html>