<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        .customTable {
            border-collapse: collapse;
        }

        .customTable td,
        .customTable th {
            border-bottom: 1px solid #ddd;
            padding: 8px 6px;
            font-size: 12px;
        }

        .customTable th {
            text-align: left;
            vertical-align: baseline;
        }

        .customTable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .lineWrapper {
            border-bottom: 4px double #333;
            padding: 5px 0;
            margin-bottom: 25px;
        }

        .topTitle {
            text-align: center;
            margin: 5px;
        }
    </style>
</head>

<body>
    <div class="lineWrapper">
        <h2 class="topTitle">Laporan Cuti Tahunan</h2>
        <h3 class="topTitle"><?php echo $empName; ?> - <?php echo $empPosition; ?></h3>
        <h5 class="topTitle"><?php echo $empDivision; ?></h5>
    </div>
    <table class="customTable" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Cuti</th>
                <th>Dari Tanggal</th>
                <th>Sampai Tanggal</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Tanggal Diproses</th>
            </tr>
        </thead>
        <tbody>
            <?php $x = 1; for($i = 0; $i < count((array)$listData); $i++){ ?>
            <tr>
                <td><?php echo $x++; ?></td>
                <td><?php echo $listData[$i]->nomor_cuti; ?></td>
                <td><?php echo date_format(date_create($listData[$i]->start_dt), "d M Y"); ?></td>
                <td><?php echo date_format(date_create($listData[$i]->until_dt), "d M Y"); ?></td>
                <td><?php echo $listData[$i]->alasan; ?></td>
                <td><?php echo $listData[$i]->description; ?></td>
                <td><?php echo date_format(date_create($listData[$i]->updated_dt), "d M Y"); ?></td>
            </tr>
            <?php }?>
        </tbody>
    </table>

    <table style="margin-top: 50px;">
        <tr>
            <td style="width:230px;"></td>
            <td style="width:230px;"></td>
            <td style="text-align: center">
                <span style="font-size: 12px;"><?php echo $empName; ?></span><br>
                <img src="<?php echo base_url('assets/img/Signature/').$empSignature; ?>"
                    style="width:100px; height:100px; margin-bottom: 5px;" alt="">
                <p style="font-size: 12px;"><?php echo $empDivision; ?></p>
            </td>
        </tr>
    </table>

</body>

</html>