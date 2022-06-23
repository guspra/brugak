
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rentang Tanggal</title>
    <link rel="stylesheet" type="text/css" href="assets/panel/plugins/bootstrap/css/bootstrap.min.css">



</head>

<body>
<center>
    <div class="container">
        <h1>Cetak Laporan</h1>
        <br>
        <form action="" method="post">
            <table>
                <tr>
                    <td style="">Dari Tanggal</td>
                    <td width="5px"></td>
                    <td><input type="date" value="<?php echo $current_date; ?>" name="dari_tgl" required="required"></td>
                    <td width="5px"></td>
                    <td style="">Sampai Tanggal</td>
                    <td width="5px"></td>
                    <td><input type="date" value="<?php echo $current_date; ?>" name="sampai_tgl" required="required"></td>
                    <td width="5px"></td>
                    <td style=""><input type="button" class="btn btn-primary" name="filter" id="filter" value="Filter"></td>
                </tr>
            </table>
        </form>
        <br>

        <br>
        <table style="width: 800px;" class="table table-bordered">
            <thead class="" style="">
            <tr style="">
                <th class="" style="text-align: center">No</th>
                <th style="text-align: center">Username</th>
                <th style="text-align: center">Nama Lengkap</th>
                <th style="text-align: center">Tanggal Masuk</th>
                <th style="text-align: center">Whatsapp</th>
                <th style="text-align: center">Aksi</th>
            </tr>
            </thead>

            <?php

            ?>

            <?php foreach ($users as $key => $it) { ?>
                <tr>
                    <td style="text-align: center"><?php echo $key + 1; ?></td>
                    <td style="text-align: center"><?php echo $it->username; ?></td>
                    <td style="text-align: center"><?php echo $it->nama; ?></td>
                    <td style="text-align: center"><?php echo $it->created_at; ?></td>
                    <td style="text-align: center"><?php echo $it->whatsapp; ?></td>
                    <!--                    <td style="text-align: center">--><?php //echo $it->whatsapp; ?><!--</td>-->
                    <td class="btn btn-danger btn-xs" style="align-items: center"><i class="fa fa-print"></i></td>


                </tr>

                <?php
            } ?>


        </table>

    </div>
</center>
</body>
</html>