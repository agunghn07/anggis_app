<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Surat Elektronik <?php echo $empInfo['nomor_cuti']; ?></title>
    <style>

        /* make sure all tables have defaults */
        table td {
            vertical-align: top;
        }

        .body-wrap-email {
            background-color: #f6f6f6;
            width: 100%;
        }

        .container-email {
            display: block !important;
            max-width: 600px !important;
            margin: 0 auto !important;
            clear: both !important;
        }

        .content-email {
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            font-size: 13px;
            max-width: 600px;
            margin: 0 auto;
            display: block;
            padding: 20px;
        }

        .main-email {
            background: #fff;
            border: 1px solid #e9e9e9;
            border-radius: 3px;
        }

        .content-wrap-email {
            padding: 20px;
        }

        .content-block-email {
            padding: 0 0 20px;
        }

        .btn-primary-email {
            text-decoration: none;
            color: #FFF !important;
            background-color: #1ab394;
            border: solid #1ab394;
            border-width: 5px 10px;
            line-height: 2;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
            text-transform: capitalize;
        }

        .alert-email {
            font-size: 16px;
            color: #fff;
            font-weight: 500;
            padding: 20px;
            text-align: center;
            border-radius: 3px 3px 0 0;
        }

        .alert-email.alert-good-email {
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            font-size: 16px;
            background: #1ab394;
        }

        /* RESPONSIVE AND MOBILE FRIENDLY STYLES*/
        @media only screen and (max-width: 640px) {
            #templateSurel h1, #templateSurel h2, #templateSurel h3, #templateSurel h4 {
                font-weight: 600 !important;
                margin: 20px 0 5px !important;
            }

            #templateSurel h1 {
                font-size: 22px !important;
            }

            #templateSurel h2 {
                font-size: 18px !important;
            }

            #templateSurel h3 {
                font-size: 16px !important;
            }

            .container-email {
                width: 100% !important;
            }

            .content-email, .content-wrap-email {
                padding: 10px !important;
            }
        }

    </style>
</head>

<body>

    <table class="body-wrap-email">
        <tr>
            <td></td>
            <td class="container-email" width="600">
                <div class="content-email">
                    <table class="main-email" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="alert-email alert-good-email">
                            Surel Pengajuan Cuti Dengan Nomor Registrasi : <?php echo $empInfo['nomor_cuti']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="content-wrap-email">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="content-block-email">
                                            Kepada <br>
                                            Yth. Bapak/Ibu <span><?php echo $kepada; ?></span><br>
                                            <span><?php echo $divisi; ?></span>
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
                                            Hendak melakukan pengajuan cuti dari tanggal <?php echo date_format(date_create($empInfo['start_dt']), "d M Y") ; ?> 
                                            sampai tanggal <?php echo date_format(date_create($empInfo['until_dt']), "d M Y"); ?> dengan alasan : 
                                            <span style="font-style: italic;"><strong>"<?php echo $empInfo['alasan']; ?>"</strong>.</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block-email">
                                            Demikian surat elektronik ini dibuat, semoga Bapak/Ibu berkenan memberikan izin atas cuti saya. 
                                            Atas perhatiannya, saya ucapkan terima kasih.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block-email">
                                            <a href="<?php echo site_url('NotifikasiSurel') ?>" data-picposition="<?php echo $picPosition; ?>" data-nomorcuti="<?php echo $empInfo['nomor_cuti']; ?>" class="btn-primary-email">Proses surat ini</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td></td>
        </tr>
    </table>

</body>

</html>