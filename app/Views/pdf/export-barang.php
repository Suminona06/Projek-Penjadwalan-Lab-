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
                <th scope="col">Nama barang</th>
                <th scope="col">Serial Number</th>
                <th scope="col">Supplier</th>
                <th scope="col">Brand</th>
                <th scope="col">Model</th>
                <th scope="col">Penanggungjawab</th>
                <th scope="col">Ruangan</th>
            </tr>

        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($barang as $fasilitas): ?>
                <tr class="text-center">
                    <td scope="row-1">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $fasilitas['deskripsi']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['serialnumber']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['supplier']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['brand']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['model']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['penanggungjawab']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['nama_ruangan']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>