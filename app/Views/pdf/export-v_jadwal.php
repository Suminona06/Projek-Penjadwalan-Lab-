<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal</title>
    <style>
        .border-table {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 11px;
        }

        .border-table th {
            border: 1 solid #000;
            font-weight: bold;

        }

        .border-table td {
            border: 1 solid #000;
        }

        .tengah {
            text-align: center;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="row text-center">
            <div class="col-lg-14 col-md-12 col-sm-12 tab">
                <h3 class="tengah">Jadwal Praktikum <?= $jenis; ?> Lab UPA-TIK Semester <?php if ($semester == 2) {
                                                                                        echo "Genap";
                                                                                    } else {
                                                                                        echo "Ganjil";
                                                                                    } ?>
                    Tahun Ajaran <?= $thn_awal; ?> -
                    <?= $thn_akhir; ?>
                    Politeknik Negeri Bandung
                </h3>
                <table class="table  border-table table-responsive">
                    <thead class="thead-dark">
                        <tr class='days'>
                            <th rowspan="2" style="text-align: center; vertical-align: middle;">HARI</th>
                            <th rowspan="2" style="text-align: center; vertical-align: middle;">LAB</th>
                            <th colspan="11">Waktu</th>

                        </tr>
                        <tr>
                            <?php foreach ($jam as $j) : ?>
                                <th class="time-2">
                                    <?= esc($j->jam); ?>
                                </th>
                            <?php endforeach; ?>
                        </tr>
                        <!-- hari -->
                        <?php foreach ($hari as $h) : ?>
                            <tr class="time">
                                <th class="time" style="text-align: center; vertical-align: middle;" rowspan="<?= esc($jumlahLab); ?>">
                                    <?= esc($h); ?>
                                </th>
                                <?php $no = 1;
                                foreach ($ruangan as $r) : ?>
                                    <?php if ($no > 1) : ?>
                            <tr>
                            <?php endif; ?>
                            <th class="time">
                                <?= esc($r->nama_ruangan); ?>
                            </th>
                            <?php foreach ($jam as $j) : ?>
                                <?php
                                        $kelas = ''; // Inisialisasi kelas
                                        foreach ($jadwal as $k) {
                                            // Cek apakah jadwal sesuai dengan hari, ruangan, dan jam saat ini
                                            if ($k->hari == $h && $k->id_ruangan == $r->id_ruangan && $k->id_jam == $j->id) {
                                                // Jika sesuai, isi variabel $kelas dengan nilai kolom 'kelas'
                                                $kelas = esc($k->kelas);
                                                break;
                                            }
                                        }
                                ?>
                                <td style='color:black'>
                                    <?= esc($kelas); ?>
                                </td>
                            <?php endforeach; ?>

                            <?php if ($no > 1) : ?>
                            </tr>
                        <?php endif; ?>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>