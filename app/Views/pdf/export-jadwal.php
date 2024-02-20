<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software</title>
    <style>
        .border-table {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
        }

        .border-table th {
            border: 1 solid #000;
            font-weight: bold;

        }

        .border-table td {
            border: 1 solid #000;
        }
    </style>

</head>

<body>
    <table class="border-table">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Mata Kuliah</th>
                <th scope="col">Nama Dosen</th>
                <th scope="col">Kelas</th>
                <th scope="col">Jam</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Ruangan</th>
                <th scope="col">Jenis</th>
                <th scope="col">Hari</th>
                <th scope="col">Tahun</th>
            </tr>
        <tbody>

            <?php
            // Ambil nilai parameter 'page_lab2' dari URL dan konversi ke integer
            $page = intval(request()->getVar('page_jadwal'));

            // Jika parameter tidak ada, atur nilai default ke 1
            if ($page <= 0) {
                $page = 1;
            }

            // Hitung nilai $i
            $i = 1 + (10 * ($page - 1));
            ?>
            <?php foreach ($jadwal as $jadwal): ?>
                <tr class="text-center">
                    <td scope="row">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $jadwal['mk']; ?>
                    </td>
                    <td>
                        <?= $jadwal['nama_dosen']; ?>
                    </td>
                    <td>
                        <?= $jadwal['kelas']; ?>
                    </td>
                    <td>
                        <?= $jadwal['jam']; ?>
                    </td>
                    <td>
                        <?= $jadwal['nama_prodi']; ?>
                    </td>
                    <td>
                        <?= $jadwal['nama_ruangan']; ?>
                    </td>
                    <td>
                        <?= $jadwal['jenis']; ?>
                    </td>
                    <td>
                        <?= $jadwal['hari']; ?>
                    </td>
                    <td>
                        <?= $jadwal['thn_awal']; ?>-
                        <?= $jadwal['thn_akhir']; ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>