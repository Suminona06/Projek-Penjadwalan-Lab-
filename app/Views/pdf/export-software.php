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
                <th scope="col">Gambar</th>
                <th scope="col">Nama Software</th>
                <th scope="col">Jumlah</th>
                <th scope="col"> Ruangan Lab</th>
            </tr>

        <tbody>
            <?php
            // Hitung nilai $i
            $i = 1;
            ?>
            <?php foreach ($model as $fasilitas): ?>
                <tr class="text-center">
                    <td scope="row">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $fasilitas['gambar']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['nama']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['jumlah']; ?>
                    </td>
                    <td>
                        <?= $ruangan['nama_ruangan']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>