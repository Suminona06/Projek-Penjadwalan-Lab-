<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurusan</title>
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
                <th scope="col">Nama Jurusan</th>
            </tr>

        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($jurusan as $row): ?>
                <tr class="text-center">
                    <td scope="row">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $row['nama_jurusan']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>