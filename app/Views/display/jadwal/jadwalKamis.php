<div class="container">
    <div class="row text-center">
        <div class="col-lg-14 col-md-12 col-sm-12 tab">
            <br>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr class='days'>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">HARI</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">LAB</th>
                        <th colspan="11">Waktu</th>

                    </tr>
                    <tr>
                        <?php foreach ($jam as $j): ?>
                            <th class="time-2">
                                <?= esc($j->jam); ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                    <!-- hari3 -->
                    <?php foreach ($hari3 as $h): ?>
                        <tr class="time">
                            <th class="time" style="text-align: center; vertical-align: middle;"
                                rowspan="<?= esc($jumlahLab); ?>">
                                <?= esc($h); ?>
                            </th>
                            <?php $no = 1;
                            foreach ($ruangan as $r): ?>
                                <?php if ($no > 1): ?>
                                <tr>
                                <?php endif; ?>
                                <th class="time">
                                    <?= esc($r->nama_ruangan); ?>
                                </th>
                                <?php foreach ($jam as $j): ?>
                                    <?php
                                    $kelas = ''; // Inisialisasi kelas
                                    foreach ($jadwal as $k) {
                                        // Cek apakah jadwal sesuai dengan hari3, ruangan, dan jam saat ini
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

                                <?php if ($no > 1): ?>
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